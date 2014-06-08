<?php
App::uses('AppModel', 'Model');
/**
 * OfficialReceipt Model
 *
 * @property Collector $Collector
 * @property Seller $Seller
 * @property Customer $Customer
 */
class OfficialReceipt extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'or_number';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Collector' => array(
			'className' => 'Collector',
			'foreignKey' => 'collector_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Seller' => array(
			'className' => 'Seller',
			'foreignKey' => 'seller_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
