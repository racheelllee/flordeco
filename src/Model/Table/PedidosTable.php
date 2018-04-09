<?php
namespace App\Model\Table;

use App\Model\Entity\Pedido;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Network\Email\Email;

/**
 * Pedidos Model
 */
class PedidosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('pedidos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Zona', [
            'className' => 'Ciudades',
            'foreignKey' => 'ciudad_id'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'cliente_id'
        ]);

        $this->belongsTo('Formasdepagos', [
            'foreignKey' => 'forma_pago_id'
        ]);

        $this->belongsTo('Estatuses', [
            'foreignKey' => 'estatus_id'
        ]);

        $this->hasMany('Partidas', [
            'foreignKey' => 'pedido_id'
        ]);

        $this->hasMany('PedidosComentarios', [
            'foreignKey' => 'pedido_id'
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
        return $rules;
    }

    public function sendEstatusPedido($pedido, $respuesta='') {

        //$pedido['user']['email'] = 'felix.flores@webpoint.mx';
        $correo_cliente = ($pedido['user']['email'])? $pedido['user']['email'] : 'felix.flores@webpoint.mx';

        $email = new Email('default');
        $email->template('estatuspedido_'.$pedido->estatus_id)
        ->emailFormat('html')
        ->to($correo_cliente)
        ->from(EMAIL_FROM_ADDRESS)
        ->subject('Estatus Pedido No.'.$pedido->id.' - '.$pedido->estatus->nombre)
        ->viewVars([ 'pedido' => $pedido, 'respuesta' => $respuesta ]);

        try {

            $email->send();

        } catch (Exception $ex) {

        }
    }
}
