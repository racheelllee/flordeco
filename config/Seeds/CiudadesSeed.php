<?php
use Migrations\AbstractSeed;

/**
 * Ciudades seed.
 */
class CiudadesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre' => 'Nombre',
                'url' => 'url-custom',
                'estado_id' => 19,
                'ciudad_status_id' => 1,
                'rango_precio_id' => 1,
                'costo_envio' => 0,
                'descripcion' => 'Descripción',
            ],
            [
                'nombre' => 'Nombre 2',
                'url' => 'url-custom-2',
                'estado_id' => 19,
                'ciudad_status_id' => 1,
                'rango_precio_id' => 1,
                'costo_envio' => 0,
                'descripcion' => 'Descripción',
            ],
            [
                'nombre' => 'Nombre 3',
                'url' => 'url-custom-3',
                'estado_id' => 1,
                'ciudad_status_id' => 2,
                'rango_precio_id' => 1,
                'costo_envio' => 0,
                'descripcion' => 'Descripción',
            ],
        ];
        $table = $this->table('ciudades');
        $table->insert($data)->save();
    }
}
