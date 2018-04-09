<?php
namespace App\Model\Table;

use App\Model\Entity\Cliente;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientes Model
 */
class ClientesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');

        $this->displayField('nombre');
        $this->primaryKey('id');
         $this->belongsTo('Municipios', [
             'foreignKey' => 'municipio_id',
             'joinType' => 'LEFT'
         ]);
         $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
            'joinType' => 'LEFT'
         ]);
        $this->belongsTo('Paises', [
            'foreignKey' => 'pais_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Usrmgmt.UsersGroups', [
            'foreignKey' => 'user_group_id',
            'joinType' => 'LEFT'
        ]);
        
        $this->belongsTo('Clienteestatuses', [
            'foreignKey' => 'clienteestatus_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('Cupones', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->hasMany('Direcciones', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->hasMany('Pedidos', [
            'foreignKey' => 'cliente_id'
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
            ->requirePresence('correo_electronico', 'create')
            ->notEmpty('correo_electronico');
            
        $validator
            ->requirePresence('telefono_local', 'create')
            ->notEmpty('telefono_local');
            
        $validator
            ->requirePresence('telefono_celular', 'create')
            ->notEmpty('telefono_celular');
            
        $validator
            ->requirePresence('contrasena', 'create')
            ->notEmpty('contrasena');
            
        $validator
            ->requirePresence('razon_social', 'create')
            ->notEmpty('razon_social');
            
        $validator
            ->requirePresence('rfc', 'create')
            ->notEmpty('rfc');
            
        $validator
            ->requirePresence('calle', 'create')
            ->notEmpty('calle');
            
        $validator
            ->requirePresence('numero_exterior', 'create')
            ->notEmpty('numero_exterior');
            
        $validator
            ->requirePresence('numero_interior', 'create')
            ->notEmpty('numero_interior');
            
        $validator
            ->requirePresence('entre_calles', 'create')
            ->notEmpty('entre_calles');
            
        $validator
            ->requirePresence('colonia', 'create')
            ->notEmpty('colonia');
            
        $validator
            ->requirePresence('codigo_postal', 'create')
            ->notEmpty('codigo_postal');

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
        $rules->add($rules->existsIn(['municipio_id'], 'Municipios'));
        //$rules->add($rules->existsIn(['estado_id'], 'Estados'));
        $rules->add($rules->existsIn(['pais_id'], 'Paises'));
        $rules->add($rules->existsIn(['clienteestatus_id'], 'Clienteestatuses'));
        return $rules;
    }
}
