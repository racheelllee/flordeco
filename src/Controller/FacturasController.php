<?php
namespace App\Controller;

use App\Controller\AppController;

use Usermgmt\Controller\UsermgmtAppController;
use Cake\View\CellTrait; 
use Cake\Mailer\Email;
use Cake\Orm\TableRegistry;

/**
 * Facturas Controller
 * @accesslevel 1
 * @property \App\Model\Table\FacturasTable $Facturas
 */
class FacturasController extends AppController
{
	use CellTrait;

	 /**
     * Helpers
     *
     * @var array
     */
    public $helpers = ['Usermgmt.Tinymce', 'Usermgmt.Ckeditor','Usermgmt.Search'];

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
    public $paginate = ['limit' => '100'];


    /**
     * This controller uses search filters in following functions for ex index, online function
     *
     * @var array
     */
    public $searchFields = [
        'index'=>[
            'Facturas'=>[
                'Facturas'=>[
                    'type'=>'text',
                    'label'=>'Buscar',
                    'tagline'=>'<br>Busca por ID',
                    'condition'=>'multiple',
                    'searchFields'=>['Facturas.id'],
                    'inputOptions'=>['style'=>'width:300px;']
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
        $this->paginate = ['limit'=>10, 'order'=>['Facturas.id'=>'DESC']];
        $this->Search->applySearch();
        $facturas = $this->paginate($this->Facturas)->toArray();
        $this->set(compact('facturas'));

        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
            $this->render('/Element/all_facturas');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Factura id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $factura = $this->Facturas->get($id, [
            'contain' => ['Cotizacions', 'Cargos', 'Customers']
        ]);
        $this->set('factura', $factura);
        $this->set('_serialize', ['factura']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function add($cotizacion_id = 0, $cliente_id = 0)
    {
        $this->loadModel('Monedas');

        $cotizacion = $this->Facturas->Cotizaciones->get($cotizacion_id, [
            'contain'=>[
                'Monedas',
                'Customers',
                'Cargos'
            ]
        ]); 

        $montoTotalPesos = $cotizacion->monto_total;
        if (strtolower($cotizacion->moneda->name) == 'usd' && $cotizacion->tipo_cambio != 0) { // Si son dólares
            $montoTotalPesos = $cotizacion->monto_total * $cotizacion->tipo_cambio;
        }

        $factura = $this->Facturas->newEntity();
        if ($this->request->is('post')) {
            $factura = $this->Facturas->patchEntity($factura, $this->request->data);
            $factura->cotizacion_id = $cotizacion_id;
            $factura->cargo_id = $cotizacion->cargo_id;
            $factura->customer_id = $cliente_id;
            
            if ($this->Facturas->save($factura)) {
                if (isset($this->request->data['ajuste']) && $this->request->data['ajuste']) {
                    $ajuste = $this->Facturas->newEntity();
                    $ajuste = $this->Facturas->patchEntity($ajuste, $this->request->data);
                    $ajuste->padre = $factura->id;
                    $ajuste->user_id = $this->UserAuth->getUserId();
                    $ajuste->moneda_id = 1;
                    $ajuste->por_ajuste = 1;
                    $ajuste->tipo_cambio = 0;
                    $ajuste->cotizacion_id = $cotizacion->id;
                    $ajuste->customer_id = $cliente_id;
                    $ajuste->cargo_id = $cotizacion->cargo_id;
                    $ajuste->importe = $this->request->data['ajuste_por_cambio'];
                    $this->Facturas->save($ajuste);
                }
                $this->Flash->success(__('La factura se guardo.'));
                if($cliente_id == 0){
                        return $this->redirect(['action' => 'index']); 
                } else {
                    return $this->redirect('/customers/customers/view/'.$cliente_id.'/facturas');
                }
            } else {
                $this->Flash->error(__('La factura no se pudo guardar. Intentalo de nuevo.'));
            }
        }

        $monedas = $this->Monedas->find('list');

        $this->set(compact('factura', 'cotizacion', 'monedas', 'montoTotalPesos'));
        $this->set('_serialize', ['factura']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function edit($id = null, $cliente_id = 0)
    {
        $this->loadModel('Monedas');

        $factura = $this->Facturas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $factura = $this->Facturas->patchEntity($factura, $this->request->data);
            if ($this->Facturas->save($factura)) {
                $this->Flash->success(__('La factura se guardo.'));
                
                if($cliente_id == 0){
                        return $this->redirect(['action' => 'index']); 
                }else{
                    return $this->redirect('/customers/customers/view/'.$cliente_id.'/facturas');
                }

            } else {
                $this->Flash->error(__('La factura no se pudo guardar. Intentalo de nuevo.'));
            }
        }
        $cotizacion = $this->Facturas->Cotizaciones->get($factura->cotizacion_id, [
            'contain'=>[
                'Monedas',
                'Customers',
                'Cargos'
            ]
        ]);
        $monedas = $this->Monedas->find('list');

        $this->set(compact('factura', 'cotizacion', 'monedas'));
        $this->set('_serialize', ['factura']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function delete($id = null, $cliente_id = 0)
    {
        $this->request->allowMethod(['post']);
        $factura = $this->Facturas->get($id);
        $factura->deleted = TRUE;
        if ($this->Facturas->save($factura)) {
            TableRegistry::get('Facturas')
                ->query()
                ->update()
                ->set(['deleted' => 1])
                ->where(['padre' => $id])
                ->execute();
            $this->Flash->success(__('La Factura se Eliminó.'));
            if($cliente_id == 0){
                    return $this->redirect(['action' => 'index']); 
            }else{
                return $this->redirect('/customers/customers/view/'.$cliente_id.'/facturas');
            }
        } else {
            $this->Flash->error(__('La factura no se pudo eliminar. Intentalo de nuevo.'));
        }
    }
}
