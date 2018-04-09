<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PedidoCobroExtras Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pedidos
 * @property \Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\PedidoCobroExtra get($primaryKey, $options = [])
 * @method \App\Model\Entity\PedidoCobroExtra newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PedidoCobroExtra[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PedidoCobroExtra|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PedidoCobroExtra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PedidoCobroExtra[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PedidoCobroExtra findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PedidoCobroExtrasTable extends Table
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

        $this->table('pedido_cobro_extras');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pedidos', [
            'foreignKey' => 'pedido_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id'
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
        /*$validator
          ->integer('id')
          ->allowEmpty('id', 'create');
        */

        /*$validator
          ->decimal('monto')
          ->requirePresence('monto', 'create')
          ->notEmpty('monto');
        */

        /*$validator
          ->requirePresence('comentario', 'create')
          ->notEmpty('comentario');
        */

        /*$validator
          ->requirePresence('no_tarjeta', 'create')
          ->notEmpty('no_tarjeta');
        */

        /*$validator
          ->requirePresence('respuesta_pago', 'create')
          ->notEmpty('respuesta_pago');
        */

        /*$validator
          ->requirePresence('nombre_completo', 'create')
          ->notEmpty('nombre_completo');
        */

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
        #$rules->add($rules->existsIn(['pedido_id'], 'Pedidos'));
        #$rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }


}
