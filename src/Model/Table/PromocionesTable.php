<?php
namespace App\Model\Table;

use App\Model\Entity\Promocion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Promociones Model
 */
class PromocionesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('promociones');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Productos', [
            'foreignKey' => 'promocion_id',
            'targetForeignKey' => 'producto_id',
            'joinTable' => 'productos_promociones'
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
            ->add('fecha_inicio', 'valid', ['rule' => 'datetime'])
            ->requirePresence('fecha_inicio', 'create')
            ->notEmpty('fecha_inicio');
            
        $validator
            ->add('fecha_fin', 'valid', ['rule' => 'datetime'])
            ->requirePresence('fecha_fin', 'create')
            ->notEmpty('fecha_fin');
            
        $validator
            ->add('monto', 'valid', ['rule' => 'decimal'])
            ->requirePresence('monto', 'create')
            ->notEmpty('monto');
            
        $validator
            ->add('descuento', 'valid', ['rule' => 'decimal'])
            ->requirePresence('descuento', 'create')
            ->notEmpty('descuento');
            
        $validator
            ->add('envio', 'valid', ['rule' => 'numeric'])
            ->requirePresence('envio', 'create')
            ->notEmpty('envio');

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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));
        return $rules;
    }
}
