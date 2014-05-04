<?php
/**
 * SellerFixture
 *
 */
class SellerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'area_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seller_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_sellers_sellers1_idx' => array('column' => 'seller_id', 'unique' => 0),
			'fk_sellers_customers1_idx' => array('column' => 'customer_id', 'unique' => 0),
			'fk_sellers_areas1_idx' => array('column' => 'area_id', 'unique' => 0)
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
			'customer_id' => 1,
			'area_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'seller_id' => 1,
			'address' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-05-03 08:52:36',
			'modified' => '2014-05-03 08:52:36'
		),
	);

}
