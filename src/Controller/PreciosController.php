<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component\RequestHandlerComponent;

/**
 * Precios Controller
 *
 * @property \App\Model\Table\PreciosTable $Precios
 */
class PreciosController extends AppController
{
    /**
     * initialize method
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {        
        $precios = $this->Precios->find('all');
        $this->set('precios', $precios);
        $this->set('_serialize', ['precios']);
    }

    /**
     * View method
     *
     * @param string|null $id Precio id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($producto_id = null)
    {
       
        $this->loadModel('Preciocompetencias');
        $this->loadModel('Competencias');

        $precios = $this->Precios->find('all')
        ->contain(['Proveedores', 'Usuarios'])
        ->where(['producto_id'=>$producto_id]);


        $this->loadModel('Productos');
        $producto = $this->Productos->find('all', ['conditions' => ['Productos.id'=>$producto_id], 'contain' => ['Proveedores']])->first();
        
        $precioscompetencia = $this->Preciocompetencias->find('all')
                            ->contain(['Competencias','Usuarios'])
                            ->where(['Preciocompetencias.producto_id =' => $producto_id]);


        $this->set('competencias', $this->Competencias->find('list'));
        $this->set('producto', $producto);
        $this->set('precios', $precios);
        $this->set('precioscompetencia', $precioscompetencia);
       # $this->set('_serialize', ['precio']);
        $this->render(null,'iframe');
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($producto_id = null)
    {

        $precio = $this->Precios->newEntity();
        if ($this->request->is('post')) {
            
            $precio = $this->Precios->patchEntity($precio, $this->request->data);
            $precio['created'] = date('Y-m-d H:m:s');
            $precio['modified'] = date('Y-m-d H:m:s');
            
            if ($this->Precios->save($precio)) {
                $this->Flash->success(__('El precio ha sido guardado.'));
                return $this->redirect(['action' => 'view',$precio->producto_id]);
            } else {
                


                $this->Flash->error(__('El precio no pudo ser guardado'));
            }
        }
       
         $proveedores = $this->Precios->Proveedores->find('list', ['limit' => 200]);   

         $this->loadModel('Productos');
         $producto = $this->Productos->get($producto_id);


if($producto->envio>0){

    $envio->precio = $producto->envio;
}else{
                            $peso = $producto->peso;
                            $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);
                
                            $this->loadModel('Enviotarifas');
                            $tarifa_peso = $this->Enviotarifas->find('all', array(
                                    'conditions'=>array($this->distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                                        $peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                            //$tarifa_peso->precio
                        
                            $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                                    'conditions'=>array($this->distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                                        'cubicaje >=' => $cubicaje),
                                    'order' => 'cubicaje ASC'))->first();
                            //$tarifa_cubicaje->precio
                    
                            if(is_null($tarifa_peso)){
                                $tarifa_peso->precio=0;
                            }
                            if(is_null($tarifa_cubicaje)){
                                $tarifa_cubicaje->precio=0;
                            }

                            if($tarifa_peso->tarifa == 7){
                                $tarifa_peso->precio =  $peso * $tarifa_peso->precio_kilo; 
                            }
        
                            if($tarifa_cubicaje->tarifa == 7){
                                $tarifa_cubicaje->precio =  $cubicaje * $tarifa_cubicaje->precio; 
                            }


                            if($tarifa_peso->precio > $tarifa_cubicaje->precio)
                            {
                              $envio =   $tarifa_peso;
                            }else{
                                $envio =   $tarifa_cubicaje;
                            }
}

        $this->set('envio', $envio);
        $this->set('producto', $producto);
       
        $this->set(compact('precio', 'productos', 'proveedores', 'usuarios'));
        $this->set('_serialize', ['precio']);
        $this->render(null,'iframe');
    }


    public function asignar_proveedor($precio_id = null)
    {
        $precio = $this->Precios->get($precio_id);

        $producto = $this->Precios->Productos->get($precio['producto_id']);

        $producto['proveedor_id'] = $precio['proveedor_id'];
        $producto['precio'] = $precio['precio'];
        $producto['costo'] = $precio['costo'];
        $producto['margen'] = $precio['margen'];
        $producto['existencia'] = $precio['existencia'];
        $producto['envio_gratis'] = $precio['envio_gratis'];
        $producto['modified'] = date('Y-m-d H:m:s');
        $precio['activo'] = true;

        $this->Precios->updateAll(['activo' => false], ['producto_id' => $precio['producto_id']]);
        $this->Precios->save($precio);

        $this->Precios->Productos->save($producto);

        $this->Flash->success(__('El proveedor ha sido actualizado.'));
        return $this->redirect(['action' => 'view',$precio['producto_id']]);
    }


    /**
     * Edit method
     *
     * @param string|null $id Precio id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $precio = $this->Precios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $precio = $this->Precios->patchEntity($precio, $this->request->data);
            if ($this->Precios->save($precio)) {
                $this->Flash->success(__('El precio ha sido editado.'));
                return $this->redirect(['action' => 'view',$precio->producto_id]);
            } else {
                $this->Flash->error(__('El precio no pudo ser editado.'));
            }
        }
       
        $proveedores = $this->Precios->Proveedores->find('list', ['limit' => 200]);

          $producto = $this->Precios->Productos->get($precio->producto_id);

if($producto->envio>0){

    $envio->precio = $producto->envio;
}else{

                            $peso = $producto->peso;
                            $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);
                
                            $this->loadModel('Enviotarifas');
                            $tarifa_peso = $this->Enviotarifas->find('all', array(
                                    'conditions'=>array($this->distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                                        $peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                            //$tarifa_peso->precio
                        
                            $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                                    'conditions'=>array($this->distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                                        'cubicaje >=' => $cubicaje),
                                    'order' => 'cubicaje ASC'))->first();
                            //$tarifa_cubicaje->precio

                            // $this->loadModel('Enviotarifas');
                            // $tarifa_peso = $this->Enviotarifas->find('all', array(
                            //         'conditions'=>array('2300 BETWEEN distancia_inicio AND distancia_fin', 
                            //             $peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                            // //$tarifa_peso->precio
                        
                            // $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                            //         'conditions'=>array(' 2300 BETWEEN distancia_inicio AND distancia_fin', 
                            //             'cubicaje <=' => $cubicaje),
                            //         'order' => 'precio DESC'))->first();
                            //$tarifa_cubicaje->precio
                            
                            if(is_null($tarifa_peso)){
                                $tarifa_peso->precio=0;
                            }
                            if(is_null($tarifa_cubicaje)){
                                $tarifa_cubicaje->precio=0;
                            }

                            if($tarifa_peso->tarifa == 7){
                                $tarifa_peso->precio =  $peso * $tarifa_peso->precio_kilo; 
                            }
        
                            if($tarifa_cubicaje->tarifa == 7){
                                $tarifa_cubicaje->precio =  $cubicaje * $tarifa_cubicaje->precio; 
                            }


                            if($tarifa_peso->precio > $tarifa_cubicaje->precio)
                            {
                              $envio =   $tarifa_peso;
                            }else{
                                $envio =   $tarifa_cubicaje;
                            }
                            //debug($cubicaje);
                            //debug($tarifa_peso); debug($tarifa_peso->precio); debug($tarifa_cubicaje);
                            //debug($tarifa_cubicaje->precio);
}

        $this->set('envio', $envio);
        $this->set('producto', $producto);
       


        
        $this->set(compact('precio', 'proveedores'));
        $this->set('_serialize', ['precio']);
         $this->render(null,'iframe');

    }

    /**
     * Delete method
     *
     * @param string|null $id Precio id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null,$producto_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $precio = $this->Precios->get($id);
        if ($this->Precios->delete($precio)) {
            $this->Flash->success(__('El precio ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El precio no pudo ser eliminado'));
        }
        return $this->redirect(['action' => 'view',$producto_id]);
    }
}
