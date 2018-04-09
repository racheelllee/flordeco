<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Cotizaciones Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Clientes
 * @property \Cake\ORM\Association\BelongsTo $ContactoClientes
 * @property \Cake\ORM\Association\BelongsTo $CategoriaClientes
 * @property \Cake\ORM\Association\BelongsTo $VendedorAsignados
 * @property \Cake\ORM\Association\BelongsTo $Sucursals
 * @property \Cake\ORM\Association\BelongsTo $Statuses
 *
 * @method \App\Model\Entity\Cotizacione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cotizacione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cotizacione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cotizacione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cotizacione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cotizacione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cotizacione findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CotizacionesTable extends Table
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

        $this->table('cotizaciones');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers.Customers', [
            'foreignKey' => 'cliente_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Contacts', [
            'foreignKey' => 'contacto_cliente_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('SegundoContacto', [
            'foreignKey' => 'segundo_contacto_id',
            'joinType' => 'LEFT',
            'className' => 'Contacts',
            'propertyName' => 'segundo_contacto'
        ]);

        $this->belongsTo('CustomerCategories', [
            'foreignKey' => 'categoria_cliente_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'sucursal_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'vendedor_asignado_id',
            //'joinType' => 'INNER',
            'className' => 'Cotizaciones.Users'
        ]);

        $this->belongsTo('CotizacionesEstatuses', [
            'foreignKey' => 'status_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Second', [
            'foreignKey' => 'second_seller',
            'joinType' => 'LEFT',
            'className' => 'Users',
            'propertyName' => 'second'
        ]);

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Cargos', [
            'foreignKey' => 'cargo_id',
            //'joinType' => 'INNER'
        ]);

        $this->hasMany('Facturas', [
            'foreignKey' => 'cotizacion_id',
            'conditions' => [
                'Facturas.deleted' => 0
            ]
        ]);

        $this->belongsTo('Monedas', [
            'foreignKey' => 'moneda_id',
            //'joinType' => 'INNER'
        ]);

        $this->hasMany('Interactions', [
            'foreignKey' => 'quote_id'
        ]);

        $this->hasMany('CotizacionMarcas', [
            'foreignKey' => 'cotizacion_id'
        ]);

        $this->hasMany('PurchaseOrders', [
            'foreignKey' => 'cotizacion_id'
        ]);

        $this->hasMany('BillingDates', [
            'foreignKey' => 'cotizacion_id'
        ]);

        $this->hasOne('TotalFacturado', [
            'foreignKey' => 'cotizacion_id',
            'joinType' => 'LEFT'
        ]);

        $this->addBehavior('Xety/Cake3Upload.Upload', [
                'fields' => [
                    'archivo' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'file_order' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'explosion_insumos_1' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'explosion_insumos_2' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'explosion_insumos_3' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'explosion_insumos_4' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'explosion_insumos_5' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                    'informacion_adicional' => [
                        'path' => 'files/cotizaciones/:md5'
                    ],
                ]
            ]
        );
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

        $validator
            ->requirePresence('cliente_id', 'create')
            ->notEmpty('cliente_id', __('Por favor seleccione un cliente'));

        $validator
            ->requirePresence('contacto_cliente_id', 'create')
            ->notEmpty('contacto_cliente_id', __('Por favor seleccione un contacto'));


        //$validator
          //  ->requirePresence('categoria_cliente_id', 'create')
        // ->notEmpty('categoria_cliente_id', __('Por favor seleccione una categoría'));


        $validator
            ->requirePresence('vendedor_asignado_id', 'create')
            ->notEmpty('vendedor_asignado_id', __('Por favor seleccione un vendedor'));

        $validator
            ->requirePresence('sucursal_id', 'create')
            ->notEmpty('sucursal_id', __('Por favor seleccione una sucursal'));


        $validator
            ->requirePresence('status_id', 'create')
            ->notEmpty('status_id', __('Por favor seleccione un estatus'));

        $validator
            ->requirePresence('moneda_id', 'create')
            ->notEmpty('moneda', __('Por favor seleccione un tipo'));

        $validator
            ->requirePresence('codiciones_pago', 'create')
            ->notEmpty('codiciones_pago', __('Por favor seleccione las condiciones de pago'));

        $validator
            ->requirePresence('tiempo_entrega', 'create')
            ->notEmpty('tiempo_entrega', __('Por favor proporcione el tiempo de entrega'));

        $validator
            ->requirePresence('comentarios_generales', 'create')
            ->notEmpty('comentarios_generales', __('Por favor ingrese los comentarios generales'));

        $validator
            ->requirePresence('vigencia', 'create')
            ->notEmpty('vigencia', __('Por favor ingrese una vigencia en días'));

/*        $validator
            ->requirePresence('fecha_solicitud', 'create')
            ->notEmpty('fecha_solicitud', __('Por favor seleccione una fecha'));

        $validator
            ->requirePresence('fecha_entrega_cliente', 'create')
            ->notEmpty('fecha_entrega_cliente', __('Por favor seleccione una fecha'));

        $validator
            ->requirePresence('fecha_entrega_real', 'create')
            ->notEmpty('fecha_entrega_real', __('Por favor seleccione una fecha'));

        $validator
            ->requirePresence('fecha_estimada_compra', 'create')
            ->notEmpty('fecha_estimada_compra', __('Por favor seleccione una fecha'));*/

        $validator
            ->requirePresence('monto_total', 'create')
            ->notEmpty('monto_total', __('Introduzca una cantidad igual o mayor a cero'));

        $validator
            ->requirePresence('descuento', 'create')
            ->notEmpty('descuento', __('Introduzca una cantidad igual o mayor a cero'));

        $validator
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion', __('Introduzca una descripción.'));


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
        $rules->add($rules->isUnique(['numero_cotizacion']));
        /*$rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['contacto_cliente_id'], 'ContactoClientes'));
        $rules->add($rules->existsIn(['categoria_cliente_id'], 'CategoriaClientes'));
        $rules->add($rules->existsIn(['vendedor_asignado_id'], 'VendedorAsignados'));
        $rules->add($rules->existsIn(['sucursal_id'], 'Sucursals'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));*/

        return $rules;
    }

    public function getUser(){
        $this->loadModel('Users');
        $result = $this->find()
                ->select(['id', 'first_name'])
                ->hydrate(false)
                ->toArray();die;

        debug($result);die();
        $rows = [];
        $rows[0] = "Seleccione";
        foreach($result as $row) {
                $rows[$row['id']] = 'first_name'; 
        }
        return $rows;
    }
}
