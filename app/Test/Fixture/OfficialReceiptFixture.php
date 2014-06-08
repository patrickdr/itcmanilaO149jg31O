<?php
/**
 * OfficialReceiptFixture
 *
 */
class OfficialReceiptFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'collector_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'seller_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'or_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => null),
		'date_received' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_official_receipts_collectors1_idx' => array('column' => 'collector_id', 'unique' => 0),
			'fk_official_receipts_sellers1_idx' => array('column' => 'seller_id', 'unique' => 0),
			'fk_official_receipts_customers1_idx' => array('column' => 'customer_id', 'unique' => 0)
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
			'seller_id' => 1,
			'customer_id' => 1,
			'or_number' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'date_received' => '2014-06-08',
			'created' => '2014-06-08 04:48:59',
			'modified' => '2014-06-08 04:48:59'
		),
	);

}
