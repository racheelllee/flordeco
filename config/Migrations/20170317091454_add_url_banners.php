<?php

use Phinx\Migration\AbstractMigration;

class AddUrlBanners extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('banners');
        $table->addColumn('url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true
        ])->update();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}