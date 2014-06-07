<?php
App::uses('Reason', 'Model');

/**
 * Reason Test Case
 *
 */
class ReasonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reason',
		'app.itinerary',
		'app.buyer',
		'app.customer',
		'app.address',
		'app.seller',
		'app.area',
		'app.trip_area',
		'app.trip',
		'app.collector'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reason = ClassRegistry::init('Reason');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reason);

		parent::tearDown();
	}

}
