<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Proveedores Controller
 *
 * @property \App\Model\Table\ProveedoresTable $Proveedores
 */
class ProveedoresController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('proveedores', $this->Proveedores->find('all'));
        $this->set('_serialize', ['proveedores']);
    }

    /**
     * View method
     *
     * @param string|null $id Proveedor id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proveedor = $this->Proveedores->get($id, [
            'contain' => ['Productos', 'Precios']
        ]);
        $this->set('proveedor', $proveedor);
        $this->set('_serialize', ['proveedor']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proveedor = $this->Proveedores->newEntity();
        if ($this->request->is('post')) {
            $proveedor = $this->Proveedores->patchEntity($proveedor, $this->request->data);

            if ($this->Proveedores->save($proveedor)) {
                $this->Flash->success(__('El proveedor se guardo.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El proveedor no se pudo guardar.'));
            }
        }
        $productos = $this->Proveedores->Productos->find('list', ['limit' => 200]);
        $this->set(compact('proveedor', 'productos'));
        $this->set('_serialize', ['proveedor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Proveedor id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proveedor = $this->Proveedores->get($id, [
            'contain' => ['Productos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proveedor = $this->Proveedores->patchEntity($proveedor, $this->request->data);
            if ($this->Proveedores->save($proveedor)) {
                $this->Flash->success(__('Los cambios en proveedor se guardaron.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios no se pudieron guardar.'));
            }
        }
        $productos = $this->Proveedores->Productos->find('list', ['limit' => 200]);
        $this->set(compact('proveedor', 'productos'));
        $this->set('_serialize', ['proveedor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Proveedor id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proveedor = $this->Proveedores->get($id);
        if ($this->Proveedores->delete($proveedor)) {
            $this->Flash->success(__('The proveedor has been deleted.'));
        } else {
            $this->Flash->error(__('The proveedor could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
