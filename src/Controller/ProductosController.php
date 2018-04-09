<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;
use Cake\Utility\Inflector;

use Cake\I18n\Time;
use Cake\Network\Email\Email;
use PDF_Code128;
use MP;

use httpClient;

use Cake\Orm\TableRegistry;

use CompropagoSdk\Client;
use CompropagoSdk\Factory\Factory;
/**
 * Productos Controller
 *
 * @property \App\Model\Table\ProductosTable $Productos
 */

class ProductosController extends AppController
{
    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = ['Usermgmt.Tinymce', 'Usermgmt.Ckeditor','Usermgmt.Search'];

    /**
     * Components
     *
     * @var array
     */
    public $components = ['Usermgmt.Search','Cewi/Excel.Import'];

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
            'Productos'=>[
                'Productos'=>[
                    'type'=>'text',
                    'label'=>'Buscar',
                    'tagline'=>'Busca por nombre de producto o código',
                    'condition'=>'multiple',
                    'searchFields'=>['Productos.nombre', 'Productos.sku'],
                    'inputOptions'=>['style'=>'width:300px;']
                ],

                'Productos.estatus_id'=>[
                    'type'=>'select',
                    'label'=>'Estatus',
                    'model'=>'ProductosEstatuses',
                    'selector'=>'getEstatuses'
                ]
            ]
        ],
        'masiva'=>[
            'Productos'=>[
                'Productos'=>[
                    'type'=>'text',
                    'label'=>'Buscar',
                    'tagline'=>'<br>Busca por nombre de producto, código y codigo de fabricante',
                    'condition'=>'multiple',
                    'searchFields'=>['Productos.nombre', 'Productos.sku', 'Productos.codigo_fabricante'],
                    'inputOptions'=>['style'=>'width:300px;']
                ],
                'Categorias.id'=>[
                    'type'=>'select',
                    'label'=>'Categorias',
                    'model'=>'Categorias',
                    'selector'=>'GetCategorias',
                ],
                'Productos.marca_id'=>[
                    'type'=>'select',
                    'label'=>'Marca',
                    'model'=>'Marcas',
                    'selector'=>'GetMarcas'



                ],
                'Productos.proveedor_id'=>[
                    'type'=>'select',
                    'label'=>'Proveedor',
                    'model'=>'Proveedores',
                    'selector'=>'getProveedores'
                ],
                'Productos.estatus_id'=>[
                    'type'=>'select',
                    'label'=>'Estatus',
                    'model'=>'ProductosEstatuses',
                    'selector'=>'getEstatuses'
                ]
            ]
        ]
    ];


    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Categorias');
        $categorias_principales = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado = 1'],
            'order' => ['Categorias.orden' => 'DESC']
        ])->toArray();

        $categorias_secundarias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is not null and publicado=1']
        ])->toArray();

        $this->set(compact('categorias_principales', 'categorias_secundarias'));

    }

    public $categoria_id = null;

    public function beforeFilter(\Cake\Event\Event $event){

        parent::beforeFilter($event);

        if($this->request->params['action']=='masiva'){
            $this->categoria_id='';
            if(isset($this->request->data['Categorias']['id'])){
                //debug($this->request->data['Categorias']['id']);
                $this->categoria_id=$this->request->data['Categorias']['id'];
                unset($this->request->data['Categorias']);
            }else{
                $sesion=$this->request->session();
                //debug($sesion->read('UserAuth.Search.Productos.masiva.Categorias'));
                $categorias=$sesion->read('UserAuth.Search.Productos.masiva.Categorias');
                if(!is_null($categorias)){
                    //debug($categorias['id']);
                    $this->categoria_id=$categorias['id'];
                    $sesion->delete('UserAuth.Search.Productos.masiva.Categorias');
                }
            }
            if(isset($this->request->data['search_clear']) && $this->request->data['search_clear'] ==1){
                $this->categoria_id='';
            }
            //debug($this->categoria_id);
            //$sesion->delete('UserAuth.Search.Productos.masiva');
            //debug($this->request->data);
        }

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = ['Productos.deleted'=>false];
        $this->paginate = ['limit'=>10, 'order'=>['Productos.id'=>'DESC'],'contain'=>['Marcas','Proveedores','ProductosEstatuses'], 'conditions'=>$conditions];
        $this->Search->applySearch($conditions);

        $productos = $this->paginate($this->Productos)->toArray();
        $this->set(compact('productos'));

        if($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $this->render('/Element/all_productos');
        }
    }


    /**
     * View method
     *
     * @param string|null $id Producto id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $producto = $this->Productos->get($id, [
            'contain' => ['Usuarios', 'Marcas', 'Proveedores', 'Categorias', 'Promociones', 'Atributos', 'Cupones', 'Imagenes', 'Preciocomeptencias', 'Precios']
        ]);
        $this->set('producto', $producto);
        $this->set('_serialize', ['producto']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $producto = $this->Productos->newEntity();
        if ($this->request->is('post')) {

            //preg_match_all("",$contenido,$matches)

            $producto = $this->Productos->patchEntity($producto, $this->request->data);

            $producto['activo'] = $producto['estatus_id'];
            if($producto['activo'] == true){
                $producto['fecha_publicacion'] = date('Y-m-d H:m:s');
            }

            $producto['meta_titulo'] = $producto['nombre'];
            $producto['meta_descripcion'] = $producto['descripcion_corta'];


            if(preg_match_all("#<strong>(.*?)</strong>#s", $producto['descripcion_larga'],$matches))
            {
                $num_matches = count($matches[1]);
                //echo "Matches: " . $num_matches . "\n";
                for ($i = 0; $i < $num_matches; $i++) {
                    $producto['meta_keywords'] .= $matches[1][$i].", ";
                }
            }

            $producto['meta_keywords'] =  strtolower(substr($producto['meta_keywords'], 0, -2));

            $registro_producto = $this->Productos->save($producto);


            $this->Flash->success(__('El producto se guardo.'));
            return $this->redirect('/productos/edit/'.$registro_producto->id);


        }

        $estatus = $this->Productos->ProductosEstatuses->find('list');
        $usuarios = $this->Productos->Usuarios->find('list', ['limit' => 200]);
        $marcas = $this->Productos->Marcas->find('list', ['order' => ['nombre' => 'asc']]);
        $proveedores = $this->Productos->Proveedores->find('list', ['limit' => 200]);
        $categorias = $this->Productos->Categorias->find('list', ['limit' => 200]);
        $promociones = $this->Productos->Promociones->find('list', ['limit' => 200]);
        $sucursales = $this->Productos->Sucursales->find('list', ['limit' => 200]);
        $this->set(compact('estatus', 'producto', 'usuarios', 'marcas', 'proveedores', 'categorias', 'promociones', 'sucursales'));
        $this->set('_serialize', ['producto']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Producto id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $producto = $this->Productos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $producto = $this->Productos->patchEntity($producto, $this->request->data);

            $producto['activo'] = $producto['estatus_id'];
            if($producto['activo'] == true){
                $producto['fecha_publicacion'] = date('Y-m-d H:m:s');
            }
        if (!$producto['meta_titulo']){
            $producto['meta_titulo'] = $producto['nombre'];
            $producto['meta_descripcion'] = $producto['descripcion_corta'];
            $producto['meta_keywords'] = '';

            if(preg_match_all("#<strong>(.*?)</strong>#s", $producto['descripcion_larga'],$matches))
            {
                $num_matches = count($matches[1]);
                //echo "Matches: " . $num_matches . "\n";
                for ($i = 0; $i < $num_matches; $i++) {
                    $producto['meta_keywords'] .= $matches[1][$i].", ";
                }
            }

            $producto['meta_keywords'] =  strtolower(substr($producto['meta_keywords'], 0, -2));

        }


            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del producto.'));
            }
        }


        //die(debug($precioscompetencia->toArray()));
        $estatus = $this->Productos->ProductosEstatuses->find('list');
        $usuarios = $this->Productos->Usuarios->find('list', ['limit' => 200]);
        $marcas = $this->Productos->Marcas->find('list', ['order' => ['nombre' => 'asc']]);
        $proveedores = $this->Productos->Proveedores->find('list', ['limit' => 500]);
        $categorias = $this->Productos->Categorias->find('treeList', ['spacer' => '-']);
        $promociones = $this->Productos->Promociones->find('list', ['limit' => 200]);
        $sucursales = $this->Productos->Sucursales->find('list', ['limit' => 200]);

        //$this->loadModel('ComplementosCategorias');
        $categoria_relacionada = $this->Productos->ComplementosCategorias->find('all')->where(['producto_id'=>$id])->first();

        $this->set(compact('estatus', 'producto', 'usuarios', 'marcas', 'proveedores', 'categorias', 'promociones', 'precioscompetencia','categoria_relacionada', 'sucursales'));
        $this->set('_serialize', ['producto']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Producto id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producto = $this->Productos->get($id);
        $producto->deleted = true;
        if ($this->Productos->save($producto)) {
            $this->Flash->success(__('El producto fue borrado.'));
        } else {
            $this->Flash->error(__('El producto no se pudo borrar. Intentalo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

 /**
     * masiva method
     *
     * @return void
     */
    public function masiva()
    {

                $this->paginate =  ['limit'=>200,
                                    'order'=>['Productos.id'=>'DESC'],
                                    'contain'=>['Marcas','Proveedores','ProductosEstatuses','Categorias']
                                    ];
                //debug($this->request->data);
                if(!is_null($this->categoria_id) && $this->categoria_id !=''){
                    $this->paginate['finder'] = ['Categorias' => ['categoria_id' => $this->categoria_id]];
                }
                $this->Search->applySearch();
                if(!is_null($this->categoria_id) && $this->categoria_id !=''){
                    $sesion=$this->request->session();
                    $sesion->write('UserAuth.Search.Productos.masiva.Categorias.id',$this->categoria_id);
                }

          $this->set('estatus', $this->Productos->ProductosEstatuses->find('list')->toArray());


        $productos = $this->paginate($this->Productos)->toArray();
        $marcas=$this->Productos->Marcas->find('list')->toArray();
        $categorias = $this->Productos->Categorias->find('treeList');
        $this->set(compact('productos','marcas','categorias'));
        $this->set('categoria_selected',$this->categoria_id);

        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_productosmasiva');
        }
    }


 public function carga()
    {
        $logeado = $this->UserAuth->getUser();
        $unocero = array('SI' => 1, 'NO' => 0);
        $cant=0;
                $ok=0;
                $nok=0;
                $actualizado=0;
                $nuevo_proveedor=0;
                $mal=array();

        if ($this->request->is('post')) {
            if(!move_uploaded_file($this->request->data('file.tmp_name'),TMP. $this->request->data('file.name'))){
                $this->Flash->error(__('NO fue posible procesar el archivo, por favor vuelva a intentar'));

            }else{
                //debug($this->request->data);
                $filename=TMP. $this->request->data('file.name');

                $data = $this->Import->prepareEntityData($filename);
                foreach($data as $row){

                    $busqueda_producto = $this->Productos->find('all', ['conditions'=>['Productos.codigo_fabricante'=>$row['NO_PARTE']]])->first();

                    if(empty($busqueda_producto)){ // Producto nuevo

                            $producto = $this->Productos->newEntity();
                            $producto = $this->Productos->patchEntity($producto, $row);


                            $producto['usuario_id'] = $logeado['User']['id'];
                            $producto['usuario'] = $logeado['User']['first_name']." ".$logeado['User']['last_name'];
                            $producto['proveedor_id'] = $this->request->data('proveedor_id');
                            $producto['sku'] = $row['SKU'];
                            $producto['codigo_fabricante'] = $row['NO_PARTE'];
                            $producto['nombre'] = $row['NOMBRE'];
                            $producto['frase_push'] = $row['PUSH'];
                            $producto['descripcion_corta'] = $row['DESCRIPCION_CORTA'];
                            $producto['descripcion_larga'] = $row['DESCRIPCION_LARGA'];
                            $producto['ficha_tecnica'] = $row['FICHA_TECNICA'];
                            $producto['largo'] = $row['LARGO'];
                            $producto['ancho'] = $row['ANCHO'];
                            $producto['alto'] = $row['ALTO'];
                            $producto['peso'] = $row['PESO'];
                            $producto['costo'] = $row['COSTO_SIN_IVA'];
                            $producto['precio'] = $row['PRECIO_META'];
                            $producto['envio_gratis'] = $unocero[$row['INCLUYE_ENVIO']];
                            $producto['garantia'] = $row['GARANTIA'];
                            $producto['marca'] = $row['MARCA'];
                            $producto['existencia'] = $row['STOCK'];


                            $producto['meta_titulo'] = $producto['nombre'];
                            $producto['meta_descripcion'] = $producto['descripcion_corta'];

                            $producto['estatus_id'] = 2;
                            $producto['url'] = $this->crea_url($producto['nombre']);
                            $marca=$this->Productos->Marcas->find('all')->where("nombre ='".$row['MARCA']."'")->first();
                            $producto['marca_id'] = $marca['id'];

                            // $producto['modelo'] = ;
                            // $producto['fecha_publicacion'] = ;


                            // $producto['meta_keywords'] = ;
                            // $producto['peso_volumetrico'] = ;
                            // $producto['margen'] = ;
                            // $producto['tiempo_de_entrega'] = ;

                            // $producto['proveedores'] = ;
                            // $producto['atributos'] = ;
                            // $producto['cupones'] = ;
                            // $producto['imagenes'] = ;
                            // $producto['preciocomeptencias'] = ;
                            // $producto['precios'] = ;
                            // $producto['categorias'] = ;
                            // $producto['promociones'] = ;

                            $producto['modified'] = date("Y-m-d H:m:s");

                            $cant++;
                            if($this->Productos->save($producto)){
                                $ok++;

                                $this->precios_proveedor($producto['id'], $this->request->data('proveedor_id'), $producto['costo'], 0, $producto['precio'], $producto['existencia'], true, $producto['envio_gratis']);
                            }else{
                                $nok++;
                                $mal[$producto['sku']]=1;
                            }




                    }else{ // Producto existente



                        ///////////////////////////////////////////

                        $cant++;

                        // CALCULO NUEVO PRECIO
                        if($busqueda_producto['margen'] > 0){

                            $peso = $busqueda_producto['peso'];
                            $cubicaje = ($busqueda_producto['largo'] / 100) * ($busqueda_producto['ancho'] / 100) * ($busqueda_producto['alto'] / 100);
                            $nuevo_precio = $this->recalculaPrecio($row['COSTO_SIN_IVA'], $busqueda_producto['envio_gratis'], $busqueda_producto['margen'], $peso, $cubicaje, $unocero[$row['INCLUYE_ENVIO']]);

                        }else{

                            $nuevo_precio = 0;

                        }


                            $activo = false;
                            if($busqueda_producto['proveedor_id'] == $this->request->data('proveedor_id')){ // ACTUAL PROVEEDOR ES EL SELECCIONADO

                                if ($row['STOCK'] <= 0) { // NUEVA EXISTENCIA 0

                                    $busqueda_producto['estatus_id'] = 0;

                                    $cambio_publicacion++;

                                    $busqueda_producto['costo'] = $row['COSTO_SIN_IVA'];
                                    $busqueda_producto['precio'] = $nuevo_precio;
                                    $busqueda_producto['existencia'] = 0;
                                    $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                                    $this->Productos->save($busqueda_producto);

                                    $actualizado++;
                                    $activo = true;

                                }else{  // NUEVA EXISTENCIA > 0

                                    if($nuevo_precio > 0){
                                        $busqueda_producto['estatus_id'] = 1;
                                    }else{
                                        $busqueda_producto['estatus_id'] = 0;
                                    }

                                    $busqueda_producto['costo'] = $row['COSTO_SIN_IVA'];
                                    $busqueda_producto['precio'] = $nuevo_precio;
                                    $busqueda_producto['existencia'] = $row['STOCK'];
                                    $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                                    $this->Productos->save($busqueda_producto);

                                    $actualizado++;
                                    $activo = true;
                                }

                            }else{ // PROVEEDOR ACTUAL NO ES EL SELECCIONADO

                                if ($row['STOCK'] > 0 && $row['COSTO_SIN_IVA'] < $busqueda_producto['costo']) { // NUEVA EXISTENCIA > 1

                                    if($nuevo_precio > 0){
                                        $busqueda_producto['estatus_id'] = 1;
                                    }else{
                                        $busqueda_producto['estatus_id'] = 0;
                                    }

                                    $busqueda_producto['proveedor_id'] = $this->request->data('proveedor_id');
                                    $busqueda_producto['costo'] = $row['COSTO_SIN_IVA'];
                                    $busqueda_producto['precio'] = $nuevo_precio;
                                    $busqueda_producto['existencia'] = $row['STOCK'];
                                    $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                                    $this->Productos->save($busqueda_producto);

                                    $actualizado++;
                                    $nuevo_proveedor++;
                                    $activo = true;
                                }

                            }


                        $this->precios_proveedor($busqueda_producto['id'], $this->request->data('proveedor_id'), $row['COSTO_SIN_IVA'], $busqueda_producto['margen'], $nuevo_precio, $row['STOCK'], $activo, $unocero[$row['INCLUYE_ENVIO']]);

                        //////////////////////////////////////////


                    }




                }
            }

        }

        $proveedores = $this->Productos->Proveedores->find('list', ['limit' => 500]);
        $this->set(compact('proveedores','cant','ok','nok','mal', 'actualizado', 'nuevo_proveedor'));

    }


    public function precios_proveedor($producto_id, $proveedor_id, $costo, $margen, $precio, $existencia, $activo, $envio_gratis){

        $this->loadModel('Precios');

        if($activo == true){

            $this->Precios->updateAll(['activo' => false], ['producto_id' => $producto_id]);

        }

        // CHECO SI EXISTE UN REGISTRO DE PRECIOS
        $registro_precio = $this->Precios->find('all', ['conditions' => ['Precios.producto_id'=>$producto_id, 'proveedor_id'=>$proveedor_id]])->first();

        if(!empty($registro_precio)){

            $registro_precio['costo'] = $costo;
            $registro_precio['margen'] = $margen;
            $registro_precio['precio'] = $precio;
            $registro_precio['existencia'] = $existencia;
            $registro_precio['activo'] = $activo;
            $registro_precio['envio_gratis'] = $envio_gratis;
            $registro_precio['modified'] = date('Y-m-d H:m:s');

            $this->Precios->save($registro_precio);

        }else{

            $nuevo_registro_precio = $this->Precios->newEntity();
            $nuevo_registro_precio['producto_id'] = $producto_id;
            $nuevo_registro_precio['proveedor_id'] = $proveedor_id;
            $nuevo_registro_precio['usuario_id'] = 3;
            $nuevo_registro_precio['costo'] = $costo;
            $nuevo_registro_precio['margen'] = $margen;
            $nuevo_registro_precio['precio'] = $precio;
            $nuevo_registro_precio['existencia'] = $existencia;
            $nuevo_registro_precio['activo'] = $activo;
            $nuevo_registro_precio['envio_gratis'] = $envio_gratis;
            $nuevo_registro_precio['created'] = date('Y-m-d H:m:s');
            $nuevo_registro_precio['modified'] = date('Y-m-d H:m:s');

            $this->Precios->save($nuevo_registro_precio);

        }

    }


    public function recalculaPrecio($vendor, $envio, $margen, $peso, $cubicaje,$envio_fijo){


        if($envio == true){

            if($envio_fijo>0){

                $costo_envio =$envio_fijo;

            }else{

                $distancia_media = 1300; //Kilómetros

                $tarifa_peso = $this->Enviotarifas->find('all', array(
                    'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin',
                    $peso.' BETWEEN peso_inicio AND peso_fin')))->first();


                $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                    'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin',
                    'cubicaje >=' => $cubicaje),
                    'order' => 'cubicaje ASC'))->first();

                if(is_null($tarifa_peso)){
                    $tarifa_peso->precio=0;
                }
                if(is_null($tarifa_cubicaje)){
                    $tarifa_cubicaje->precio=0;
                }

                if($tarifa_peso->precio > $tarifa_cubicaje->precio)
                {
                    $costo_envio = $tarifa_peso->precio;
                }else{
                    $costo_envio = $tarifa_cubicaje->precio;
                }

            }

        }else{

                $costo_envio = 0;

        }

        $costo_tarjeta = (($vendor + $costo_envio) + (($vendor + $costo_envio) * ($margen / 100))) * .04;
        $nuevo_precio = (($vendor + $costo_envio + $costo_tarjeta) + (($vendor + $costo_envio + $costo_tarjeta) * ($margen / 100)));

        return $nuevo_precio;

    }

    public function crea_url($url) {

        $url=Inflector::slug($url);
        $url=strtolower($url);
        return $url;

        // $url = preg_replace('/á|à|â|ã|ª/','a',$url);
        // $url = preg_replace('/Á|À|Â|Ã/','a',$url);
        // $url = preg_replace('/é|è|ê/','e',$url);
        // $url = preg_replace('/É|È|Ê/','e',$url);
        // $url = preg_replace('/í|ì|î/','i',$url);
        // $url = preg_replace('/Í|Ì|Î/','i',$url);
        // $url = preg_replace('/ó|ò|ô|õ|º/','o',$url);
        // $url = preg_replace('/Ó|Ò|Ô|Õ/','o',$url);
        // $url = preg_replace('/ú|ù|û/','u',$url);
        // $url = preg_replace('/Ú|Ù|Û/','u',$url);

        // $url = str_replace('ñ','n',$url);
        // $url = str_replace('Ñ','n',$url);

        // $url = str_replace('‘','', $url);
        // $url = str_replace(' ','-',$url);
        // $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        // $url = trim($url, '-');
        // return $url;
    }


    public function url_existente()
    {
        if ($this->request->is('post')) {

            $busca_url = $this->Productos->find('all', ['conditions' => ['Productos.url' => $this->request->data['url']]])->first();

            die(json_encode(count($busca_url)));

            //die(debug($busca_url));
        }
    }

    public function masiva_columna(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                foreach($this->request->data['check'] as $k => $id){
                    $producto = $this->Productos->get($id);

                    $producto[$this->request->data['columna']]=$this->request->data[$this->request->data['columna']];

                    $this->Productos->save($producto);

                }
            }

        }
        $this->redirect(['action'=>'masiva']);
    }

    public function editmodal($id = null,$columna=null)
    {

        if(is_null($id) || is_null($columna)){
            return false;
            exit;
        }

        $producto = $this->Productos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $producto = $this->Productos->patchEntity($producto, $this->request->data);


            if($producto['estatus_id'] == 1){
                $producto['fecha_publicacion'] = date('Y-m-d H:m:s');
            }


            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                //return $this->redirect('/productos/masiva/'.$id);
                $this->redirect( $this->request->referer() );
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del producto.'));
            }
        }


        //die(debug($precioscompetencia->toArray()));
        $estatus_ids = $this->Productos->ProductosEstatuses->find('list');
        $marca_ids = $this->Productos->Marcas->find('list', ['order' => ['nombre' => 'asc']]);
        $proveedor_ids = $this->Productos->Proveedores->find('list', ['limit' => 500]);

        $this->set(compact('estatus_ids', 'producto', 'marca_ids', 'proveedor_ids','columna'));
        $this->set('_serialize', ['producto']);
        $this->layout = 'blank';
    }


    public function editajax($id = null,$columna=null)
    {

        if(is_null($id) || is_null($columna)){
            return false;
            exit;
        }
        $saved=0;

        $producto = $this->Productos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $producto = $this->Productos->patchEntity($producto, $this->request->data);


            if($producto['estatus_id'] == 1){
                $producto['fecha_publicacion'] = date('Y-m-d H:m:s');
            }

            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                //return $this->redirect('/productos/masiva/'.$id);
                //$this->redirect( $this->request->referer() );
                $saved=1;
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del producto.'));
            }
        }


        //die(debug($precioscompetencia->toArray()));
        $estatus_ids = $this->Productos->ProductosEstatuses->find('list');
        $marca_ids = $this->Productos->Marcas->find('list', ['order' => ['nombre' => 'asc']]);
        $proveedor_ids = $this->Productos->Proveedores->find('list', ['limit' => 500]);

        $this->set(compact('estatus_ids', 'producto', 'marca_ids', 'proveedor_ids','columna','saved'));
        $this->set('_serialize', ['producto']);
        $this->layout = 'ajax';
    }


    public function editarpeso($id = null)
    {

        if(is_null($id)){
            return false;
            exit;
        }

        $producto = $this->Productos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $producto = $this->Productos->patchEntity($producto, $this->request->data);


            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                //return $this->redirect('/productos/masiva/'.$id);
                $this->redirect( $this->request->referer() );
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del producto.'));
            }
        }


        $this->set(compact('producto'));
        $this->set('_serialize', ['producto']);
        $this->layout = 'ajax';
    }


    public function masiva_peso(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                foreach($this->request->data['check'] as $k => $id){
                    $producto = $this->Productos->get($id);

                    $producto['ancho']=$this->request->data['mancho'];
                    $producto['largo']=$this->request->data['mlargo'];
                    $producto['alto']=$this->request->data['malto'];
                    $producto['peso_volumetrico']=$this->request->data['mpeso_volumetrico'];
                    $producto['peso']=$this->request->data['mpeso'];

                    $this->Productos->save($producto);

                }
            }

        }
        $this->redirect( $this->request->referer() );
    }

    public function masiva_categoria(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                $this->loadModel('CategoriasProductos');

                foreach($this->request->data['check'] as $k => $id){
                    $categoria_id=$this->request->data['categoria_id'];
                    $registro = $this->CategoriasProductos->find('all')->where(['producto_id'=> $id, 'categoria_id' => $categoria_id])->first();
                    if(!isset($registro['id'])){
                        $nuevo = $this->Productos->newEntity();
                        $nuevo = $this->Productos->patchEntity($nuevo, $this->request->data);
                        $nuevo['categoria_id']=$categoria_id;
                        $nuevo['producto_id']=$id;
                        $this->CategoriasProductos->save($nuevo);
                    }

                }
            }

        }
        $this->redirect( $this->request->referer() );
    }

    public function masiva_atributos(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                $this->loadModel('Atributos');

                foreach($this->request->data['check'] as $k => $id){
                    for($i=1;$i<=5;$i++){
                        $atributo=$this->request->data['atributo_'.$i];
                        if($atributo != ""){
                            $nuevo = $this->Atributos->newEntity();
                            $nuevo['nombre']=$atributo;
                            $nuevo['producto_id']=$id;
                            $this->Atributos->save($nuevo);
                        }
                    }
                }
            }

        }
        $this->redirect( $this->request->referer() );
    }

    public function masiva_complementos(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                $this->loadModel('ComplementosProductos');
                $todos=explode(',', $this->request->data['producto_relacionados']);

                foreach($this->request->data['check'] as $k => $id){
                    foreach ($todos as $complemento_id) {
                        $complementosProducto = $this->ComplementosProductos->newEntity();
                        $complementosProducto->complemento_id = $complemento_id;
                        $complementosProducto->producto_id = $id;
                        $this->ComplementosProductos->save($complementosProducto);
                    }
                }
            }

        }
        $this->redirect( $this->request->referer() );
    }


    public function relacionados($id = null)
    {

        $producto = $this->Productos->get($id);



        //die(debug($precioscompetencia->toArray()));
        $estatus = $this->Productos->ProductosEstatuses->find('list');
        $usuarios = $this->Productos->Usuarios->find('list', ['limit' => 200]);
        $marcas = $this->Productos->Marcas->find('list', ['order' => ['nombre' => 'asc']]);
        $proveedores = $this->Productos->Proveedores->find('list', ['limit' => 500]);
        //$categorias = $this->Productos->Categorias->find('list', ['limit' => 200]);
        $promociones = $this->Productos->Promociones->find('list', ['limit' => 200]);

        $categorias = $this->Productos->Categorias->find('treeList', ['spacer' => '-']);
        $categoria_relacionada = $this->Productos->ComplementosCategorias->find('all')->where(['producto_id'=>$id])->first();

        $this->set(compact('estatus', 'producto', 'usuarios', 'marcas', 'proveedores', 'categorias', 'promociones', 'precioscompetencia','categoria_relacionada'));
        $this->set('_serialize', ['producto']);
        $this->layout = 'blank';
    }

    public function atributos($id = null)
    {

        $producto = $this->Productos->get($id);



        //die(debug($precioscompetencia->toArray()));
        $estatus = $this->Productos->ProductosEstatuses->find('list');
        $usuarios = $this->Productos->Usuarios->find('list', ['limit' => 200]);
        $marcas = $this->Productos->Marcas->find('list', ['order' => ['nombre' => 'asc']]);
        $proveedores = $this->Productos->Proveedores->find('list', ['limit' => 500]);
        $categorias = $this->Productos->Categorias->find('list', ['limit' => 200]);
        $promociones = $this->Productos->Promociones->find('list', ['limit' => 200]);
        $this->set(compact('estatus', 'producto', 'usuarios', 'marcas', 'proveedores', 'categorias', 'promociones', 'precioscompetencia'));
        $this->set('_serialize', ['producto']);
        $this->layout = 'blank';
    }



    public function masiva_margen(){

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                foreach($this->request->data['check'] as $k => $id){

                    //Tomo el producto
                    $producto = $this->Productos->get($id);
                    $costo=$producto->costo;
                    $porcentaje=$this->request->data['margen'];
                    //debug('Costo:'.$costo);
                    //debug('Porcentaje:'.$porcentaje);

                    //Si tiene envío gratis tomo su costo de envio
                    $costo_envio=0;
                    if($producto->envio_gratis){
                        $peso = $producto->peso;
                        $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);

                        $costo_envio=$this->get_envio($producto->id,$peso,$cubicaje);
                    }

                    //debug('CostoEnvio:'.$costo_envio);

                    $margen  = ($costo*$porcentaje)/100;
                    //debug('Margen:'.$margen);

                    $suma=$costo+$margen;
                    //debug('Suma:'.$suma);

                    $iva = $suma*($this->iva); //Sacamos el IVA del vendor mas porcentaje, el envio ya trae iva.
                    //debug('IVA'.$iva);

                    $suma=$suma+$iva+$costo_envio; //Sumamos todo
                    $noventayseis = $suma; //La suma hasta el momento es el 96% del precio
                    //debug('95%:'.$noventayseis);

                    $costo_pago = ($noventayseis/96)*4; //El costo de pago es el 4% del precio final
                    //debug('CostoPago:'.$costo_pago);

                    //$total_costos=$suma+$costo_pago-$margen; //Ahora sumas todos los costos (resto el margen para no sumarlo dos veces)
                    $msrp=$noventayseis+$costo_pago; //El precio (MSRP) es la suma de todo.
                    //debug('Msrp:'.$msrp);

                    $producto['margen']=$porcentaje;
                    $producto['precio']=$msrp;
                    //die;
                    $this->Productos->save($producto);

                }
            }
        }

        $this->redirect( $this->request->referer() );
    }

    public function masiva_ganancia(){

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                foreach($this->request->data['check'] as $k => $id){

                    //Tomo el producto
                    $producto = $this->Productos->get($id);
                    $costo=$producto->costo;
                    $ganancia=$this->request->data['ganancia'];

                    $porcentaje=$ganancia/$costo*100;

                    //$porcentaje=$this->request->data['margen'];
                    //debug('Costo:'.$costo);
                    //debug('Porcentaje:'.$porcentaje);

                    //Si tiene envío gratis tomo su costo de envio
                    $costo_envio=0;
                    if($producto->envio_gratis){
                        $peso = $producto->peso;
                        $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);

                        $costo_envio=$this->get_envio($producto->id,$peso,$cubicaje);
                    }

                    //debug('CostoEnvio:'.$costo_envio);

                    $margen  = ($costo*$porcentaje)/100;
                    //debug('Margen:'.$margen);

                    $suma=$costo+$margen;
                    //debug('Suma:'.$suma);

                    $iva = $suma*($this->iva); //Sacamos el IVA del vendor mas porcentaje, el envio ya trae iva.
                    //debug('IVA'.$iva);

                    $suma=$suma+$iva+$costo_envio; //Sumamos todo
                    $noventayseis = $suma; //La suma hasta el momento es el 96% del precio
                    //debug('95%:'.$noventayseis);

                    $costo_pago = ($noventayseis/96)*4; //El costo de pago es el 4% del precio final
                    //debug('CostoPago:'.$costo_pago);

                    //$total_costos=$suma+$costo_pago-$margen; //Ahora sumas todos los costos (resto el margen para no sumarlo dos veces)
                    $msrp=$noventayseis+$costo_pago; //El precio (MSRP) es la suma de todo.
                    //debug('Msrp:'.$msrp);

                    $producto['margen']=$porcentaje;
                    $producto['precio']=$msrp;
                    //die;
                    $this->Productos->save($producto);

                }
            }
        }

        $this->redirect( $this->request->referer() );
    }

    public function get_envio($id=null,$peso=null,$cubicaje=null){
        $costo_envio=0;
        $distancia_media = $this->distancia_media; //Kilómetros
        $this->loadModel('Enviotarifas');

            $tarifa_peso = $this->Enviotarifas->find('all', array(
                'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin',
                $peso.' BETWEEN peso_inicio AND peso_fin')))->first();


            $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin',
                'cubicaje >=' => $cubicaje),
                'order' => 'cubicaje ASC'))->first();

            if(is_null($tarifa_peso)){
                $tarifa_peso->precio=0;
            }
            if(is_null($tarifa_cubicaje)){
                $tarifa_cubicaje->precio=0;
            }

            if($tarifa_peso->precio > $tarifa_cubicaje->precio)
            {
                $costo_envio = $tarifa_peso->precio;
            }else{
                $costo_envio = $tarifa_cubicaje->precio;
            }

            return $costo_envio;
    }

    public function edit_categoria_relacionada($producto_id=null)
    {

        $deleted = $this->Productos->ComplementosCategorias->deleteAll(['producto_id' => $producto_id]);
        $nuevo=$this->Productos->ComplementosCategorias->newEntity();
        $nuevo['producto_id']=$producto_id;
        $nuevo['categoria_id']=$this->request->data['categoria_relacionada'];
        if($this->Productos->ComplementosCategorias->save($nuevo)){
            $this->Flash->success(__('Se guardó la categoría relacionada.'));
        } else {
            $this->Flash->error(__('No se pudo guardar el cambio en categoría, por favor intente de nuevo.'));
        }

        $this->redirect( $this->request->referer() );
    }

    public function masiva_categoria_relacionada()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['check'])){
                $categoria_relacionada =  $this->request->data['categoria_relacionada'];

                foreach($this->request->data['check'] as $k => $id){
                        $deleted = $this->Productos->ComplementosCategorias->deleteAll(['producto_id' => $id]);
                        $nuevo=$this->Productos->ComplementosCategorias->newEntity();
                        $nuevo['producto_id']=$id;
                        $nuevo['categoria_id']=$categoria_relacionada;
                        $this->Productos->ComplementosCategorias->save($nuevo);
                }
            }

        }

        $this->redirect( $this->request->referer() );
    }

    public function precios_view($id = null)
    {

        $producto = $this->Productos->get($id,['contain'=>['Proveedores']]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $producto = $this->Productos->patchEntity($producto, $this->request->data);
            $producto['modified']=date('Y-m-d H:i:s');

            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                $producto = $this->Productos->get($id,['contain'=>['Proveedores']]);
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del producto.'));
            }
        }


        //die(debug($precioscompetencia->toArray()));
        $usuarios = $this->Productos->Usuarios->find('list', ['limit' => 200]);
        $proveedores = $this->Productos->Proveedores->find('list', ['limit' => 500]);

        $this->set(compact( 'producto', 'usuarios',  'proveedores'));
        $this->set('_serialize', ['producto']);
        $this->layout='iframe';
    }

    public function versiones_view($id = null)
    {

        $versiones = $this->Productos->find('all',['contain'=>['Proveedores'], 'conditions'=>['Productos.padre_id'=>$id]]);

        $this->set(compact( 'versiones','id'));
        $this->set('_serialize', ['versiones']);
        $this->layout='iframe';
    }

    public function versiones_edit($id = null)
    {

        $producto = $this->Productos->get($id,['contain'=>['Proveedores']]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $producto = $this->Productos->patchEntity($producto, $this->request->data);
            $producto['modified']=date('Y-m-d H:i:s');

            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                return $this->redirect('/productos/versiones_view/'.$producto['padre_id']);
            } else {
                $this->Flash->error(__('No se pudieron guardar los cambios del producto.'));
            }
        }
        $padre_id=$producto['padre_id'];
        $this->set(compact( 'producto','padre_id'));
        $this->set('_serialize', ['producto']);
        $this->layout='iframe';
    }

    public function versiones_add($padre_id = null)
    {

       $producto = $this->Productos->newEntity();
        if ($this->request->is('post')) {

            $producto = $this->Productos->patchEntity($producto, $this->request->data);
            $producto['modified']=date('Y-m-d H:i:s');
            $producto['padre_id']=$padre_id;

            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                return $this->redirect('/productos/versiones_view/'.$producto['padre_id']);
            } else {
                $this->Flash->error(__('No se pudieron guardar los cambios del producto.'));
            }
        }


        $this->set(compact( 'producto','padre_id'));
        $this->set('_serialize', ['producto']);
        $this->layout='iframe';
    }

    public function versiones_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producto = $this->Productos->get($id);
        if ($this->Productos->delete($producto)) {
            $this->Flash->success(__('La versión se ha eliminado'));
        } else {
            $this->Flash->error(__('La versión no pudo ser eliminada, por favor intente de nuevo.'));
        }
        return $this->redirect(['action' => 'versiones_view',$producto['padre_id']]);
    }


    public function emailcotizar(){

        $this->loadModel("Settings");
        $emailcotizar = $this->Settings->find("all",['conditions'=> ['Settings.name ' => 'emailcotizar' ] ] )->first();


        if ($this->request->is('post')) {

            $settings = $this->Settings->get( $emailcotizar->id  );


            $settings  = $this->Settings->patchEntity($settings, $this->request->data );

            $settings['value'] = $this->request->data['Email'];

            $emailcotizar = $this->Settings->save($settings);

        }




        $this->set(compact( 'emailcotizar'));


    }



    public function detalle($estadoUrl = null, $ciudadUrl = null, $url = null, $comentario =null)
    {
        $is_shopping = explode('/', $this->request->here());

        $is_shopping = ($is_shopping[1] == 'shopping')? true : false;


        if($is_shopping){

            $url = $this->request->params['pass'][0];

            $ciudadUrl = (isset($this->request->data['municipio_id'])) ? $this->request->data['municipio_id'] : null;

            $url_base = '/shopping';

            $element_base = 'Productos/detalle_shopping';

            $existencia_en_ciudad = true;

        }else{

            $url_base = '/' . $estadoUrl . '/ciudad/' . $ciudadUrl;
            $element_base = 'Productos/detalle';

        }

        $ciudad = TableRegistry::get('Ciudades')->ciudadPorUrl($ciudadUrl);

        if($ciudad == null){

            if(!$is_shopping){
                return $this->redirect('/');
            }

            $tipo_precio = 'precio_1';

        }else{

            $tipo_precio = $ciudad->precio;

        }

        $settings =  getAllSettings();
        $tipocambio = $settings['tipocambio']['value'];



        $this->set(compact('url_base'));


        //$this->Productos->recursive=2;
        $condiciones = [];
        $condiciones['Productos.deleted'] = false;
        $condiciones['Productos.activo'] = true;
        $condiciones['Productos.url'] = $url;

        $producto = $this->Productos->find('all')
            ->contain(['Imagenes','Promociones','Atributos.Opciones','Complementos.Imagenes','Complementos.Atributos','Categorias.Productos.Imagenes','Marcas','ComplementosCategorias','Comentarios','Comentarios.Usuarios','Fichas', 'CiudadesProductos']) //,'Marcas'
            ->where($condiciones)
            ->limit(1);

        if(!$is_shopping){
            $ciudad_id = $ciudad->id;
            $producto->matching('CiudadesProductos', function ($q) use ($ciudad_id) {
                return $q->where(['CiudadesProductos.ciudad_id' => $ciudad_id]);
                });

            $producto_f = $producto->first();

        }else{

            $producto_f = $producto->first();

            if($ciudad){

                $ciudadesProductos = $this->Productos->CiudadesProductos->find('all')
                ->where(['CiudadesProductos.ciudad_id'=>$ciudad->id, 'CiudadesProductos.producto_id'=>$producto_f->id])->first();

                if(!$ciudadesProductos){
                    $existencia_en_ciudad = false;
                }

            }
        }


        // eliminamos los repetidos, se necesita editar las relaciones de productos y categorias,
        // pero si se hace eso puede que le pegue en otra parte :S
        if(isset($producto_f->categorias[0]) && count( $producto_f->categorias[0]->productos->where  > 0)){
            $existe = [];
            foreach ($producto_f->categorias[0]->productos as $key => $value) {

                if( in_array( $value->id  , $existe) || $value->deleted == true || $value->activo == false){

                    unset($producto_f->categorias[0]->productos[$key]);

                }else{
                    $existe[] =  $value->id ;

                }


            }
        }



        $recientes = $this->request->session()->read('recientes');
        $recientes[$producto_f->url]=$producto_f->nombre;
        $this->request->session()->write('recientes', $recientes);

        if(isset($producto_f->complementos_categoria->categoria_id)){

            $conditions['AND'][]= array('Productos.estatus_id in (1,3)');
            $conditions['AND'][]= array('Productos.precio>0');

            $categoria=$producto_f->complementos_categoria->categoria_id;
            $busqueda_productos = $this->Productos->find('all',
                    ['conditions'=>$conditions, 'contain'=>['CategoriasProductos','Imagenes']])
                ->matching('CategoriasProductos', function ($q) use ($categoria) {
                return $q->where(['CategoriasProductos.categoria_id' => $categoria]);
                })->toArray();

                foreach($busqueda_productos as $p){
                    array_push($producto_f->complementos,$p);
                }

            }

            //busco las versiones (los que están en relacionados con él)
            $versiones=[];
            if(!is_null($producto_f->id)){
                $versiones = $this->Productos->find('all')
                ->where(['Productos.padre_id' => $producto_f->id])
                ->toArray();
            }
            //->toArray();
            $this->set('versiones',$versiones);

        if($this->UserAuth->isLogged()) {
            // se utiliza para solicitar cotización
            $this->buscar_direcciones();
        }


        $this->loadModel('Monedas');
        $monedas = $this->Monedas->find('list')->toArray();

        $this->set('currency', ($this->Cookie->read('currency') > 0)? $this->Cookie->read('currency') : 1);

        $this->set('comentariorecibo',$comentario);
        $this->set('producto', $producto_f);
        $this->set('_serialize', ['producto']);

        $ciudad_url = $ciudadUrl;


        $this->loadModel('Estados');
        $estados = $this->Estados->find('list');


        $this->set(compact('ciudad', 'ciudadUrl', 'monedas', 'tipocambio', 'ciudad_url', 'element_base', 'tipo_precio', 'estados', 'existencia_en_ciudad'));
        $this->set('hoy',new Time());
        $this->render(null,'front');
    }


 public function confirmacion($url = null)
    {

        $categorias = $this->Productos->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado=1'],
            'limit' => 50
        ]);

        $subCategorias = $this->Productos->Categorias->find('all', [
            'conditions' => ['categoria_id is not null and publicado=1']
        ]);

        $categorias_principales = $categorias->toArray();
        $categorias_secundarias = $subCategorias->toArray();

        $this->loadModel('Banners');
        $banner = $this->Banners->find('all');
        $banners = $banner->toArray();

        $this->set(compact('categorias_principales', 'categorias_secundarias', 'banners'));


           //$this->Productos->recursive=2;
           $producto = $this->Productos->find('all')
            ->contain(['Imagenes','Promociones','Atributos.Opciones','Complementos.Imagenes','Complementos.Atributos','Categorias.Productos.Imagenes','Marcas'])
            ->where(['Productos.url' => $url])
            ->limit(1);
            //debug($producto);

        $this->set('producto', $producto->first());
        $this->set('_serialize', ['producto']);
        $this->set('hoy',new Time());
        $this->render(null,'front');
    }

    public function buscar($buscar= null, $marca = null)
    {

        if(!$buscar){
            $this->request->data['data']['Producto']['buscar'] = str_replace(array('<', '>', '&', '{', '}', '*','/','-detail'), array('-'), $this->request->data['data']['Producto']['buscar']);
            $this->redirect('productos/buscar/'.urlencode($this->request->data['data']['Producto']['buscar']));
        }

        if($buscar){
            $buscar = str_replace(array('<', '>', '&', '{', '}', '*','/','-detail'), array('-'), $buscar);

            $this->request->data['data']['Producto']['buscar']= $buscar;

        }
        if($this->UserAuth->isLogged()) {
            $this->direccion_logeado();
            $this->buscar_direcciones();
        }


        $cat = $this->Productos->Categorias->find('all')
            ->where(['Categorias.url' =>  $this->request->data['data']['Producto']['buscar']])
            ->limit(1);

        if($cat->first()->url){
            $this->redirect('/c/'.$cat->first()->url);
        }

        $this->loadModel('Categorias');
        $categorias = $this->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado=1'],
            'limit' => 50
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

        if($this->request->data['data']['Producto']['buscar']!="" or $this->request->data['data']['Producto']['buscar']=="-1"){

            if($marca){
                if($this->request->data['data']['Producto']['buscar']=="-1"){
                    $productos = $this->Productos->find('all')
                       ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                       ->where(['Marcas.id = '.$marca,'Productos.estatus_id'=>1])
                       ->where(function ($exp, $q) {
                            return $exp->isNull('padre_id');
                        });
                    $this->set('productos', $this->paginate($productos));

                }else{
                    $productos = $this->Productos->find('all')
                       ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                       ->where(function ($exp, $q) {
                                return $exp->isNull('padre_id');
                            })
                       ->where(['(Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.url like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.codigo_fabricante like "%'.$this->request->data['data']['Producto']['buscar'].'%"  or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" ) and Marcas.id = '.$marca,'Productos.estatus_id'=>1]);
                    $this->set('productos', $this->paginate($productos));
                }


            }else{

                $productos = $this->Productos->find('all')
                   ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                   ->where(function ($exp, $q) {
                        return $exp->isNull('padre_id');
                    })
                   ->where(['((Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.url like "%'.$this->request->data['data']['Producto']['buscar'].'%"  or  Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.codigo_fabricante like "%'.$this->request->data['data']['Producto']['buscar'].'%"  or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%")  or Marcas.nombre = "'.$buscar.'") and Productos.estatus_id=1']);
                $this->set('productos', $this->paginate($productos));
            }

            if($productos->count()==1){

                $this->redirect("/p/".$productos->first()->url);

            }

            $productos = $this->Productos->find('all')
                   ->contain(['Marcas'])
                   ->where(['((Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.url like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.codigo_fabricante like "%'.$this->request->data['data']['Producto']['buscar'].'%"  or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%")  or Marcas.nombre = "'.$buscar.'") and Productos.estatus_id=1'])->where(function ($exp, $q) {
                return $exp->isNull('padre_id');
            });


            $marcas = array();
            foreach ($productos as $key => $producto) {
                $marcas[$producto['marca']['nombre']] = $producto['marca']['id'];
            }


            $this->set('buscar', $buscar);
            $this->set('marca_id', $marca);
            $this->set('marcas', $marcas);
            $this->set('_serialize', ['productos']);
            $this->render(null,'front');

        }else{

                //error
                $this->redirect('/');
           // $this->Flash->error('La busqueda no pudo realizarse');
        }


    }


    public function buscarlista($buscar= null, $marca = null)
    {


        if($buscar){
            $this->request->data['data']['Producto']['buscar']= $buscar;
        }


        if($this->UserAuth->isLogged()) {
            $this->direccion_logeado();
            $this->buscar_direcciones();
        }


        $categorias = $this->Productos->Categorias->find('all', [
            'conditions' => ['categoria_id is null and publicado=1'],
            'limit' => 50
        ]);

        $subCategorias = $this->Productos->Categorias->find('all', [
            'conditions' => ['categoria_id is not null and publicado=1']
        ]);

        $categorias_principales = $categorias->toArray();
        $categorias_secundarias = $subCategorias->toArray();

        $this->loadModel('Banners');
        $banner = $this->Banners->find('all');
        $banners = $banner->toArray();

        $this->set(compact('categorias_principales', 'categorias_secundarias', 'banners'));

        if($this->request->data['data']['Producto']['buscar'] or $this->request->data['data']['Producto']['buscar']=="-1"){

            if($marca){
                if($this->request->data['data']['Producto']['buscar']=="-1"){
                    $productos = $this->Productos->find('all')
                       ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                       ->where(function ($exp, $q) {
                            return $exp->isNull('padre_id');
                         })
                       ->where(['Marcas.id = '.$marca,'Productos.estatus_id'=>1]);
                        $this->set('productos', $this->paginate($productos));

                }else{

                    $productos = $this->Productos->find('all')
                       ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                       ->where(function ($exp, $q) {
                            return $exp->isNull('padre_id');
                        })
                       ->where(['(Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.codigo_fabricante like "%'.$this->request->data['data']['Producto']['buscar'].'%"  or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" ) and Marcas.id = '.$marca,'Productos.estatus_id'=>1]);
                    $this->set('productos', $this->paginate($productos));
                }


            }else{

                $productos = $this->Productos->find('all')
                   ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                   ->where(function ($exp, $q) {
                        return $exp->isNull('padre_id');
                    })
                   ->where(['((Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.codigo_fabricante like "%'.$this->request->data['data']['Producto']['buscar'].'%"  or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%")  or Marcas.nombre = "'.$buscar.'") and Productos.estatus_id=1']);
                $this->set('productos', $this->paginate($productos));
            }


            $marcas = array();
            foreach ($productos as $key => $producto) {
                $marcas[$producto['marca']['nombre']] = $producto['marca']['id'];
            }

        }else{

            //error

          //  $this->Flash->error('La busqueda no pudo realizarse');
        }

        $this->set('buscar', $buscar);
        $this->set('marca_id', $marca);
        $this->set('marcas', $marcas);
        $this->set('_serialize', ['productos']);
        $this->render(null,'front');
    }




     public function registrarme()
    {
        if ($this->request->is('post')) {

            if(!empty($this->request->data['g-recaptcha-response'])){
                if(isset($this->request->data['terminos_condiciones']) && $this->request->data['terminos_condiciones'] == '1'){

                    $this->loadModel('Users');
                    $valida_email = $this->Users->find('all', ['conditions'=>['email'=>$this->request->data['email']]])->first();

                    if(count($valida_email) == 0 && filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL)){

                        if(strlen($this->request->data['password']) > 5 && $this->request->data['password'] == $this->request->data['confirmar_password']){

                                $logeado = '';

                                $usuario = $this->Users->newEntity();
                                $usuario = $this->Users->patchEntity($usuario, $this->request->data);

                                if(!EMAIL_VERIFICATION) {
                                                $usuario['email_verified'] = 1;
                                }
                                $usuario['active'] = 1;
                                $usuario['ip_address'] = $this->request->clientIp();
                                $usuario['password'] = $this->UserAuth->makeHashedPassword($this->request->data['password']);
                                $usuario['user_group_id'] = 4;
                                $usuario['created'] = date('Y-m-d H:i:s');


                                if($this->Users->save($usuario)){

                                    $cliente_id = $usuario->id;

                                    $user = $this->Users->get($cliente_id);
                                    $user = $user->toArray();
                                    $this->UserAuth->login($user);


                                    $tipo_compra = $this->request->session()->read('tipo_compra');
                                    $this->request->session()->write('url_proceso_pago', 'pedido/direccion');

                                    return $this->redirect($this->referer());

                                }

                        }else{

                            unset($this->request->data['password']);
                            unset($this->request->data['confirmar_password']);
                            unset($this->request->data['g-recaptcha-response']);

                            $this->Flash->error(__('La contraseña debe tener mas de 5 caracteres y coincidir con la confirmación'));
                            return $this->redirect('/pedido?'.http_build_query($this->request->data));

                        }

                    }else{

                        unset($this->request->data['password']);
                        unset($this->request->data['confirmar_password']);
                        unset($this->request->data['g-recaptcha-response']);

                        $this->Flash->error(__('Verifica que tu correo eléctronico sea valido y no haya sido registro previamente'));
                        return $this->redirect('/pedido?'.http_build_query($this->request->data));

                    }

                }else{

                    unset($this->request->data['password']);
                    unset($this->request->data['confirmar_password']);
                    unset($this->request->data['g-recaptcha-response']);

                    $this->Flash->error(__('Para continuar acepta los términos y condiciones'));
                    return $this->redirect('/pedido?'.http_build_query($this->request->data));

                }

            }else{

                unset($this->request->data['password']);
                unset($this->request->data['confirmar_password']);
                unset($this->request->data['g-recaptcha-response']);

                $this->Flash->error(__('Para continuar confirma que no eres un robot'));
                return $this->redirect('/pedido?'.http_build_query($this->request->data));

            }

        }



    }

    public function codigo_postal()
    {
        if ($this->request->is('ajax')) {


            //$this->request->session()->delete('codigo_postal');

            $origen = 'MTY';
            $this->loadModel('Codigos');


            if(isset($this->request->data['direccion_id'])){ // USUARIO LOGEADO

                $this->loadModel('Direcciones');
                $direccion_id=$this->request->data['direccion_id'];

                if(isset($this->request->data['codigo_postal'])){ // CAMBIO EL CODIGO POSTAL DE UNA DIRECCION

                    // CHECO SI EXISTE EL CODIGO POSTAL
                    $codigo_postal_valido = $this->Codigos->find('all', array(
                    'conditions'=>array('Codigos.codigo =' => $this->request->data['codigo_postal'])))->first();

                    if(count($codigo_postal_valido) > 0) { // EXISTE GUARDA CAMBIO

                        $direccion = $this->Direcciones->newEntity();

                        $direccion['id'] = $this->request->data['direccion_id'];
                        $direccion['codigo_postal'] = $this->request->data['codigo_postal'];
                        $direccion['ciudad'] = $codigo_postal_valido['ciudad'];
                        $direccion['estado'] = $codigo_postal_valido['estado'];

                        //$this->Direcciones->save($direccion);
                    }

                    $codigo_postal=$this->request->data['codigo_postal'];

                }else{ // SELECCIONO UNA DIRECCION

                    $direccion_envio = $this->Direcciones->find('all', array(
                    'conditions'=>array('Direcciones.id =' => $direccion_id)
                    ))->first();

                    $codigo_postal=$direccion_envio['codigo_postal'];

                    $this->request->session()->write('codigo_postal',$codigo_postal);

                    $this->request->session()->write('direccion_logeado',$direccion_id);
                }

            }else{ // USUARIO NO LOGEADO o SOLO CAMBIO

                $codigo_postal=$this->request->data['codigo_postal'];

                if($this->UserAuth->isLogged()) {

                    $logeado = $this->UserAuth->getUser();
                    $cliente_id = $logeado['User']['id'];

                    $this->loadModel('Direcciones');
                    $direccion_envio = $this->Direcciones->find('all', array(
                    'conditions'=>array('Direcciones.cliente_id =' => $cliente_id)
                    ))->first();

                    if(count($direccion_envio) == 0){

                        $this->request->session()->write('codigo_postal',$codigo_postal);

                    }

                }else{

                    if(isset($this->request->data['desde_carrito'])){

                        $this->request->session()->write('codigo_postal',$codigo_postal);

                    }

                }

            }


            $distancia = $this->Codigos->find('all', array(
                    'conditions'=>array('Codigos.codigo =' => $codigo_postal),
                    'contain'=>array(
                        'Distancias' => array(
                            'conditions'=>array('Distancias.origen =' => $origen)
                        ))
                    ))->first();


            if(count($distancia) > 0) {

                $distancia->ciudad = $distancia->ciudad;
                $distancia->estado = $distancia->estado;

                //$distancia->envio = $this->calculo_envio();

            }

            // SE OBTIENE LA TARIFA POR PRODUCTO
            /*
            if(count($distancia) > 0) {

                $this->request->session()->write('codigo_postal',$codigo_postal);

                $carrito = array();
                $carrito = $this->request->session()->read('carrito');

                if(count($carrito) > 0){

                    $carrito_envio = $carrito;

                    $this->loadModel('Productos');
                    foreach ($carrito as $k => $articulo) {

                        $producto=$this->Productos->get($articulo['id']);

                        if($producto->envio_gratis == 0)
                        {
                            $peso = $producto->peso;
                            $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);
                /*
                            $this->loadModel('Enviotarifas');
                            $tarifa_peso = $this->Enviotarifas->find('all', array(
                                    'conditions'=>array($distancia->distancia->distancia.' BETWEEN distancia_inicio AND distancia_fin',
                                        $peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                            //$tarifa_peso->precio

                            $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                                    'conditions'=>array($distancia->distancia->distancia.' BETWEEN distancia_inicio AND distancia_fin',
                                        'cubicaje <=' => $cubicaje),
                                    'order' => 'precio DESC'))->first();
                            //$tarifa_cubicaje->precio

                            if($tarifa_peso['precio'] > $tarifa_cubicaje['precio'])
                            {
                                $carrito_envio[$k]['envio'] = $tarifa_peso->precio;
                            }else{
                                $carrito_envio[$k]['envio'] = $tarifa_cubicaje->precio;
                            }

                            *//*
                            $carrito_envio[$k]['proveedor_id']=$producto->proveedor_id;
                            $carrito_envio[$k]['peso']= $peso;
                            $carrito_envio[$k]['cubicaje']= $cubicaje;

                        }

                    }
                    //$this->request->session()->write('carrito', $carrito_envio);
                    //die(debug($carrito_envio));
                }
            }*/


            die(json_encode($distancia));
        }
    }



    public function codigo_postal_fiscal()
    {
        if ($this->request->is('ajax')) {

            $this->loadModel('Codigos');

            $codigo_postal = $this->request->data['codigo_postal'];

            $codigo = $this->Codigos->find('all', array(
                    'conditions'=>array('Codigos.codigo =' => $codigo_postal)))->first();

            $data = array();
            if(count($codigo) > 0)
            {

                $data['codigo']=$codigo->codigo;
                $data['ciudad']=$codigo->ciudad;
                $data['estado']=$codigo->estado;

            }else{
                $data['codigo']=null;
            }


            die(json_encode($data));
        }
    }


    public function carrito($ciudad_url = null)
    {

        $settings =  getAllSettings();
        $tipocambio = $settings['tipocambio']['value'];

        $detalle = $this->detalle_carrito($ciudad_url);

        $ciudad = $detalle['ciudad'];
        $carrito = $detalle['carrito'];
        $detalle_envio = $detalle['detalle_envio'];
        $resumen = $detalle['resumen'];

        $url_base = $detalle['url_base'];

        $this->loadModel('Monedas');
        $monedas = $this->Monedas->find('list')->toArray();

        $this->set('currency', ($this->Cookie->read('currency') > 0)? $this->Cookie->read('currency') : 1);

        $this->set(compact('carrito', 'monedas', 'tipocambio', 'resumen', 'detalle_envio', 'ciudad', 'ciudad_url', 'url_base', 'resumen'));
        $this->render(null,'front');
    }

    public function detalle_carrito($ciudad_url)
    {

        $this->loadModel('Ciudades');
        $detalle['ciudad'] = $this->Ciudades->find('all')
            ->contain(['Estados'])
            ->where(['Ciudades.url' => $ciudad_url])
            ->first();

        $detalle['url_base'] = '/' . $detalle['ciudad']->estado->url . '/ciudad/' . $ciudad_url;

        $detalle['carrito'] = [];
        if($this->request->session()->check('carrito')) {
            $detalle['carrito'] = $this->request->session()->read('carrito');
            $detalle['carrito'] = $detalle['carrito'][$detalle['ciudad']->url];
        }


        $detalle['detalle_envio'] = [
            'fecha' => '-',
            'ciudad_horario_entrega_id' => 0,
            'ciudad_horario_entrega_preciso_id' => 0,
            'codigo_postal' => '',
            'horario_text' => ''
        ];

        $detalle['resumen'] = [
            'subtotal' => 0,
            'envio' => 0,
            'total' => 0
        ];

        foreach ($detalle['carrito'] as $k => $articulo) {

            $detalle['carrito'][$k]['precio_real'] = $articulo['precio'];

            if(!empty($articulo['precio_especial_hasta']) && date('Y-m-d') < $articulo['precio_especial_hasta']->format('Y-m-d')){

                $detalle['carrito'][$k]['precio'] = $articulo['precio_especial'];

            }

            $detalle['resumen']['subtotal'] += $detalle['carrito'][$k]['precio'] * $articulo['cantidad'];

        }

        if($this->request->session()->check('detalle_envio')) {
            $detalle['detalle_envio'] = $this->request->session()->read('detalle_envio');

            if(isset($detalle['detalle_envio']['ciudad_horario_entrega_preciso_id']) && $detalle['detalle_envio']['ciudad_horario_entrega_preciso_id'] > 0){

                $horario = $this->Ciudades->CiudadHorarioEntregas->CiudadHorarioEntregaPrecisos->find('all',['conditions'=>['CiudadHorarioEntregaPrecisos.id'=>$detalle['detalle_envio']['ciudad_horario_entrega_preciso_id']]])->first();

                $detalle['resumen']['envio'] += $horario['costo_pesos'];

            }elseif (isset($detalle['detalle_envio']['ciudad_horario_entrega_id']) && $detalle['detalle_envio']['ciudad_horario_entrega_id'] > 0) {

                $horario = $this->Ciudades->CiudadHorarioEntregas->find('all',['conditions'=>['CiudadHorarioEntregas.id'=>$detalle['detalle_envio']['ciudad_horario_entrega_id']]])->first();

            }

            $detalle['detalle_envio']['horario_text'] = $horario->desde->format('g:i A').' '.__('a').' '.$horario->hasta->format('g:i A');
        }

        $detalle['resumen']['envio'] += $this->get_costo_envio($detalle['detalle_envio']['fecha'], $detalle['ciudad'], $detalle['ciudad']->estado);

        $detalle['resumen']['cupon'] = 0;

        $detalle['resumen']['puntos'] = 0;

        if($this->request->session()->check('cupon')) {

            $detalle['resumen']['cupon_detalles'] = $this->request->session()->read('cupon');
            $detalle['resumen']['cupon'] = $this->calculo_cupon($detalle['resumen']['cupon_detalles']['codigo'], $ciudad_url);

        }

        if($this->UserAuth->getUserId()){

            $this->loadModel('Users');
            $cliente = $this->Users->get($this->UserAuth->getUserId());

            if($cliente){
                $total = $detalle['resumen']['subtotal'] + $detalle['resumen']['envio'] - $detalle['resumen']['cupon'];
                $detalle['resumen']['puntos'] = ($total < $cliente->puntos)? $total : $cliente->puntos;
            }

        }

        $detalle['resumen']['total'] = $detalle['resumen']['subtotal'] + $detalle['resumen']['envio'] - $detalle['resumen']['cupon'] - $detalle['resumen']['puntos'];

        return $detalle;
    }

    public function calculo_envio()
    {

        //return 100/1.16; //

        //calcular el envio
        $carrito = $this->request->session()->read('carrito');
        $envio = 0;

        foreach($carrito as $producto){
            if(isset($producto['envio']) && $producto['envio'] == 0){
                $envio= 100/1.16;
            }
        }
        return $envio;

        if($this->request->session()->check('codigo_postal')) {

                $codigo_postal = $this->request->session()->read('codigo_postal');
                $origen = 'MTY';

                $this->loadModel('Codigos');
                $distancia = $this->Codigos->find('all', array(
                    'conditions'=>array('Codigos.codigo =' => $codigo_postal),
                    'contain'=>array(
                        'Distancias' => array(
                            'conditions'=>array('Distancias.origen =' => $origen)
                        ))
                    ))->first();

                $envio = 0;

                if(count($distancia) > 0){
                $pesos = array();
                $cubicajes = array();

                foreach($carrito as $producto){

                    if($producto['envio'] == 0){ // No tiene envio gratis

                        if($producto['envio_fijo'] > 0)
                        {
                            $envio += $producto['envio_fijo'];
                        }else{
                            if( !isset($pesos[$producto['proveedor_id']])){
                                $pesos[$producto['proveedor_id']]=0;
                            }
                            $pesos[$producto['proveedor_id']] += $producto['peso'] * $producto['cantidad'];
                            if( !isset($cubicajes[$producto['proveedor_id']])){
                                $cubicajes[$producto['proveedor_id']] =0;
                            }
                            $cubicajes[$producto['proveedor_id']] += $producto['cubicaje'] * $producto['cantidad'];
                        }
                    }

                }

                //debug($carrito); debug($pesos); debug($cubicajes); die;

                $this->loadModel('Enviotarifas');
                foreach($pesos as $proveedor_id => $peso){

                    $tarifa_peso = $this->Enviotarifas->find('all', array(
                        'conditions'=>array($distancia->distancia->distancia.' BETWEEN distancia_inicio AND distancia_fin',
                            $peso.' BETWEEN peso_inicio AND peso_fin')))->first();


                    $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                        'conditions'=>array($distancia->distancia->distancia.' BETWEEN distancia_inicio AND distancia_fin',
                            'cubicaje <=' => $cubicajes[$proveedor_id]),
                        'order' => 'precio DESC'))->first();

                    //debug($peso); debug($tarifa_peso); debug($tarifa_cubicaje);
                    if($tarifa_peso['tarifa'] == 7){
                       $tarifa_peso['precio'] =  $peso * $tarifa_peso['precio_kilo'];
                    }

                    if($tarifa_cubicaje['tarifa'] == 7){
                       $tarifa_cubicaje['precio'] =  $cubicajes[$proveedor_id] * $tarifa_cubicaje['precio'];
                    }

                    //debug($tarifa_peso['precio']); debug($tarifa_cubicaje['precio']);

                    if($tarifa_peso['precio'] > $tarifa_cubicaje['precio'])
                    {
                        $envio += $tarifa_peso->precio;
                    }else{
                        $envio += $tarifa_cubicaje->precio;
                    }


                }
                }

        }

        return $envio/1.16;
    }


    public function agregar_carrito()
    {
        if ($this->request->is('ajax')) {

            $ciudad_url = $this->request->data['ciudad_url'];
            $id_producto = $this->request->data['id_producto'];
            $cantidad = $this->request->data['cantidad'];
            $mensaje_personalizado = $this->request->data['mensaje_personalizado'];

            $this->request->session()->write('detalle_envio', $this->request->data['detalle_envio']);

            $this->loadModel('Ciudades');
            $ciudad = $this->Ciudades->find('all')
                ->where(['Ciudades.url' => $ciudad_url])
                ->first();

            // datos de producto
            $producto = $this->Productos->get($id_producto, [
                'fields'=>[
                    'id',
                    'nombre',
                    'sku',
                    'precio' => $ciudad->precio,
                    'precio_especial' => $ciudad->precio.'_especial',
                    'precio_especial_hasta' => $ciudad->precio.'_especial_hasta',
                    'adicional'
                ],
                'contain'=>['Imagenes']
            ]);

            // Evitamos que cheque si tienes hijos.
            $producto->checkgroup = FALSE;


            $carrito = array();
            $carrito = $this->request->session()->read('carrito');

            $posicion = count($carrito[$ciudad_url]);
            $carrito[$ciudad_url][$posicion] = $producto->toArray();
            $carrito[$ciudad_url][$posicion]['cantidad'] = $cantidad;
            $carrito[$ciudad_url][$posicion]['mensaje_personalizado'] = $mensaje_personalizado;


            $this->request->session()->write('carrito', $carrito);


            $url = '/adicionales/'.$ciudad_url;
            die(json_encode($url));

        }
    }

    public function editar_carrito($ciudad_url = null)
    {

        if ($this->request->is('ajax')) {

            $accion=$this->request->data['accion'];
            $posicion=$this->request->data['posicion'];

            $carrito = array();
            $carrito = $this->request->session()->read('carrito');

            $carrito_ciudad = $carrito[$ciudad_url];

            if($accion == 'editar_articulo')
            {

                $carrito_ciudad[$posicion]['cantidad'] = $this->request->data['cantidad'];

            }else if($accion == 'eliminar_articulo'){

                unset($carrito_ciudad[$posicion]);
                $carrito_ciudad = array_values($carrito_ciudad);
            }

            $carrito[$ciudad_url] = $carrito_ciudad;

            $this->request->session()->write('carrito', $carrito);
            $carrito = $this->request->session()->read('carrito');

            die(json_encode($carrito));
        }

    }

    public function pedido( $ciudad_url = null, $paso = null)
    {
        // debug($this->request->session()->read());
        // debug($this->request->data);
        // die();
        $tipo_compra = $this->request->session()->read('tipo_compra');
        $this->request->session()->write('url_proceso_pago', 'pedido/direccion');
        if($tipo_compra == 0 && $tipo_compra != null){
           $this->request->session()->write('url_proceso_pago', 'pedido/recogersucursal');
        }


        $settings =  getAllSettings();
        $idusuarioinvitado = $settings['idusuarioinvitado']['value'];

        if( !isset( $settings['idusuarioinvitado']  ) ){
            throw new Exception("ID de usuario invitado no esta registrado ", 1);

        }

        $this->loadModel('Medios');
        $this->loadModel('Paises');
        $this->loadModel('Pedidos');
        $this->loadModel('Formasdepagos');
        $this->loadModel('TelefonoTipos');
        $this->loadModel('MensajeTarjetas');
        $this->loadModel('Monedas');

        $monedas = $this->Monedas->find('list')->toArray();

        $medios = $this->Medios->find('list')->toArray();
        $paises = $this->Paises->find('list')->toArray();
        $telefono_tipos = $this->TelefonoTipos->find('list')->toArray();
        $mensaje_tarjetas = $this->MensajeTarjetas->find('list')->toArray();

        $this->direccion_logeado();

        $pedido = $this->Pedidos->newEntity();
        $FormasdePagos = $this->Formasdepagos->find('all', array('order' => array('Formasdepagos.orden' => 'asc')));


        $detalle = $this->detalle_carrito($ciudad_url);

        $ciudad = $detalle['ciudad'];
        $carrito = $detalle['carrito'];
        $detalle_envio = $detalle['detalle_envio'];
        $resumen = $detalle['resumen'];

        $url_base = $detalle['url_base'];

        $direccion_actual = $this->request->session()->read('direccion_logeado');

        $this->set(compact('medios','paises','pedido', 'FormasdePagos', 'telefono_tipos', 'mensaje_tarjetas', 'ciudad', 'carrito', 'detalle_envio', 'resumen', 'ciudad_url', 'direccion_actual', 'monedas', 'url_base'));

        $this->set('recoger_sucursal', '0'  );
        $this->set('sucursal_id', '1'  );
        $this->set('currency', ($this->Cookie->read('currency') > 0)? $this->Cookie->read('currency') : 1);







        $inCancelado  =  ( @$this->request->params['pass'][0] == "cancelado" );

        if($inCancelado){
            $modo_invitado = $this->request->session()->read('modo_invitado');


            if( $modo_invitado){

                $this->request->session()->delete('modo_invitado');

                $this->Auth->logout();

            }
        }

        $inConfirmar  =  ( @$this->request->params['pass'][0] == "confirmar" );
        $this->set('inConfirmar' , $inConfirmar );

        $this->set( 'inDireccion', ( @$this->request->params['pass'][0] == "direccion" ) );

        $inRecogerSucursal = ( @$this->request->params['pass'][0] == "recogersucursal" );
        $this->set( 'inRecogerSucursal', $inRecogerSucursal  );

        $inFormaPago = ( @$this->request->params['pass'][0] == "formapago" );
        $this->set('inFormaPago' , $inFormaPago );


        //$this->request->session()->delete('codigo_postal');
        if($this->request->session()->check('codigo_postal')) {

            $codigo_postal = $this->request->session()->read('codigo_postal');
            $this->loadModel('Codigos');
            $direccion = $this->Codigos->find('all', array(
                    'conditions'=>array('Codigos.codigo =' => $codigo_postal)
                    ))->first();



            $ciudades_direccion = $this->Codigos->find('list', [
            'conditions' => ['Codigos.estado' => $direccion['estado']],
            'order' => ['ciudad' => 'ASC'],
            'keyField' => 'ciudad', 'valueField' => 'ciudad']);


            $this->set(compact('direccion', 'ciudades_direccion'));
        }else{

            $this->set('ciudades_direccion', array());

        }

        $this->loadModel('Estados');
        $this->loadModel('Municipios');
        $this->set('estados', $this->Estados->find('list'));
        $this->set('municipios', $this->Municipios->find('list', array(
            'conditions'=>array('Municipios.estado_id = 1'))));

        /*if($this->request->session()->check('cupon')) {

            $datos_cupon = $this->request->session()->read('cupon');
            $this->calculo_cupon($datos_cupon['codigo']);

        }*/


        /*$totalEnvio = $this->calculo_envio();
        $this->set('envio', $totalEnvio);*/
        $envio_exitoso=0;

        if($inFormaPago || $inConfirmar ){

            // Estoy seteando valores de si es en sucursal o no.
            // si es sucursal poner cual es .
            $this->set('recoger_sucursal', @$this->request->data['recoger_sucursal']  );
            $this->set('sucursal_id', @$this->request->data['sucursal_id']  );
            $this->set('formasdepago_id', @$this->request->data['formasdepago_id']  );


        }


        if ($this->request->is('post')) { // FINALIZAR
        
            $this->loadModel('Direcciones');
            $user = $this->UserAuth->getUser();
            $user = $user['User'];
            $detalle = $this->detalle_carrito($ciudad_url);

            $direccion_envio = $this->Direcciones->get($this->request->data['envio_a'], ['contain'=>['DireccionTipos']])->toArray();

            $pedido = $this->Pedidos->newEntity();
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->data);
            $pedido = $this->Pedidos->patchEntity($pedido, $direccion_envio);

            $pedido['cliente_id'] = $this->UserAuth->getUserId();
            $pedido['tipo_domicilio'] = ($direccion_envio['direccion_tipo'])? $direccion_envio['direccion_tipo']['nombre'] : '';
            $pedido['ciudad_id'] = $detalle['ciudad']['id'];
            $pedido['fecha'] = date('Y-m-d H:m:s');
            $pedido['monto'] = $detalle['resumen']['total'];
            $pedido['subtotal'] = $detalle['resumen']['subtotal'];
            $pedido['envio'] = $detalle['resumen']['envio'];
            $pedido['cupon'] = $detalle['resumen']['cupon'];
            $pedido['puntos_aplicados'] = $detalle['resumen']['puntos'];
            $pedido['iva'] = 0;

            $pedido['nombre_cliente'] = $user['first_name'].' '.$user['last_name'];
            $pedido['correo_electronico'] = $user['email'];

            $pedido['facturar'] = 0;

            $pedido['estatus_id'] = (in_array($pedido->forma_pago_id, [4,5,6]))? 1 : 2;

            if($this->request->session()->check('cupon')) {
                $cupon = $this->request->session()->read('cupon');
                $pedido['cupon_id'] = $cupon['cupon_id'];
            }

            $pedido->fecha_entrega = $detalle['detalle_envio']['fecha'];
            $pedido->ciudad_horario_entrega_id = $detalle['detalle_envio']['ciudad_horario_entrega_id'];
            $pedido->ciudad_horario_entrega_preciso_id = $detalle['detalle_envio']['ciudad_horario_entrega_preciso_id'];
            $pedido->horario_entrega = $detalle['detalle_envio']['horario_text'];


            if(in_array($pedido->forma_pago_id, [1,2])){
                $pedido->tarjeta_nombre = $this->request->data['tarjeta'][$pedido->forma_pago_id]['vpc_CardName'];
                $pedido->tarjeta_number = substr($this->request->data['tarjeta'][$pedido->forma_pago_id]['vpc_CardNum'], -4);
            }

            $this->Pedidos->save($pedido);

            //mensajin
            if ($this->request->data['enviar_mensaje']) {
                $this->loadModel('PedidosComentarios');
                $pedidosComentarios = $this->PedidosComentarios->newEntity();
                $pedidosComentarios->pedido_id = $pedido->id;
                $pedidosComentarios->usuario_id = $this->UserAuth->getUserId();
                $pedidosComentarios->mensaje = $this->request->data['enviar_mensaje'];
                $pedidosComentarios->created = date('Y-m-d H:m:s');
                $this->PedidosComentarios->save($pedidosComentarios);
            }

            if ($this->request->data['recordatorio']) {
                $recordar = TableRegistry::get('recordatorios')->newEntity();
                $recordar->pedido_id = $pedido->id;
                $recordar->created = date('Y-m-d H:i:s');
                $recordar->cliente_id  = $this->UserAuth->getUserId();

                TableRegistry::get('recordatorios')->save($recordar);
            }


            $this->loadModel('Partidas');
            $articulos = $this->Partidas->newEntities($detalle['carrito']);

            foreach ($articulos as $k => $articulo) {

                $articulo['pedido_id'] = $pedido->id;
                $articulo['producto_id'] = $carrito[$k]['id'];
                $articulo['producto'] = $carrito[$k]['nombre'];
                $articulo['codigo_fabricante'] = '';
                $articulo['atributos'] = '';

                $this->Partidas->save($articulo);

            }

            $cliente = $this->Users->get($this->UserAuth->getUserId());
            $cliente->puntos_aplicados += $pedido->puntos_aplicados;
            $cliente->puntos -= $pedido->puntos_aplicados;
            $this->Pedidos->Users->save($cliente);

            $pedido = $this->Pedidos->get($pedido->id, ['contain'=>['Users', 'Formasdepagos', 'Estatuses', 'Partidas', 'Zona']]);

            $this->request->session()->delete('carrito');
            $this->request->session()->delete('cupon');
            $this->request->session()->delete('direccion_logeado');
            $this->request->session()->delete('detalle_envio');


            $respuesta = $this->proceso_pago($pedido, $this->request->data);
            $this->Pedidos->sendEstatusPedido($pedido, $respuesta);


            $this->set('respuesta', $respuesta);
            $this->set(compact('pedido'));

        } // FIN POST


        if($this->UserAuth->isLogged()) {

            $this->loadModel('Users');

            $logeado = $this->Users->get($this->UserAuth->getUserId());

            $this->loadModel('Direcciones');

            unset($conditionsDirecciones_envio);
            $conditionsDirecciones_envio[] =  array('Direcciones.cliente_id =' => $logeado['id']) ;
            if( $this->request->session()->check('modo_invitado') ){

                $conditionsDirecciones_envio[ ] = array('Direcciones.session_id =' => session_id() ) ;

            }

            $direcciones_envio = $this->Direcciones->find('list', array(
            'conditions'=> $conditionsDirecciones_envio ,
            ))->select(['calle'=>'CONCAT(Direcciones.calle, " #",Direcciones.numero_exterior, " - ",Direcciones.nombre_destinatario)']);

            $direcciones = $this->Direcciones->find('all', ['contain'=>['DireccionTipos']]);

            $this->set(compact('direcciones_envio', 'direcciones'));

            $this->set('usuario', $logeado);

            $this->set('datos_personales',
                ((empty($logeado->telefono_local) || empty($logeado->telefono_tipo_id) || empty($logeado->ciudad) || empty($logeado->pais_id) || empty($logeado->medio_id))? true : false));



        }else{

             $this->loadModel('Direcciones');

             unset($conditionsDirecciones_envio);
             $conditionsDirecciones_envio[] =  array('Direcciones.cliente_id =' => 0);
             if( $this->request->session()->read('modo_invitado') ){

                $conditionsDirecciones_envio[ ] = array('Direcciones.session_id =' => session_id() ) ;

            }

             $this->set('direcciones_envio', $this->Direcciones->find('list', array(
            'conditions'=> $conditionsDirecciones_envio ,
            ))->select(['calle'=>'CONCAT(Direcciones.calle, " #",Direcciones.numero_exterior, " - ",Direcciones.colonia)']));


            //DATOS DE REGISTRO INVALIDO
            foreach ($this->request->query as $key => $value) {
                $this->request->data[$key]=$value;
            }

            if(count($this->request->query) > 0){
                $this->loadModel('Codigos');
                $ciudades_direccion = $this->Codigos->find('list', [
                'conditions' => ['Codigos.estado' => $this->request->query['estado_envio']],
                'order' => ['ciudad' => 'ASC'],
                'keyField' => 'ciudad', 'valueField' => 'ciudad']);

                $this->set(compact('ciudades_direccion'));
            }
        }



        $this->loadModel('Users');
        $this->set('userEntity', $this->Users->newEntity());

        $this->loadModel('Codigos');
        $estados_busqueda = $this->Codigos->find('list', ['keyField' => 'estado', 'valueField' => 'estado', 'order' => ['estado' => 'ASC']])
        ->group('estado');


        $this->loadModel('Sucursales');
        $sucursales = $this->Sucursales->find('all');

        $this->set(compact('estados_busqueda', 'sucursales'));

        if(isset($pedido->id)){
            $this->render('order_confirmation','front');
        }else{
            $this->render(null,'front');
        }

    }


    public function busqueda_ciudad()
    {

        if ($this->request->is('ajax')) {
            $this->loadModel('Codigos');

            $estado = $this->request->data['selected'];

            $data = array();
            $ciudades_busqueda = $this->Codigos->find('list', [
            'conditions' => ['Codigos.estado' => $estado],
            'order' => ['ciudad' => 'ASC'],
            'keyField' => 'ciudad', 'valueField' => 'ciudad']);

            $data['data'] = $ciudades_busqueda;

            die(json_encode($data));
        }
    }

    public function busqueda_colonia()
    {

        if ($this->request->is('ajax')) {
            $this->loadModel('Codigos');

            $ciudad = $this->request->data['selected'];

            $data = array();
            $colonias_busqueda = $this->Codigos->find('list', [
            'conditions' => ['Codigos.ciudad' => $ciudad],
            'order' => ['colonia' => 'ASC'],
            'keyField' => 'codigo', 'valueField' => 'colonia']);

            $data['data'] = $colonias_busqueda;

            die(json_encode($data));
        }
    }


    public function proceso_pago($pedido = null, $data = null){

        $respuesta = '';

        if($pedido->forma_pago_id == 1 || $pedido->forma_pago_id == 2){ // BANORTE

            require_once(ROOT.DS.'vendor'.DS.'banorte/http_client.php');

            $http = new httpClient();

            $http->Connect("via.banorte.com", 443) or die("Connect problem");

            $params = [
                'ID_AFILIACION' => '7139227',
                'CLAVE_USR' => 'flor9227',
                'USER' => 'a7139227',
                'MODE' => 'DEC', //PRD,AUT,DEC
                'CMD_TRANS' => 'VENTA',
                'ID_TERMINAL' => '71392271',
                'MODO_ENTRADA' => 'MANUAL',

                'MONTO' => $pedido->monto,
                'NUMERO_TARJETA' => $data['tarjeta'][$pedido->forma_pago_id]['vpc_CardNum'], //'5454545454545454',
                'FECHA_EXP' => $data['tarjeta'][$pedido->forma_pago_id]['vpc_month'].'/'.$data['tarjeta'][$pedido->forma_pago_id]['vpc_year'], //'01/20',
                'CODIGO_SEGURIDAD' => $data['tarjeta'][$pedido->forma_pago_id]['vpc_CardSecurityCode']
            ];

            $status = $http->Post('/payw2', $params);

            if ($status != 200) {
                //debug($http->getBody());
            } else {

                $response = [
                  'ResponseCode' => $status,
                  'RESULTADO_PAYW' => $http->getHeader('RESULTADO_PAYW'),
                  'ID_AFILIACION' => $http->getHeader('ID_AFILIACION'),
                  'FECHA_RSP_CTE' => $http->getHeader('FECHA_RSP_CTE'),
                  'CODIGO_AUT' => $http->getHeader('CODIGO_AUT'),
                  'REFERENCIA' => $http->getHeader('REFERENCIA'),
                  'TEXTO' => $http->getHeader('TEXTO'),
                  'FECHA_REQ_CTE' => $http->getHeader('FECHA_REQ_CTE')
                ];

                foreach($response as $k => $v){
                    $pedido->respuesta_pago .= $k." : ".$v."\n";
                }

                $this->Pedidos->save($pedido);
            }

            $http->Disconnect();

            //$respuesta = "banorte";

        }elseif($pedido->forma_pago_id == 3){ // PAYPAL

            foreach(json_decode($data['paypal']) as $k => $v){
                $pedido->respuesta_pago .= $k." : ".$v."\n";
            }

            $this->Pedidos->save($pedido);

            //$respuesta = "paypal";

        }elseif($pedido->forma_pago_id == 4){ // OXXO

            require_once(ROOT.DS.'vendor'.DS.'conekta'.DS.'conekta-php'.DS.'lib'.DS.'Conekta.php');
            \Conekta\Conekta::setApiKey("key_idu7vQaw2cb57po1X8z5kQ");
            \Conekta\Conekta::setApiVersion("2.0.0");
            \Conekta\Conekta::setLocale('es');

            $respuesta = '';
            $pedido_nombre_cliente = $pedido->nombre_cliente;
            $pedido_correo_electronico = $pedido->correo_electronico;
            $pedido_calle = $pedido->calle;
            $pedido_ciudad = $pedido->ciudad;
            $pedido_estado = $pedido->estado;
            $pedido_codigo_postal = $pedido->codigo_postal;
            $pedido_monto = $pedido->monto;
            $pedido_envio = $pedido->envio;

            try {
                $customer = \Conekta\Customer::create(
                                array(
                                    'name'  => $pedido_nombre_cliente,
                                    'phone' => '0000000000',
                                    'email' => $pedido_correo_electronico
                                )
                            );

                $customer->createShippingContact(
                               array(
                                    'receiver' => $pedido_nombre_cliente,
                                    'phone' => '0000000000',
                                    'address' => array(
                                        'street1' => $pedido_calle,
                                        'city'    => $pedido_ciudad,
                                        'state'   => $pedido_estado,
                                        'country' => 'MX',
                                        'postal_code' => $pedido_codigo_postal
                                    )
                                ));

            } catch (Conekta_Error $e) {
                $respuesta  = $e->getMessage();
                $respuesta .= $e->message_to_purchaser;

                $pedido->respuesta_pago = $respuesta;
                $this->Pedidos->save($pedido);
            }

            if ($respuesta != '') { return ''; } //La orden no pudo ser procesada

            $aline_items = array();
            foreach ($pedido->partidas as $partida) {
                $aItem = array(
                                'name'        => $partida->producto,
                                'unit_price'  => $partida->precio*100,
                                'quantity'    => $partida->cantidad
                                );
                array_push($aline_items, $aItem);
            }

            $valid_order = array(
                              'line_items'  => $aline_items,
                              'currency'    => 'mxn',

                              'customer_info' => array(
                                    'customer_id'  => $customer->id
                              ),
                              'shipping_lines' => array(
                                    array(
                                      "amount"  => $pedido_envio*100,
                                      "carrier" => 'Pendiente x Confirmar'
                                    )
                              ),
                              'shipping_contact' => $customer->shipping_contacts[0],
                              'charges'     => array(
                                  array(
                                       'amount'   => $pedido_monto*100,
                                       'livemode' => false,
                                       'currency' => 'mxn',
                                       'payment_method' => array(
                                          'type'       => 'oxxo_cash',
                                          'expires_at' => strtotime(date("Y-m-d H:i:s")) + "84600"
                                       ),
                                    )
                              ),
                          );

            try {
                $order = \Conekta\Order::create($valid_order);
//error_log('$order:'.print_r($order, true).PHP_EOL, 3, 'conekta.log');
            } catch (\Conekta\ProcessingError $e){
                $respuesta = 'ProcessingError:'.$e->getMessage();
                $pedido->respuesta_pago = $respuesta;
                $this->Pedidos->save($pedido);
            } catch (\Conekta\ParameterValidationError $e){
                $respuesta = 'ParameterValidationError:'.$e->getMessage();
                $conektaError = $e->getConektaMessage();
                foreach ($conektaError->details as $key) {
                  $respuesta .= PHP_EOL.$key->debug_message;
                }
                $pedido->respuesta_pago = $respuesta;
                $this->Pedidos->save($pedido);
            } catch (\Conekta\Handler $e){
                $respuesta = 'Handler:'.$e->getMessage();
                $pedido->respuesta_pago = $respuesta;
                $this->Pedidos->save($pedido);
            }

            if ($respuesta != '') { return ''; } //La orden no pudo ser procesada

            $pedido->respuesta_pago_id = $order->id;
            $pedido->respuesta_pago = '';
            foreach ($order as $k0 => $v0)
            {
                if (is_object($v0))
                {
                    foreach ($v0 as $k1 => $v1)
                    {
                        if (is_object($v1))
                        {
                            foreach ($v1 as $k2 => $v2)
                            {
                                $pedido->respuesta_pago .= $k0.' : '.$k1.' : '.$k2." : ".$v2."\n";
                            }
                        }
                        else
                        {
                            $pedido->respuesta_pago .= $k0.' : '.$k1." : ".$v1."\n";
                        }
                    }
                }
                else
                {
                    $pedido->respuesta_pago .= $k0." : ".$v0."\n";
                }
            }

            $this->Pedidos->save($pedido);

            $respuesta = '<div class="blk_1">
                            <div class="title_2 ">
                                <h4><strong>MONTO A PAGAR</strong><br>
                                    <span>$ '.number_format($order->amount/100, 2).'</span><span style="font-size: 11px;">'.$order->currency.'</span>
                                </h4>
                                <p>OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
                                <br>
                                <h3><strong>REFERENCIA</strong></h3>
                                <div style="padding: 7px; max-width: 250px; border: 1px solid gray; margin: 7px; border-radius: 8px; font-size: 18px; text-align: center;">
                                    '.substr($order->charges[0]->payment_method->reference, 0, 4).'-'.
                                      substr($order->charges[0]->payment_method->reference, 4, 4).'-'.
                                      substr($order->charges[0]->payment_method->reference, 8, 4).'-'.
                                      substr($order->charges[0]->payment_method->reference, 12).
                                '</div>
                                <h3><strong>INSTRUCCIONES</strong></h3>
                                <span>1. Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encuéntrala aquí</a>.</span><br>
                                <span>2. Indica en caja que quieres ralizar un pago de <strong>OXXOPay</strong>.</span><br>
                                <span>3. Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</span><br>
                                <span>4. Realiza el pago correspondiente con dinero en efectivo.</span><br>
                                <span>5. Al confirmar tu pago, el cajero te entregará un comprobante impreso. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</span><br>
                                <br>
                                <div style="font-weight:bold; text-decoration:italic;">Al completar estos pasos recibirás un correo de confirmación de tu pago.</div>
                            </div>
                        </div>';

        }elseif($pedido->forma_pago_id == 5){ // DEPOSITO O TRANSFERENCIA

            //$respuesta = "deposito o transferencia";

        }elseif($pedido->forma_pago_id == 6){ // TIENDAS

            /* METODO 2*/
            # @param string publickey     Llave publica correspondiente al modo de la tienda
            # @param string privatekey    Llave privada correspondiente al modo de la tienda
            # @param bool   live          Modo de la tienda (false = Test | true = Live)
            $client = new Client(
                'pk_test_529d4303602446fd41',  # publickey
                'sk_test_67988030472248728d',  # privatekey
                false                         # live
            );

            # Se genera el objeto con la informacion de la orden
            /**
             * @param string order_id          Id de la orden
             * @param string order_name        Nombre del producto o productos de la orden
             * @param float  order_price       Monto total de la orden
             * @param string customer_name     Nombre completo del cliente
             * @param string customer_email    Correo electronico del cliente
             * @param string payment_type      (default = SEVEN_ELEVEN) Valor del atributo internal_name' de un objeto 'Provider'
             * @param string currency          (default = MXN) Codigo de la moneda con la que se esta creando el cargo
             * @param int    expiration_time   (default = null) Fecha en formato Epoch la cual indica la fecha de expiración de la orden
             */
            $aProductosName = array();
            foreach ($pedido->partidas as $partida):
                array_push($aProductosName, $partida->producto);
            endforeach;

            $expiration_date = strtotime("+2 days");
            $order_info = [
                'order_id'      => $pedido->id,
                'order_name'    => implode($aProductosName, ', '),
                'order_price'   => $pedido->monto,
                'customer_name' => $pedido->nombre_cliente,
                'customer_email' => ( ($pedido->correo_electronico)? $pedido->correo_electronico : 'felix.flores@webpoint.mx' ),
                'payment_type'  => 'SEVEN_ELEVEN',
                'currency'      => 'MXN',
                'expiration_time' => $expiration_date,
                'customer_phone' => $data['tarjeta'][$pedido->forma_pago_id]['vpc_Celular'],
                'send_sms'      => true
            ];
            $order = Factory::getInstanceOf('PlaceOrderInfo', $order_info);

            # Llamada al metodo 'place_order' del API para generar la orden
            # @param [PlaceOrderInfo] order
            # @return [NewOrderInfo]
            $neworder = $client->api->placeOrder($order);

            # Numero al cual se enviaran las instrucciones
            $phone_number = $data['tarjeta'][$pedido->forma_pago_id]['vpc_Celular'];

            # Id de la orden de compra de cual se enviaran las instrucciones
            $order_id = $neworder->id;

            # Llamada al metodo del API para envio de las instrucciones
            $smsinfo = $client->api->sendSmsInstructions($phone_number , $order_id);

            $pedido->respuesta_pago_id = $neworder->id;
            $pedido->respuesta_pago = '';
            foreach ($neworder as $k0 => $v0)
            {
                if (is_object($v0))
                {
                    foreach ($v0 as $k1 => $v1)
                    {
                        if (is_object($v1))
                        {
                            foreach ($v1 as $k2 => $v2)
                            {
                                $pedido->respuesta_pago .= $k0.' : '.$k1.' : '.$k2." : ".$v2."\n";
                            }
                        }
                        else
                        {
                            $pedido->respuesta_pago .= $k0.' : '.$k1." : ".$v1."\n";
                        }
                    }
                }
                else
                {
                    $pedido->respuesta_pago .= $k0." : ".$v0."\n";
                }
            }

            $this->Pedidos->save($pedido);

            $respuesta = '<div class="blk_1">
                            <div class="title_2 ">
                                <h4><strong>MONTO A PAGAR</strong><br>
                                    <span>$ '.number_format($neworder->instructions->details->amount, 2).'</span><span style="font-size: 11px;">MXN</span>
                                </h4>
                                <p>
                                   '.$neworder->instructions->description.'<br>
                                   '.$neworder->instructions->note_expiration_date.'<br>
                                   '.$neworder->instructions->note_extra_comition.'
                                </p>
                                <br>
                                <h3><strong>REFERENCIA</strong></h3>
                                <div style="padding: 7px; max-width: 250px; border: 1px solid gray; margin: 7px; border-radius: 8px; font-size: 18px; text-align: center;">
                                    '.$neworder->instructions->details->bank_account_number.'</div>
                                <h3><strong>INSTRUCCIONES</strong></h3>
                                <span>1. '.$neworder->instructions->step_1.'</span><br>
                                <span>2. '.$neworder->instructions->step_2.'</span><br>
                                <span>3. '.$neworder->instructions->step_3.'</span><br>
                                <br>
                                <div style="font-weight:bold; text-decoration:italic;">'.$neworder->instructions->note_confirmation.'</div>
                            </div>
                        </div>';

        }

        return $respuesta;

    }

    public function finalizar_compra()
    {

        $email = new Email('default');
        $email->template(null,'email')
        ->emailFormat('html')
        ->to(EMAIL_FROM_ADDRESS)
        ->from(EMAIL_FROM_ADDRESS)
        ->send();

    $this->render('pedido');

    }

    public function busqueda_municipio()
    {

        if ($this->request->is('ajax')) {
            $this->loadModel('Municipios');

            $idEstado = $this->request->data['selected'];

            $data = array();
            $municipios = $this->Municipios->find('list', array(
            'conditions'=>array('Municipios.estado_id =' => $idEstado)));

            $data['data'] = $municipios;

            die(json_encode($data));
        }
    }

    public function img($url = null)
    {
           $image = WWW_ROOT."img/no_image_available.png";

           $producto = $this->Productos->find('all')
            ->contain(['Imagenes'])
            ->where(['Productos.url' => $url])
            ->limit(1);
         $prod=$producto->toArray();
         //debug($prod[0]->imagenes);


         if(is_array($prod[0]->imagenes) && (isset($prod[0]->imagenes[0])) && (!is_null($prod[0]->imagenes[0]->nombre)) && ($prod[0]->imagenes[0]->nombre != "") ){

            $image = WWW_ROOT."producto_files/".$prod[0]->imagenes[0]->nombre;
         }
        //debug($image);
        //die;

        $imginfo = getimagesize($image);
        //header("Content-type: ".$imginfo['mime']);


        header('Content-Type: image/png');

        // Get new dimensions
        $filename=$image;
        $width = 120;
        $height = 120;

        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
           $width = $height*$ratio_orig;
        } else {
           $height = $width/$ratio_orig;
        }

        // Resample
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefrompng($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // Output
        imagepng($image_p);
        imagedestroy($im);


        //readfile($image);
        die;

    }

    public function promociones($url = null)
    {
        $producto = $this->Productos->find('all')
            ->contain(['Promociones'])
            ->where(['Productos.url' => $url])
            ->first();
        $response = [
            'producto' => $producto,
            'hoy' => new Time()
        ];
        $this->response->body(json_encode($response));
        return $this->response;
    }


    public function calculo_cupon($codigo_cupon = null, $ciudadUrl = null)
    {

        $hoy = date('Y-m-d');

        $this->loadModel('Cupones');
        $cupon = $this->Cupones->find('all', [
            'conditions'=>[
                'Cupones.codigo =' => $codigo_cupon,
                ['AND' => ['Cupones.fecha_inicio <=' => $hoy, 'Cupones.fecha_fin >=' => $hoy]]
            ]])->first();

        $limite = $cupon['cantidad']; // si cantidad = 0 Sin limite si es igual a 1 solo un producto
        $valido = 0;
        $carrito = [];

        if($this->request->session()->check('carrito')) {
            $carrito = $this->request->session()->read('carrito');
            $carrito = $carrito[ $ciudadUrl ];
            if(!$carrito){ $carrito = []; }
        }


        $carrito_cupon = $carrito;
        $total_cupon = 0;
        if($cupon)
        {

            $subtotal=0;
            $subtotal_acumulado=0;

            foreach ($carrito as $articulo) {
                $subtotal = $articulo['cantidad'] * $articulo['precio'];
                $subtotal_acumulado += $subtotal;
            }

            if($cupon['compra_minima'] <= $subtotal_acumulado){

                if($this->UserAuth->isLogged()) {
                    $logeado = $this->UserAuth->getUser();
                    $logeado = $logeado['User']['id'];

                    //CHECO SI HA REALIZADO OTRA COMPRA CON ESE CUPON
                    $this->loadModel('Pedidos');
                    $pedidos = $this->Pedidos->find('all', ['conditions'=>['cupon_id'=>$cupon['id'], 'cliente_id'=>$logeado]])->toArray();
                    $valido = count($pedidos);


                }else{
                    $logeado = null;
                }

                foreach ($carrito as $k => $articulo) {

                    $usuario_valido = 0;
                    if($cupon['cliente_id'] == ''){
                        $usuario_valido = 1;
                    }elseif($cupon['cliente_id'] == $logeado) {
                        $usuario_valido = 1;
                    }

                    $categoria_valido = 0;
                    $this->loadModel('CuponesCategorias');
                    $categorias_permitidas = $this->CuponesCategorias->find('list', ['conditions'=>['cupon_id'=>$cupon['id']]])->toArray();

                    if(count($categorias_permitidas) == 0){

                        $categoria_valido = 1;

                    }else{
                            foreach ($articulo['categorias'] as $categoria) { // Un producto puede estar en muchas categorias

                                foreach ($categorias_permitidas as $key => $value) { // Cupon muchas categorias

                                    if($value == $categoria->categoria_id) {

                                        $categoria_valido = 1;

                                    }

                                }

                            }

                    }

                    $marca_valido = 0;
                    $this->loadModel('CuponesMarcas');
                    $marcas_permitidas = $this->CuponesMarcas->find('list', ['conditions'=>['cupon_id'=>$cupon['id']]])->toArray();
                    if(count($marcas_permitidas) == 0){

                        $marca_valido = 1;

                    }else{

                        foreach ($marcas_permitidas as $key => $value) { // Cupon muchas marcas

                            if($value == $articulo['marca']) {

                                $marca_valido = 1;

                            }

                        }

                    }

                    $producto_valido = 0;
                    if($cupon['producto_id'] == ''){

                        $producto_valido = 1;

                    }elseif($cupon['producto_id'] == $articulo['id']){

                        $producto_valido = 1;

                    }


                    $carrito_cupon[$k]['descuento_cupon'] = 0;
                    if($usuario_valido == 1 && $categoria_valido == 1 && $marca_valido == 1 && $producto_valido == 1){

                        if($cupon['monto'] > 0)
                        {

                            if($limite == 1 && $valido == 0) {

                                $carrito_cupon[$k]['descuento_cupon'] = $cupon['monto'];
                                $total_cupon = $cupon['monto'];
                                $valido = 1;

                            }elseif($limite == 0){

                                $carrito_cupon[$k]['descuento_cupon'] = $cupon['monto'] * $articulo['cantidad'];
                                $total_cupon += $cupon['monto'] * $articulo['cantidad'];
                                $valido = 1;

                            }

                        }else{

                            if($limite == 1 && $valido == 0) {

                                $carrito_cupon[$k]['descuento_cupon'] = $articulo['precio'] *  $articulo['cantidad'] * ($cupon['porcentaje']/100);
                                $total_cupon = $articulo['precio'] *  $articulo['cantidad'] * ($cupon['porcentaje']/100);
                                $valido = 1;

                            }elseif($limite == 0){

                                $carrito_cupon[$k]['descuento_cupon'] = $articulo['precio'] *  $articulo['cantidad'] * ($cupon['porcentaje']/100);
                                $total_cupon += $articulo['precio'] *  $articulo['cantidad'] * ($cupon['porcentaje']/100);
                                $valido = 1;

                            }

                        }

                    }



                }// Fin recorrido de productos

            }
        }

        if($total_cupon > 0){

            $this->request->session()->write('cupon',array('codigo'=>$codigo_cupon, 'total'=>$total_cupon, 'cupon_id'=>$cupon['id']));

        }else{

            $this->request->session()->delete('cupon');

        }

        //$this->request->session()->write('carrito', $carrito_cupon);

        return $total_cupon;

    }


    public function cupon()
    {
        if ($this->request->is('ajax')) {

            $total_cupon = $this->calculo_cupon($this->request->data['cupon'], $this->request->data['ciudadUrl']);

            if($total_cupon > 0){ $exito=1; }else{ $exito=0; }

            die(json_encode($exito));
        }
    }

    public function editar_datos_usuario()
    {
        if ($this->request->is('post')) {

                $this->loadModel('Direcciones');

                $logeado = $this->UserAuth->getUser();
                $cliente_id = $logeado['User']['id'];

                if($this->request->data['id'] < 1){
                    $direccion = $this->Direcciones->newEntity();
                }

                $direccion = $this->Direcciones->patchEntity($direccion, $this->request->data);
                $direccion['cliente_id'] = $cliente_id;


                $this->Direcciones->save($direccion);
                $this->request->session()->write('direccion_logeado', $direccion['id']);

                return $this->redirect($this->referer());
        }
    }


public function moverimagenes(){
 set_time_limit ( -1 );

    $imagenes = $this->Productos->Imagenes->find('all',
            ['order' => 'id desc']
            );

foreach($imagenes as $imagen){
   //debug($imagen->nombre);
rename('/Users/trevino/Desktop/product/'.$imagen->nombre, '/Users/trevino/Desktop/original/'.$imagen->nombre);

}
echo  "termino";
exit;
   # var_dump($imagenes);

}

public function recomienda($id = null){


$producto = $this->Productos->get($id);


$status="Te recomiendo Padmont.com";
    $texto="<p>Tu amigo ".$this->request->data['tu_nombre']." te recomineda este producto:</p>

    <p>http://padmontfront.webpoint.mx/p/".$producto->url."</p>

    <p>Ofertas permanentes en Padmont.</p>


     ".$this->request->data['comentarios'];



        $email = new Email('default');
         $email->emailFormat('html')
        ->to($this->request->data['email'])
        ->from(EMAIL_FROM_ADDRESS)
        ->subject($status)
        ->send($texto);

$this->redirect('/p/'.$producto->url);



}


public function comentario(){

    $this->loadModel('Comentarios');
    $comentario = $this->Comentarios->newEntity();

    $logeado = $this->UserAuth->getUser();

    $producto = $this->Productos->get($this->request->data['producto_id']);
    $comentario['producto_id']=$this->request->data['producto_id'];
    $comentario['calificacion']=$this->request->data['calificacion'];
     $comentario['comentarios']=$this->request->data['comentarios'];

    $comentario['user_id']=$logeado['User']['id'];
    $comentario['fecha']=date("Y-m-d H:m:s");

    $this->Comentarios->save($comentario);

    $this->redirect('/p/'.$producto->url.'/1');

}

    public function confirmation_bancomer($id_pedido) {

        if ($this->request->is('post')) {
             $this->loadModel('Pedidos');
            $pedido = $this->Pedidos->find('all', array(
                'conditions'=>array('Pedidos.id ='=>$id_pedido)))->first();

            $pedido['respuesta_pago'] = implode(",", $this->request->data);

            $this->Pedidos->save($pedido);
        }else{
            $this->loadModel('Pedidos');
            $pedido = $this->Pedidos->find('all', array(
                'conditions'=>array('Pedidos.id ='=>$id_pedido)))->first();

            $pedido['respuesta_pago'] = 'NO PASAO NADA';

            $this->Pedidos->save($pedido);
        }
    }

    public function order_confirmation($pedido_id = null) {

            $this->loadModel('Pedidos');
            $pedido = $this->Pedidos->find('all', [
                'conditions'=>['Pedidos.id ='=>$pedido_id]])->first();


            //Capturamos lo que regresa el procesador:
            $retorno="\n-------------------------\n";
            foreach($this->request->query as $k=>$v){
                $retorno.=$k." : ".$v ."\n";
            }

            foreach($this->request->data as $k=>$v){
                $retorno.=$k." : ".$v ."\n";
            }

            $pedido['respuesta_pago'] .= $retorno;

            $this->Pedidos->save($pedido);

            die;
    }

    // Funciones para el calculo del codigo  de oxxo

    function referencia($cadena_ref){
              $ref=str_pad($cadena_ref,10,'0',STR_PAD_LEFT);
              return $ref;
    }
    function CadenaVerificador($id_ox,$orden_id,$fecha,$monto){
            $array[]=$id_ox;
            $array[]=$orden_id;
            $array[]=$fecha;
            $array[]=$monto;
            foreach ($array as $value) { $string.= $value; }
            return $string;
    }

    function verificador($cadena_ver)
                  {
                  $array = array ();

                    //separa y multiplica
                    $longitud= strlen($cadena_ver);
                    for($i = 0; $i < $longitud; ++$i) {
                    $num = $cadena_ver[$i];
                    $multip= $num*($swich=(($c++%2==1)?'1':'2'));
                    $array[$i]=$multip;
                                                      }
                    $result = count($array);
                    $arraysumatotal = array ();

                    for($i = 0; $i < $result; ++$i) {
                    $num2 = $array[$i];
                    if ($num2 > 9 ) {
                    $izq=(int)($num2/10);
                    $der=$num2-($izq*10);
                    $suma= $izq+$der;
                    $arraysumatotal[$i]=$suma;
                                    }else{
                                        $arraysumatotal[$i]=$num2;
                                         }
                                }

                    $sumatotal=array_sum($arraysumatotal);
                    $res = ($sumatotal % 10);
                    if ($res == 0 ) {
                    $digito=0;
                                    }else {
                                    $digito=10-$res;
                                          }
                    return $digito;

    }

    function monto($cadena_mont) {
                  $caracteres= array(",", ".","$");
                  // $caracteres= array("&nbsp","<b>","</b>"," ",".","$","Pesos",",");

                  $dot = str_replace($caracteres,"",$cadena_mont);
                  $mont=str_pad($dot,7,'0',STR_PAD_LEFT);
                  return $mont;
    }

    private function is_valid_email($email){


        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }



    public function cotizar( ){

        $this->direccion_logeado();

        if($this->UserAuth->isLogged()) {

            $this->buscar_direcciones();
        }

        $this->loadModel("Settings");
        $emailcotizar = $this->Settings->find("all",['conditions'=> ['Settings.name ' => 'emailcotizar' ] ] )->first();


        $id = $this->request->data['id_producto_cotizar'] ;
        $emailFrom = $this->request->data['Email'];
        $notes = $this->request->data['notes'];
        $nombre = $this->request->data['nombre'];

        $producto = $this->Productos->get( $id );
        if( $this->is_valid_email( $emailFrom) ){


            $email = new Email('default');
            $producto = $this->Productos->get( $id );

            $email->template('cotizar');

            $email ->emailFormat('html')
                ->to( $emailcotizar->value )
                ->from($emailFrom)
                ->subject("Solicitud de Cotización ")
                ->viewVars( ['producto'=>$producto , 'email' => $emailFrom , 'data' =>  $this->request->data  ] )
                ->send();


            $this->Flash->info(__('Solicitud de cotización enviada'));

        }else{

            $this->Flash->error(__("El correo no es valido ". $email ));
        }





        $this->redirect('/p/'. $producto->url);

    }

    public function producto_calendario($ciudad_id = null, $producto_id = null, $dias = 0, $fecha_seleccionada = false)
    {

        $settings =  getAllSettings();
        $tipocambio = $settings['tipocambio']['value'];

        $dias_maximo = 60;
        $fecha_maxima = date( 'Y-m-d' , strtotime( '+'.$dias_maximo.' day' ) );

        $this->loadModel('Ciudades');
        $ciudad = $this->Ciudades->find('all')
            ->contain([
                'CiudadFestivos',
                'CiudadFestivosSemanas',
                'CiudadHorarioEntregas'=>['conditions'=>['CiudadHorarioEntregas.ciudad_horario_entrega_tipo_id IN'=>[1]]],
                'CiudadHorarioEntregas.CiudadHorarioEntregaPrecisos',
                'CiudadProductoFestivos'=>['conditions'=>['CiudadProductoFestivos.producto_id'=>$producto_id]],

                'Estados.CiudadFestivos',
                'Estados.CiudadFestivosSemanas',
                'Estados.CiudadHorarioEntregas'=>['conditions'=>['CiudadHorarioEntregas.ciudad_horario_entrega_tipo_id IN'=>[1]]],
                'Estados.CiudadHorarioEntregas.CiudadHorarioEntregaPrecisos'
                ])
            ->where(['Ciudades.id' => $ciudad_id])
            ->first();

        $time = new Time();
        if($dias > 0){
            $time->modify('+'.$dias.' days');
        }

        $noDispobible = [];

        $dias_festivos_semana = $this->get_dias_festivos_semana($ciudad, $ciudad->estado, $dias_maximo);

        $festivos = array_merge($ciudad->ciudad_festivos, $ciudad->estado->ciudad_festivos, $dias_festivos_semana, $ciudad->ciudad_producto_festivos);

        foreach ($festivos as $key => $festivo) {
            $festivos[$key]['sort'] = strtotime($festivo['fecha']->format('Y-m-d'));
        }

        $festivos = $this->array_msort($festivos, ['sort' => SORT_ASC]);

        foreach ($festivos as $festivo) {
            $noDispobible[] = [
                'title' => __('NO DISPOBIBLE'),
                'start' => $festivo['fecha']->format('Y-m-d'),
                'backgroundColor' => '#c3c3cb',
                'eventColor' => '#c3c3cb',
                'borderColor' => '#c3c3cb'
            ];

            if($time->format('Y-m-d') == $festivo['fecha']->format('Y-m-d')){
                $dias++;
                $time->modify('+1 days');
            }

        }

        $horarios = $this->get_horarios_entrega($ciudad, $ciudad->estado, $time, $dias);

        $this->loadModel('Monedas');
        $monedas = $this->Monedas->find('list')->toArray();

        $currency = ($this->Cookie->read('currency') > 0)? $this->Cookie->read('currency') : 1;

        $costo_envio_por_dia = $this->get_costo_envio_por_dia($ciudad, $ciudad->estado, $dias_maximo, $noDispobible, $monedas, $currency, $tipocambio);
        $eventos = array_merge($costo_envio_por_dia, $noDispobible);

        $costo_envio = $this->get_costo_envio($time->format("Y-m-d"), $ciudad, $ciudad->estado);

        $this->set(compact('noDispobible', 'horarios', 'time', 'ciudad_id', 'producto_id', 'monedas', 'tipocambio', 'fecha_seleccionada', 'costo_envio', 'fecha_maxima', 'eventos', 'currency'));

        //$this->render(null,'front');
        $this->render(null,'ajax');
    }

    public function get_costo_envio($time = '', $ciudad = [], $estado = []){

        $costo_envio = $ciudad->costo_envio + $ciudad[ 'costo_envio'.date('N', strtotime($time)) ];

        if($ciudad->costo_envio == 0){
            $costo_envio = $estado->costo_envio + $estado[ 'costo_envio'.date('N', strtotime($time)) ];
        }

        return $costo_envio;
    }

    public function get_horarios_entrega($ciudad = [], $estado = [], $time = null, $dias = 0){

        $horarios = [];

        if($ciudad->ciudad_horario_entregas){
            $horarios = $ciudad->ciudad_horario_entregas;
        }else{
            $horarios = $estado->ciudad_horario_entregas;
        }

        $dia_semana = date('N', strtotime($time->format('Y-m-d')));

        if(in_array($dia_semana, [6,7])){

            $horario_entrega_tipos = $this->Ciudades->CiudadHorarioEntregas->CiudadHorarioEntregaTipos->find('all', ['conditions'=>['CiudadHorarioEntregaTipos.num_dia'=>$dia_semana]])->first();

            $horarios_dia_semana = $this->Ciudades->CiudadHorarioEntregas->find('all', ['conditions'=>[
                'CiudadHorarioEntregas.ciudad_horario_entrega_tipo_id' => $horario_entrega_tipos->id,
                'CiudadHorarioEntregas.ciudad_id' => $ciudad->id,
            ]])->toArray();

            if(!$horarios_dia_semana){
                $horarios_dia_semana = $this->Ciudades->CiudadHorarioEntregas->find('all', ['conditions'=>[
                    'CiudadHorarioEntregas.ciudad_horario_entrega_tipo_id' => $horario_entrega_tipos->id,
                    'CiudadHorarioEntregas.estado_id' => $estado->id,
                ]])->toArray();
            }

            if($horarios_dia_semana){
                $horarios = $horarios_dia_semana;
            }
        }


        $fecha = $time->format("Y-m-d");

        $horarios_fecha = $this->Ciudades->CiudadHorarioEntregas->find('all', ['conditions'=>[
            'CiudadHorarioEntregas.ciudad_horario_entrega_tipo_id' => 2,
            'CiudadHorarioEntregas.ciudad_id' => $ciudad->id,
            'CiudadHorarioEntregas.fecha' => $fecha
        ]])->toArray();

        if(!$horarios_fecha){
            $horarios_fecha = $this->Ciudades->CiudadHorarioEntregas->find('all', ['conditions'=>[
                'CiudadHorarioEntregas.ciudad_horario_entrega_tipo_id' => 2,
                'CiudadHorarioEntregas.estado_id' => $estado->id,
                'CiudadHorarioEntregas.fecha' => $fecha
            ]])->toArray();
        }

        if($horarios_fecha){
            $horarios = $horarios_fecha;
        }


        foreach ($horarios as $key => $horario) {


            if($horario->disponible_hasta->format('H:i') < $time->format('H:i') && $dias == 0){
                $horarios[$key]->disponible = 0;
            }else{
                $horarios[$key]->disponible = 1;
            }
        }


        return $horarios;
    }

    public function get_dias_festivos_semana($ciudad = [], $estado = [], $dias_maximo = 0){

        $festivos = [];
        if($ciudad->ciudad_festivos_semanas){

            $festivos = $this->get_fechas_dias_festivos($ciudad->ciudad_festivos_semanas[0], $dias_maximo);
            $festivos = $festivos['festivos'];

        }else if($estado->ciudad_festivos_semanas){

            $festivos = $this->get_fechas_dias_festivos($estado->ciudad_festivos_semanas[0], $dias_maximo);
            $festivos = $festivos['festivos'];
        }

        return $festivos;
    }

    public function get_fechas_dias_festivos($festivos = [], $dias_maximo = 0){

        $fechas = [];

        $fechas['festivos'] = [];
        $fechas['no_festivos'] = [];

        $dias = [];
        $dias_name = [
            1 => 'lun',
            2 => 'mar',
            3 => 'mie',
            4 => 'jue',
            5 => 'vie',
            6 => 'sab',
            7 => 'dom'
        ];

        foreach ($dias_name as $key => $dia) {
            if($festivos[$dia]){
                $dias[] = $key;
            }
        }

        $hoy = date('Y-m-d');
        for ($i=0; $i <= $dias_maximo; $i++) {

            $dia = date('N', strtotime($hoy));

            if(in_array($dia, $dias)){
                $fechas['festivos'][]['fecha'] = new Time($hoy);
            }else{
                $fechas['no_festivos'][]['fecha'] = new Time($hoy);
            }

            $hoy = date( 'Y-m-d' , strtotime( '+1 day' , strtotime( $hoy ) ) );

        }

        return $fechas;
    }

    public function get_costo_envio_por_dia($ciudad = [], $estado = [], $dias_maximo = 0, $noDispobible = [], $monedas = [], $currency = 1, $tipocambio = 1){

        $precioEnvio = [];

        $fechasNoDisponibles = [];
        foreach ($noDispobible as $fecha) {
            $fechasNoDisponibles[] = $fecha['start'];
        }

        $no_festivos = [];
        if($ciudad->ciudad_festivos_semanas){

            $no_festivos = $this->get_fechas_dias_festivos($ciudad->ciudad_festivos_semanas[0], $dias_maximo);
            $no_festivos = $no_festivos['no_festivos'];

        }else if($estado->ciudad_festivos_semanas){

            $no_festivos = $this->get_fechas_dias_festivos($estado->ciudad_festivos_semanas[0], $dias_maximo);
            $no_festivos = $no_festivos['no_festivos'];

        }

        foreach ($no_festivos as $dia) {

            if(!in_array($dia['fecha']->format("Y-m-d"), $fechasNoDisponibles)){
                $costo_envio = $this->get_costo_envio($dia['fecha']->format("Y-m-d"), $ciudad, $estado);

                $precioEnvio[] = [
                    'title' => '$ '.( ( $currency == 2 )? number_format($costo_envio / $tipocambio, 2) : number_format($costo_envio, 2) ).' '.$monedas[$currency],
                    'start' => $dia['fecha']->format("Y-m-d"),
                    'backgroundColor' => '#fff',
                    'eventColor' => '#fff',
                    'borderColor' => '#fff',
                    'textColor' => '#000'
                ];
            }
        }

        return $precioEnvio;
    }

    public function array_msort($array, $cols){
        $colarr = [];
        foreach ($cols as $col => $order) {
            $colarr[$col] = [];
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = [];
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;

    }

    public function adicionales($ciudadUrl = null)
    {
        $this->loadModel('CiudadesProductos');
        $this->loadModel('Categorias');

        $this->loadModel('Ciudades');
        $ciudad = $this->Ciudades->find('all')
            ->where(['Ciudades.url' => $ciudadUrl])
            ->first();

        $condiciones['Ciudades.url'] = $ciudadUrl;
        $condiciones['Productos.adicional'] = true;
        $condiciones['Productos.deleted'] = false;
        $condiciones['Productos.activo'] = true;

        $cat_adicionales = [70,71,72];

        $matcher = function($q)  use ($cat_adicionales) {
                return $q->where( [ 'Categorias.id IN' => $cat_adicionales]);
            };

        $productos = $this->CiudadesProductos->find('all')
            ->distinct(['Productos.id'])
            ->contain([
                'Ciudades',
                'Productos' => function ($q) use ($matcher) {
                     return $q->matching('Categorias', $matcher);
                },
                'Productos.Imagenes'
            ])
            ->where($condiciones)
            ->toArray();


        $categorias = [];

        foreach ($productos as $key => $producto) {

            $categorias[$producto->_matchingData['Categorias']->id]['categoria'] = $producto->_matchingData['Categorias'];

            $producto->_matchingData['Productos']['imagenes'] = $producto->producto->imagenes;

            $categorias[$producto->_matchingData['Categorias']->id]['productos'][] = $producto->_matchingData['Productos'];

        }

        $settings =  getAllSettings();
        $tipocambio = $settings['tipocambio']['value'];

        $this->loadModel('Monedas');
        $monedas = $this->Monedas->find('list')->toArray();

        $this->set('currency', ($this->Cookie->read('currency') > 0)? $this->Cookie->read('currency') : 1);

        $this->set(compact('categorias', 'monedas', 'ciudadUrl', 'ciudad', 'tipocambio'));

        $this->render(null,'front');
    }

    public function agregar_adicionales()
    {

        if ($this->request->is('ajax')) {

            $ciudad_url = $this->request->data['ciudad_url'];

            $this->loadModel('Ciudades');
            $ciudad = $this->Ciudades->find('all')
                ->where(['Ciudades.url' => $ciudad_url])
                ->first();

            $url = '/carrito/'.$ciudad_url;

            if(!isset($this->request->data['adicionales'])){
                die(json_encode($url));
            }


            $adicionales = $this->request->data['adicionales'];
            $cantidad = $this->request->data['cantidad'];

            // datos de productos
            $productos = $this->Productos->find('all', [
                'fields'=>['id', 'nombre', 'sku', 'precio' => $ciudad->precio, 'adicional'],
                'conditions'=>['Productos.id IN'=>$adicionales],
                'contain'=>['Imagenes']
            ]);

            $carrito = array();
            $carrito = $this->request->session()->read('carrito');

            $posicion = count($carrito[$ciudad_url]);
            foreach ($productos as $key => $producto) {
                $producto->checkgroup = FALSE;

                $carrito[$ciudad_url][$posicion] = $producto->toArray();
                $carrito[$ciudad_url][$posicion]['cantidad'] = $cantidad;

                $posicion++;
            }


            $this->request->session()->write('carrito', $carrito);


            die(json_encode($url));

        }
    }

    public function buscar_direccion()
    {
        $this->loadModel('DireccionTipos');
        $direcciones_tipos = $this->DireccionTipos->find('list');
        $this->set(compact('direcciones_tipos'));

        $this->render(null,'ajax');
        //$this->render(null,'front');
    }
}
