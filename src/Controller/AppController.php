<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\I18n\I18n;
use Cake\Datasource\ConnectionManager;
use Cake\Orm\TableRegistry;


define('WWW_RUTA' ,'flordeco.dev/'); # For now
define('FRONT_WWW_ROOT', WWW_ROOT);

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = ['Cookie', 'Flash', 'Auth', 'Usermgmt.UserAuth'/*, 'Security'*/];
    public $helpers = ['Usermgmt.UserAuth', 'Usermgmt.Image', 'Form'];
    public $sino=array(0=>'NO',1=>'SI');
    public $distancia_media='1300'; //Kilómetros para calculo de envío medio.
    public $iva = 0.16; //Porcentaje de IVA

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);

        $this->set('sino',$this->sino);
        $this->set('iva',$this->iva);
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
       

        parent::initialize();
        //$this->loadComponent('Flash');

        $haystack[] = 'pedido';
        $haystack[] = 'confirmacion';
        $haystack[] = 'editar_datos_usuario';
        $haystack[] = 'codigo_postal';
        $haystack[] = 'busqueda_ciudad';
        $haystack[] = 'order_confirmation';

        $modo_invitado = $this->request->session()->read('modo_invitado');

     
        if( $this->request->params['controller'] != 'Productos' && !in_array( $this->request->params['action']  , $haystack) ){
            // no estoy en el proceso de compra.  quitamos acceso al modo_invitado.

            $modo_invitado = $this->request->session()->read('modo_invitado');

            if( $modo_invitado){
                UsermgmtInIt();
                //die("Estoy por borrar modo invitado");
                $this->request->session()->delete('modo_invitado');
                $this->loadComponent('Auth');
                $this->loadComponent('Usermgmt.UserAuth');

                $this->Auth->config('logoutRedirect', LOGOUT_REDIRECT_URL);

                //die("Antes del ");
                $this->request->session()->delete('Auth.User');
                
            }

        }

    }
    
    /* Override functions */
    public function paginate($object = NULL, array $settings = []) {
        $sessionKey = sprintf('UserAuth.Search.%s.%s', $this->request['controller'], $this->request['action']);
        if($this->request->session()->check($sessionKey)) {
            $persistedData = $this->request->session()->read($sessionKey);
            if(!empty($persistedData['page_limit'])) {
                $this->paginate['limit'] = $persistedData['page_limit'];
            }
        }
        return parent::paginate($object);
    }


    protected function validPathFiles( &$data){

        $cadena = \Cake\Utility\Inflector::slug($data['name']);

        $ext = $this->response->mapType($data['type']);

        

        $data['name'] = str_replace( '-'.$ext, '.'.$ext,$cadena   );

        //$data['name'] = time(). $data['name'];


    }   


    protected function direccion_logeado(){
        
        if($this->UserAuth->isLogged()) { 
           
            if(empty($this->request->session()->read('direccion_logeado'))){

                // ELMINA CODIGO POSTAL Y LIMPIA CALCULO DE ENVIO PARA SER TOMADO POR UN DIRECCION DE CLIENTE
                //$this->request->session()->delete('codigo_postal');
                $this->request->session()->delete('direccion_logeado');
        
                $this->loadModel('Direcciones');
        
                $logeado = $this->UserAuth->getUser();
                $cliente_id = $logeado['User']['id'];
                
                $conditions[ ] = array('Direcciones.cliente_id =' => $cliente_id) ;
                if( $this->request->session()->check('modo_invitado') ){
                        
                    $conditions[ ] = array('Direcciones.session_id =' => session_id() ) ;

                }

                $direccion_envio = $this->Direcciones->find('all', array(
                    'conditions'=> $conditions ))->first();
                


                if(!empty($direccion_envio)){

                   
                        $this->request->session()->write('codigo_postal',$direccion_envio['codigo_postal']);
                        $this->request->session()->write('direccion_logeado',$direccion_envio['id']);
                    
                }

            }
            
        }

    }


    protected function buscar_direcciones(){
        $logeado = $this->UserAuth->getUser();

            $this->loadModel('Users');
            $this->loadModel('Codigos');
            $logeado = $this->Users->get($logeado['User']['id']);

            $this->loadModel('Direcciones');
            if($this->request->session()->check('codigo_postal')) {

                $codigo_postal = $this->request->session()->read('codigo_postal');
                $direccion_id = $this->request->session()->read('direccion_logeado');
                /*
                $this->set('direccion_envio', $this->Direcciones->find('all', array(
                'conditions'=>array('Direcciones.cliente_id =' => $logeado['User']['id'], 'Direcciones.codigo_postal =' => $codigo_postal)
                ))->first());*/
                
                $direccion_envio = $this->Direcciones->find('all', array(
                'conditions'=>array('Direcciones.id =' => $direccion_id)
                ))->first();

                if(count($direccion_envio) == 0){

                    $direccion_envio = $this->Codigos->find('all', array(
                    'conditions'=>array('Codigos.codigo =' => $codigo_postal)))->first();

                }

                $ciudades_direccion = $this->Codigos->find('all', [
                'conditions' => ['Codigos.estado' => $direccion_envio['estado']],
                'order' => ['ciudad' => 'ASC'],
                'keyField' => 'ciudad', 'valueField' => 'ciudad']);

                $this->set(compact('direccion_envio', 'ciudades_direccion'));
            }

            $this->set('direcciones_envio', $this->Direcciones->find('all', array(
            'conditions'=>array('Direcciones.cliente_id =' => $logeado['id']),
            )));

            $this->set('usuario', $logeado);

    }


    public function beforeFilter(\Cake\Event\Event $event) {
        $this->setLang();
        $this->setCurrency();
        #$this->setLocation();
    }

    public function setLang(){
        $lang = $this->Cookie->read('lang');
        $lang = $lang ? $lang : 'es_ES';
        I18n::locale($lang);
        $this->set(compact('lang'));
    }

    public function setCurrency(){
        $currency = $this->Cookie->read('currency');
        $currency = $currency ? $currency : 'mxn';
        $this->set(compact('currency'));
    }

    public function setLocation(){
        $estado_id = $this->Cookie->read('estado_id');
        $estado_id = $estado_id ? $estado_id : '';
        $municipio_id = $this->Cookie->read('municipio_id');
        $municipio_id = $municipio_id ? $municipio_id : '';
        $nombreEstado = $this->getField('Estados', 'nombre', ['id' => $estado_id]);
        $nombreMunicipio = $this->getField('Municipios', 'nombre', ['id' => $municipio_id]);
        $this->set(compact('estado_id', 'municipio_id', 'nombreEstado', 'nombreMunicipio'));
    }

    public function uploadFile($requestData, $path = 'files/sucursales/'){
        if ($requestData) {
            if ( isset($requestData['error']) && $requestData['error'] == UPLOAD_ERR_OK ) {
                $uniqId     = uniqid();
                $ext        = pathinfo($requestData['name'], PATHINFO_EXTENSION);
                $filePath   = "{$path}{$uniqId}.{$ext}";
                if(move_uploaded_file($requestData['tmp_name'], WWW_ROOT . $filePath)){
                    return $filePath;
                }
            }
        }
        return '';
    }

    public function sucursalActual(){
        $estado_id = $this->Cookie->read('estado_id');
        $estado_id = $estado_id ? $estado_id : 0;
        $municipio_id = $this->Cookie->read('municipio_id');
        $municipio_id = $municipio_id ? $municipio_id : 0;
        if ($estado_id && $municipio_id) {
            return $this->getField('Sucursales', 'id', [
                'estado_id' => $estado_id,
                'municipio_id' => $municipio_id,
            ]);
        }
        return 0;
    }

    public function getField($model, $field, $conditions = []){
        $res = TableRegistry::get($model)->find()->select($field)->where($conditions)->first();
        if ($res) {
            return $res->{$field};
        }
        return false;
    }

}
