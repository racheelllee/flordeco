<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity.
 */
class Pedido extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cliente_id' => true,
        'ciudad_id' => true,
        'fecha' => true,
        'monto' => true,
        'subtotal' => true,
        'envio' => true,
        'cupon' => true,
        'iva' => true,
        'cupon_id' => true,
        'forma_pago_id' => true,
        'mensaje_tarjeta' => true,
        'mensaje_tarjeta_id' => true,
        'firma' => true,
        'arreglo_funeral' => true,
        'estatus_id' => true,
        'respuesta_pago' => true,
        'facturar' => true,
        'nombre_cliente' => true,
        'correo_electronico' => true,
        'nombre_destinatario' => true,
        'telefono_destinatario' => true,
        'referencias_direccion' => true,
        'calle' => true,
        'numero_exterior' => true,
        'numero_interior' => true,
        'colonia' => true,
        'codigo_postal' => true,
        'ciudad' => true,
        'estado' => true,
        'pais' => true,
        'guia_de_envio' => true,
        'recibido_por' => true,
        'fecha_entrega' => true,
        'horario_entrega' => true,
        'ciudad_horario_entrega_id' => true,
        'ciudad_horario_entrega_preciso_id' => true,
        'proveedor_mensajeria' => true,
        'modified' => true,
		'asociado_id' => true,
        'tipo_domicilio' => true,

        'puntos_acumulados' => true,
        'puntos_aplicados' => true,
        'puntos_acumulados_porcentaje' => true
    ];
}
