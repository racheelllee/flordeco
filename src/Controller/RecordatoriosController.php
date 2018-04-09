<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Recordatorios Controller
 *
 * @property \App\Model\Table\RecordatoriosTable $Recordatorios
 */

class RecordatoriosController extends AppController
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
			'Recordatorios'=>[
        'Recordatorios.created'=>[
                    'type'=>'text',
                    'label'=>'Fecha',
                    'tagline'=>'yyyy-mm-dd',
                    'searchFields'=>'Recordatorios.created',
          //'condition'=>'=',
					'inputOptions'=>['class'=>'form-control', 'style'=>'width:100px;']
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

        $this->paginate = [
          'searchFilter'=>false, 'limit'=>10, 'order'=>['Recordatorios.id'=>'DESC'],
            'contain' => ['Pedidos','Clientes']
            ];
        $this->Search->applySearch();
        $recordatorios = $this->paginate($this->Recordatorios)->toArray();
        $this->set(compact('recordatorios'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_recordatorios');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Recordatorio id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $recordatorio = $this->Recordatorios->get($id, [
            'contain' => ['Pedidos', 'Clientes']
        ]);
        $this->set('recordatorio', $recordatorio);
        $this->set('_serialize', ['recordatorio']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recordatorio = $this->Recordatorios->newEntity();
        if ($this->request->is('post')) {
            $recordatorio = $this->Recordatorios->patchEntity($recordatorio, $this->request->data);
            if ($this->Recordatorios->save($recordatorio)) {
                $this->Flash->success(__('The recordatorio has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The recordatorio could not be saved. Please, try again.'));
            }
        }
        $pedidos = $this->Recordatorios->Pedidos->find('list', ['limit' => 200]);
        $clientes = $this->Recordatorios->Clientes->find('list', ['limit' => 200]);
        $this->set(compact('recordatorio', 'pedidos', 'clientes'));
        $this->set('_serialize', ['recordatorio']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Recordatorio id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recordatorio = $this->Recordatorios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $recordatorio = $this->Recordatorios->patchEntity($recordatorio, $this->request->data);
            if ($this->Recordatorios->save($recordatorio)) {
                $this->Flash->success(__('The recordatorio has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The recordatorio could not be saved. Please, try again.'));
            }
        }
        $pedidos = $this->Recordatorios->Pedidos->find('list', ['limit' => 200]);
        $clientes = $this->Recordatorios->Clientes->find('list', ['limit' => 200]);
        $this->set(compact('recordatorio', 'pedidos', 'clientes'));
        $this->set('_serialize', ['recordatorio']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Recordatorio id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recordatorio = $this->Recordatorios->get($id);
        if ($this->Recordatorios->delete($recordatorio)) {
            $this->Flash->success(__('The recordatorio has been deleted.'));
        } else {
            $this->Flash->error(__('The recordatorio could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
