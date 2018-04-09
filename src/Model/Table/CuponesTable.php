<?php
namespace App\Model\Table;

use App\Model\Entity\Cupon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cupones Model
 */
class CuponesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('cupones');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'cliente_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Marcas', [
            'foreignKey' => 'marca_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            //'joinType' => 'INNER'
        ]);

        $this->hasMany('Pedidos', [
            'foreignKey' => 'cupon_id'
        ]);

        $this->hasMany('CuponesCategorias', [
            'foreignKey' => 'cupon_id'
        ]);

        $this->hasMany('CuponesMarcas', [
            'foreignKey' => 'cupon_id'
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
            
        $validator
            ->requirePresence('codigo', 'create')
            ->notEmpty('codigo');
            
        // $validator
        //     ->add('monto', 'valid', ['rule' => 'decimal'])
        //     ->requirePresence('monto', 'create')
        //     ->notEmpty('monto');
            
        // $validator
        //     ->add('porcentaje', 'valid', ['rule' => 'numeric'])
        //     ->requirePresence('porcentaje', 'create')
        //     ->notEmpty('porcentaje');
            
        $validator
            ->add('fecha_inicio', 'valid', ['rule' => 'date'])
            ->requirePresence('fecha_inicio', 'create')
            ->notEmpty('fecha_inicio');
            
        $validator
            ->add('fecha_fin', 'valid', ['rule' => 'date'])
            ->requirePresence('fecha_fin', 'create')
            ->notEmpty('fecha_fin');
            
        $validator
            ->add('cantidad', 'valid', ['rule' => 'numeric'])
            ->requirePresence('cantidad', 'create')
            ->notEmpty('cantidad');

        $validator
            ->add('compra_minima', 'valid', ['rule' => 'decimal'])
            ->requirePresence('compra_minima', 'create')
            ->notEmpty('compra_minima');

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
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'));
        $rules->add($rules->existsIn(['marca_id'], 'Marcas'));
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));
        return $rules;
    }
}
