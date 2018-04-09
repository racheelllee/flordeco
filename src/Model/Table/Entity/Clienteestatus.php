<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clienteestatus Entity.
 */
class Clienteestatus extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'clientes' => true,
    ];
}
