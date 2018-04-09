<?php
use Migrations\AbstractMigration;

class CreateTipoFlores extends AbstractMigration
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
        $table = $this->table('tipo_flores');
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
        $table->create();
    }
}
