<?php
namespace App\Model\Table;

use App\Model\Entity\Proveedor;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Proveedores Model
 */
class ProveedoresTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('proveedores');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->hasMany('Precios', [
            'foreignKey' => 'proveedor_id'
        ]);
        $this->hasMany('Productos', [
            'foreignKey' => 'proveedor_id'
        ]);
        $this->belongsToMany('Productos', [
            'foreignKey' => 'proveedor_id',
            'targetForeignKey' => 'producto_id',
            'joinTable' => 'productos_proveedores'
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

     public function getProveedores(){

       $proveedores=$this->find('list', ['order' => ['nombre' => 'asc']])->toArray();
       $proveedores=[''=>' -- Seleccione -- ']+$proveedores;
       return $proveedores;
       

    }
}
