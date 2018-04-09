<?php
namespace App\Model\Table;

use App\Model\Entity\Marca;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Marcas Model
 */
class MarcasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('marcas');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->hasMany('Cupones', [
            'foreignKey' => 'marca_id'
        ]);
        $this->hasMany('Productos', [
            'foreignKey' => 'marca_id'
        ]);
        $this->hasMany('ProductosCopy', [
            'foreignKey' => 'marca_id'
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

    public function getMarcas(){

       $marcas=$this->find('list', ['order' => ['nombre' => 'asc']])->toArray();
       //debug($marcas);
       $marcas=[''=>' -- Seleccione -- ']+$marcas;

       //asort($marcas);
       return $marcas;
       

    }
}
