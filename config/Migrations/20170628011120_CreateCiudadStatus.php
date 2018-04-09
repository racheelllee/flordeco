<?php
use Migrations\AbstractMigration;

class CreateCiudadStatus extends AbstractMigration
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
        $table = $this->table('ciudad_statuses');
        $table->addColumn('nombre', 'string', [
            'default' => '',
            'limit' => 256,
            'null' => false,
        ]);
        $table->addColumn('etiqueta', 'string', [
            'default' => '',
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('color', 'string', [
            'default' => '',
            'limit' => 32,
            'null' => false,
        ]);
        $table->create();
    }
}
