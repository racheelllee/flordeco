<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Direccionesfiscale Entity.
 */
class Direccionesfiscale extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
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
        'ciudad' => true,
        'estado' => true,
        'session_id' => true,
        'municipio' => true,
        'estado' => true,
        'pais' => true,
        'session' => true,
    ];
}
