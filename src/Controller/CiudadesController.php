<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ciudades Controller
 *
 * @property \App\Model\Table\CiudadesTable $Ciudades
 */
class CiudadesController extends AppController
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
    public $components = ['Usermgmt.Search', 'Cookie'];


    public $searchFields = [
        'index'=>[
            'Ciudades'=>[
                'Ciudades'=>[
                    'type'=>'text',
                    'label'=>'Buscar',
                    'tagline'=>'Busca por nombre de ciudad o url',
                    'condition'=>'multiple',
                    'searchFields'=>['Ciudades.nombre', 'Ciudades.url'],
                    'inputOptions'=>['style'=>'width:300px;']
                ]
            ]
        ],
        'ciudadesProductos'=>[
            'Ciudades'=>[
                'Ciudades.estado_id'=>[
                    'type'=>'select',
                    'label'=>'Estados',
                    'model'=>'Estados',
                    'selector'=>'getEstados',
                ],
                'Ciudades.cat_id'=>[
                    'type'=>'select',
                    'label'=>'Categorias',
                    'model'=>'Categorias',
                    'selector'=>'GetCategorias'
                ]
            ]
        ],
        'ciudadesCalendario'=>[
            'Ciudades'=>[
                'Ciudades.estado_id'=>[
                    'type'=>'select',
                    'label'=>'Estados',
                    'model'=>'Estados',
                    'selector'=>'getEstados',
                ]
            ]
        ]
    ];


    public $categoria_id = null;

    public function beforeFilter(\Cake\Event\Event $event){
        parent::beforeFilter($event);


        $sesion= $this->request->session();
        $var = $sesion->read('UserAuth.Search.Ciudades.ciudadesProductos');
      
        if($this->request->params['action'] == 'ciudadesProductos'){
            if(isset($this->request->data['Ciudades']['cat_id'])){
               
               $this->categoria_id = $this->request->data['Ciudades']['cat_id'];
               unset($this->request->data['Ciudades']['cat_id']);
           }else{
                $sesion->delete('UserAuth.Search.Ciudades.ciudadesProductos.Ciudades.cat_id');
                $this->categoria_id = $var['Ciudades']['cat_id'];
           }
        }

        if(isset($this->request->data['search_clear']) && $this->request->data['search_clear'] ==1){
               $this->categoria_id = '';
        }

        $var = $sesion->read('UserAuth.Search.Ciudades.ciudadesCalendario.Ciudades.estado_id');

        if(!$var){
            $sesion->write('UserAuth.Search.Ciudades.ciudadesCalendario.Ciudades.estado_id', 1);
        }

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $conditions = ['Ciudades.deleted' => 0];
        $ciudad = $this->Ciudades->newEntity();
        $this->paginate = [
            'conditions' => $conditions,
            'contain' => ['Estados', 'CiudadStatuses']
        ];

        $this->Search->applySearch($conditions);

        $ciudades = $this->paginate($this->Ciudades);
        $estados = $this->Ciudades->Estados->find('list', ['limit' => 200]);
        $ciudadStatuses = $this->Ciudades->CiudadStatuses->find('list', ['limit' => 200]);
        $rangoPrecios = $this->Ciudades->RangoPrecios->find('list', ['limit' => 200]);

        $this->loadModel('TipoPrecios');
        $tipoPrecios = $this->TipoPrecios->find('list')->toArray();

        $this->set(compact('ciudad', 'ciudades', 'estados', 'ciudadStatuses', 'rangoPrecios', 'tipoPrecios'));
        
        $this->set('_serialize', ['ciudades']);

        if($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $this->render('/Element/all_ciudades');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Ciudad id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ciudad = $this->Ciudades->get($id, [
            'contain' => ['Estados', 'CiudadStatuses', 'RangoPrecios']
        ]);

        $this->set('ciudad', $ciudad);
        $this->set('_serialize', ['ciudad']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Banners');
        $this->viewBuilder()->layout('ajax');
        $ciudad = $this->Ciudades->newEntity();
        if ($this->request->is('post')) {

            $this->validPathFiles( $this->request->data['imagen_fondo'] ) ;

            $ciudad = $this->Ciudades->patchEntity($ciudad, $this->request->data);

            $ciudad->imagen_fondo = $this->uploadFile($this->request->data('imagen_fondo'));
            if(empty($ciudad->imagen_fondo)){ unset($ciudad->imagen_fondo); }

            if ($this->Ciudades->save($ciudad)) {
                $this->Flash->success(__('The ciudad has been saved.'));

                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The ciudad could not be saved. Please, try again.'));
            }
        }
        $estados = $this->Ciudades->Estados->find('list', ['limit' => 200]);
        $ciudadStatuses = $this->Ciudades->CiudadStatuses->find('list', ['limit' => 200]);
        $rangoPrecios = $this->Ciudades->RangoPrecios->find('list', ['limit' => 200]);
        $banners =  $this->Banners->find('list', ['conditions' => ['Banners.principal' => 4], 'keyField' => 'id', 'valueField' => 'nombre' ])->toArray();

        $this->loadModel('TipoPrecios');
        $tipoPrecios = $this->TipoPrecios->find('list')->toArray();

        $this->set(compact('ciudad', 'estados', 'ciudadStatuses', 'rangoPrecios','banners', 'tipoPrecios'));
        $this->set('_serialize', ['ciudad']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ciudad id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Banners');
        $this->viewBuilder()->layout('ajax');
        $ciudad = $this->Ciudades->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->validPathFiles( $this->request->data['imagen_fondo'] ) ;

            $ciudad = $this->Ciudades->patchEntity($ciudad, $this->request->data);

            $ciudad->imagen_fondo = $this->uploadFile($this->request->data('imagen_fondo'));
            if(empty($ciudad->imagen_fondo)){ unset($ciudad->imagen_fondo); }
            
            if ($this->Ciudades->save($ciudad)) {
                $this->Flash->success(__('The ciudad has been saved.'));

                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The ciudad could not be saved. Please, try again.'));
            }
        }
        $estados = $this->Ciudades->Estados->find('list', ['limit' => 200]);
        $ciudadStatuses = $this->Ciudades->CiudadStatuses->find('list', ['limit' => 200]);
        $rangoPrecios = $this->Ciudades->RangoPrecios->find('list', ['limit' => 200]);
        $banners =  $this->Banners->find('list', ['conditions' => ['Banners.principal' => 4], 'keyField' => 'id', 'valueField' => 'nombre' ])->toArray();

        $this->loadModel('TipoPrecios');
        $tipoPrecios = $this->TipoPrecios->find('list')->toArray();

        $this->set(compact('ciudad', 'estados', 'ciudadStatuses', 'rangoPrecios','banners', 'tipoPrecios'));
        $this->set('_serialize', ['ciudad']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ciudad id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $ciudad = $this->Ciudades->get($id);
        $ciudad->deleted = 1;
        if ($this->Ciudades->save($ciudad)) {
            $this->Flash->success(__('The ciudad has been deleted.'));
        } else {
            $this->Flash->error(__('The ciudad could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }


    public function bannersAjaxAdd($numero){

        $this->loadModel('SucursalesBanners');
        $this->loadModel('Banners');

        $banner = $this->SucursalesBanners->newEntity();
        $banner = $this->SucursalesBanners->patchEntity($banner, $this->request->data);

        //$exists = $this->SucursalesBanners->exists(['numero_sap' => $this->request->data['numero_sap'] ]);

        /*if($exists){
            die;
        }*/

        debug( $this->request->data ); die();

        if(isset( $this->request->data['is_edit'] ) && $this->request->data['is_edit'] == true){
            
            $version['referencia_id'] = $this->request->data['referencia_id'];
            $version['flag'] = false;
            
            if( $this->SucursalesBanners->save( $version ) ){
                echo 'OK';
            }else{
                die( debug( $version->errors() ) );
            }
        }

        $banners = $this->Banners->find('list')->toArray();

        $this->set(compact('numero','banners','banner'));
        $this->viewBuilder()->layout('ajax');
        $this->render('/Element/Ciudades/banners');
    }

    public function ciudadesProductos()
    {
        $conditions = ['Ciudades.deleted' => 0];

        $this->paginate = [
            'conditions' => $conditions,
            'contain' => ['CiudadesProductos']
        ];

        $this->Search->applySearch($conditions);
        $ciudades = $this->paginate($this->Ciudades)->toArray();


        $this->loadModel('Productos');
        $conditionsProductos = [];

        $conditionsProductos = ['Productos.estatus_id'=>1, 'Productos.deleted'=>0];

        if(!is_null($this->categoria_id) && $this->categoria_id !=''){
            
            $hijos = [];
            $hijos[] = $this->categoria_id;

            $productos_ids = $this->Productos->find('list')
            ->matching('Categorias', function ($q) use ($hijos) {
                           return $q->where( [ 'Categorias.id IN' => $hijos,'Productos.deleted'=>0]);
                    })->toArray();
            
            $conditionsProductos[] = ['Productos.id IN'=>array_keys($productos_ids)];
        } 


        $productos = $this->Productos->find('all', [
            'contain'=>['Imagenes'],
            'conditions'=>$conditionsProductos])->toArray();
        

        $ciudades_productos = [];
        foreach ($ciudades as $key => $ciudad) {
            foreach ($ciudad->ciudades_productos as $key => $producto) {
                $ciudades_productos[$producto->ciudad_id][$producto->producto_id] = true;
            }
        }

        if(!is_null($this->categoria_id) && $this->categoria_id !=''){
            $sesion=$this->request->session();
            $sesion->write('UserAuth.Search.Ciudades.ciudadesProductos.Ciudades.cat_id',$this->categoria_id);
            $this->request->data['Ciudades']['cat_id'] = $this->categoria_id;
        }

        $this->set('search_categoria',$this->categoria_id);


        $this->set(compact('ciudades', 'productos', 'ciudades_productos'));
        
        $this->set('_serialize', ['ciudades']);

        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_ciudades_productos');
        }
    }

    public function addProducto()
    {
        $product = [];
        if($this->request->is('post')) {

            $data = $this->request->data;

            $product = $this->Ciudades->CiudadesProductos->find('all', ['conditions'=>[
                        'CiudadesProductos.ciudad_id' => $data['ciudad_id'],
                        'CiudadesProductos.producto_id' => $data['producto_id'],
                    ]])->first();

            if($product){
                $this->Ciudades->CiudadesProductos->delete($product);
                unset($product->id);
            }else{
                $product = $this->Ciudades->CiudadesProductos->newEntity();
                $this->Ciudades->CiudadesProductos->patchEntity($product, $data);

                $this->Ciudades->CiudadesProductos->save($product);
            }
        }

        die(json_encode($product));
    }

    public function ciudadesCalendario()
    {
        $conditions = ['Ciudades.deleted' => 0];

        $sesion= $this->request->session();
        $estado_id = $sesion->read('UserAuth.Search.Ciudades.ciudadesCalendario.Ciudades.estado_id');

        if(!$estado_id){
            $estado_id = 1;
            $conditions = ['Ciudades.estado_id' => $estado_id];
        }

        $estado = $this->Ciudades->Estados->get($estado_id, ['contain' => ['CiudadFestivos', 'CiudadFestivosSemanas', 'CiudadHorarioEntregas.CiudadHorarioEntregaTipos']]);

        $this->paginate = [
            'conditions' => $conditions,
            'contain' => ['CiudadFestivos', 'CiudadFestivosSemanas', 'CiudadHorarioEntregas.CiudadHorarioEntregaTipos'],
            'limit' => 1000
        ];

        $this->Search->applySearch($conditions);
        $ciudades = $this->paginate($this->Ciudades)->toArray();

        $this->set(compact('ciudades', 'estado'));

        $this->set('_serialize', ['ciudades']);

        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_ciudades_calendario');
        }
    }

    public function addDiaFestivo($estado_id = '', $ciudad_id = '')
    {
        if($this->request->is('post')) {

            $data = $this->request->data;


            $diaFestivo = $this->Ciudades->CiudadFestivos->newEntity();
            $diaFestivo = $this->Ciudades->CiudadFestivos->patchEntity($diaFestivo, $this->request->data);

            $diaFestivo->estado_id = ($estado_id && $estado_id != ' ')? $estado_id : 0;
            $diaFestivo->ciudad_id = ($ciudad_id && $ciudad_id != ' ')? $ciudad_id : 0;

            $this->Ciudades->CiudadFestivos->save($diaFestivo);

            return $this->redirect($this->referer());
        }

        $this->render(null,'ajax');
    }

    public function deleteDiaFestivo()
    {
        if($this->request->is('post')) {

            $data = $this->request->data;

            $diaFestivo = $this->Ciudades->CiudadFestivos->find('all', ['conditions'=>[
                        'CiudadFestivos.id' => $data['ciudad_festivo_id']
                    ]])->first();

            if($diaFestivo){
                $this->Ciudades->CiudadFestivos->delete($diaFestivo);
            }
        }

        return $this->redirect($this->referer());
    }

    public function addDiaFestivoSemana()
    { 
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->data;

            $conditions = [];
            if(isset($data['estado_id'])){
                $conditions = ['CiudadFestivosSemanas.estado_id' => $data['estado_id']];
            }else if(isset($data['ciudad_id'])){
                $conditions = ['CiudadFestivosSemanas.ciudad_id' => $data['ciudad_id']];
            }

            $semanaFestivo = $this->Ciudades->CiudadFestivosSemanas->find('all', ['conditions'=>$conditions])->first();

            if(!$semanaFestivo){
                $semanaFestivo = $this->Ciudades->CiudadFestivosSemanas->newEntity();
            }else{
                $semanaFestivo->lun = false;
                $semanaFestivo->mar = false;
                $semanaFestivo->mie = false;
                $semanaFestivo->jue = false;
                $semanaFestivo->vie = false;
                $semanaFestivo->sab = false;
                $semanaFestivo->dom = false;
            }
            
            $semanaFestivo = $this->Ciudades->CiudadFestivosSemanas->patchEntity($semanaFestivo, $this->request->data);

            $this->Ciudades->CiudadFestivosSemanas->save($semanaFestivo);

        }

        return $this->redirect($this->referer());
    }

    public function editEstado($id = null)
    {
        
        $estado = $this->Ciudades->Estados->get($id, [
            'contain' => []
        ]); 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estado = $this->Ciudades->Estados->patchEntity($estado, $this->request->data);
            $this->Ciudades->Estados->save($estado);
        }

        return $this->redirect($this->referer());
    }

    public function addHorario($estado_id = '', $ciudad_id = '')
    {
        if($this->request->is('post')) {

            $data = $this->request->data;


            $horario = $this->Ciudades->CiudadHorarioEntregas->newEntity();
            $horario = $this->Ciudades->CiudadHorarioEntregas->patchEntity($horario, $this->request->data);

            $horario->estado_id = ($estado_id && $estado_id != ' ')? $estado_id : 0;
            $horario->ciudad_id = ($ciudad_id && $ciudad_id != ' ')? $ciudad_id : 0;

            $this->Ciudades->CiudadHorarioEntregas->save($horario);

            return $this->redirect($this->referer());
        }

        $horarios_tipos = $this->Ciudades->CiudadHorarioEntregas->CiudadHorarioEntregaTipos->find('list')->toArray();
        $this->set(compact('horarios_tipos'));

        $this->render(null,'ajax');
    }

    public function deleteHorario()
    {
        if($this->request->is('post')) {

            $data = $this->request->data;

            $horario = $this->Ciudades->CiudadHorarioEntregas->find('all', ['conditions'=>[
                        'CiudadHorarioEntregas.id' => $data['horario_id']
                    ]])->first();

            if($horario){
                $this->Ciudades->CiudadHorarioEntregas->delete($horario);
            }
        }

        return $this->redirect($this->referer());
    }
}
