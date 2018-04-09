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
        'costo_envio' => true,
        'costo_envio1' => true,
        'costo_envio2' => true,
        'costo_envio3' => true,
        'costo_envio4' => true,
        'costo_envio5' => true,
        'costo_envio6' => true,
        'costo_envio7' => true,
    ];
}
