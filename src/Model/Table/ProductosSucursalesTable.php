<?php
namespace App\Model\Table;

use App\Model\Entity\ProductosSucursale;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductosSucursales Model
 */
class ProductosSucursalesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('productos_sucursales');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Sucursales', [
            'foreignKey' => 'sucursal_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
            'joinType' => 'LEFT'
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
        #$rules->add($rules->existsIn(['producto_id'], 'Productos'));
        #$rules->add($rules->existsIn(['sucursal_id'], 'Sucursales'));
        #$rules->add($rules->existsIn(['estado_id'], 'Estados'));
        return $rules;
    }
}
