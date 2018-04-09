<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Utility\Inflector;
/**
 * Fichas Controller
 *
 * @property \App\Model\Table\FichasTable $Fichas
 */
class FichasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($producto_id = null)
    {

        if ($this->request->is('post')) {

            $ficha = $this->Fichas->get($this->request->data['id']);
            $ficha = $this->Fichas->patchEntity($ficha, $this->request->data);

            if ($this->Fichas->save($ficha)) {
                $this->Flash->success(__('El orden se guardo.'));
            } else {
                $this->Flash->error(__('El orden no se pudo guardar.'));
            }
           
        }

        $this->set('fichas', $this->Fichas->find('all',['conditions'=>['producto_id'=>$producto_id], 'order' => ['orden' => 'ASC']]));
        $this->set('_serialize', ['fichas']);
        $this->set('producto_id',$producto_id);
        $this->render(null,'iframe');
    }

    /**
     * View method
     *
     * @param string|null $id ficha id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ficha = $this->Fichas->get($id, [
            'contain' => ['Productos']
        ]);
        $this->set('ficha', $ficha);
        $this->set('_serialize', ['ficha']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($producto_id = null)
    {
        $ficha = $this->Fichas->newEntity();
        if ($this->request->is('post')) {

            
             if(count($this->request->data['fichas']) > 0){
                foreach ($this->request->data['fichas'] as $ficha_upload) {

                    $this->validPathFiles( $ficha_upload ) ;
                    

                    $ext = $ext[ $total ];

                    $ficha = $this->Fichas->newEntity();

                    $ficha['producto_id'] = $this->request->data['producto_id'];
                    $ficha['nombre'] = $ficha_upload['name'];

                   
                    //$ruta = '/var/www/html/app/webroot/img/productos/original/'.$ficha_upload['name'];
                    $ruta = FRONT_WWW_ROOT.'/files/productos/fichas/'.$ficha['producto_id'].'_'.$ficha['nombre'];
                    $tmp = $ficha_upload['tmp_name'];
                    move_uploaded_file($tmp, $ruta);

                    $this->Fichas->save($ficha);
                }


                $this->Flash->success(__('La ficha ha sido agregada.'));
                return $this->redirect(['action' => 'index', $this->request->data['producto_id']]);
            }

            /*
            $ficha = $this->Fichas->patchEntity($ficha, $this->request->data);
            
             if($this->request->data['nombre']['tmp_name'] != ''){
                
                    $ruta = '/var/www/html/app/webroot/img/productos/original/'.$this->request->data['nombre']['name'];
                    //$ruta = WWW_ROOT.'img/'.$this->request->data['nombre']['name'];
                    //debug($ruta);
                    //die;
                    $tmp = $this->request->data['nombre']['tmp_name'];
                    move_uploaded_file($tmp, $ruta);
                    $ficha->nombre = $this->request->data['nombre']['name'];
                }


            if ($this->Fichas->save($ficha)) {
                $this->Flash->success(__('La ficha ha sido agregada.'));
                return $this->redirect(['action' => 'index',$ficha->producto_id]);
            } else {
                $this->Flash->error(__('The ficha could not be saved. Please, try again.'));
            }

            */
        }
       
        $this->set(compact('ficha'));
        $this->set('_serialize', ['ficha']);
          $this->set('producto_id',$producto_id);
        $this->render(null,'iframe');
    }

    /**
     * Edit method
     *
     * @param string|null $id ficha id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ficha = $this->Fichas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ficha = $this->Fichas->patchEntity($ficha, $this->request->data);
            if ($this->Fichas->save($ficha)) {
                $this->Flash->success(__('The ficha has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ficha could not be saved. Please, try again.'));
            }
        }
        $productos = $this->Fichas->Productos->find('list', ['limit' => 200]);
        $this->set(compact('ficha', 'productos'));
        $this->set('_serialize', ['ficha']);
    }

    /**
     * Delete method
     *
     * @param string|null $id ficha id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ficha = $this->Fichas->get($id);
        if ($this->Fichas->delete($ficha)) {
            $this->Flash->success(__('The ficha has been deleted.'));
        } else {
            $this->Flash->error(__('The ficha could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index',$ficha->producto_id]);
    }
}
