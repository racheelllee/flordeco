<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Comentarios Controller
 *
 * @property \App\Model\Table\ComentariosTable $Comentarios
 */

class ComentariosController extends AppController
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
			'Comentarios'=>[
				'Comentarios'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Comentarios.nombre'],
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

        $this->paginate = ['limit'=>10, 'order'=>['Comentarios.id'=>'DESC'],'contain'=>['Usuarios','Productos']];
        $this->Search->applySearch();
        $comentarios = $this->paginate($this->Comentarios)->toArray();
        $this->set(compact('comentarios'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_comentarios');
        }


    }

    /**
     * View method
     *
     * @param string|null $id Comentario id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comentario = $this->Comentarios->get($id, [
            'contain' => ['Productos', 'Usuarios']
        ]);
        $this->set('comentario', $comentario);
        $this->set('_serialize', ['comentario']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comentario = $this->Comentarios->newEntity();
        if ($this->request->is('post')) {
            $comentario = $this->Comentarios->patchEntity($comentario, $this->request->data);
            if ($this->Comentarios->save($comentario)) {
                $this->Flash->success(__('The comentario has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comentario could not be saved. Please, try again.'));
            }
        }
        $productos = $this->Comentarios->Productos->find('list', ['limit' => 200]);
        $usuarios = $this->Comentarios->Usuarios->find('list', ['limit' => 200]);
       
        $this->set(compact('comentario', 'productos', 'usuarios'));
        $this->set('_serialize', ['comentario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comentario id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comentario = $this->Comentarios->get($id,['contain'=>['Usuarios','Productos']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comentario = $this->Comentarios->patchEntity($comentario, $this->request->data);
            if ($this->Comentarios->save($comentario)) {
                $this->Flash->success(__('The comentario has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comentario could not be saved. Please, try again.'));
            }
        }
      
     
        $this->set(compact('comentario'));
        $this->set('_serialize', ['comentario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comentario id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comentario = $this->Comentarios->get($id);
        if ($this->Comentarios->delete($comentario)) {
            $this->Flash->success(__('The comentario has been deleted.'));
        } else {
            $this->Flash->error(__('The comentario could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
