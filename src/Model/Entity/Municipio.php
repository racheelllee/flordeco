<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Municipio Entity.
 */
class Municipio extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'estado_id' => true,
        'nombre' => true,
        'estado' => true,
        'clientes' => true,
        'direcciones' => true,
    ];
}
