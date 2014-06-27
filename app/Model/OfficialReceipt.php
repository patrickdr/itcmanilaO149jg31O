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

  const RECEIVED = 1,
        DISPATCHED = 2,
        REMMITED = 3, 
        BALANCE = 4,
        RETURNED = 5;
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
		'SellerAffiliate' => array(
			'className' => 'Seller',
			'foreignKey' => 'seller_affiliate_id',
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
  public $hasOne = array(
    'Collection' => array(
      'className' => 'Collection',
      'foreignKey' => 'official_receipt_id',
      'dependent' => true,
      'conditions' => array()
    )
  );  
  public function getStatuses(){
    return array(
      self::RECEIVED => 'OR Received',
      self::DISPATCHED => 'OR Dispatched',
      self::REMMITED => 'OR Remmited',
      self::BALANCE => 'OR Balance',
      self::RETURNED => 'OR Returned'
    );
  }
}
