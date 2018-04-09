<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facturas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cotizacions
 * @property \Cake\ORM\Association\BelongsTo $Cargos
 * @property \Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Factura get($primaryKey, $options = [])
 * @method \App\Model\Entity\Factura newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Factura[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Factura|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factura patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Factura[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Factura findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FacturasTable extends Table
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

        $this->table('facturas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Upload',[
            'fields'=> [
                'archivo'=> [
                    
                    'path' => '/files/facturas-files/:md5'
                    
                ]

            ]
        ]);

        $this->belongsTo('Cotizaciones', [
            'foreignKey' => 'cotizacion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cargos', [
            'foreignKey' => 'cargo_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Monedas', [
            'foreignKey' => 'moneda_id',
            //'joinType' => 'INNER'
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

        /*$validator
            ->requirePresence('no_factura', 'create')
            ->notEmpty('no_factura');*/

        /*$validator
            ->decimal('importe')
            ->requirePresence('importe', 'create')
            ->notEmpty('importe');*/

        /*$validator
            ->requirePresence('archivo', 'create')
            ->notEmpty('archivo');

        $validator
            ->boolean('deleted')
            ->requirePresence('deleted', 'create')
            ->notEmpty('deleted');*/

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
        //$rules->add($rules->existsIn(['cotizacion_id'], 'Cotizaciones'));
        //$rules->add($rules->existsIn(['cargo_id'], 'Cargos'));
        //$rules->add($rules->existsIn(['customer_id'], 'Customers'));

        return $rules;
    }
}
