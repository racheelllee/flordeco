<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * State Entity
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $abrev
 * @property bool $active
 * @property int $country_id
 *
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Municipality[] $municipalities
 * @property \App\Model\Entity\Office[] $offices
 */
class State extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
