<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proveedor Entity.
 */
class Proveedor extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'precios' => true,
        'productos' => true,


        'tiempo_de_entrega' => true,
        'contacto_comercial' => true,
        'puesto' => true,
        'correo_electronico' => true,
        'telefono1' => true,
        'codigo_postal_bodega' => true,
        'nombre_fiscal' => true,
        'contacto_credito_cobranza' => true,
        'codigo_postal_fiscal' => true,
        'rfc' => true,
        'telefono2' => true,
        'condiciones_pago' => true,
        'banco' => true,
        'no_cuenta' => true,
        'clabe_interbancaria' => true,
        'opcion_proveedor' => true,
        'costo_opcion_proveedor' => true,
        'calle_bodega' => true,
        'numero_exterior_bodega' => true,
        'numero_interior_bodega' => true,
        'entre_calles_bodega' => true,
        'colonia_bodega' => true,
        'ciudad_bodega' => true,
        'estado_bodega' => true,
        'calle_fiscal' => true,
        'numero_exterior_fiscal' => true,
        'numero_interior_fiscal' => true,
        'entre_calles_fiscal' => true,
        'colonia_fiscal' => true,
        'ciudad_fiscal' => true,
        'estado_fiscal' => true,
        'envio_guia' => true
    ];
}
