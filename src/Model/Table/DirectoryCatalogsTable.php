<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DirectoryCatalogs Model
 *
 * @method \App\Model\Entity\DirectoryCatalog get($primaryKey, $options = [])
 * @method \App\Model\Entity\DirectoryCatalog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DirectoryCatalog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DirectoryCatalog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DirectoryCatalog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DirectoryCatalog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DirectoryCatalog findOrCreate($search, callable $callback = null)
 */
class DirectoryCatalogsTable extends Table
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

        $this->table('directory_catalogs');
        $this->displayField('nombre');
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->integer('tipo')
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        return $validator;
    }

    public function getDirectoryCatalogs(){
        $result = $this->find()
                ->select(['id', 'id' ])
                ->hydrate(false)
                ->toArray();
        return $result;
        $rows = [];
        foreach($result as $row) {
                $rows[$row['id']] = 'id'; 
        }
        return $rows;
    }

}
