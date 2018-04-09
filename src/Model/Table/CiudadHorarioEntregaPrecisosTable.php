<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadHorarioEntregaPrecisos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CiudadHorarioEntregas
 *
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntregaPreciso findOrCreate($search, callable $callback = null)
 */
class CiudadHorarioEntregaPrecisosTable extends Table
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

        $this->table('ciudad_horario_entrega_precisos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CiudadHorarioEntregas', [
            'foreignKey' => 'ciudad_horario_entrega_id',
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
          ->time('desde')
          ->requirePresence('desde', 'create')
          ->notEmpty('desde');
        */

        /*$validator
          ->time('hasta')
          ->requirePresence('hasta', 'create')
          ->notEmpty('hasta');
        */

        /*$validator
          ->decimal('costo_pesos')
          ->requirePresence('costo_pesos', 'create')
          ->notEmpty('costo_pesos');
        */

        /*$validator
          ->decimal('costo_dolar')
          ->requirePresence('costo_dolar', 'create')
          ->notEmpty('costo_dolar');
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
        #$rules->add($rules->existsIn(['ciudad_horario_entrega_id'], 'CiudadHorarioEntregas'));

        return $rules;
    }


}
