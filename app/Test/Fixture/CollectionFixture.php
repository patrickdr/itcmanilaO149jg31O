<?php
/**
 * CollectionFixture
 *
 */
class CollectionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'collection_type' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'official_receipt_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'collector_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'invoice_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ded1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ded2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'check_amount' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '20,2'),
		'check_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'bank' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'check_dat e' => array('type' => 'date', 'null' => true, 'default' => null),
		'check_type' => array('type' => 'integer', 'null' => true, 'default' => null),
		'currency' => array('type' => 'integer', 'null' => true, 'default' => null),
		'deposit_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'deposit_channel' => array('type' => 'integer', 'null' => true, 'default' => null),
		'clearing_type_code' => array('type' => 'integer', 'null' => true, 'default' => null),
		'drawee_bank_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 155, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'drawee_bank_branch_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 155, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'check_pickup_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'collector_remarks' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_collections_lookups1_idx' => array('column' => 'collection_type', 'unique' => 0),
			'fk_collections_official_receipts1_idx' => array('column' => 'official_receipt_id', 'unique' => 0),
			'fk_collections_collectors1_idx' => array('column' => 'collector_id', 'unique' => 0)
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
			'collection_type' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-06-24 16:05:13',
			'modified' => '2014-06-24 16:05:13',
			'official_receipt_id' => 1,
			'collector_id' => 1,
			'invoice_number' => 'Lorem ipsum dolor sit amet',
			'ded1' => 'Lorem ipsum dolor sit amet',
			'ded2' => 'Lorem ipsum dolor sit amet',
			'check_amount' => 1,
			'check_number' => 'Lorem ipsum dolor sit amet',
			'bank' => 'Lorem ipsum dolor sit amet',
			'check_dat e' => '2014-06-24',
			'check_type' => 1,
			'currency' => 1,
			'deposit_date' => '2014-06-24',
			'deposit_channel' => 1,
			'clearing_type_code' => 1,
			'drawee_bank_code' => 'Lorem ipsum dolor sit amet',
			'drawee_bank_branch_code' => 'Lorem ipsum dolor sit amet',
			'check_pickup_date' => '2014-06-24',
			'collector_remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
