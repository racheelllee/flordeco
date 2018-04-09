<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ColaExportacion Entity
 *
 * @property int $id
 * @property int $user_id
 * @property bool $en_ejecucion
 * @property string $condiciones
 * @property string $parametros
 * @property bool $terminado
 * @property int $cantidad
 * @property string $archivo
 * @property string $correo
 * @property \Cake\I18n\Time $fecha
 * @property string $tipo
 *
 * @property \App\Model\Entity\User $user
 */
class ColaExportacion extends Entity
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
