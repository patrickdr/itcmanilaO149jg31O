<?php
/**
 * TripFixture
 *
 */
class TripFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'collector_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'trip_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_collectors_has_itineraries_collectors1_idx' => array('column' => 'collector_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'collector_id' => 1,
			'trip_type' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-05-18 11:25:20',
			'modified' => '2014-05-18 11:25:20'
		),
	);

}
