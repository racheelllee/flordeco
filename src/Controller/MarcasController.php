<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Marcas Controller
 *
 * @property \App\Model\Table\MarcasTable $Marcas
 */
class MarcasController extends AppController
{


    public $paginate = ['limit' => '100'];




    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('marcas', $this->Marcas->find('all'));
        $this->set('_serialize', ['marcas']);
    }

    /**
     * View method
     *
     * @param string|null $id Marca id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $marca = $this->Marcas->get($id, [
            'contain' => ['Productos']
        ]);
        $this->set('marca', $marca);
        $this->set('_serialize', ['marca']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $marca = $this->Marcas->newEntity();
        if ($this->request->is('post')) {
            $marca = $this->Marcas->patchEntity($marca, $this->request->data);
              if($this->request->data['logo']['tmp_name'] != ''){
                    $this->validPathFiles($this->request->data['logo']) ;
                
                    $ruta = FRONT_WWW_ROOT.'/img/marcas/'.$this->request->data['logo']['name'];
                    $tmp = $this->request->data['logo']['tmp_name'];
                    move_uploaded_file($tmp, $ruta);
                    $marca->logo = $this->request->data['logo']['name'];
                }
                
            if ($this->Marcas->save($marca)) {
                $this->Flash->success(__('La marca ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La marca no pudo ser agregada, intente de nuevo.'));
            }
        }
        $this->set(compact('marca'));
        $this->set('_serialize', ['marca']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Marca id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $marca = $this->Marcas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $marca = $this->Marcas->patchEntity($marca, $this->request->data);

             if($this->request->data['logo']['tmp_name'] != ''){
                    $this->validPathFiles($this->request->data['logo']) ;
                
                    $ruta = FRONT_WWW_ROOT.'/img/marcas/'.$this->request->data['logo']['name'];
                    $tmp = $this->request->data['logo']['tmp_name'];
                    move_uploaded_file($tmp, $ruta);
                    $marca->logo = $this->request->data['logo']['name'];
                }


            if ($this->Marcas->save($marca)) {
                $this->Flash->success(__('La marca ha sido editada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La marca no pudo ser editada, intente de nuevo.'));
            }
        }
        $this->set(compact('marca'));
        $this->set('_serialize', ['marca']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Marca id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $marca = $this->Marcas->get($id);
        if ($this->Marcas->delete($marca)) {
            $this->Flash->success(__('La marca ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La marca no pudo ser eliminada, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
