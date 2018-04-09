<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyDepartments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CompanyDepartment get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyDepartment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyDepartment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyDepartment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyDepartment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyDepartment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyDepartment findOrCreate($search, callable $callback = null)
 */
class CompanyDepartmentsTable extends Table
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

        $this->table('company_departments');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
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
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

/*        $validator
            ->boolean('deleted')
            ->requirePresence('deleted', 'create')
            ->notEmpty('deleted');*/

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }

    public function getDepartments($sel=true){
        $result = $this->find()
                ->select(['id', 'name' ])
                ->order(['orden ASC'])
                ->hydrate(false)
                ->toArray();
        
        $rows = [];
        if($sel) {
            $rows[''] = __('All');
        }
        foreach($result as $row) {
                $rows[$row['id']] = $row['name'];
                   
        }
        return $rows;
    }
}
