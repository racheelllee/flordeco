<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Estado Entity.
 */
class Estado extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'pais_id' => true,
        'nombre' => true,
        'pais' => true,
        'clientes' => true,
        'direcciones' => true,
        'municipios' => true,
    ];
}
