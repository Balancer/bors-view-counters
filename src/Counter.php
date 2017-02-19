<?php

namespace \B2\Views;

class Counter extends \B2\Object\Db
{
	function table_name() { return 'bors_view_counters'; }

	function table_fields()
	{
		return [
			'id',

			'target_class_name',
			'target_id',
			'vews_count',

			'create_time' => 'UNIX_TIMESTAMP(`create_ts`)',
			'modify_time' => 'UNIX_TIMESTAMP(`modify_ts`)',
		];
    }
}
