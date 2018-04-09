<?php
use Migrations\AbstractMigration;

class CreateRangoPrecios extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('rango_precios');
        $table->addColumn('nombre', 'string', [
            'default' => null,
            'limit' => 256,
            'null' => false,
        ]);
        $table->addColumn('etiqueta', 'string', [
            'default' => null,
            'limit' => 64,
            'null' => false,
        ]);
        $table->create();
    }
}
