<?php
namespace App\Model\Table;

use App\Model\Entity\Estatus;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Estatuses Model
 */
class EstatusesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('estatuses');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->hasMany('Pedidos', [
            'foreignKey' => 'estatus_id'
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        return $validator;
    }

    public function getEstatuses(){

       $estatuses=$this->find('list', ['order' => ['nombre' => 'asc']])->toArray();
       $estatuses=[''=>' -- Seleccione -- ']+$estatuses;
       return $estatuses;

    }
}
