<?php
/**
 * ItineraryFixture
 *
 */
class ItineraryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'buyer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'itinerary_type' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'trip_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'trip_number' => array('type' => 'integer', 'null' => true, 'default' => null),
		'remarks' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_received' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_itineraries_lookups1_idx' => array('column' => 'itinerary_type', 'unique' => 0),
			'fk_itineraries_buyers1_idx' => array('column' => 'buyer_id', 'unique' => 0)
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
			'buyer_id' => 1,
			'itinerary_type' => 1,
			'trip_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'trip_number' => 1,
			'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'date_received' => '2014-05-17 14:40:53',
			'created' => '2014-05-17 14:40:53',
			'modified' => '2014-05-17 14:40:53',
			'type' => 'Lorem ipsum dolor sit amet'
		),
	);

}
