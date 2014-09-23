<?php
App::uses('TripArea', 'Model');

/**
 * TripArea Test Case
 *
 */
class TripAreaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.trip_area',
		'app.trip',
		'app.collector',
		'app.itinerary',
		'app.buyer',
		'app.customer',
		'app.address',
		'app.seller',
		'app.area'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TripArea = ClassRegistry::init('TripArea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TripArea);

		parent::tearDown();
	}

}
