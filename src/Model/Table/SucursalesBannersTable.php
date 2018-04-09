<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SucursalesBanners Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sucursals
 * @property \Cake\ORM\Association\BelongsTo $Productos
 * @property \Cake\ORM\Association\BelongsTo $Banneres
 *
 * @method \App\Model\Entity\SucursalesBanner get($primaryKey, $options = [])
 * @method \App\Model\Entity\SucursalesBanner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SucursalesBanner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SucursalesBanner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SucursalesBanner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SucursalesBanner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SucursalesBanner findOrCreate($search, callable $callback = null)
 */
class SucursalesBannersTable extends Table
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

        $this->table('sucursales_banners');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Sucursales', [
            'foreignKey' => 'sucursal_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Banners', [
            'foreignKey' => 'banner_id',
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

        /*$validator
          ->integer('posicion')
          ->requirePresence('posicion', 'create')
          ->notEmpty('posicion');
        */

        /*$validator
          ->integer('num_columna')
          ->requirePresence('num_columna', 'create')
          ->notEmpty('num_columna');
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
        #$rules->add($rules->existsIn(['sucursal_id'], 'Sucursals'));
        #$rules->add($rules->existsIn(['producto_id'], 'Productos'));
        #$rules->add($rules->existsIn(['banner_id'], 'Banneres'));

        return $rules;
    }


}
