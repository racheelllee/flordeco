<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Cargos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Clientes
 * @property \Cake\ORM\Association\BelongsTo $Sucursals
 * @property \Cake\ORM\Association\BelongsTo $Supervisors
 * @property \Cake\ORM\Association\BelongsTo $Statuses
 *
 * @method \App\Model\Entity\Cargo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cargo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cargo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cargo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cargo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cargo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cargo findOrCreate($search, callable $callback = null)
 */
class CargosTable extends Table
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

        $this->table('cargos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'sucursal_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'supervisor_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('CargosStatuses', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasMany('Cotizaciones', [
            'foreignKey' => 'cargo_id',
            'conditions' => [
                'Cotizaciones.deleted' => 0
            ]
        ]);

        $this->belongsTo('TiposObra', [
            'foreignKey' => 'tipo_obra',
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

        $validator
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        $validator
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->decimal('ingresos')
            ->allowEmpty('ingresos');

        $validator
            ->decimal('costo_directo_material')
            ->allowEmpty('costo_directo_material');

        $validator
            ->decimal('costo_directo_obra')
            ->allowEmpty('costo_directo_obra');

        $validator
            ->decimal('utilidad')
            ->allowEmpty('utilidad');

        $validator
            ->decimal('rentabilidad')
            ->allowEmpty('rentabilidad');

        $validator
            ->integer('no_cotizaciones_asociadas')
            ->allowEmpty('no_cotizaciones_asociadas');

        $validator
            ->integer('pendientes_facturacion')
            ->allowEmpty('pendientes_facturacion');

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
        /*$rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['sucursal_id'], 'Sucursals'));
        $rules->add($rules->existsIn(['supervisor_id'], 'Supervisors'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));*/

        return $rules;
    }

    public function getOptionsForExcel(){

        $headerCols = [
                        'numero',
                        'costo_directo_material',
                        'costo_directo_obra'
        ];
        $notEmpty = [
                        'numero',
                        'costo_directo_material',
                        'costo_directo_obra'
        ];

        $options = [
                    'startRow'=>1,
                    'headerCols'=>$headerCols,
                    'notEmpty'=>$notEmpty,
                    'worksheetPosition'=>0
                    ];

        return $options;
    }

    public function validationExcel($cargosArray){
        
        foreach ($cargosArray as $key => $cargo) {
            
            if(!empty($cargo['numero'])){
                $cargo_ = $this->find('all', [
                    'fields'=>['id', 'descripcion'],
                    'conditions'=>['Cargos.numero'=>$cargo['numero']]])->first();

                if(!$cargo_){
                    $cargosArray[$key]['cargo'] = '';
                    $cargosArray[$key]['result_upload'][] = 'El cargo no existe';
                }else{
                    $cargosArray[$key]['cargo'] = $cargo_;
                }
            }   
            
            if(!empty($cargo['costo_directo_material']) && (!is_numeric($cargo['costo_directo_material']) || $cargo['costo_directo_material'] < 0 )){
                $cargosArray[$key]['result_upload'][] = 'Costo Directo de Materiales no valido';
            }
            
            if(!empty($cargo['costo_directo_obra']) && (!is_numeric($cargo['costo_directo_obra']) || $cargo['costo_directo_obra'] < 0 )){
                $cargosArray[$key]['result_upload'][] = 'Costo Directo de Mano de Obra no valido';
            }
        }

        return $cargosArray;
    }

    public function supervisores(){

        $users = [NULL => 'Todos'] + TableRegistry::get('Users')->find('list', [
            'keyField' => 'id',
            'valueField' =>
                function($user){
                    return $user['first_name'] .' '. $user['last_name'] .' '. $user['clast_name'];
                }
        ])->where([
            'Users.deleted' => false,
            'user_group_id !=' => 1
        ])->order('Users.first_name asc')->toArray();

        $result = $this->find('list', [
            'keyField' => 'id',
            'valueField' => 'supervisor_id',
            'conditions' => [
                'deleted' => false
            ]
        ])->toArray();

        foreach($users as $id => $user) {
            if (!in_array($id, $result)) {
                unset($users[$id]);
            }
        }

        return $users;
    }

    public function getCargos($sel=true){
        return 
            [ NULL => 'Todos'] +
            $this->find('list', [
                'conditions' => ['deleted' => false],
                'keyField' => 'id',
                'valueField' => 'numero',
            ])->hydrate(false)->toArray();
    }

    public function tiposDeObra(){
        return [NULL => 'Todos'] + TableRegistry::get('TiposObra')->find('list')->toArray();
    }
}
