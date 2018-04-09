<?php
namespace App\Model\Table;

use App\Model\Entity\Pais;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paises Model
 */
class PaisesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('paises');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->hasMany('Clientes', [
            'foreignKey' => 'pais_id'
        ]);
        $this->hasMany('Direcciones', [
            'foreignKey' => 'pais_id'
        ]);
        $this->hasMany('Estados', [
            'foreignKey' => 'pais_id'
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
}
