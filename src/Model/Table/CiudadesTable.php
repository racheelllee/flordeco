<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ciudades Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Estados
 * @property \Cake\ORM\Association\BelongsTo $CiudadStatuses
 * @property \Cake\ORM\Association\BelongsTo $RangoPrecios
 *
 * @method \App\Model\Entity\Ciudad get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ciudad newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ciudad[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ciudad|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ciudad patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ciudad[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ciudad findOrCreate($search, callable $callback = null)
 */
class CiudadesTable extends Table
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

        $this->table('ciudades');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CiudadStatuses', [
            'foreignKey' => 'ciudad_status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RangoPrecios', [
            'foreignKey' => 'rango_precio_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CiudadesBanners', [
            'foreignKey' => 'ciudad_id'
        ]);

        $this->hasMany('CiudadFestivos', [
            'foreignKey' => 'ciudad_id',
            'sort' => ['CiudadFestivos.fecha'=>'ASC']
        ]);

        $this->hasMany('CiudadProductoFestivos', [
            'foreignKey' => 'ciudad_id'
        ]);

        
        $this->hasMany('CiudadHorarioEntregas', [
            'foreignKey' => 'ciudad_id'
        ]);

        $this->hasMany('CiudadesProductos', [
            'foreignKey' => 'ciudad_id'
        ]);

        $this->hasMany('CiudadFestivosSemanas', [
            'foreignKey' => 'ciudad_id'
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
          ->requirePresence('name', 'create')
          ->notEmpty('name');
        */

        /*$validator
          ->requirePresence('url', 'create')
          ->notEmpty('url');
        */

        /*$validator
          ->integer('costo_envio')
          ->requirePresence('costo_envio', 'create')
          ->notEmpty('costo_envio');
        */

        /*$validator
          ->requirePresence('descripcion', 'create')
          ->notEmpty('descripcion');
        */

        /*$validator
          ->integer('deleted')
          ->requirePresence('deleted', 'create')
          ->notEmpty('deleted');
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
        #$rules->add($rules->existsIn(['estado_id'], 'Estados'));
        #$rules->add($rules->existsIn(['ciudad_status_id'], 'CiudadStatuses'));
        #$rules->add($rules->existsIn(['rango_precio_id'], 'RangoPrecios'));

        return $rules;
    }

    public function beforeDelete($event, $entity, $options){
      $event->stopPropagation();
      $entity->deleted = 1;
      return $this->save($entity);
    }

    public function ciudadPorUrl($ciudadUrl = '')
    {
        return $this->find('all')->where(['Ciudades.url' => $ciudadUrl])->first();
    }
    
}
