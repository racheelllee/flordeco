<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Clienteestatuses Controller
 *
 * @property \App\Model\Table\ClienteestatusesTable $Clienteestatuses
 */

class ClienteestatusesController extends AppController
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
			'Clienteestatuses'=>[
				'Clienteestatuses'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Clienteestatuses.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Clienteestatuses.id'=>'DESC']];
        $this->Search->applySearch();
        $clienteestatuses = $this->paginate($this->Clienteestatuses)->toArray();
        $this->set(compact('clienteestatuses'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_clienteestatuses');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Clienteestatus id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clienteestatus = $this->Clienteestatuses->get($id, [
            'contain' => ['Clientes']
        ]);
        $this->set('clienteestatus', $clienteestatus);
        $this->set('_serialize', ['clienteestatus']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clienteestatus = $this->Clienteestatuses->newEntity();
        if ($this->request->is('post')) {
            $clienteestatus = $this->Clienteestatuses->patchEntity($clienteestatus, $this->request->data);
            if ($this->Clienteestatuses->save($clienteestatus)) {
                $this->Flash->success(__('The clienteestatus has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The clienteestatus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('clienteestatus'));
        $this->set('_serialize', ['clienteestatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Clienteestatus id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clienteestatus = $this->Clienteestatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clienteestatus = $this->Clienteestatuses->patchEntity($clienteestatus, $this->request->data);
            if ($this->Clienteestatuses->save($clienteestatus)) {
                $this->Flash->success(__('The clienteestatus has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The clienteestatus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('clienteestatus'));
        $this->set('_serialize', ['clienteestatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Clienteestatus id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clienteestatus = $this->Clienteestatuses->get($id);
        if ($this->Clienteestatuses->delete($clienteestatus)) {
            $this->Flash->success(__('The clienteestatus has been deleted.'));
        } else {
            $this->Flash->error(__('The clienteestatus could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
