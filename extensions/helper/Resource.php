<?php

namespace li3_rest\extensions\helper;

use lithium\util\Inflector;

class Resource extends \lithium\template\Helper {

	public function path($entity) {
		$resource = Inflector::tableize(basename(str_replace('\\', '/', $entity->model())));

		if ($entity->exists()) {
			return '/' . $resource . '/' . $entity->_id;
		} else {
			return '/' . $resource;
		}
	}
}

?>
