<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MensajeTarjetas Model
 *
 * @method \App\Model\Entity\MensajeTarjeta get($primaryKey, $options = [])
 * @method \App\Model\Entity\MensajeTarjeta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MensajeTarjeta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MensajeTarjeta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MensajeTarjeta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MensajeTarjeta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MensajeTarjeta findOrCreate($search, callable $callback = null)
 */
class MensajeTarjetasTable extends Table
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

        $this->table('mensaje_tarjetas');
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
        /*$validator
          ->integer('id')
          ->allowEmpty('id', 'create');
        */

        /*$validator
          ->requirePresence('nombre', 'create')
          ->notEmpty('nombre');
        */

        return $validator;
    }


}
