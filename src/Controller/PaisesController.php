<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Paises Controller
 *
 * @property \App\Model\Table\PaisesTable $Paises
 */
class PaisesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('paises', $this->Paises->find('all'));
        $this->set('_serialize', ['paises']);
    }

    /**
     * View method
     *
     * @param string|null $id Pais id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pais = $this->Paises->get($id, [
            'contain' => ['Clientes', 'Direcciones', 'Estados']
        ]);
        $this->set('pais', $pais);
        $this->set('_serialize', ['pais']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pais = $this->Paises->newEntity();
        if ($this->request->is('post')) {
            $pais = $this->Paises->patchEntity($pais, $this->request->data);
            if ($this->Paises->save($pais)) {
                $this->Flash->success(__('The pais has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pais could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pais'));
        $this->set('_serialize', ['pais']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pais id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pais = $this->Paises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pais = $this->Paises->patchEntity($pais, $this->request->data);
            if ($this->Paises->save($pais)) {
                $this->Flash->success(__('The pais has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pais could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pais'));
        $this->set('_serialize', ['pais']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pais id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pais = $this->Paises->get($id);
        if ($this->Paises->delete($pais)) {
            $this->Flash->success(__('The pais has been deleted.'));
        } else {
            $this->Flash->error(__('The pais could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
