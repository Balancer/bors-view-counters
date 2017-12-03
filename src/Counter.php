<?php

namespace B2\Views;

class Counter extends \bors_object_db
{
	function table_name() { return 'bors_view_counters'; }

	function table_fields()
	{
		return [
			'id',

			'target_class_name',
			'target_id',
			'views_count',

			'create_time' => 'UNIX_TIMESTAMP(`create_ts`)',
			'modify_time' => 'UNIX_TIMESTAMP(`modify_ts`)',
		];
    }

	static function add($object)
	{
		$id = is_null($object->id()) ? '' : $object->id();
		$prev = Counter::find([
			'target_class_name' => $object->class_name(),
			'target_id' => $id,
		])->first();
		if($prev->is_null())
		{
			$prev = Counter::create([
				'target_class_name' => $object->class_name(),
				'target_id' => $id,
				'views_count' => 1,
			]);
		}
		else
		{
			$prev->set_views_count($prev->views_count()+1);
			$prev->store();
		}
	}

	static function views($object)
	{
		$ch = new \bors_cache_fast();
		if($ch->get('views_count_v2', $object->internal_uri_ascii()))
			return $ch->last();

		$id = is_null($object->id()) ? '' : $object->id();

		$counter = Counter::find([
			'target_class_name' => $object->class_name(),
			'target_id' => $id,
		])->first();

		if($counter->is_null())
			return $ch->set(0, rand(60, 900));

		return $ch->set($counter->views_count(), rand(60, 900));
	}
}
