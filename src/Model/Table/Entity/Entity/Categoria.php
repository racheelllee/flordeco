<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Categoria Entity.
 */
class Categoria extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'categoria_id' => true,
        'nombre' => true,
        'descripcion' => true,
        'meta_descripcion' => true,
        'meta_keywords' => true,
        'meta_titulo' => true,
        'url' => true,
        'orden' => true,
        'banner' => true,
        'imagen_fondo' => true,
        'categorias' => true,
        'cupones' => true,
        'filtros' => true,
        'productos' => true,
        'banner_secundario' => true,
    ];
}
