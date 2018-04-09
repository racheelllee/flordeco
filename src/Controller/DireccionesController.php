<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Direcciones Controller
 *
 * @property \App\Model\Table\DireccionesTable $Direcciones
 */

class DireccionesController extends AppController
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
			'Direcciones'=>[
				'Direcciones'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Direcciones.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Direcciones.id'=>'DESC']];
        $this->Search->applySearch();
        $direcciones = $this->paginate($this->Direcciones)->toArray();
        $this->set(compact('direcciones'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_direcciones');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Direccion id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $direccion = $this->Direcciones->get($id, [
            'contain' => ['Clientes', 'Municipios', 'Estados', 'Paises']
        ]);
        $this->set('direccion', $direccion);
        $this->set('_serialize', ['direccion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $direccion = $this->Direcciones->newEntity();
        if ($this->request->is('post')) {
            $direccion = $this->Direcciones->patchEntity($direccion, $this->request->data);
            if ($this->Direcciones->save($direccion)) {
                $this->Flash->success(__('The direccion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The direccion could not be saved. Please, try again.'));
            }
        }
        $clientes = $this->Direcciones->Clientes->find('list', ['limit' => 200]);
        $municipios = $this->Direcciones->Municipios->find('list', ['limit' => 200]);
        $estados = $this->Direcciones->Estados->find('list', ['limit' => 200]);
        $paises = $this->Direcciones->Paises->find('list', ['limit' => 200]);
        $this->set(compact('direccion', 'clientes', 'municipios', 'estados', 'paises'));
        $this->set('_serialize', ['direccion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Direccion id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $direccion = $this->Direcciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $direccion = $this->Direcciones->patchEntity($direccion, $this->request->data);
            if ($this->Direcciones->save($direccion)) {
                $this->Flash->success(__('The direccion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The direccion could not be saved. Please, try again.'));
            }
        }
        $clientes = $this->Direcciones->Clientes->find('list', ['limit' => 200]);
        $municipios = $this->Direcciones->Municipios->find('list', ['limit' => 200]);
        $estados = $this->Direcciones->Estados->find('list', ['limit' => 200]);
        $paises = $this->Direcciones->Paises->find('list', ['limit' => 200]);
        $this->set(compact('direccion', 'clientes', 'municipios', 'estados', 'paises'));
        $this->set('_serialize', ['direccion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Direccion id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $direccion = $this->Direcciones->get($id);
        if ($this->Direcciones->delete($direccion)) {
            $this->Flash->success(__('The direccion has been deleted.'));
        } else {
            $this->Flash->error(__('The direccion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
