<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TiposObra Model
 *
 * @method \App\Model\Entity\TiposObra get($primaryKey, $options = [])
 * @method \App\Model\Entity\TiposObra newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TiposObra[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TiposObra|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TiposObra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TiposObra[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TiposObra findOrCreate($search, callable $callback = null)
 */
class TiposObraTable extends Table
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

        $this->table('tipos_obra');
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
}
