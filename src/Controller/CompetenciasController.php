<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Competencias Controller
 *
 * @property \App\Model\Table\CompetenciasTable $Competencias
 */

class CompetenciasController extends AppController
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
			'Competencias'=>[
				'Competencias'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Competencias.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Competencias.id'=>'DESC']];
        $this->Search->applySearch();
        $competencias = $this->paginate($this->Competencias)->toArray();
        $this->set(compact('competencias'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_competencias');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Competencia id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competencia = $this->Competencias->get($id, [
            'contain' => []
        ]);
        $this->set('competencia', $competencia);
        $this->set('_serialize', ['competencia']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competencia = $this->Competencias->newEntity();
        if ($this->request->is('post')) {
            $competencia = $this->Competencias->patchEntity($competencia, $this->request->data);
            if ($this->Competencias->save($competencia)) {
                $this->Flash->success(__('The competencia has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The competencia could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('competencia'));
        $this->set('_serialize', ['competencia']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Competencia id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competencia = $this->Competencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competencia = $this->Competencias->patchEntity($competencia, $this->request->data);
            if ($this->Competencias->save($competencia)) {
                $this->Flash->success(__('The competencia has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The competencia could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('competencia'));
        $this->set('_serialize', ['competencia']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Competencia id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competencia = $this->Competencias->get($id);
        if ($this->Competencias->delete($competencia)) {
            $this->Flash->success(__('The competencia has been deleted.'));
        } else {
            $this->Flash->error(__('The competencia could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
