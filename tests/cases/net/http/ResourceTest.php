<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_rest\tests\cases\net\http;
use li3_rest\net\http\Resource;

class ResourceTest extends \lithium\test\Unit {

	public function testResourceConnect() {
		$routes = Resource::connect('posts');
		$this->assertEqual(7, count($routes));
	}

	public function testResourceConnectExcept() {
		$routes = Resource::connect('posts', array('except' => 'delete'));
		$this->assertEqual(6, count($routes));

		$routes = Resource::connect('posts', array('except' => array('delete')));
		$this->assertEqual(6, count($routes));

		foreach ($routes as $route) {
			$result[] = $route['params']['http:method'];
		}
		$this->assertFalse(in_array('DELETE', $result));
	}

	public function testResourceConnectOnly() {
		$routes = Resource::connect('posts', array('only' => 'index'));
		$this->assertEqual(1, count($routes));

		$routes = Resource::connect('posts', array('only' => array('index', 'show')));
		$this->assertEqual(2, count($routes));

		$expected = array('index', 'show');
		foreach ($routes as $route) {
			$result[] = $route['params']['action'];
		}
		$this->assertEqual($expected, $result);
	}
}

?>