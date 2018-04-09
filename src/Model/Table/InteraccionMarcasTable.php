<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InteraccionMarcas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Interactions
 * @property \Cake\ORM\Association\BelongsTo $Marcas
 *
 * @method \App\Model\Entity\InteraccionMarca get($primaryKey, $options = [])
 * @method \App\Model\Entity\InteraccionMarca newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InteraccionMarca[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InteraccionMarca|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InteraccionMarca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InteraccionMarca[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InteraccionMarca findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InteraccionMarcasTable extends Table
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

        $this->table('interaccion_marcas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Interactions', [
            'foreignKey' => 'interaction_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Marcas', [
            'foreignKey' => 'marca_id',
            'joinType' => 'LEFT'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

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
        $rules->add($rules->existsIn(['interaction_id'], 'Interactions'));
        $rules->add($rules->existsIn(['marca_id'], 'Marcas'));

        return $rules;
    }
}
