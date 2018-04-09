<?php
namespace App\Model\Table;

use App\Model\Entity\Sucursale;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sucursales Model
 */
class SucursalesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('sucursales');
        $this->displayField('nombre');
        $this->primaryKey('id');
        $this->belongsTo('Estados', [
            'foreignKey' => 'estado_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Municipios', [
            'foreignKey' => 'municipio_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Ciudades', [
            'foreignKey' => 'ciudad_id',
            'joinType' => 'LEFT'
        ]);

        $this->addBehavior('Xety/Cake3Upload.Upload', [
                'fields' => [
                    'banner' => [
                        'path' => 'files/sucursales/:id/:md5'
                    ]
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
        return $validator;
    }
}
