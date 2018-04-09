<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadHorarioEntregas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ciudades
 * @property \Cake\ORM\Association\HasMany $CiudadHorarioEntregaPrecisos
 *
 * @method \App\Model\Entity\CiudadHorarioEntrega get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntrega newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntrega[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntrega|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntrega patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntrega[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadHorarioEntrega findOrCreate($search, callable $callback = null)
 */
class CiudadHorarioEntregasTable extends Table
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

        $this->table('ciudad_horario_entregas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Ciudades', [
            'foreignKey' => 'ciudad_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CiudadHorarioEntregaPrecisos', [
            'foreignKey' => 'ciudad_horario_entrega_id'
        ]);
        $this->belongsTo('CiudadHorarioEntregaTipos', [
            'foreignKey' => 'ciudad_horario_entrega_tipo_id',
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
          ->requirePresence('titulo', 'create')
          ->notEmpty('titulo');
        */

        /*$validator
          ->requirePresence('descripcion', 'create')
          ->notEmpty('descripcion');
        */

        /*$validator
          ->time('disponible_hasta')
          ->requirePresence('disponible_hasta', 'create')
          ->notEmpty('disponible_hasta');
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
        #$rules->add($rules->existsIn(['ciudad_id'], 'Ciudades'));

        return $rules;
    }


}
