<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadStatuses Model
 *
 * @property \Cake\ORM\Association\HasMany $Ciudades
 *
 * @method \App\Model\Entity\CiudadStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadStatus findOrCreate($search, callable $callback = null)
 */
class CiudadStatusesTable extends Table
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

        $this->table('ciudad_statuses');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->hasMany('Ciudades', [
            'foreignKey' => 'ciudad_status_id'
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

        /*$validator
          ->requirePresence('etiqueta', 'create')
          ->notEmpty('etiqueta');
        */

        /*$validator
          ->requirePresence('color', 'create')
          ->notEmpty('color');
        */

        return $validator;
    }


}
