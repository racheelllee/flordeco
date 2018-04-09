<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoPrecios Model
 *
 * @method \App\Model\Entity\TipoPrecio get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoPrecio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoPrecio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoPrecio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoPrecio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoPrecio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoPrecio findOrCreate($search, callable $callback = null)
 */
class TipoPreciosTable extends Table
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

        $this->table('tipo_precios');
        $this->displayField('nombre');
        $this->primaryKey('field');
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
          ->requirePresence('nombre', 'create')
          ->notEmpty('nombre');
        */

        /*$validator
          ->requirePresence('field', 'create')
          ->notEmpty('field');
        */

        return $validator;
    }


}
