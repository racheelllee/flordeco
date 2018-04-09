<?php
use Migrations\AbstractMigration;

class AddMinToRangoPrecios extends AbstractMigration
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
        $table->addColumn('min', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
