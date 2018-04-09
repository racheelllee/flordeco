<?php
namespace App\Model\Table;

use App\Model\Entity\Categoria;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categorias Model
 */
class CategoriasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('categorias');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->addBehavior('Tree',['parent' => 'categoria_id'  ]);

        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Categorias', [
            'foreignKey' => 'categoria_id'
        ]);
        $this->hasMany('Cupones', [
            'foreignKey' => 'categoria_id'
        ]);
        $this->hasMany('Filtros', [
            'foreignKey' => 'categoria_id'
        ]);
        $this->belongsToMany('Productos', [
            'foreignKey' => 'categoria_id',
            'targetForeignKey' => 'producto_id',
            'joinTable' => 'categorias_productos'
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
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');
            
        //$validator
        //    ->requirePresence('descripcion', 'create')
        //    ->notEmpty('descripcion');
            
        /*$validator
            ->requirePresence('meta_descripcion', 'create')
            ->notEmpty('meta_descripcion');
            
        $validator
            ->requirePresence('meta_keywords', 'create')
            ->notEmpty('meta_keywords');
            
        $validator
            ->requirePresence('meta_titulo', 'create')
            ->notEmpty('meta_titulo');*/
            
        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');
            
        $validator
            ->add('orden', 'valid', ['rule' => 'numeric'])
            ->requirePresence('orden', 'create')
            ->notEmpty('orden');
            
        //$validator
        //    ->requirePresence('banner', 'create')
        //    ->notEmpty('banner');
        //    
        //$validator
        //    ->requirePresence('imagen_fondo', 'create')
        //    ->notEmpty('imagen_fondo');

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
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'));
        return $rules;
    }



     public function getCategorias(){

       $categorias=$this->find('treeList', ['order' => ['nombre' => 'asc']])->toArray();
       $categorias=[''=>' -- Seleccione -- ']+$categorias;
       return $categorias;
       

    }
}
