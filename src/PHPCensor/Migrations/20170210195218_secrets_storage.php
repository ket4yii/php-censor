<?php

use Phinx\Migration\AbstractMigration;

class SecretsStorage extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('secret');
        $table->addColumn('project_id', 'integer');
        $table->addColumn('name', 'string');
        $table->addColumn('value', 'string');
        $table->addForeignKey('project_id', 'project', 'id', ['delete'=> 'CASCADE', 'update' => 'CASCADE']);

        $table->save();
    }
}
