<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\ORM\TableRegistry;
/**
 * Preciocompetencias Controller
 *
 * @property \App\Model\Table\PreciocompetenciasTable $Preciocompetencias
 */
class PreciocompetenciasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadComponent('RequestHandler');
    }

    public function index($producto_id = null)
    {
        $this->set('preciocompetencias', $this->Preciocompetencias->find('all'));
        $this->set('_serialize', ['preciocompetencias']);
    }

    // public function fields()
    // {
    //     header('Content-Type: application/json');
    //     die(json_encode($fields));
    //     $this->set('fields', $fields);
    //     $this->set('_serialize', ['fields']);
    // }

    /**
     * View method
     *
     * @param string|null $id Preciocompetencia id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $preciocompetencia = $this->Preciocompetencias->get($id, [
            'contain' => ['Productos', 'Competencias', 'Usuarios']
        ]);
        $this->set('preciocompetencia', $preciocompetencia);
        $this->set('_serialize', ['preciocompetencia']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $this->loadModel('preciocompetencias');
        $competencia = $this->preciocompetencias->newEntity();

        if ($this->request->is('post')) {
            
            //$competencia = $this->preciocompetencias->patchEntity($competencia, $this->request->data);
            $competencia['producto_id'] = $this->request->data['producto_id'];
            $competencia['competencia_id'] = $this->request->data['comptencia_id'];
            $competencia['precio'] = $this->request->data['precio_competencia'];
            $competencia['envio_gratis'] = $this->request->data['envio_gratis_competencia'];
            $logeado = $this->UserAuth->getUser();
            $competencia['usuario_id'] = $logeado['User']['id'];
            $competencia['created'] = date('Y-m-d H:m:s');

            if ($this->preciocompetencias->save($competencia)) {
                $this->Flash->success(__('La competencia se ha guardado.'));
                return $this->redirect('/precios/view/'.$competencia['producto_id']);
            } else {
                


                $this->Flash->error(__('La competencia no se pudo guardar'));
            }
        }
        
        /*

        [
    'producto_id' => '129604',
    'comptencia_id' => '4',
    'precio_competencia' => '950',
    'envio_gratis_competencia' => '1'
]


        $this->loadModel('Competencias');
        $competencia = $this->Competencias->newEntity();
        $competencia->nombre = $this->request->data['Competencia_nombre'];
        $saved_competencia = $this->Competencias->save($competencia);

        $this->request->data['competencia_id'] = $saved_competencia->id;

        $preciocompetencia = $this->Preciocompetencias->newEntity($this->request->data);
        $preciocompetencia['Competencia_nombre'] = $this->request->data['Competencia_nombre'];
        
        if ($this->Preciocompetencias->save($preciocompetencia)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'response' => $preciocompetencia,
            '_serialize' => ['message', 'response']
        ]);
        */
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Preciocompetencia id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $preciocompetencia = $this->Preciocompetencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $preciocompetencia = $this->Preciocompetencias->patchEntity($preciocompetencia, $this->request->data);
            if ($this->Preciocompetencias->save($preciocompetencia)) {
                $this->Flash->success(__('The preciocompetencia has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The preciocompetencia could not be saved. Please, try again.'));
            }
        }
        $productos = $this->Preciocompetencias->Productos->find('list', ['limit' => 200]);
        $competencias = $this->Preciocompetencias->Competencias->find('list', ['limit' => 200]);
        $usuarios = $this->Preciocompetencias->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('preciocompetencia', 'productos', 'competencias', 'usuarios'));
        $this->set('_serialize', ['preciocompetencia']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Preciocompetencia id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->loadModel('preciocompetencias');
        $this->request->allowMethod(['post', 'delete']);
        $preciocompetencia = $this->Preciocompetencias->get($id);
        if ($this->Preciocompetencias->delete($preciocompetencia)) {
            $this->Flash->success(__('La competencia se ha eliminado.'));
        } else {
            $this->Flash->error(__('La competencia no se pudo elimnar.'));
        }
        return $this->redirect('/precios/view/'.$preciocompetencia['producto_id']);
    }
}
