<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DireccionTipos Model
 *
 * @property \Cake\ORM\Association\HasMany $Direcciones
 *
 * @method \App\Model\Entity\DireccionTipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\DireccionTipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DireccionTipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DireccionTipo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DireccionTipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DireccionTipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DireccionTipo findOrCreate($search, callable $callback = null)
 */
class DireccionTiposTable extends Table
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

        $this->table('direccion_tipos');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->hasMany('Direcciones', [
            'foreignKey' => 'direccion_tipo_id'
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
