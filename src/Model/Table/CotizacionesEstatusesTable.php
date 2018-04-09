<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CotizacionesEstatuses Model
 *
 * @method \App\Model\Entity\CotizacionesEstatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\CotizacionesEstatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CotizacionesEstatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CotizacionesEstatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CotizacionesEstatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CotizacionesEstatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CotizacionesEstatus findOrCreate($search, callable $callback = null)
 */
class CotizacionesEstatusesTable extends Table
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

        $this->table('cotizaciones_estatuses');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        return $validator;
    }

    public function getEstatus($sel=true){
        $result = $this->find()
                ->select(['id', 'nombre' ])
                ->where(['deleted' => false])
                ->hydrate(false)
                ->toArray();
        $rows = [];
        $rows[NULL] = 'Todos';
        foreach($result as $row) {
            $rows[$row['id']] = $row['nombre'];
        }
        return $rows;
    }

    public function getEstatusV2($sel=true){
        return $this->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre',
            'conditions' => ['deleted' => false],
        ]);
    }

    public function getEstatusVenta($sel=true){
        $result = $this->find()
                ->select(['id', 'nombre' ])
                ->where(['deleted' => false, 'venta' => true])
                ->hydrate(false)
                ->toArray();
        $rows = [];
        foreach($result as $row) {
            $rows[$row['id']] = $row['nombre'];
        }
        return $rows;
    }
}
