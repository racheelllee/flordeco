<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Formasdepagos Controller
 *
 * @property \App\Model\Table\FormasdepagosTable $Formasdepagos
 */
class FormasdepagosController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('formasdepagos', $this->Formasdepagos->find('all'));
        $this->set('_serialize', ['formasdepagos']);
    }

    /**
     * View method
     *
     * @param string|null $id Formasdepago id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formasdepago = $this->Formasdepagos->get($id, [
            'contain' => ['Pedidos']
        ]);
        $this->set('formasdepago', $formasdepago);
        $this->set('_serialize', ['formasdepago']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formasdepago = $this->Formasdepagos->newEntity();
        if ($this->request->is('post')) {
            $formasdepago = $this->Formasdepagos->patchEntity($formasdepago, $this->request->data);
            if ($this->Formasdepagos->save($formasdepago)) {
                $this->Flash->success(__('The formasdepago has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The formasdepago could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('formasdepago'));
        $this->set('_serialize', ['formasdepago']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Formasdepago id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formasdepago = $this->Formasdepagos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formasdepago = $this->Formasdepagos->patchEntity($formasdepago, $this->request->data);
            if ($this->Formasdepagos->save($formasdepago)) {
                $this->Flash->success(__('The formasdepago has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The formasdepago could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('formasdepago'));
        $this->set('_serialize', ['formasdepago']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Formasdepago id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formasdepago = $this->Formasdepagos->get($id);
        if ($this->Formasdepagos->delete($formasdepago)) {
            $this->Flash->success(__('The formasdepago has been deleted.'));
        } else {
            $this->Flash->error(__('The formasdepago could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
