<?php
App::uses('FileCount', 'Model');

/**
 * FileCount Test Case
 *
 */
class FileCountTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.file_count'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FileCount = ClassRegistry::init('FileCount');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FileCount);

		parent::tearDown();
	}

}
