<?php
/**
 * TripAreaFixture
 *
 */
class TripAreaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'trip_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'area_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_trips_has_areas_areas1_idx' => array('column' => 'area_id', 'unique' => 0),
			'fk_trips_has_areas_trips1_idx' => array('column' => 'trip_id', 'unique' => 0)
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
			'trip_id' => 1,
			'area_id' => 1,
			'created' => '2014-05-18 11:54:14',
			'modified' => '2014-05-18 11:54:14'
		),
	);

}
