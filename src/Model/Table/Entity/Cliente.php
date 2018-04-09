<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity.
 */
class Cliente extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'correo_electronico' => true,
        'telefono_local' => true,
        'telefono_celular' => true,
        'contrasena' => true,
        'razon_social' => true,
        'rfc' => true,
        'calle' => true,
        'numero_exterior' => true,
        'numero_interior' => true,
        'entre_calles' => true,
        'colonia' => true,
        'municipio_id' => true,
        'codigo_postal' => true,
        'estado_id' => true,
        'pais_id' => true,
        'clienteestatus_id' => true,
        'municipio' => true,
        'estado' => true,
        'pais' => true,
        'clienteestatus' => true,
        'cupones' => true,
        'direcciones' => true,
        'pedidos' => true,
    ];
}
