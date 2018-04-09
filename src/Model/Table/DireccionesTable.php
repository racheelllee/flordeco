<?php
namespace App\Model\Table;

use App\Model\Entity\Direccion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Direcciones Model
 */
class DireccionesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('direcciones');
        $this->displayField('calle');
        $this->primaryKey('id');
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->belongsTo('Municipios', [
            'foreignKey' => 'municipio_id'
        ]);
        $this->belongsTo('DireccionTipos', [
            'foreignKey' => 'direccion_tipo_id'
        ]);
        /*$this->belongsTo('Estados', [
            'foreignKey' => 'estado_id'
        ]);
        $this->belongsTo('Paises', [
            'foreignKey' => 'pais_id'
        ]);*/
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
            
        /*$validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');
            
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
            ->notEmpty('codigo_postal');*/

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
}
