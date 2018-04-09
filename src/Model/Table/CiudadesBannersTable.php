<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CiudadesBanners Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ciudades
 * @property \Cake\ORM\Association\BelongsTo $Banneres
 *
 * @method \App\Model\Entity\CiudadesBanner get($primaryKey, $options = [])
 * @method \App\Model\Entity\CiudadesBanner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CiudadesBanner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CiudadesBanner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CiudadesBanner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadesBanner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CiudadesBanner findOrCreate($search, callable $callback = null)
 */
class CiudadesBannersTable extends Table
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

        $this->table('ciudades_banners');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Ciudades', [
            'foreignKey' => 'ciudad_id',
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
          ->integer('num_comuna')
          ->requirePresence('num_comuna', 'create')
          ->notEmpty('num_comuna');
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
        #$rules->add($rules->existsIn(['banner_id'], 'Banneres'));

        return $rules;
    }


}
