<?php
App::uses('Buyer', 'Model');

/**
 * Buyer Test Case
 *
 */
class BuyerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.buyer',
		'app.customer',
		'app.area',
		'app.itinerary'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Buyer = ClassRegistry::init('Buyer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Buyer);

		parent::tearDown();
	}

}
