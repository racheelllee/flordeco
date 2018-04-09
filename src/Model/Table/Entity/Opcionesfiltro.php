<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Opcionesfiltro Entity.
 */
class Opcionesfiltro extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'filtro_id' => true,
        'nombre' => true,
        'filtro' => true,
        'orden' => true,
        'opcionefiltros_productos' => true,
    ];
}
