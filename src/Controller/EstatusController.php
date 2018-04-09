<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Estatus Controller
 *
 * @property \App\Model\Table\EstatusTable $Estatus
 */
class EstatusController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('estatus', $this->Estatus->find('all'));
        $this->set('_serialize', ['estatus']);
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
        $estatus = $this->Estatus->get($id, [
            'contain' => []
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
        $estatus = $this->Estatus->newEntity();
        if ($this->request->is('post')) {
            $estatus = $this->Estatus->patchEntity($estatus, $this->request->data);
            if ($this->Estatus->save($estatus)) {
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
        $estatus = $this->Estatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estatus = $this->Estatus->patchEntity($estatus, $this->request->data);
            if ($this->Estatus->save($estatus)) {
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
        $estatus = $this->Estatus->get($id);
        if ($this->Estatus->delete($estatus)) {
            $this->Flash->success(__('The estatus has been deleted.'));
        } else {
            $this->Flash->error(__('The estatus could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
