<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Estatuses Controller
 *
 * @property \App\Model\Table\EstatusesTable $Estatuses
 */
class EstatusesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('estatuses', $this->Estatuses->find('all'));
        $this->set('_serialize', ['estatuses']);
    }

    /**
     * View method
     *
     * @param string|null $id Estatus id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $estatus = $this->Estatuses->get($id, [
            'contain' => ['Pedidos']
        ]);
        $this->set('estatus', $estatus);
        $this->set('_serialize', ['estatus']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estatus = $this->Estatuses->newEntity();
        if ($this->request->is('post')) {
            $estatus = $this->Estatuses->patchEntity($estatus, $this->request->data);
            if ($this->Estatuses->save($estatus)) {
                $this->Flash->success(__('The estatus has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The estatus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('estatus'));
        $this->set('_serialize', ['estatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Estatus id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $estatus = $this->Estatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estatus = $this->Estatuses->patchEntity($estatus, $this->request->data);
            if ($this->Estatuses->save($estatus)) {
                $this->Flash->success(__('The estatus has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The estatus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('estatus'));
        $this->set('_serialize', ['estatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Estatus id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estatus = $this->Estatuses->get($id);
        if ($this->Estatuses->delete($estatus)) {
            $this->Flash->success(__('The estatus has been deleted.'));
        } else {
            $this->Flash->error(__('The estatus could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
