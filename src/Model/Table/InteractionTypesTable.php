<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InteractionTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Interactions
 *
 * @method \App\Model\Entity\InteractionType get($primaryKey, $options = [])
 * @method \App\Model\Entity\InteractionType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InteractionType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InteractionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InteractionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InteractionType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InteractionType findOrCreate($search, callable $callback = null)
 */
class InteractionTypesTable extends Table
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

        $this->table('interaction_types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Interactions', [
            'foreignKey' => 'interaction_type_id'
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

    public function getInteractionTypes(){

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
