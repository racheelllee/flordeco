<?php
namespace App\Model\Table;

use App\Model\Entity\Preciocompetencia;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Preciocompetencias Model
 */
class PreciocompetenciasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('preciocompetencias');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Competencias', [
            'foreignKey' => 'competencia_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->add('precio', 'valid', ['rule' => 'decimal'])
            ->requirePresence('precio', 'create')
            ->notEmpty('precio');
            
        $validator
            ->add('envio_gratis', 'valid', ['rule' => 'numeric'])
            ->requirePresence('envio_gratis', 'create')
            ->notEmpty('envio_gratis');
            
        $validator
            ->add('actualizacion', 'valid', ['rule' => 'datetime'])
            ->requirePresence('actualizacion', 'create')
            ->notEmpty('actualizacion');

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
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));
        $rules->add($rules->existsIn(['compentecia_id'], 'Compentecias'));
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));
        return $rules;
    }
}
