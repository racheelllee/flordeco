<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadFestivosSemanas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ciudades
 * @property \Cake\ORM\Association\BelongsTo $Estados
 *
 * @method \App\Model\Entity\CiudadFestivosSemana get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadFestivosSemana newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadFestivosSemana[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadFestivosSemana|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadFestivosSemana patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadFestivosSemana[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadFestivosSemana findOrCreate($search, callable $callback = null)
 */
class CiudadFestivosSemanasTable extends Table
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

        $this->table('ciudad_festivos_semanas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Ciudades', [
            'foreignKey' => 'ciudad_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
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
          ->boolean('lun')
          ->requirePresence('lun', 'create')
          ->notEmpty('lun');
        */

        /*$validator
          ->boolean('mar')
          ->requirePresence('mar', 'create')
          ->notEmpty('mar');
        */

        /*$validator
          ->boolean('mie')
          ->requirePresence('mie', 'create')
          ->notEmpty('mie');
        */

        /*$validator
          ->boolean('jue')
          ->requirePresence('jue', 'create')
          ->notEmpty('jue');
        */

        /*$validator
          ->boolean('vie')
          ->requirePresence('vie', 'create')
          ->notEmpty('vie');
        */

        /*$validator
          ->boolean('sab')
          ->requirePresence('sab', 'create')
          ->notEmpty('sab');
        */

        /*$validator
          ->boolean('dom')
          ->requirePresence('dom', 'create')
          ->notEmpty('dom');
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
        #$rules->add($rules->existsIn(['estado_id'], 'Estados'));

        return $rules;
    }


}
