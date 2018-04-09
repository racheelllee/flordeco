<?php
namespace App\Controller;

use App\Controller\AppController;
use Usermgmt\Controller\UsermgmtAppController;
use Cake\Event\Event;

/**
 * Cupones Controller
 *
 * @property \App\Model\Table\CuponesTable $Cupones
 */

class CuponesController extends AppController
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
    public $components = ['Usermgmt.Search'];

    /**
     * Paginate
     *
     * @var array
     */
    public $paginate = ['limit' => '25'];

	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	public $searchFields = [
		'index'=>[
			'Cupones'=>[
				'Cupones'=>[
					'type'=>'text',
					'label'=>'Buscar',
					'tagline'=>'Busca por nombre',
					'condition'=>'multiple',
					'searchFields'=>['Cupones.nombre'],
					'inputOptions'=>['style'=>'width:300px;']
				]
			]
		]
	];
	

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $this->paginate = ['limit'=>10, 'order'=>['Cupones.id'=>'DESC'], 'contain' => ['Clientes']];
        $this->Search->applySearch();
        $cupones = $this->paginate($this->Cupones)->toArray();
        $this->set(compact('cupones'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_cupones');
        }

    }

    /**
     * View method
     *
     * @param string|null $id Cupon id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cupon = $this->Cupones->get($id, [
            'contain' => ['Clientes', 'Categorias', 'Marcas', 'Productos']
        ]);
        $this->set('cupon', $cupon);
        $this->set('_serialize', ['cupon']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cupon = $this->Cupones->newEntity();
        if ($this->request->is('post')) {
            $cupon = $this->Cupones->patchEntity($cupon, $this->request->data);

            $cupon['fecha_inicio'] = date('Y-m-d', strtotime($this->request->data['fecha_inicio']));
            $cupon['fecha_fin'] = date('Y-m-d', strtotime($this->request->data['fecha_fin']));

            if ($this->Cupones->save($cupon)) {
                $this->Flash->success(__('El cupon ha sido guardado.'));
                return $this->redirect('/cupones/edit/'.$cupon['id']);
            } else {
                $this->Flash->error(__('El cupon no se pudo guardar.'));
            }
        }
        
        $this->loadModel('Users');
        $clientes = $this->Users->find()
            ->where(['user_group_id' => 4])
            ->combine('id', 'first_name'); 

        $categorias = $this->Cupones->Categorias->find('list', ['limit' => 200]);
        $marcas = $this->Cupones->Marcas->find('list', ['limit' => 200]);
        $productos = $this->Cupones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('cupon', 'clientes', 'categorias', 'marcas', 'productos'));
        $this->set('_serialize', ['cupon']);
    }


    public function multiple_categoria()
    {
        if ($this->request->is('post')) {
            
            $this->loadModel('CuponesCategorias');

            if($this->request->data['accion'] == 'categorias_no_permitidas'){ //Agrega categoria

                $categoria = $this->CuponesCategorias->newEntity();
                $categoria = $this->CuponesCategorias->patchEntity($categoria, $this->request->data);

                if ($this->CuponesCategorias->save($categoria)) {
                    die(json_encode($categoria));
                }

            }else{ // Elimina Categoria

                $categoria = $this->CuponesCategorias->find('all', ['conditions'=>['cupon_id'=>$this->request->data['cupon_id'], 'categoria_id'=>$this->request->data['categoria_id']]])->first();

                if ($this->CuponesCategorias->delete($categoria)) {
                    die(json_encode($categoria));
                }
            }
        }
    }



    public function multiple_marca()
    {
        if ($this->request->is('post')) {
            
            $this->loadModel('CuponesMarcas');

            if($this->request->data['accion'] == 'marcas_no_permitidas'){ //Agrega marca

                $marca = $this->CuponesMarcas->newEntity();
                $marca = $this->CuponesMarcas->patchEntity($marca, $this->request->data);

                if ($this->CuponesMarcas->save($marca)) {
                    die(json_encode($marca));
                }

            }else{ // Elimina marca

                $marca = $this->CuponesMarcas->find('all', ['conditions'=>['cupon_id'=>$this->request->data['cupon_id'], 'marca_id'=>$this->request->data['marca_id']]])->first();

                if ($this->CuponesMarcas->delete($marca)) {
                    die(json_encode($marca));
                }
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Cupon id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cupon = $this->Cupones->get($id, [
            'contain' => ['Pedidos', 'Pedidos.Estatuses']
        ]);

        $cupon['fecha_inicio'] = $cupon->fecha_inicio->i18nFormat('dd-MM-YYYY');
        $cupon['fecha_fin'] = $cupon->fecha_fin->i18nFormat('dd-MM-YYYY');

        if ($this->request->is(['patch', 'post', 'put'])) {

            $cupon = $this->Cupones->patchEntity($cupon, $this->request->data);

            $cupon['fecha_inicio'] = date('Y-m-d', strtotime($this->request->data['fecha_inicio']));
            $cupon['fecha_fin'] = date('Y-m-d', strtotime($this->request->data['fecha_fin']));

            if ($this->Cupones->save($cupon)) {
                $this->Flash->success(__('Lo cambios de cupon se guardaron.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del cupon.'));
            }
        }
        
        $this->loadModel('Users');
        $clientes = $this->Users->find()
            ->where(['user_group_id' => 4])
            ->combine('id', 'first_name'); 

        $categorias = $this->Cupones->Categorias->find('list', ['limit' => 200]);

        $this->loadModel('CuponesCategorias');
        $categorias_permitidas = $this->CuponesCategorias->find()
            ->where(['cupon_id' => $cupon['id']])
            ->contain(['Categorias'])
            ->combine('categoria_id', 'categoria.nombre');
        //die(debug($categorias_permitidas->toArray()));

        $categorias_no_permitidas = $this->Cupones->Categorias->find('list', ['order' => ['nombre'=>'ASC']])->toArray();

        foreach ($categorias_permitidas as $key => $permitida) {
            unset($categorias_no_permitidas[$key]);
        }


        $marcas = $this->Cupones->Marcas->find('list', ['order' => ['nombre'=>'ASC']]);

        $this->loadModel('CuponesMarcas');
        $marcas_permitidas = $this->CuponesMarcas->find()
            ->where(['cupon_id' => $cupon['id']])
            ->contain(['Marcas'])
            ->combine('marca_id', 'marca.nombre');

        $marcas_no_permitidas = $this->Cupones->Marcas->find('list', ['order' => ['nombre'=>'ASC']])->toArray();

        foreach ($marcas_permitidas as $key => $marca) {
            unset($marcas_no_permitidas[$key]);
        }


        $productos = $this->Cupones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('cupon', 'clientes', 'categorias', 'marcas', 'productos', 'categorias_permitidas', 'categorias_no_permitidas', 'marcas_permitidas', 'marcas_no_permitidas'));
        $this->set('_serialize', ['cupon']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cupon id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cupon = $this->Cupones->get($id);
        if ($this->Cupones->delete($cupon)) {
            $this->Flash->success(__('The cupon has been deleted.'));
        } else {
            $this->Flash->error(__('The cupon could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
