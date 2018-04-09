<?php
namespace App\Model\Table;

use App\Model\Entity\Estado;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Estados Model
 */
class EstadosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('estados');
       $this->displayField('nombre');
        $this->primaryKey('id');
        $this->belongsTo('Paises', [
            'foreignKey' => 'pais_id',
            'joinType' => 'INNER'
        ]);
        //$this->hasMany('Clientes', [
        //    'foreignKey' => 'estado_id'
        //]);
        //$this->hasMany('Direcciones', [
        //    'foreignKey' => 'estado_id'
        //]);
        $this->hasMany('Municipios', [
            'foreignKey' => 'estado_id'
        ]);

        $this->hasMany('CiudadFestivos', [
            'foreignKey' => 'estado_id',
            'sort' => ['CiudadFestivos.fecha'=>'ASC']
        ]);

        $this->hasMany('CiudadFestivosSemanas', [
            'foreignKey' => 'estado_id'
        ]);

        $this->hasMany('CiudadHorarioEntregas', [
            'foreignKey' => 'estado_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('nombre');

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
        $rules->add($rules->existsIn(['pais_id'], 'Paises'));
        return $rules;
    }

    public function getEstados(){

       $estados = $this->find('list', ['order' => ['nombre' => 'asc']])->toArray();
       $estados = [''=>' -- Seleccione -- ']+$estados;
       return $estados;
    }

    public function estadoPorUrl($estadoUrl = '')
    {
        return $this->find('all')->where(['Estados.url' => $estadoUrl])->first();
    }
}
