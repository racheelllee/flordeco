<?php
namespace App\Model\Table;

use App\Model\Entity\Producto;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Productos Model
 */
class ProductosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('productos');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->addBehavior('Tree',['parent' => 'padre_id'  ]);
        
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
          //  'joinType' => 'INNER'
        ]);
        $this->belongsTo('Proveedores', [
            'foreignKey' => 'proveedor_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Marcas', [
            'foreignKey' => 'marca_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('ProductosEstatuses', [
            'foreignKey' => 'estatus_id'
        ]);

/*        $this->hasOne('ProductosSucursales', [
            'foreignKey' => 'producto_id',
            'joinType' => 'LEFT'
        ]);*/

        $this->belongsTo('Sucursales', [
            'foreignKey' => 'sucursal_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasMany('Atributos', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Cupones', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Imagenes', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Preciocomeptencias', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Precios', [
            'foreignKey' => 'producto_id'
        ]);
        // $this->belongsToMany('Categorias', [
        //     'through' => 'CategoriasProductos',
        //     'joinType' => 'INNER'
        // ]);

        
        $this->belongsToMany('Categorias', [
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'categoria_id',
            'joinTable' => 'categorias_productos',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsToMany('Promociones', [
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'promocion_id',
            'joinTable' => 'productos_promociones'
        ]);

        

        //$this->belongsToMany('Proveedores', [
        //    'foreignKey' => 'producto_id',
        //    'targetForeignKey' => 'proveedor_id',
        //    'joinTable' => 'productos_proveedores'
        //]);

        $this->belongsToMany('Complementos', [
            'className' => 'Productos',
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'complemento_id',
            'joinTable' => 'complementos_productos'
        ]);

        $this->hasMany('CategoriasProductos', [
            'foreignKey' => 'producto_id'
        ]);

        $this->hasOne('ComplementosCategorias', [
            'foreignKey' => 'producto_id'
        ]);

        $this->belongsToMany('Complementos', [
            'className' => 'Productos',
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'complemento_id',
            'joinTable' => 'complementos_productos',
              'conditions'=> 'Complementos.estatus_id= 1'
        ]);

        $this->hasMany('OpcionefiltrosProductos', [
            'foreignKey' => 'producto_id'
        ]);

        $this->hasMany('Fichas', [
            'foreignKey' => 'producto_id',
            'sort' => ['orden'=>'ASC']
        ]);

        $this->hasMany('Comentarios', [
            'foreignKey' => 'producto_id',
             'conditions'=> 'Comentarios.autorizado= 1'
        ]);


        $this->hasMany('CiudadesProductos', [
            'foreignKey' => 'producto_id'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        /*
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('sku', 'create')
            ->notEmpty('sku');
            
        $validator
            ->requirePresence('codigo_fabricante', 'create')
            ->notEmpty('codigo_fabricante');
            
        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');
            
        //$validator
         //   ->requirePresence('arugemnto_de_venta', 'create')
         //   ->notEmpty('arugemnto_de_venta');
            
        //$validator
        //    ->requirePresence('descripcion', 'create')
        //    ->notEmpty('descripcion');
            
        $validator
            ->requirePresence('ficha_tecnica', 'create')
            ->notEmpty('ficha_tecnica');
            
        //$validator
        //    ->requirePresence('modelo', 'create')
        //    ->notEmpty('modelo');
            
        $validator
            ->add('activo', 'valid', ['rule' => 'numeric'])
            ->requirePresence('activo', 'create')
            ->notEmpty('activo');
            
        $validator
            ->add('fecha_publicacion', 'valid', ['rule' => 'datetime'])
            ->requirePresence('fecha_publicacion', 'create')
            ->notEmpty('fecha_publicacion');
            
        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');
            
        $validator
            ->requirePresence('meta_titulo', 'create')
            ->notEmpty('meta_titulo');
            
        $validator
            ->requirePresence('meta_descripcion', 'create')
            ->notEmpty('meta_descripcion');
            
        $validator
            ->requirePresence('meta_keywords', 'create')
            ->notEmpty('meta_keywords');
            
        $validator
            ->add('largo', 'valid', ['rule' => 'numeric'])
            ->requirePresence('largo', 'create')
            ->notEmpty('largo');
            
        $validator
            ->add('ancho', 'valid', ['rule' => 'numeric'])
            ->requirePresence('ancho', 'create')
            ->notEmpty('ancho');
            
        $validator
            ->add('alto', 'valid', ['rule' => 'numeric'])
            ->requirePresence('alto', 'create')
            ->notEmpty('alto');
            
        $validator
            ->add('peso', 'valid', ['rule' => 'decimal'])
            ->requirePresence('peso', 'create')
            ->notEmpty('peso');
            
        $validator
            ->add('peso_volumetrico', 'valid', ['rule' => 'decimal'])
            ->requirePresence('peso_volumetrico', 'create')
            ->notEmpty('peso_volumetrico');
            
        $validator
            ->add('costo', 'valid', ['rule' => 'decimal'])
            ->requirePresence('costo', 'create')
            ->notEmpty('costo');
            
        $validator
            ->add('margen', 'valid', ['rule' => 'decimal'])
            ->requirePresence('margen', 'create')
            ->notEmpty('margen');
            
        $validator
            ->add('precio', 'valid', ['rule' => 'decimal'])
            ->requirePresence('precio', 'create')
            ->notEmpty('precio');
            
        $validator
            ->add('envio_gratis', 'valid', ['rule' => 'boolean'])
            ->requirePresence('envio_gratis', 'create')
            ->notEmpty('envio_gratis');
            
        $validator
            ->requirePresence('grantia', 'create')
            ->notEmpty('grantia');
            
        //$validator
        //    ->requirePresence('tiempo_de_entrega', 'create')
        //    ->notEmpty('tiempo_de_entrega');

*/
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }

    public function findCategorias(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->matching('Categorias', function(\Cake\ORM\Query $q) use ($options) {
                return $q->where([
                    'Categorias.id' => $options['categoria_id']
                ]);
            })
            ->group(['Productos.id']);
        return $query;
    }
}
