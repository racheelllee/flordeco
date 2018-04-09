<?php
use Migrations\AbstractMigration;

class AddDeletedToCiudades extends AbstractMigration
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
        $table = $this->table('ciudades');
        $table->addColumn('deleted', 'integer', [
            'default' => null,
            'limit' => 1,
            'null' => false,
        ]);
        $table->update();
    }
}
