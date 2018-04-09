<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CotizacionMarcas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cotizacions
 * @property \Cake\ORM\Association\BelongsTo $Marcas
 *
 * @method \App\Model\Entity\CotizacionMarca get($primaryKey, $options = [])
 * @method \App\Model\Entity\CotizacionMarca newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CotizacionMarca[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CotizacionMarca|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CotizacionMarca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CotizacionMarca[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CotizacionMarca findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CotizacionMarcasTable extends Table
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

        $this->table('cotizacion_marcas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cotizaciones', [
            'foreignKey' => 'cotizacion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Marcas', [
            'foreignKey' => 'marca_id',
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
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

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
        $rules->add($rules->existsIn(['cotizacion_id'], 'Cotizaciones'));
        $rules->add($rules->existsIn(['marca_id'], 'Marcas'));

        return $rules;
    }
}
