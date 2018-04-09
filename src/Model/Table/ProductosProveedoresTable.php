<?php
namespace App\Model\Table;

use App\Model\Entity\ProductosProveedor;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductosProveedores Model
 */
class ProductosProveedoresTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('productos_proveedores');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Proveedores', [
            'foreignKey' => 'proveedor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->add('activo', 'valid', ['rule' => 'numeric'])
            ->requirePresence('activo', 'create')
            ->notEmpty('activo');
            
        $validator
            ->add('existencia', 'valid', ['rule' => 'numeric'])
            ->requirePresence('existencia', 'create')
            ->notEmpty('existencia');

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
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));
        $rules->add($rules->existsIn(['proveedor_id'], 'Proveedores'));
        $rules->add($rules->existsIn(['user_id'], 'Useres'));
        return $rules;
    }
}
