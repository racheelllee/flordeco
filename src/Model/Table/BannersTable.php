<?php
namespace App\Model\Table;

use App\Model\Entity\Banner;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banners Model
 */
class BannersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('banners');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->addBehavior('Upload', [
                //'root' => FRONT_WWW_ROOT,
                'root' => WWW_ROOT,
                'fields' => [
                    'imagen' => [
                    'path' => 'upload/banner/:id/:md5'
                    ]
                ]
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
