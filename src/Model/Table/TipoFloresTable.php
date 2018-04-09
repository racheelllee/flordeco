<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoFlores Model
 *
 * @property \Cake\ORM\Association\HasMany $Productos
 *
 * @method \App\Model\Entity\TipoFlor get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoFlor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoFlor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoFlor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoFlor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoFlor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoFlor findOrCreate($search, callable $callback = null)
 */
class TipoFloresTable extends Table
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

        $this->table('tipo_flores');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Productos', [
            'foreignKey' => 'tipo_flor_id'
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

        return $validator;
    }


}
