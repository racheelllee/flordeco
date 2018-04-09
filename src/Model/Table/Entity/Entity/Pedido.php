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
        'fecha' => true,
        'monto' => true,
        'formasdepago_id' => true,
        'estatus_id' => true,
        'nombre_cliente' => true,
        'correo_electronico' => true,
        'telefono_local' => true,
        'telefono_celular' => true,
        'nombre_quien_recibe' => true,
        'calle' => true,
        'numero_exterior' => true,
        'numero_interior' => true,
        'entre_calles' => true,
        'colonia' => true,
        'municipio_id' => true,
        'codigo_postal' => true,
        //'estado_id' => true,
        'pais_id' => true,
        'respuesta_pago' => true,
        'cliente' => true,
        'formasdepago' => true,
        'estatus' => true,
        'municipio' => true,
        'estado' => true,
        'pais' => true,
        'partidas' => true,
        'modified' => true,
        'guia_de_envio' => true,
        'proveedor_mensajeria' => true,
        'recibido_por' => true,
        'fecha_entrega' => true

    ];
}
