<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TelefonoTipos Model
 *
 * @property \Cake\ORM\Association\HasMany $Clientes
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\TelefonoTipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\TelefonoTipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TelefonoTipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TelefonoTipo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TelefonoTipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TelefonoTipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TelefonoTipo findOrCreate($search, callable $callback = null)
 */
class TelefonoTiposTable extends Table
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

        $this->table('telefono_tipos');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->hasMany('Clientes', [
            'foreignKey' => 'telefono_tipo_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'telefono_tipo_id'
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
