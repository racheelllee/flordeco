<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Interactions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Customers
 * @property \Cake\ORM\Association\BelongsTo $InteractionStatuses
 * @property \Cake\ORM\Association\BelongsTo $InteractionTypes
 *
 * @method \App\Model\Entity\Interaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Interaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Interaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Interaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Interaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Interaction findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InteractionsTable extends Table
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

        $this->table('interactions');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('InteractionStatuses', [
            'foreignKey' => 'interaction_status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('InteractionTypes', [
            'foreignKey' => 'interaction_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cotizaciones', [
            'foreignKey' => 'quote_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('CotizacionesEstatuses', [
            'foreignKey' => 'quote_status_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('InteraccionMarcas', [
            'foreignKey' => 'interaction_id',
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

        $validator
            ->requirePresence('comments', 'create')
            ->notEmpty('comments');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['interaction_status_id'], 'InteractionStatuses'));
        $rules->add($rules->existsIn(['interaction_type_id'], 'InteractionTypes'));

        return $rules;
    }
}
