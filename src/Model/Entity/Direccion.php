<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Direccion Entity.
 */
class Direccion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cliente_id' => true,
        'nombre' => true,
        'calle' => true,
        'numero_exterior' => true,
        'numero_interior' => true,
        'entre_calles' => true,
        'colonia' => true,
        'municipio_id' => true,
        'codigo_postal' => true,
        'estado_id' => true,
        'pais_id' => true,
        'cliente' => true,
        'municipio' => true,
        'estado' => true,
        'pais' => true,
        'nombre_destinatario' => true,
        'telefono_destinatario' => true,
        'direccion_tipo_id' => true,
        'ciudad' => true,
    ];
}
