<?php
namespace App\Model\Table;

use App\Model\Entity\Formasdepago;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Formasdepagos Model
 */
class FormasdepagosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('formasdepagos');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->hasMany('Pedidos', [
            'foreignKey' => 'formasdepago_id'
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
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');
            
        $validator
            ->requirePresence('imagen', 'create')
            ->notEmpty('imagen');
            
        $validator
            ->add('activo', 'valid', ['rule' => 'boolean'])
            ->requirePresence('activo', 'create')
            ->notEmpty('activo');

        return $validator;
    }
}
