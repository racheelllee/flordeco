<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interaction Entity
 *
 * @property int $id
 * @property string $title
 * @property int $length
 * @property int $user_id
 * @property string $comments
 * @property int $customer_id
 * @property int $interaction_status_id
 * @property int $interaction_type_id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\InteractionStatus $interaction_status
 * @property \App\Model\Entity\InteractionType $interaction_type
 */
class Interaction extends Entity
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

    public function _getMarcas(){
        $str = '';
        if ($this->interaccion_marcas) {
            $marcas = [];
            foreach ($this->interaccion_marcas as $key => $cotizacion_marca) {
                if ( $cotizacion_marca->has('marca') ) {
                    $marcas[] = $cotizacion_marca->marca->nombre;
                }
            }
            $str = implode(', ', $marcas);
        }
        return $str;
    }
}
