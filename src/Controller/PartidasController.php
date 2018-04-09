<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Partidas Controller
 *
 * @property \App\Model\Table\PartidasTable $Partidas
 */
class PartidasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('partidas', $this->Partidas->find('all'));
        $this->set('_serialize', ['partidas']);
    }

    /**
     * View method
     *
     * @param string|null $id Partida id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partida = $this->Partidas->get($id, [
            'contain' => ['Pedidos']
        ]);
        $this->set('partida', $partida);
        $this->set('_serialize', ['partida']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partida = $this->Partidas->newEntity();
        if ($this->request->is('post')) {
            $partida = $this->Partidas->patchEntity($partida, $this->request->data);
            if ($this->Partidas->save($partida)) {
                $this->Flash->success(__('The partida has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The partida could not be saved. Please, try again.'));
            }
        }
        $pedidos = $this->Partidas->Pedidos->find('list', ['limit' => 200]);
        $this->set(compact('partida', 'pedidos'));
        $this->set('_serialize', ['partida']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Partida id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partida = $this->Partidas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partida = $this->Partidas->patchEntity($partida, $this->request->data);
            if ($this->Partidas->save($partida)) {
                $this->Flash->success(__('The partida has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The partida could not be saved. Please, try again.'));
            }
        }
        $pedidos = $this->Partidas->Pedidos->find('list', ['limit' => 200]);
        $this->set(compact('partida', 'pedidos'));
        $this->set('_serialize', ['partida']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Partida id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partida = $this->Partidas->get($id);
        if ($this->Partidas->delete($partida)) {
            $this->Flash->success(__('The partida has been deleted.'));
        } else {
            $this->Flash->error(__('The partida could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
