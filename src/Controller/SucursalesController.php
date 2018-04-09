<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sucursales Controller
 *
 * @property \App\Model\Table\SucursalesTable $Sucursales
 */
class SucursalesController extends AppController
{

    public $helpers = ['Usermgmt.Tinymce', 'Usermgmt.Ckeditor'];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sucursale = $this->Sucursales->newEntity();
        $this->paginate = [
            'conditions' => ['Sucursales.deleted' => 0],
            'contain' => ['Estados', 'Municipios', 'Ciudades']
        ];
        $sucursales = $this->paginate($this->Sucursales);
        $estados = $this->Sucursales->Estados->find('list', ['limit' => 200]);
        $municipios = $this->Sucursales->Municipios->find('list', ['limit' => 200]);

        #debug($sucursales->toArray());die();

        $this->set(compact('sucursale', 'sucursales', 'estados', 'municipios'));
        
        $this->set('_serialize', ['sucursales']);
    }

    /**
     * View method
     *
     * @param string|null $id Sucursale id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sucursale = $this->Sucursales->get($id, [
            'contain' => ['Estados', 'Municipios']
        ]);

        $this->set('sucursale', $sucursale);
        $this->set('_serialize', ['sucursale']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        #$this->layout('ajax');
        #$this->layout = 'ajax';
        $this->loadModel('Banners');
        $this->loadModel('SucursalesBanners');

        $sucursale = $this->Sucursales->newEntity();
        if ($this->request->is('post')) {

            $sucursale = $this->Sucursales->patchEntity($sucursale, $this->request->data);
            
            $sucursale->estado_id = $this->request->data('estado_id');
            $sucursale->municipio_id = $this->request->data('ciudad_id');
            $sucursale->ciudad_id = $this->request->data('ciudad_id');

            if ($this->Sucursales->save($sucursale)) {

                #debug($this->request->data); die();
                $data['sucursal_id'] = $sucursale->id;
                $data['posicion'] = $this->request->data['posicion'];
                $data['num_columna'] = $this->request->data['num_columna'];
                $data['banner_id'] = $this->request->data['banner_id'];

                $sucursalesBanners = $this->SucursalesBanners->newEntity();
                $sucursalesBanners = $this->SucursalesBanners->patchEntity($sucursalesBanners, $data);
                //debug($data);

                if($this->SucursalesBanners->save($sucursalesBanners));

                $this->Flash->success(__('The sucursale has been saved.'));
                #return $this->redirect($this->referer());
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sucursale could not be saved. Please, try again.'));
            }
        }
        
        $estados = $this->Sucursales->Estados->find('list', ['limit' => 200]);
        $ciudades = $this->Sucursales->Ciudades->find('list', ['limit' => 200]);   
        $banners =  $this->Banners->find('list', ['conditions' => ['Banners.principal' => 4], 'keyField' => 'id', 'valueField' => 'nombre' ])->toArray();

        $this->set(compact('sucursale', 'estados','ciudades', 'banners'));
        $this->set('_serialize', ['sucursale']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sucursale id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Banners');

        $sucursale = $this->Sucursales->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sucursale = $this->Sucursales->patchEntity($sucursale, $this->request->data);
            $sucursale->estado_id = $this->request->data('estado_id');
            $sucursale->municipio_id = $this->request->data('ciudad_id');
            $sucursale->ciudad_id = $this->request->data('ciudad_id');

            if ($this->Sucursales->save($sucursale)) {
                $this->Flash->success(__('The sucursale has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sucursale could not be saved. Please, try again.'));
            }
        }
        $estados = $this->Sucursales->Estados->find('list', ['limit' => 200]);
        $ciudades = $this->Sucursales->Ciudades->find('list', ['limit' => 200]);
        
        $banners =  $this->Banners->find('list', ['conditions' => ['Banners.principal' => 4], 'keyField' => 'id', 'valueField' => 'nombre' ])->toArray();

        $this->set(compact('sucursale', 'estados', 'ciudades', 'banners'));
        $this->set('_serialize', ['sucursale']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sucursale id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $sucursale = $this->Sucursales->get($id);
        $sucursale->deleted = 1;
        if ($this->Sucursales->save($sucursale)) {
            $this->Flash->success(__('The sucursale has been deleted.'));
        } else {
            $this->Flash->error(__('The sucursale could not be deleted. Please, try again.'));
        }
        #return $this->redirect($this->referer());
        return $this->redirect(['action' => 'index']);
    }
}
