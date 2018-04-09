<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TotalFacturado Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cotizaciones
 *
 * @method \App\Model\Entity\TotalFacturado get($primaryKey, $options = [])
 * @method \App\Model\Entity\TotalFacturado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TotalFacturado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TotalFacturado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TotalFacturado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TotalFacturado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TotalFacturado findOrCreate($search, callable $callback = null)
 */
class TotalFacturadoTable extends Table
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

        $this->table('total_facturado');

        $this->belongsTo('Cotizaciones', [
            'foreignKey' => 'cotizacion_id',
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
            ->decimal('total_facturado')
            ->allowEmpty('total_facturado');

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

        return $rules;
    }
}
