<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Orm\TableRegistry;

/**
 * Categorias Controller
 *
 * @property \App\Model\Table\CategoriasTable $Categorias
 */

class CategoriasController extends AppController
{

    public $url;
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

    /**
     * Paginate
     *
     * @var array
     */
    public $paginate = ['limit' => '100'];

	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	public $searchFields = [
		'index'=>[
			'Categorias'=>[
				'Categorias'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Categorias.nombre'],
					'inputOptions'=>['style'=>'width:300px;']
				],
                'Categorias.id'=>[
                    'type'=>'select',
                    'label'=>'Categorias',
                    'model'=>'Categorias',
                    'selector'=>'GetCategorias',
                ],
                'Categorias.categoria_id'=>[
                    'type'=>'select',
                    'label'=>'Categoria Padre',
                    'model'=>'Categorias',
                    'selector'=>'GetCategorias',
                ]
			]
		]
	];

    public function initialize()
    {
        parent::initialize();

        $categorias_principales = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado = 1'],
            'order' => ['Categorias.orden' => 'DESC']
        ])->toArray();

        $categorias_secundarias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is not null and publicado=1']
        ])->toArray();

        $this->loadModel('Banners');
        $banner = $this->Banners->find('all')->toArray();
        $this->set(compact('categorias_principales', 'categorias_secundarias', 'banners'));

        $this->loadComponent('Paginator');

        $this->loadModel('Users');
        $this->set('userEntity', $this->Users->newEntity());
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        //$categories = TableRegistry::get('Categories');
        //$this->Categorias->recover();

        $categoriaslista = $this->Categorias->find('list')->toArray();
        $this->set('categoriaslista',$categoriaslista);
        $this->paginate = ['limit'=>10, 'order'=>['Categorias.id'=>'DESC']];
        $this->Search->applySearch();
        $categorias = $this->paginate($this->Categorias)->toArray();
        $this->set(compact('categorias'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_categorias');
        }



    }

    /**
     * View method
     *
     * @param string|null $id Categoria id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoria = $this->Categorias->get($id, [
            'contain' => ['Productos', 'Categorias', 'Cupones', 'Filtros']
        ]);
        $this->set('categoria', $categoria);
        $this->set('_serialize', ['categoria']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoria = $this->Categorias->newEntity();
        if ($this->request->is('post')) {
            $this->validPathFiles( $this->request->data['banner'] ) ;
            $this->validPathFiles( $this->request->data['imagen_fondo'] ) ;

            $categoria = $this->Categorias->patchEntity($categoria, $this->request->data);

            
            $categoria->banner = $this->uploadFile($this->request->data('banner'));
            if(empty($categoria->banner)){ unset($categoria->banner); }

            $categoria->imagen_fondo = $this->uploadFile($this->request->data('imagen_fondo'));
            if(empty($categoria->imagen_fondo)){ unset($categoria->imagen_fondo); }



            $orden = $this->Categorias->find('all', array('conditions'=>array('categoria_id'=>$categoria->categoria_id), 'order'=>array('orden DESC')))->first();
            if(count($orden)>0){
                $categoria->orden = $orden->orden + 1;
            }else{
                $categoria->orden = 1;
            }

            $categoria->publicado = 0;

            if ($this->Categorias->save($categoria)) {
                $this->Flash->success(__('La categoria se guardo.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La categoria no se pudo guardar.'));
            }
        }

        $categorias = $this->Categorias->find('treeList');



        $this->set(compact('categoria', 'productos', 'categorias', 'subcategorias'));
        $this->set('_serialize', ['categoria']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$orden = null)
    {
        $categoria = $this->Categorias->get($id, [
            'contain' => ['Productos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {


            $this->validPathFiles( $this->request->data['banner'] ) ;
            $this->validPathFiles( $this->request->data['imagen_fondo'] ) ;

            $categoria = $this->Categorias->patchEntity($categoria, $this->request->data);

            $categoria->banner = $this->uploadFile($this->request->data('banner'));
            if(empty($categoria->banner)){ unset($categoria->banner); }

            $categoria->imagen_fondo = $this->uploadFile($this->request->data('imagen_fondo'));
            if(empty($categoria->imagen_fondo)){ unset($categoria->imagen_fondo); }

            if ($this->Categorias->save($categoria)) {
                $this->Flash->success(__('La categoria se guardo.'));
                if($orden){
                    return $this->redirect(['action' => 'index']);
                }else{
                       return $this->redirect(['action' => 'edit',$categoria->id]);
                }
            } else {
                $this->Flash->error(__('La categoria no se pudo guardar.'));
            }
        }


       # $referencia = $this->Categorias->find('all', array('conditions' => array('id'=>$categoria->categoria_id)))->first();
        $categorias = $this->Categorias->find('treeList');

        //$this->loadModel('Filtros');
        //$filtros = $this->Filtros->find('all', array(
            //'conditions' => array('categoria_id'=>$categoria->id),
            //'contain' => array('Opcionesfiltros')
            //));


        $this->set(compact('categoria', 'categorias'));
        $this->set('_serialize', ['categoria']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoria = $this->Categorias->get($id);
        if ($this->Categorias->delete($categoria)) {
            $this->Flash->success(__('The categoria has been deleted.'));
        } else {
            $this->Flash->error(__('The categoria could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function busqueda_subcategoria()
    {
        if ($this->request->is('ajax')) {

            $id_categoria = $this->request->data['selected'];

            $data = array();
            $subcategorias = $this->Categorias->find('list', array('conditions' => array('categoria_id'=>$id_categoria)));

            $data['data'] = $subcategorias;

            die(json_encode($data));
        }
    }

    public function productosDestacados()
    {
        $this->loadModel('Productos');
        $sucursalId = $this->sucursalActual();
        return $this->Productos->find('all')
            #->distinct(['Productos.id'])
            ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones', 'OpcionefiltrosProductos'])
            ->where([
                #'padre_id' => 'IS NULL',
                'Productos.sucursal_id' => $sucursalId,
                'Productos.destacado' => 1,
            ])->toArray();
    }

    public function home()
    {
        $categorias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado=1'],
            'order' => ['Categorias.orden' => 'ASC']
        ]);

        $subCategorias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is not null and publicado=1']
        ]);

        $marcas = $this->Categorias->productos->Marcas->find('all',['conditions'=>'Marcas.activo = 1 and Marcas.logo !=\'\'','order'=>'rand()','limit 20']);

        $this->loadModel('Banners');
        $banner = $this->Banners->find('all');

        if ($this->request->is('post')) {
            if(array_keys($this->request->data)[0] == 1){
                $banner['contenido'] = $this->request->data[1];
            }

        }

        $this->set('banner', $banner);

        $categorias_principales = $categorias->toArray();
        $categorias_secundarias = $subCategorias->toArray();
        $banners = $banner->toArray();

        #$productos = $this->productosDestacados();
        $this->loadModel('Estados');
        $estados = $this->Estados->find('list');


        $this->loadModel('StaticPages');
        $home_content = $this->StaticPages->find()->where(['StaticPages.url_name'=>'home'])->first();

        $this->set(compact('categorias_principales', 'categorias_secundarias', 'banners', 'estados', 'home_content'));
        $this->set(compact('marcas', 'productos'));
        $this->render(null,'front');

    }

    public function ciudades($estadoId)
    {
        $this->loadModel('Ciudades');
        $ciudades =  [NULL => __('Ciudad')] + $this->Ciudades->find('list', [
            'valueField' => 'nombre',
            'keyField' => 'url',
            'conditions' => [
                'estado_id' => $estadoId
            ],
            'order'=>['Ciudades.orden' => 'ASC']
        ])->toArray();
        $this->response->body(json_encode($ciudades));
        return $this->response;
    }

    public function estadoMunicipio($estadoId, $municipioId)
    {
        $this->Cookie->write('estado_id', $estadoId);
        $this->Cookie->write('municipio_id', $municipioId);
        return $this->response;
    }

    /**
     * View method
     *
     * @param string|null $id Categoria id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function categoria($url = null)
    {

        $categorias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado=1'],
            'order' => ['Categorias.orden' => 'ASC']
        ]);

        $subCategorias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is not null and publicado=1']
        ]);

        $categorias_principales = $categorias->toArray();
        $categorias_secundarias = $subCategorias->toArray();

        $this->loadModel('Banners');
        $banner = $this->Banners->find('all');
        $banners = $banner->toArray();

        $this->set(compact('categorias_principales', 'categorias_secundarias', 'banners'));

        $categoria = $this->Categorias->find('all')
            ->where(['Categorias.url' => $url])
            ->limit(1);
        //todas las subcategorias
        $subc = $this->Categorias->find('all')
            ->where(['Categorias.categoria_id' => $categoria->first()->id,'Categorias.publicado'=>1])
            ->order(['Categorias.orden' => 'ASC']);


        $ids_categoria[]= $categoria->first()->id;

             $crumbs = $this->Categorias->find('path', ['for' => $categoria->first()->id]);

            $this->set('crumbs',$crumbs);


        $subcIds = array();
        foreach ($subc as $sub) {
            array_push($subcIds, $sub->id);
             $ids_categoria[]= $sub->id;
        }
        $subcNames = array();
        foreach ($subc as $sub) {
            array_push($subcNames, $sub->nombre);
        }
        $subcBanners = array();
        foreach ($subc as $sub) {
            array_push($subcBanners, $sub->imagen_fondo);
        }
        $subcurls = array();
        foreach ($subc as $sub) {
            array_push($subcurls, $sub->url);
        }



        //subcategorias de 2do nivel
        $subc2 = $this->Categorias->find('all')
            ->where(['Categorias.categoria_id IN' => $subcIds, 'Categorias.publicado'=>1])
            ->order(['Categorias.orden' => 'ASC']);

        //generando estructura para render
        $categoria_sub = array();
        foreach ($subcIds as $ids) {
            array_push($categoria_sub, array());

            # code...
        }
         $subcount =array();
        foreach ($subc2 as $leaf_cat) {
            $index = array_search($leaf_cat->categoria_id, $subcIds);
            array_push($categoria_sub[$index], $leaf_cat);
            $ids_categoria[]= $leaf_cat->id;


                foreach ($subc as $sub) {

                    $subcount[$leaf_cat->id] = $this->Categorias->childCount($leaf_cat);
                }


        }





        $conn = ConnectionManager::get('default');
        $marcas = $conn->query('select * from marcas where logo !="" and activo = 1 and  id in ( SELECT  productos.marca_id FROM productos INNER JOIN categorias_productos ON productos.id = categorias_productos.producto_id

where   productos.estatus_id =1 and categorias_productos.categoria_id in ('.implode(',', $ids_categoria).') group by (productos.marca_id) ) limit 20')->fetchAll('assoc');

//debug($marcas);
//exit;

        $this->set('marcas', $marcas);
        $this->set('categoria', $categoria->first());
        $this->set('subcNames', $subcNames);
        $this->set('subcBanners', $subcBanners);
        $this->set('subcurls', $subcurls);
        $this->set('subcount', $subcount);
        $this->set('title', $categoria->first()->nombre);

        $this->set('categoria_sub', $categoria_sub);
        $this->set('_serialize', ['categoria']);
        $this->render(null,'front');
    }

    public function filtraPrecio($prod_url, $min, $max){

            //die(debug(json_encode($prod_url)));
            // $this->loadModel('Productos');
            // $this->url = $prod_url;
            // $productos = $this->paginate($this->Productos->find('all')
            //                    ->contain(['Imagenes', 'Marcas'])
            //                    ->matching('Categorias', function ($q) {
            //                    return $q->where(['Categorias.url' => $this->url]);
            //                }));

            //die(json_encode($productos));
            $this->redirect(array("controller" => "Categorias",
                      "action" => "subcategoria"));

    }


    public function subcategoria($estado = '', $ciudadUrl = '', $categoriaUrl = '', $producto = null, $url = null, $prod = null)
    {
        $ciudad = TableRegistry::get('Ciudades')->ciudadPorUrl($ciudadUrl);

        if($ciudad == null){
            return $this->redirect('/');
        }
        $url = '/'.$estado.'/ciudad/'.$ciudadUrl;

        $this->subcategorias_datos($ciudadUrl, $categoriaUrl, $url , $prod);
        $this->render("subcategoriasmosaico",'front');
    }

    public function subcategoriaestado($estadoUrl = '', $producto = null, $url = null, $prod = null)
    {
		$estado = TableRegistry::get('Estados')->estadoPorUrl($estadoUrl);
		if($estado == null){
            return $this->redirect('/');
        }

		$estadoId = $estado->id;
        $this->loadModel('Ciudades');
        $ciudad = $this->Ciudades->find('all')->where(['Ciudades.estado_id' => $estadoId])->first();
        if($ciudad == null){
            return $this->redirect('/');
        }

		$ciudadUrl = $ciudad->url;
		$ciudades = [NULL => __('Ciudad')] + $this->Ciudades->find('list', [
		            'valueField' => 'nombre',
            		'keyField' => 'url',
		            'conditions' => [
		                'estado_id' => $estadoId
		            ]
		        ])->toArray();
		$this->set('showciudadeslist', 1);
		$this->set('ciudades', $ciudades);
		$this->set('estadourl', $estadoUrl);
        $this->subcategorias_datos($ciudadUrl, $url , $prod);
        $this->render("subcategoriasmosaico",'front');
    }

    private function subcategorias_datos($ciudadUrl, $categoriaUrl, $url , $prod){
        //codigo de carlos

       $conditions = [];

        if($this->UserAuth->isLogged()) {
            $this->direccion_logeado();
            $this->buscar_direcciones();
        }

        # $this->Categorias->recover();
        $opciones = $this->request->query;
        //$this->url = $url;
        // Obtenemos las categorias generales para menu


        // Obtenemos la categoria
        $categoria = $this->Categorias->find('all')->where(['Categorias.url'=>$categoriaUrl])->first();

        
        /*$this->loadModel('Filtros');
        $filtros = $this->Filtros->find('all', array(
            'conditions'=>array('Filtros.categoria_id =' => $categoria->id),
            'contain' => 'Opcionesfiltros'));*/

        //Obtenemos el minimo y maximo de los precios

        if( isset($this->request->query['precio'])){
            $precios = array();
            $precio = explode('-', $this->request->query['precio']);
            $precios['min'] = $precio[0];
            $precios['max'] = $precio[1];
            $this->set('precios', $precios);
        }

        if( isset($this->request->query['marca'])){
            $marca = $this->request->query['marca'];
        }
        $i=0;
                //$seleccion="OpcionefiltrosProductos.opcionesfiltro_id is not null ";
                $seleccion = '';
                 foreach($opciones as $k =>$val){
                    if(strpos($k,'art') !== false){
                        //$seleccion .= " and OpcionefiltrosProductos.opcionesfiltro_id =".$val;
                        if($i==0){

                             $seleccion .= 'Productos.id in (select producto_id from opcionefiltros_productos where  opcionefiltros_productos.opcionesfiltro_id='.$val;
                             $i++;

                        }else{

                            $seleccion .= ' and producto_id in (select producto_id from opcionefiltros_productos where  opcionefiltros_productos.opcionesfiltro_id='.$val.')';

                        }
                    }
                 }

        $ciudad = TableRegistry::get('Ciudades')->ciudadPorUrl($ciudadUrl);

        $condiciones = [];
        $condiciones = ['Productos.estatus_id'=>1];

        if ($rangoPrecio = $this->request->query('rango_precio')) {
            $rango = $this->rangoPrecios($rangoPrecio);
            $condiciones['Productos.'.$ciudad->precio.' <='] = $rango->max;
            $condiciones['Productos.'.$ciudad->precio.' >='] = $rango->min;
        }

        if ($tipo_flor = $this->request->query('tipo_flor')) {
            $condiciones['Productos.tipo_flor_id'] = $tipo_flor;
        }

        if ($nombre = $this->request->query('nombre_producto')) {
            $condiciones['Productos.nombre LIKE'] = "%{$nombre}%";
        }


        if(isset($marca)){
          $condiciones['Marcas.nombre']=$marca;
        }
        if($seleccion !=''){
          array_push($condiciones, $seleccion.')');
        }
         $sort='ASC';
         if( isset($this->request->query['sort'])){
              if($this->request->query['sort'] == 'DESC'){
                    $sort = 'DESC';
                }
        }

        
        $hijos = [];
        $productosCategorias = [];
        if($categoria){
            $hijos = $this->Categorias->find('children', ['for'=>$categoria->id])->find('list', ['keyField'=>'id', 'valueField'=>'id'])->toArray(); 
            $hijos[] = $categoria->id;

            $productosCategorias = $this->Categorias->Productos->find('list', ['keyField'=>'id', 'valueField'=>'id'])
                ->distinct(['Productos.id'])
                ->matching('Categorias', function ($q) use ($hijos) {
                               return $q->where( [ 'Categorias.id IN' => $hijos,'Productos.estatus_id'=>1,'Productos.deleted'=>0]);
                        })->toArray();

            if($productosCategorias){
                $condiciones['Productos.id IN'] = $productosCategorias;
            }else{
                $condiciones['Productos.id IN'] = [0];
            }
        }

       

        $condiciones['Ciudades.url'] = $ciudadUrl;
        $condiciones['Productos.adicional'] = false;
        $condiciones['Productos.deleted'] = false;
        $condiciones['Productos.activo'] = true;


        $this->loadModel('CiudadesProductos');
        $productos = $this->CiudadesProductos->find('all')
            ->distinct(['Productos.id'])
            ->contain([
                'Ciudades',
                'Productos.Imagenes',
                'Productos.Marcas',
                'Productos.Atributos.Opciones',
                'Productos.OpcionefiltrosProductos'
            ])
            ->where($condiciones)
            ->order (['Productos.'.$ciudad->precio => $sort]);


        $banners =  TableRegistry::get('CiudadesBanners')->find('all')
            ->contain(['Banners'])
            ->where(['ciudad_id' => $ciudad['id']])
            ->order('posicion ASC')
            ->toArray();


        $bannerRow = [];

        foreach ($banners as $key => $value) {
            $bannerRow[$key]['posicion'] = [$value->posicion];
            $bannerRow[$key]['columna'] =  [$value->columna];
            $bannerRow[$key]['banner'] =  [$value->banner];
        }


        // obtener arbol de categorias

        $treeList = $this->Categorias->find('treeList',['for' => $categoria->id]);
        $productos = $this->paginate($productos);
        $rangosPrecios = [NULL => 'Todos los precios'] + TableRegistry::get('RangoPrecios')->find('list')->toArray();
        $tipoFlores = [NULL => 'Cualquier tipo'] + TableRegistry::get('TipoFlores')->find('list')->toArray();

        $this->loadModel('Monedas');
        $monedas = $this->Monedas->find('list')->toArray();

        $this->set('currency', ($this->Cookie->read('currency') > 0)? $this->Cookie->read('currency') : 1);

        $settings =  getAllSettings();
        $tipocambio = $settings['tipocambio']['value'];

        $url_base = $url;
        
        $this->set(compact(
            'tipoFlores',
            'rangosPrecios',
            'productos',
            'banners',
            'treeList',
            'crumbs',
            'filtros',
            'categoria',
            'categoria_sub',
            'marcas',
            'opciones',
            'ciudad',
            'bannerRow',
            'monedas',
            'tipocambio',
            'url_base'
        ));

        $this->set('ciudad_url', $ciudadUrl);
        $this->set('_serialize', ['categorias']);
    }


    public function ciudadPorUrl($ciudadUrl = '')
    {
        return TableRegistry::get('Ciudades')->find('all')->where(['Ciudades.url' => $ciudadUrl])->first();
    }

    public function rangoPrecios($rangoPrecioId)
    {
        return TableRegistry::get('RangoPrecios')->find('all')->where(['id' => $rangoPrecioId])->first();
    }

    public function subcategorialista($ciudad = '', $url = null, $prod = null)
    {
        $this->subcategorias_datos($ciudad, $url , $prod);
        $this->render(null,'front');
    }

    public function changeLang($lang){
        $this->Cookie->write('lang', $lang);
        return $this->response;
    }

    public function changeCurrency($currency){
        $this->Cookie->write('currency', $currency);
        return $this->response;
    }

    public function getCiudades($estadoId)
    {
        $this->loadModel('Ciudades');
        $ciudades =  [NULL => __('Ciudad')] + $this->Ciudades->find('list', [
            'valueField' => 'nombre',
            'keyField' => 'id',
            'conditions' => [
                'estado_id' => $estadoId
            ]
        ])->toArray();
        $this->response->body(json_encode($ciudades));
        return $this->response;
    }

}
