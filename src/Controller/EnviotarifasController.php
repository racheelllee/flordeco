<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Enviotarifas Controller
 *
 * @property \App\Model\Table\EnviotarifasTable $Enviotarifas
 */

class EnviotarifasController extends AppController
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
			'Enviotarifas'=>[
				'Enviotarifas'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Enviotarifas.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Enviotarifas.id'=>'DESC']];
        $this->Search->applySearch();
        $enviotarifas = $this->paginate($this->Enviotarifas)->toArray();
        $this->set(compact('enviotarifas'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_enviotarifas');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Enviotarifa id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enviotarifa = $this->Enviotarifas->get($id, [
            'contain' => []
        ]);
        $this->set('enviotarifa', $enviotarifa);
        $this->set('_serialize', ['enviotarifa']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enviotarifa = $this->Enviotarifas->newEntity();
        if ($this->request->is('post')) {
            $enviotarifa = $this->Enviotarifas->patchEntity($enviotarifa, $this->request->data);
            if ($this->Enviotarifas->save($enviotarifa)) {
                $this->Flash->success(__('The enviotarifa has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The enviotarifa could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('enviotarifa'));
        $this->set('_serialize', ['enviotarifa']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Enviotarifa id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enviotarifa = $this->Enviotarifas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enviotarifa = $this->Enviotarifas->patchEntity($enviotarifa, $this->request->data);
            if ($this->Enviotarifas->save($enviotarifa)) {
                $this->Flash->success(__('The enviotarifa has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The enviotarifa could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('enviotarifa'));
        $this->set('_serialize', ['enviotarifa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Enviotarifa id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enviotarifa = $this->Enviotarifas->get($id);
        if ($this->Enviotarifas->delete($enviotarifa)) {
            $this->Flash->success(__('The enviotarifa has been deleted.'));
        } else {
            $this->Flash->error(__('The enviotarifa could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
