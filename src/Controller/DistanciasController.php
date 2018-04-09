<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Distancias Controller
 *
 * @property \App\Model\Table\DistanciasTable $Distancias
 */

class DistanciasController extends AppController
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
			'Distancias'=>[
				'Distancias'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Distancias.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Distancias.id'=>'DESC']];
        $this->Search->applySearch();
        $distancias = $this->paginate($this->Distancias)->toArray();
        $this->set(compact('distancias'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_distancias');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Distancia id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $distancia = $this->Distancias->get($id, [
            'contain' => []
        ]);
        $this->set('distancia', $distancia);
        $this->set('_serialize', ['distancia']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $distancia = $this->Distancias->newEntity();
        if ($this->request->is('post')) {
            $distancia = $this->Distancias->patchEntity($distancia, $this->request->data);
            if ($this->Distancias->save($distancia)) {
                $this->Flash->success(__('The distancia has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The distancia could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('distancia'));
        $this->set('_serialize', ['distancia']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Distancia id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $distancia = $this->Distancias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $distancia = $this->Distancias->patchEntity($distancia, $this->request->data);
            if ($this->Distancias->save($distancia)) {
                $this->Flash->success(__('The distancia has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The distancia could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('distancia'));
        $this->set('_serialize', ['distancia']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Distancia id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $distancia = $this->Distancias->get($id);
        if ($this->Distancias->delete($distancia)) {
            $this->Flash->success(__('The distancia has been deleted.'));
        } else {
            $this->Flash->error(__('The distancia could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
