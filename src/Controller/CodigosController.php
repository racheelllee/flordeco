<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Codigos Controller
 *
 * @property \App\Model\Table\CodigosTable $Codigos
 */

class CodigosController extends AppController
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
			'Codigos'=>[
				'Codigos'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Codigos.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Codigos.id'=>'DESC']];
        $this->Search->applySearch();
        $codigos = $this->paginate($this->Codigos)->toArray();
        $this->set(compact('codigos'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_codigos');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Codigo id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $codigo = $this->Codigos->get($id, [
            'contain' => []
        ]);
        $this->set('codigo', $codigo);
        $this->set('_serialize', ['codigo']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $codigo = $this->Codigos->newEntity();
        if ($this->request->is('post')) {
            $codigo = $this->Codigos->patchEntity($codigo, $this->request->data);
            if ($this->Codigos->save($codigo)) {
                $this->Flash->success(__('The codigo has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The codigo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('codigo'));
        $this->set('_serialize', ['codigo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Codigo id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $codigo = $this->Codigos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $codigo = $this->Codigos->patchEntity($codigo, $this->request->data);
            if ($this->Codigos->save($codigo)) {
                $this->Flash->success(__('The codigo has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The codigo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('codigo'));
        $this->set('_serialize', ['codigo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Codigo id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $codigo = $this->Codigos->get($id);
        if ($this->Codigos->delete($codigo)) {
            $this->Flash->success(__('The codigo has been deleted.'));
        } else {
            $this->Flash->error(__('The codigo could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
