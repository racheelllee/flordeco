<?php
use Migrations\AbstractSeed;

/**
 * CiudadStatus seed.
 */
class CiudadStatusSeed extends AbstractSeed
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
                'nombre' => 'Activo',
                'etiqueta' => 'activo',
                'color' => '#adadad',
            ],
            [
                'nombre' => 'Inctivo',
                'etiqueta' => 'inactivo',
                'color' => '#333',
            ],
        ];

        $table = $this->table('ciudad_statuses');
        $table->insert($data)->save();
    }
}
