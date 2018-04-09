<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * ProductosProveedores Controller
 *
 * @property \App\Model\Table\ProductosProveedoresTable $ProductosProveedores
 */

class ProductosProveedoresController extends AppController
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
			'ProductosProveedores'=>[
				'ProductosProveedores'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['ProductosProveedores.nombre'],
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

    
        $productosProveedores = $this->ProductosProveedores->find('all')->toArray();
        $this->set(compact('productosProveedores'));
        
        $this->render(null,'iframe');

    }

    /**
     * View method
     *
     * @param string|null $id Productos Proveedor id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productosProveedor = $this->ProductosProveedores->get($id, [
            'contain' => ['Productos', 'Proveedores', 'Users']
        ]);
        $this->set('productosProveedor', $productosProveedor);
        $this->set('_serialize', ['productosProveedor']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productosProveedor = $this->ProductosProveedores->newEntity();
        if ($this->request->is('post')) {
            $productosProveedor = $this->ProductosProveedores->patchEntity($productosProveedor, $this->request->data);
            if ($this->ProductosProveedores->save($productosProveedor)) {
                $this->Flash->success(__('The productos proveedor has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The productos proveedor could not be saved. Please, try again.'));
            }
        }
        
        $proveedores = $this->ProductosProveedores->Proveedores->find('list', ['limit' => 200]);
        
        $this->set(compact('productosProveedor', 'proveedores'));
        $this->set('_serialize', ['productosProveedor']);

          $this->render(null,'iframe');
    }

    /**
     * Edit method
     *
     * @param string|null $id Productos Proveedor id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productosProveedor = $this->ProductosProveedores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productosProveedor = $this->ProductosProveedores->patchEntity($productosProveedor, $this->request->data);
            if ($this->ProductosProveedores->save($productosProveedor)) {
                $this->Flash->success(__('The productos proveedor has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The productos proveedor could not be saved. Please, try again.'));
            }
        }
        $productos = $this->ProductosProveedores->Productos->find('list', ['limit' => 200]);
        $proveedores = $this->ProductosProveedores->Proveedores->find('list', ['limit' => 200]);
        $useres = $this->ProductosProveedores->Users->find('list', ['limit' => 200]);
        $this->set(compact('productosProveedor', 'productos', 'proveedores', 'useres'));
        $this->set('_serialize', ['productosProveedor']);

          $this->render(null,'iframe');
    }

    /**
     * Delete method
     *
     * @param string|null $id Productos Proveedor id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productosProveedor = $this->ProductosProveedores->get($id);
        if ($this->ProductosProveedores->delete($productosProveedor)) {
            $this->Flash->success(__('The productos proveedor has been deleted.'));
        } else {
            $this->Flash->error(__('The productos proveedor could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

    }
}
