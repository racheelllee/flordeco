<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Network\Email\Email;

use CompropagoSdk\Client;
use CompropagoSdk\Factory\Factory;
use Cake\Orm\TableRegistry;
use httpClient;
/**
 * Pedidos Controller
 *
 * @property \App\Model\Table\PedidosTable $Pedidos
 */
class PedidosController extends AppController
{
	/**
     * Helpers
     *
     * @var array
     */
    public $helpers = ['Usermgmt.Tinymce', 'Usermgmt.Ckeditor'];
    /**
     * Components
     *
     * @var array
     */
    public $components = ['Usermgmt.Search'];
	/**
	 * This controller uses following default pagination values
	 *
	 * @var array
	 */
	public $paginate = ['limit' => 10];
	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	public $searchFields = [
		'index'=>[
			'Pedidos'=>[
				'Pedidos.id'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Buscar por pedido',
					'model'=>'Pedidos',
					'searchFields'=>'Pedidos.id',
					'condition'=>'=',
					'inputOptions'=>['style'=>'width:125px;']
				],
				'Pedidos.fecha'=>[
                    'type'=>'text',
                    'label'=>'Fecha',
                    'tagline'=>'yyyy-mm-dd',
                    'searchFields'=>'Pedidos.fecha',
                    //'condition'=>'=',
					'inputOptions'=>['class'=>'form-control', 'style'=>'width:100px;']
                ],
                /*
                'Pedidos.ciudad'=>[
                    'type'=>'text',
                    'label'=>'Ciudad',
                    'searchFields'=>'Pedidos.ciudad'
                ],
                */
                'Pedidos.estatus_id'=>[
                    'type'=>'select',
                    'label'=>'Estatus',
                    'model'=>'Estatuses',
                    'selector'=>'getEstatuses'
                ]
			]
		]
	];
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $conditions = [];

        if ($this->UserAuth->getGroupId() == 5) {
            $conditions[] = ['Pedidos.asociado_id' => $this->UserAuth->getUserId()];
        }

        $this->paginate = ['searchFilter'=>true,
          				    'contain' => ['Formasdepagos','Estatuses','Zona'],
                            'limit'=>10,
                            'order'=>['Pedidos.fecha'=>'DESC']
                            ];

		$this->Search->applySearch($conditions);
        $pedidos = $this->paginate($this->Pedidos)->toArray();
        $this->set(compact('pedidos'));

        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_pedidos');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Pedido id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => ['Users', 'Formasdepagos', 'Estatuses', 'Zona', 'Partidas.PartidaProductos.Imagenes', 'PedidosComentarios', 'PedidosComentarios.Users']
        ]);

        if ($this->UserAuth->getGroupId() == 5 && $pedido->asociado_id != $this->UserAuth->getUserId()) {
            return $this->redirect('/pedidos/index/');
        }

        $estatuses = $this->Pedidos->Estatuses->find('list', ['conditions'=>['Estatuses.id != 2']]);
        $asociados = $this->Pedidos->Users->find()
            ->where(['user_group_id' => 5])
            ->orWhere(['user_group_id like ' => '5,%'])
            ->orWhere(['user_group_id like ' => '%,5,%'])
            ->orWhere(['user_group_id like ' => '%,5'])
            ->combine('id', 'first_name')
            ->toArray();

        if( strlen( $pedido->session_id) > 0   ){

            //pedido en modo invitado

            // Busco direcciones.

            $this->loadModel('Direcciones');
            $this->loadModel('Direccionesfiscales');

            $direccionInvitado = $this->Direcciones->find( 'all', [ 'conditions' =>  [  'Direcciones.session_id' => $pedido->session_id   ] ] )->first();

            $direccionFactura = $this->Direccionesfiscales->find( 'all', ['conditions' => ['Direccionesfiscales.session_id' => $pedido->session_id ] ] )->first();


            $this->set('direccionInvitado', $direccionInvitado);
            $this->set('direccionFactura', $direccionFactura);

        }

        if ($this->request->is('post')) {
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->data);
            $pedido['modified']=date('Y-m-d H:i:s');

            $logeado = $this->UserAuth->getUser();
            $estatus = $estatuses->toArray();

            $comentario = $this->Pedidos->PedidosComentarios->newEntity();
            $comentario->pedido_id = $pedido->id;
            $comentario->usuario_id = $logeado['User']['id'];
            $comentario->mensaje = 'Estatus de Pedido: '.$estatus[$pedido->estatus_id];
            $comentario->created = $pedido['modified'];


            if($pedido->estatus_id == 7){
                $usuario = $this->Pedidos->Users->get($pedido['cliente_id']);

                $usuario['clienteestatus_id']  = 3;

                $this->Pedidos->Users->save($usuario);
            }

            if($pedido->estatus_id == 5){ // ENTREGADO
                $pedido->puntos_acumulados = round($pedido->monto * (PORCENTAJE_PUNTOS_PEDIDO/100));
                $pedido->puntos_acumulados_porcentaje = PORCENTAJE_PUNTOS_PEDIDO;

                $cliente = $this->Pedidos->Users->get($pedido->user->id);
                $cliente->puntos_acumulados += $pedido->puntos_acumulados;
                $cliente->puntos += $pedido->puntos_acumulados;

                $this->Pedidos->Users->save($cliente);
            }

            if($pedido->estatus_id == 6){ // CANCELADO
                $cliente = $this->Pedidos->Users->get($pedido->user->id);
                $cliente->puntos_aplicados -= $pedido->puntos_aplicados;
                $cliente->puntos += $pedido->puntos_aplicados;

                $this->Pedidos->Users->save($cliente);
            }

            if ($this->Pedidos->save($pedido)) {

                $this->Pedidos->PedidosComentarios->save($comentario);

                //Ahora envio el correo que coresponda:
                if(($pedido->estatus_id != $this->request->data['old_status_id']) && ($pedido->estatus_id != 7)){
                    //$this->enviacorreo($pedido->id);
                    $pedido->estatus = $this->Pedidos->Estatuses->get($pedido->estatus_id);
                    $this->Pedidos->sendEstatusPedido($pedido);
                }

                $this->Flash->success(__('El estatus del pedido se ha actualizado.'));
                return $this->redirect('/pedidos/view/'.$id);
            } else {
                $this->Flash->error(__('El estatus del pedido no se pudo actualizar.'));
            }
        }
        $this->loadModel('PedidoCobroExtras');

        $cobrosExtras = $this->PedidoCobroExtras->find('all',
                ['conditions'=>['PedidoCobroExtras.pedido_id'=>$pedido->id],
                'contain'=>['Usuarios']])->toArray();



        $this->set('pedido', $pedido);
        $this->set('estatuses', $estatuses);
        $this->set('cobrosExtras', $cobrosExtras);
        $this->set('asociados', $asociados);
        $this->set('_serialize', ['pedido']);

        if ($this->UserAuth->getGroupId() == 5) {
            $estatusesAsociado = $this->Pedidos->Estatuses->find('list', ['conditions'=>['Estatuses.id'=>5]]);
            $this->set('estatusesAsociado', $estatusesAsociado);
            $this->render('view_asociado');
        }
    }


    public function guardar_datos_envio()
    {
        if ($this->request->is('post')) {
            if($this->request->data['fecha_entrega'] != ''){
               $this->request->data['fecha_entrega'] = date('Y-m-d', strtotime($this->request->data['fecha_entrega']));
            }

            $pedido = $this->Pedidos->get($this->request->data['id']);

            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->data);

            if ($this->Pedidos->save($pedido)) {
                $this->Flash->success(__('Se guardaron los datos de envio.'));
                return $this->redirect('/pedidos/view/'.$this->request->data['id']);
            } else {
                $this->Flash->error(__('Los datos de envio no se pudieron guardar.'));
            }


        }
    }

    public function aplicarCargoExtra(){


        $cobrosExtras = TableRegistry::get('pedido_cobro_extras')->newEntity();

        if ($this->request->is('post')) {

            require_once(ROOT.DS.'vendor'.DS.'banorte/http_client.php');

            $http = new httpClient();

            $http->Connect("via.banorte.com", 443) or die("Connect problem");

            $params = [
                'ID_AFILIACION' => '7139227',
                'CLAVE_USR' => 'flor9227',
                'USER' => 'a7139227',
                'MODE' => 'AUT', //PRD,AUT,DEC
                'CMD_TRANS' => 'VENTA',
                'ID_TERMINAL' => '71392271',
                'MODO_ENTRADA' => 'MANUAL',

                'MONTO' => $this->request->data['monto'],
                'NUMERO_TARJETA' => $this->request->data['no_tarjeta'], //'5454545454545454',
                'FECHA_EXP' => $this->request->data['fecha_ex_mes'].'/'.$this->request->data['fecha_ex_year'], //'01/20',
                'CODIGO_SEGURIDAD' => $this->request->data['no_seguridad']
            ];

            $status = $http->Post('/payw2', $params);

            $cobrosExtras->monto = $this->request->data['monto'];
            $cobrosExtras->comentario = $this->request->data['comentario'];
            $cobrosExtras->nombre_completo = $this->request->data['nombre_completo'];
            $cobrosExtras->no_tarjeta = $this->request->data['no_tarjeta'];
            $cobrosExtras->pedido_id = $this->request->data['pedido_id'];
            $cobrosExtras->created = date('Y-m-d H:i:s');

            if ($status != 200) {
                //debug($http->getBody());
            } else {

                $response = [
                  'ResponseCode' => $status,
                  'RESULTADO_PAYW' => $http->getHeader('RESULTADO_PAYW'),
                  'ID_AFILIACION' => $http->getHeader('ID_AFILIACION'),
                  'FECHA_RSP_CTE' => $http->getHeader('FECHA_RSP_CTE'),
                  'CODIGO_AUT' => $http->getHeader('CODIGO_AUT'),
                  'REFERENCIA' => $http->getHeader('REFERENCIA'),
                  'TEXTO' => $http->getHeader('TEXTO'),
                  'FECHA_REQ_CTE' => $http->getHeader('FECHA_REQ_CTE')
                ];

                $cobrosExtras->usuario_id  = $this->UserAuth->getUserId();

                foreach($response as $k => $v){
                    $cobrosExtras->respuesta_pago .= $k." : ".$v."\n";
                }

                if (TableRegistry::get('pedido_cobro_extras')->save($cobrosExtras)) {
                    $this->Flash->success(__('Se guardaron los Cobros Extras.'));
                    return $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('Los datos no se pudieron guardar.'));
                }
            }

            $http->Disconnect();

        }

    }


    public function agregar_comentario()
    {
        if ($this->request->is('post')) {

            $logeado = $this->UserAuth->getUser();
            $comentario = $this->Pedidos->PedidosComentarios->newEntity();
            $comentario = $this->Pedidos->PedidosComentarios->patchEntity($comentario, $this->request->data);

            $comentario->usuario_id = $logeado['User']['id'];
            $comentario->created = date('Y-m-d H:m:s');

            if ($this->Pedidos->PedidosComentarios->save($comentario)) {
                $this->Flash->success(__('Se ha agregado el comentario.'));

            } else {
                $this->Flash->error(__('El comentario no se pudo agregar.'));
            }

            return $this->redirect('/pedidos/view/'.$this->request->data['pedido_id']);
        }
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pedido = $this->Pedidos->newEntity();
        if ($this->request->is('post')) {
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->data);
            if ($this->Pedidos->save($pedido)) {
                $this->Flash->success(__('The pedido has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pedido could not be saved. Please, try again.'));
            }
        }
        $clientes = $this->Pedidos->Clientes->find('list', ['limit' => 200]);
        $formasdepagos = $this->Pedidos->Formasdepagos->find('list', ['limit' => 200]);
        $estatuses = $this->Pedidos->Estatuses->find('list', ['limit' => 200]);
        $municipios = $this->Pedidos->Municipios->find('list', ['limit' => 200]);
        $estados = $this->Pedidos->Estados->find('list', ['limit' => 200]);
        $paises = $this->Pedidos->Paises->find('list', ['limit' => 200]);
        $this->set(compact('pedido', 'clientes', 'formasdepagos', 'estatuses', 'municipios', 'estados', 'paises'));
        $this->set('_serialize', ['pedido']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pedido id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->data);

$cliente = $this->Pedidos->Users->get($pedido->cliente_id);
$partidas = $this->Pedidos->Partidas->find('all',['conditions'=>['pedido_id'=>$pedido->id]]);


            if ($this->Pedidos->save($pedido)) {
                $this->Flash->success(__('El pedido ha sido editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El pedido no pudo ser editado, intente de nuevo.'));
            }
        }

        $formasdepagos = $this->Pedidos->Formasdepagos->find('list', ['limit' => 200]);
        $estatuses = $this->Pedidos->Estatuses->find('list', ['limit' => 200]);
        $municipios = $this->Pedidos->Municipios->find('list', ['limit' => 200]);
        $estados = $this->Pedidos->Estados->find('list', ['limit' => 200]);
        $paises = $this->Pedidos->Paises->find('list', ['limit' => 200]);
        $this->set(compact('pedido', 'formasdepagos', 'estatuses', 'municipios', 'estados', 'paises'));
        $this->set('_serialize', ['pedido']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pedido id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pedido = $this->Pedidos->get($id);
        if ($this->Pedidos->delete($pedido)) {
            $this->Flash->success(__('The pedido has been deleted.'));
        } else {
            $this->Flash->error(__('The pedido could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function enviacorreo($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => ['Estatuses']
        ]);

        $cliente = $this->Pedidos->Users->get($pedido->cliente_id);
        $partidas = $this->Pedidos->Partidas->find('all',['conditions'=>['pedido_id'=>$pedido->id]]);
        $titulo="";
        if($pedido->estatus->envia_correo){

            $titulo=$pedido->estatus->titulo;
            $texto=$pedido->estatus->mensaje;

            if($pedido->estatus_id==4){

                $texto.="PAQUETERIA:   ".$pedido->paqueteria."                                           NUM DE GUIA: ".$pedido->guia_de_envio."
                        <br>Si necesitas  rastrear  el paquete, consulta en la página que corresponde:<br>
                        Paquete Express - http://www.paquetexpress.com.mx/
                        Estafeta:  http://www.estafeta.com/

                        Continuamos al pendiente de tu pedido.";
            }elseif($pedido->estatus_id==5){
                $texto.="Tu pedido fue entregado el  ".$pedido->fecha_entrega." y recibido por  ".$pedido->recibido_por.".";
            }
            $email = new Email('default');
            $email->template('statuspedido')
            ->emailFormat('html')
            ->to($pedido->correo_electronico)
            ->from([EMAIL_FROM_ADDRESS => EMAIL_FROM_NAME])
            ->subject($titulo)
            ->viewVars(['status'=>$pedido->estatus->nombre,'texto'=>$texto,'pedido' => $pedido,'cliente' => $cliente,'partidas' => $partidas])
            ->send();
        }
        return true;
    }

    public function wh_compropago()
    {
		$request = @file_get_contents('php://input');
//error_log('$request:'.print_r($request, true).PHP_EOL, 3, LOGS.'/webhook_compropago.log');
		header('Content-Type: application/json');

		$resp_webhook = Factory::getInstanceOf('CpOrderInfo', $request);
//error_log('$resp_webhook:'.print_r($resp_webhook, true).PHP_EOL, 3, LOGS.'/webhook_compropago.log');

		if(!$resp_webhook || $resp_webhook->id == ''){
		    echo json_encode([
		      "status" => "error",
		      "message" => "invalid request",
		      "short_id" => null,
		      "reference" => null
		    ]);
		    exit();
		}

		try{
		    $client = new Client(
		    			'pk_test_529d4303602446fd41',  # publickey
					    'sk_test_67988030472248728d',  # privatekey
					    false                          # live
		    		  );

		    if($resp_webhook->id == "ch_00000-000-0000-000000"){
		        echo json_encode([
		          "status" => "success",
		          "message" => "test suappccess",
		          "short_id" => $resp_webhook->short_id,
		          "reference" => null
		        ]);
		        exit();
		    }

		    $response = $client->api->verifyOrder($resp_webhook->id);
//error_log('$response:'.print_r($response, true).PHP_EOL, 3, LOGS.'/webhook_compropago.log');
		    switch ($response->type){
		        case 'charge.success':
		            // TODO: Actions on success payment
		            $pedido = $this->Pedidos->find('all', array(
                								   			'conditions'=>array('Pedidos.respuesta_pago_id ='=>$response->id),
                								   			'contain' => ['Users', 'Formasdepagos', 'Estatuses', 'Zona',/*'Municipios', 'Paises',*/ 'Partidas', 'PedidosComentarios', 'PedidosComentarios.Users'/*, 'Sucursales'*/]
                								   ))->first();
					if ($pedido)
					{
						$pedido['estatus_id'] = 3;
						$this->Pedidos->save($pedido);
	                    $pedido->estatus = $this->Pedidos->Estatuses->get($pedido['estatus_id']);
	                    $this->Pedidos->sendEstatusPedido($pedido);
					}
		            break;
		        case 'charge.pending':
		            // TODO: Actions on pending payment
		            break;
		        case 'charge.expired':
		            // TODO: Actions on expired payment
		            $pedido = $this->Pedidos->find('all', array(
                								   			'conditions'=>array('Pedidos.respuesta_pago_id ='=>$response->id),
                								   			'contain' => ['Users', 'Formasdepagos', 'Estatuses', 'Zona',/*'Municipios', 'Paises',*/ 'Partidas', 'PedidosComentarios', 'PedidosComentarios.Users'/*, 'Sucursales'*/]
                								   ))->first();
					if ($pedido)
					{
						$pedido['estatus_id'] = 6;
						$this->Pedidos->save($pedido);
	                    $pedido->estatus = $this->Pedidos->Estatuses->get($pedido['estatus_id']);
	                    $this->Pedidos->sendEstatusPedido($pedido);
					}
		            break;
		        default:
		            echo json_encode([
		              "status" => "error",
		              "message" => "invalid request type",
		              "short_id" => $response->short_id,
		              "reference" => null
		            ]);
		            exit();
		    }

		    echo json_encode([
		      "status" => "success",
		      "message" => "OK",
		      "short_id" => $response->short_id,
		      "reference" => 'internal-1234'
		    ]);
		}catch (Exception $e) {
		    echo json_encode([
		      "status" => "error",
		      "message" => $e->getMessage(),
		      "short_id" => $resp_webhook->short_id,
		      "reference" => null
		    ]);
		}
		exit;
    }

    public function wh_conekta()
    {
    	$body = @file_get_contents('php://input');
//error_log('$body:'.print_r($body, true).PHP_EOL, 3, LOGS.'/webhook_conekta.log');

		$data = json_decode($body);
//error_log('$data:'.print_r($data, true).PHP_EOL, 3, LOGS.'/webhook_conekta.log');

		if ($data->type == 'charge.paid' || $data->type == 'order.paid')
		{
			$pedido = $this->Pedidos->find('all', array(
        								   			'conditions'=>array('Pedidos.respuesta_pago_id ='=>$data->data->object->id),
        								   			'contain' => ['Users', 'Formasdepagos', 'Estatuses', 'Zona',/*'Municipios', 'Paises',*/ 'Partidas', 'PedidosComentarios', 'PedidosComentarios.Users'/*, 'Sucursales'*/]
        								   ))->first();
			if ($pedido)
			{
				$pedido['estatus_id'] = 3;
				$this->Pedidos->save($pedido);
                $pedido->estatus = $this->Pedidos->Estatuses->get($pedido['estatus_id']);
                $this->Pedidos->sendEstatusPedido($pedido);
			}
		}
		elseif ($data->type == 'charge.chargeback.lost')
		{
			$pedido = $this->Pedidos->find('all', array(
        								   			'conditions'=>array('Pedidos.respuesta_pago_id ='=>$data->data->object->id),
        								   			'contain' => ['Users', 'Formasdepagos', 'Estatuses', 'Zona',/*'Municipios', 'Paises',*/ 'Partidas', 'PedidosComentarios', 'PedidosComentarios.Users'/*, 'Sucursales'*/]
        								   ))->first();
			if ($pedido)
			{
				$pedido['estatus_id'] = 6;
				$this->Pedidos->save($pedido);
                $pedido->estatus = $this->Pedidos->Estatuses->get($pedido['estatus_id']);
                $this->Pedidos->sendEstatusPedido($pedido);
			}
		}

		http_response_code(200); // Return 200 OK
		exit;
    }
}
