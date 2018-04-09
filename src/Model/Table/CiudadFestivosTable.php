<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadFestivos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ciudades
 *
 * @method \App\Model\Entity\CiudadFestivo get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadFestivo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadFestivo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadFestivo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadFestivo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadFestivo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadFestivo findOrCreate($search, callable $callback = null)
 */
class CiudadFestivosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('ciudad_festivos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Ciudades', [
            'foreignKey' => 'ciudad_id',
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
        /*$validator
          ->integer('id')
          ->allowEmpty('id', 'create');
        */

        /*$validator
          ->date('fecha')
          ->requirePresence('fecha', 'create')
          ->notEmpty('fecha');
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
        #$rules->add($rules->existsIn(['ciudad_id'], 'Ciudades'));

        return $rules;
    }


}
