<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Estados Controller
 *
 * @property \App\Model\Table\EstadosTable $Estados
 */

class EstadosController extends AppController
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
			'Estados'=>[
				'Estados'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Estados.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Estados.id'=>'DESC']];
        $this->Search->applySearch();
        $estados = $this->paginate($this->Estados)->toArray();
        $this->set(compact('estados'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_estados');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Estado id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $estado = $this->Estados->get($id, [
            'contain' => ['Paises', 'Clientes', 'Direcciones', 'Municipios']
        ]);
        $this->set('estado', $estado);
        $this->set('_serialize', ['estado']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estado = $this->Estados->newEntity();
        if ($this->request->is('post')) {
            $estado = $this->Estados->patchEntity($estado, $this->request->data);
            if ($this->Estados->save($estado)) {
                $this->Flash->success(__('The estado has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The estado could not be saved. Please, try again.'));
            }
        }
        $paises = $this->Estados->Paises->find('list', ['limit' => 200]);
        $this->set(compact('estado', 'paises'));
        $this->set('_serialize', ['estado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Estado id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $estado = $this->Estados->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estado = $this->Estados->patchEntity($estado, $this->request->data);
            if ($this->Estados->save($estado)) {
                $this->Flash->success(__('The estado has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The estado could not be saved. Please, try again.'));
            }
        }
        $paises = $this->Estados->Paises->find('list', ['limit' => 200]);
        $this->set(compact('estado', 'paises'));
        $this->set('_serialize', ['estado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Estado id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estado = $this->Estados->get($id);
        if ($this->Estados->delete($estado)) {
            $this->Flash->success(__('The estado has been deleted.'));
        } else {
            $this->Flash->error(__('The estado could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
