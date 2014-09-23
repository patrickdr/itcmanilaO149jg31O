<?php
App::uses('Collector', 'Model');

/**
 * Collector Test Case
 *
 */
class CollectorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.collector',
		'app.trip'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Collector = ClassRegistry::init('Collector');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Collector);

		parent::tearDown();
	}

}
