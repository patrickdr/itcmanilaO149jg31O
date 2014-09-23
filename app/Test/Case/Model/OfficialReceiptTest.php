<?php
App::uses('OfficialReceipt', 'Model');

/**
 * OfficialReceipt Test Case
 *
 */
class OfficialReceiptTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.official_receipt',
		'app.collector',
		'app.trip',
		'app.itinerary',
		'app.buyer',
		'app.customer',
		'app.address',
		'app.seller',
		'app.area',
		'app.trip_area',
		'app.reason'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OfficialReceipt = ClassRegistry::init('OfficialReceipt');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OfficialReceipt);

		parent::tearDown();
	}

}
