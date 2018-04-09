<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sucursale Entity.
 */
class Sucursale extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'estado_id' => true,
        'municipio_id' => true,
        'banner' => true,
        'banner_file' => true,
        'detalles' => true,
    ];
}
