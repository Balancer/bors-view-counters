<?php

use Phinx\Migration\AbstractMigration;

class Init extends AbstractMigration
{
    public function change()
    {
		$this->table('bors_view_counters', ['id' => false, 'primary_key' => 'id'])

			->addColumn('id', 'integer', ['signed' => false, 'identity' => true, 'limit' => 10])

			->addColumn('target_class_name', 'string')
			->addColumn('target_id', 'integer', ['signed' => false, 'limit' => 10, 'default' => '0'])
			->addColumn('vews_count', 'integer', ['signed' => false, 'limit' => 10, 'default' => '0'])

			->addColumn('create_ts', 'timestamp', ['null' => true])
			->addColumn('modify_ts', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])

			->create();

		$this->table('bors_view_daily_stat', ['id' => false, 'primary_key' => 'id'])

			->addColumn('id', 'integer', ['signed' => false, 'identity' => true, 'limit' => 10])

			->addColumn('target_class_name', 'string')
			->addColumn('target_id', 'integer', ['signed' => false, 'limit' => 10, 'default' => '0'])
			->addColumn('vews_count', 'integer', ['signed' => false, 'limit' => 10, 'default' => '0'])

			->addColumn('create_ts', 'timestamp', ['null' => true])
			->addColumn('modify_ts', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])

			->create();
    }
}
