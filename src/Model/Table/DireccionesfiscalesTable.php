<?php
namespace App\Model\Table;

use App\Model\Entity\Direccionesfiscale;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Direccionesfiscales Model
 */
class DireccionesfiscalesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('direccionesfiscales');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Municipios', [
            'foreignKey' => 'municipio_id'
        ]);
        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id'
        ]);
        $this->belongsTo('Paises', [
            'foreignKey' => 'pais_id'
        ]);
        $this->belongsTo('Sessiones', [
            'foreignKey' => 'session_id'
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
            ->allowEmpty('rfc');
            
        $validator
            ->allowEmpty('calle');
            
        $validator
            ->allowEmpty('numero_exterior');
            
        $validator
            ->allowEmpty('numero_interior');
            
        $validator
            ->allowEmpty('entre_calles');
            
        $validator
            ->allowEmpty('colonia');
            
        $validator
            ->allowEmpty('codigo_postal');
            
        $validator
            ->allowEmpty('ciudad');
            
        $validator
            ->allowEmpty('estado');

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
        $rules->add($rules->existsIn(['estado_id'], 'Estados'));
        $rules->add($rules->existsIn(['pais_id'], 'Paises'));
        $rules->add($rules->existsIn(['session_id'], 'Sessiones'));
        return $rules;
    }
}
