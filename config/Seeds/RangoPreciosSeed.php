<?php
use Migrations\AbstractSeed;

/**
 * RangoPrecios seed.
 */
class RangoPreciosSeed extends AbstractSeed
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
                'nombre' => '$100.00 - $200.00',
                'etiqueta' => '100_200',
            ],
            [
                'nombre' => '$200.00 - $400.00',
                'etiqueta' => '200_400',
            ],
            [
                'nombre' => '$400.00 - $600.00',
                'etiqueta' => '400_600',
            ],
            [
                'nombre' => '$600.00 - $800.00',
                'etiqueta' => '600_800',
            ],
            [
                'nombre' => '$800.00 - $1000.00',
                'etiqueta' => '800_1000',
            ],
        ];

        $table = $this->table('rango_precios');
        $table->insert($data)->save();
    }
}
