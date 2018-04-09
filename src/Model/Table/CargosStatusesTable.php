<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CargosStatuses Model
 *
 * @method \App\Model\Entity\CargosStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\CargosStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CargosStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CargosStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CargosStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CargosStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CargosStatus findOrCreate($search, callable $callback = null)
 */
class CargosStatusesTable extends Table
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

        $this->table('cargos_statuses');
        $this->displayField('name');
        $this->primaryKey('id');
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
    /**
     * 
     * @accesslevel 1
     */
    public function getStatus($flag = true) {
        $result = $this->find()
                ->select(['id', 'name' ])
                ->hydrate(false)
                ->toArray();
        $rows = [];
        
        if($flag){
            $rows[''] = __('All');
        }
        foreach($result as $row) {
                $rows[$row['id']] = $row['name']; 
        }

        return $rows;
    }
}
