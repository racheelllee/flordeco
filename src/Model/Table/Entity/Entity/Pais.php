<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pais Entity.
 */
class Pais extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'clientes' => true,
        'direcciones' => true,
        'estados' => true,
    ];
}
