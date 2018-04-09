<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Promociones Controller
 *
 * @property \App\Model\Table\PromocionesTable $Promociones
 */

class PromocionesController extends AppController
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
     * Paginate
     *
     * @var array
     */
    public $paginate = ['limit' => '25'];

	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	public $searchFields = [
		'index'=>[
			'Promociones'=>[
				'Promociones'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Promociones.nombre'],
					'inputOptions'=>['style'=>'width:300px;']
				],

                'Promociones.fecha_inicio'=>[
                    'type'=>'text',
                    'label'=>'Desde',
                    'model'=>'Promociones',
                    'inputOptions'=>['id'=>"datepicker1"]
                ],
                'Promociones.fecha_fin'=>[
                    'type'=>'text',
                    'label'=>'Hasta',
                    'model'=>'Promociones',
                    'inputOptions'=>['id'=>"datepicker2"]

                ],
			]
		]
	];
	

    public function beforeFilter(Event $event){
        if($this->request->params['action']=='index'){

            $sesion=$this->request->session();
            //debug($sesion->read('UserAuth.Search.Promociones.index.Promociones'));


            $this->fecha_inicio='';
            if(isset($this->request->data['Promociones']['fecha_inicio'])){
                //debug($this->request->data['Categorias']['id']);
                $this->fecha_inicio=$this->request->data['Promociones']['fecha_inicio'];
                unset($this->request->data['Promociones']['fecha_inicio']);
            }else{
                
                $fecha_inicio=$sesion->read('UserAuth.Search.Promociones.index.Promociones.fecha_inicio');
                if(!is_null($fecha_inicio)){
                    //debug($categorias['id']);
                    $this->fecha_inicio=$fecha_inicio;
                    
                    $sesion->delete('UserAuth.Search.Promociones.index.Promociones.fecha_inicio');
                }
            }


            $this->fecha_fin='';
            if(isset($this->request->data['Promociones']['fecha_fin'])){
                //debug($this->request->data['Categorias']['id']);
                $this->fecha_fin=$this->request->data['Promociones']['fecha_fin'];
                unset($this->request->data['Promociones']['fecha_fin']);
            }else{
                
                $fecha_fin=$sesion->read('UserAuth.Search.Promociones.index.Promociones.fecha_fin');
                if(!is_null($fecha_fin)){
                    //debug($categorias['id']);
                    $this->fecha_fin=$fecha_fin;
                    
                    $sesion->delete('UserAuth.Search.Promociones.index.Promociones.fecha_fin');
                }
            }



            if(isset($this->request->data['search_clear']) && $this->request->data['search_clear'] ==1){
                $this->fecha_inicio='';
                $this->fecha_fin='';
            }
            //debug($this->categoria_id);
            //$sesion->delete('UserAuth.Search.Productos.masiva');
            //debug($this->request->data);
        }

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $this->paginate = ['limit'=>10, 'order'=>['Promociones.id'=>'DESC']];

        $conditions=[];

        if(!is_null($this->fecha_inicio) && $this->fecha_inicio !='' && !is_null($this->fecha_fin) && $this->fecha_fin !=''){
                $conditions=['Promociones.fecha_inicio >=' => $this->fecha_inicio,
                             'Promociones.fecha_fin <=' => $this->fecha_fin];     
                //$this->Search->applySearch($conditions);
            }

            $this->Search->applySearch($conditions);
            $this->request->data['fecha_inicio']='';
            $this->request->data['fecha_fin']='';
            if(!is_null($this->fecha_inicio) && $this->fecha_inicio !='' && !is_null($this->fecha_fin) && $this->fecha_fin !=''){
                $sesion=$this->request->session();
                $sesion->write('UserAuth.Search.Promociones.index.Promociones.fecha_inicio',$this->fecha_inicio);
                $sesion->write('UserAuth.Search.Promociones.index.Promociones.fecha_fin',$this->fecha_fin);
                $this->request->data['fecha_inicio']=$this->fecha_inicio;
                $this->request->data['fecha_fin']=$this->fecha_fin;

            }

        $promociones = $this->paginate($this->Promociones)->toArray();
        $this->set(compact('promociones'));
        $this->set('fecha_fin',$this->request->data['fecha_fin']);
        $this->set('fecha_inicio',$this->request->data['fecha_inicio']);
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_promociones');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Promocion id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promocion = $this->Promociones->get($id, [
            'contain' => ['Usuarios', 'Productos']
        ]);

        $this->set('promocion', $promocion);
        $this->set('_serialize', ['promocion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $promocion = $this->Promociones->newEntity();
        if ($this->request->is('post')) {
            
            $logeado = $this->UserAuth->getUser();
            $promocion = $this->Promociones->patchEntity($promocion, $this->request->data);
            $promocion['fecha_inicio'] = date('Y-m-d', strtotime($this->request->data['fecha_inicio']));
            $promocion['fecha_fin'] = date('Y-m-d', strtotime($this->request->data['fecha_fin']));
            $promocion['usuario_id'] = $logeado['User']['id'];


            
            if ($this->Promociones->save($promocion)) {

                if(isset($this->request->data['asignar_producto'])){
                    
                    $this->loadModel('ProductosPromociones');
                    $asignar_promocion = $this->ProductosPromociones->newEntity();
                    $asignar_promocion['promocion_id'] = $promocion['id'];
                    $asignar_promocion['producto_id'] = $this->request->data['asignar_producto'];

                        $this->ProductosPromociones->save($asignar_promocion);
                        $this->Flash->success(__('Se asigno la promocion correctamente.'));
                        return $this->redirect(['action' => 'producto_promocion', $this->request->data['asignar_producto']]);
                    
                }else{
                    $this->Flash->success(__('La promocion se guardo.'));
                    return $this->redirect(['action' => 'index']);
                }
                    
            } else {
                $this->Flash->error(__('La promocion no se pudo guardar.'));
            }
        }
        $usuarios = $this->Promociones->Usuarios->find('list', ['limit' => 200]);
        $productos = $this->Promociones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('promocion', 'usuarios', 'productos'));
        $this->set('_serialize', ['promocion']);
    }


    public function producto_promocion($producto_id = null)
    {

        $this->loadModel('ProductosPromociones');
        $promocion = $this->ProductosPromociones->newEntity();
        $nueva_promocion = $this->Promociones->newEntity();

        $promociones = $this->Promociones->find('list');

        $this->loadModel('Productos');
        $producto = $this->Productos->get($producto_id, ['contain' => ['Proveedores']]);
       

        $promociones_productos = $this->ProductosPromociones->find('all', ['conditions'=>['ProductosPromociones.producto_id'=>$producto_id], 'contain'=>['Promociones']]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promocion = $this->ProductosPromociones->patchEntity($promocion, $this->request->data);

            if ($this->ProductosPromociones->save($promocion)) {
                $this->Flash->success(__('Se asigno la promocion correctamente.'));
                return $this->redirect(['action' => 'producto_promocion', $producto_id]);
            } else {
                $this->Flash->error(__('No se pudo asignar la promocion.'));
            }
        }



        if($producto->envio>0){

            $envio->precio = $producto->envio;
        }else{

                $peso = $producto->peso;
                $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);
    
                $this->loadModel('Enviotarifas');
                $tarifa_peso = $this->Enviotarifas->find('all', array(
                        'conditions'=>array($this->distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                            $peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                //$tarifa_peso->precio
            
                $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                        'conditions'=>array($this->distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                            'cubicaje >=' => $cubicaje),
                        'order' => 'cubicaje ASC'))->first();
               
                
                if(is_null($tarifa_peso)){
                    $tarifa_peso->precio=0;
                }
                if(is_null($tarifa_cubicaje)){
                    $tarifa_cubicaje->precio=0;
                }

                if($tarifa_peso->tarifa == 7){
                    $tarifa_peso->precio =  $peso * $tarifa_peso->precio_kilo; 
                }

                if($tarifa_cubicaje->tarifa == 7){
                    $tarifa_cubicaje->precio =  $cubicaje * $tarifa_cubicaje->precio; 
                }


                if($tarifa_peso->precio > $tarifa_cubicaje->precio)
                {
                  $envio =   $tarifa_peso;
                }else{
                    $envio =   $tarifa_cubicaje;
                }

                if(!$producto->envio_gratis){
                $envio->precio =0;
                }
                //debug($cubicaje);
                //debug($tarifa_peso); debug($tarifa_peso->precio); debug($tarifa_cubicaje);
                //debug($tarifa_cubicaje->precio);
        }

        $this->set('envio', $envio);

        
        $this->set(compact('promocion','promociones', 'producto_id', 'promociones_productos', 'producto', 'nueva_promocion'));
        $this->set('_serialize', ['promocion']);

        $this->render(null,'iframe');
    }

    public function eliminar_promocion($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $this->loadModel('ProductosPromociones');

        $promocion = $this->ProductosPromociones->get($id);

        if ($this->ProductosPromociones->delete($promocion)) {
            $this->Flash->success(__('La promocion se elimino del producto.'));
            return $this->redirect(['action' => 'producto_promocion', $promocion->producto_id]);
        } else {
            $this->Flash->error(__('La promocion no se puedo eliminar.'));
        }
        return $this->redirect(['action' => 'index']);

        $this->render(null,'iframe');
    }
    /**
     * Edit method
     *
     * @param string|null $id Promocion id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $palabra = null, $categoria = null, $proveedor = null, $marca = null)
    {
        $promocion = $this->Promociones->get($id, [
            'contain' => ['Productos']
        ]);

        $promocion['fecha_inicio'] = $promocion->fecha_inicio->i18nFormat('dd-MM-YYYY');
        $promocion['fecha_fin'] = $promocion->fecha_fin->i18nFormat('dd-MM-YYYY');
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promocion = $this->Promociones->patchEntity($promocion, $this->request->data);

            $promocion['fecha_inicio'] = date('Y-m-d', strtotime($this->request->data['fecha_inicio']));
            $promocion['fecha_fin'] = date('Y-m-d', strtotime($this->request->data['fecha_fin']));

            if ($this->Promociones->save($promocion)) {
                $this->Flash->success(__('Los cambios de la promocion se guardaron.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios de la promocion no se pudieron guardar.'));
            }
        }

        $productos_promociones = $this->Promociones->ProductosPromociones->find('all', ['conditions'=>['promocion_id'=>$id], 'contain'=>['Productos', 'Productos.Marcas']]);

        //die(debug($productos_promociones->toArray()));
    
        $usuarios = $this->Promociones->Usuarios->find('list', ['limit' => 200]);
        $productos = $this->Promociones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('promocion', 'usuarios', 'productos', 'productos_promociones'));


        // BUSQUEDA
        $this->loadModel('Productos');
        $conditions = array();
        $busca = 1;
        if($palabra != 'null'){
            $conditions['AND'][] = array('Productos.nombre LIKE' => '%'.$palabra.'%');
            $busca = 1;
        }
        if($proveedor != 'null'){
            $conditions['AND'][] = array('Productos.proveedor_id' => $proveedor);
            $busca = 1;
        }
        if($marca != 'null'){
            $conditions['AND'][] = array('Productos.marca_id' => $marca);
            $busca = 1;
        }
        $conditions['AND'][]= array('Productos.estatus_id'=>1);

        $busqueda_productos = array();
        if($busca == 1 AND $categoria == 'null'){
            $busqueda_productos = $this->Productos->find('all', ['conditions'=>$conditions]); 
        
        }elseif($categoria != 'null'){
           
            $busqueda_productos = $this->Productos->find('all', ['conditions'=>$conditions, 'contain'=>['CategoriasProductos']])->matching(
            'CategoriasProductos', function ($q) use ($categoria) {
            
            return $q->where(['CategoriasProductos.categoria_id' => $categoria]);
            
            });
        }



        $this->loadModel('Categorias');
        $categorias = $this->Categorias->find('treeList', ['spacer' => '-']);
        $this->loadModel('Marcas');
        $marcas = $this->Marcas->find('list',['order'=>'nombre']);
        $this->loadModel('Proveedores');
        $proveedores = $this->Proveedores->find('list',['order'=>'nombre']);

        $this->set(compact('busqueda_productos', 'categorias', 'marcas', 'proveedores'));






        $this->set('_serialize', ['promocion']);
    }



    public function add_producto($promocion_id)
    {
        if ($this->request->is('post')) {

            $this->loadModel('ProductosPromociones');


            for ($i=0; $i < count($this->request->data['producto_relacionados']); $i++) { 
             
                    
                
                    $ProductosPromocion = $this->ProductosPromociones->newEntity();

                    $ProductosPromocion->producto_id = $this->request->data['producto_relacionados'][$i];
                    $ProductosPromocion->promocion_id = $promocion_id;
                    
                    
                    $error = $ProductosPromocion->errors();

                   
                    $this->ProductosPromociones->save($ProductosPromocion);

               
                
            }

            die(json_encode($ProductosPromocion));
        }
    }


     public function edit_promocion_producto()
    {
        
        if ($this->request->is('post')) {
            
            $promocion = $this->Promociones->get($this->request->data['id']);

            $promocion = $this->Promociones->patchEntity($promocion, $this->request->data);

            $promocion['fecha_inicio'] = date('Y-m-d', strtotime($this->request->data['fecha_inicio']));
            $promocion['fecha_fin'] = date('Y-m-d', strtotime($this->request->data['fecha_fin']));


            if ($this->Promociones->save($promocion)) {
                $this->Flash->success(__('Los cambios de la promocion se guardaron.'));
                return $this->redirect('/promociones/producto_promocion/'.$this->request->data['asignar_producto']);
            } else {
                $this->Flash->error(__('Los cambios de la promocion no se pudieron guardar.'));
            }
        }
    }


    public function busqueda_promocion()
    {
        if ($this->request->is('post')) {

            $promocion = $this->Promociones->get($this->request->data['promocion_id']);

            $promocion['fecha_inicio'] = $promocion->fecha_inicio->i18nFormat('dd-MM-YYYY');
            $promocion['fecha_fin'] = $promocion->fecha_fin->i18nFormat('dd-MM-YYYY');

            die(json_encode($promocion));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Promocion id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $promocion = $this->Promociones->get($id);
        if ($this->Promociones->delete($promocion)) {
            $this->Flash->success(__('The promocion has been deleted.'));
        } else {
            $this->Flash->error(__('The promocion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
