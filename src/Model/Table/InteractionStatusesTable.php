<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InteractionStatuses Model
 *
 * @property \Cake\ORM\Association\HasMany $Interactions
 *
 * @method \App\Model\Entity\InteractionStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\InteractionStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InteractionStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InteractionStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InteractionStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InteractionStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InteractionStatus findOrCreate($search, callable $callback = null)
 */
class InteractionStatusesTable extends Table
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

        $this->table('interaction_statuses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Interactions', [
            'foreignKey' => 'interaction_status_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function getInteractionStatuses(){

        $result = $this->find()
                ->select(['id', 'name'])
                ->hydrate(false)
                ->toArray();

        $rows = [];
        $rows[NULL] = __('All');

        foreach($result as $row) {
                $rows[$row['id']] = $row['name'];
                   
        }
        return $rows;
    }


}
