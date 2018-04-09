<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadesProductos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ciudades
 * @property \Cake\ORM\Association\BelongsTo $Productos
 *
 * @method \App\Model\Entity\CiudadesProducto get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadesProducto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadesProducto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadesProducto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadesProducto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadesProducto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadesProducto findOrCreate($search, callable $callback = null)
 */
class CiudadesProductosTable extends Table
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

        $this->table('ciudades_productos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Ciudades', [
            'foreignKey' => 'ciudad_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
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
        /*$validator
          ->integer('id')
          ->allowEmpty('id', 'create');
        */

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
        #$rules->add($rules->existsIn(['ciudad_id'], 'Ciudades'));
        #$rules->add($rules->existsIn(['producto_id'], 'Productos'));

        return $rules;
    }


}
