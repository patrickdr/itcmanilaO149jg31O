<?php
App::uses('AppModel', 'Model');
/**
 * Itinerary Model
 *
 * @property Buyer $Buyer
 * @property Trip $Trip
 */
class Itinerary extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'date_received' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
    'itenerary_number' => 'notEmpty'
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Buyer' => array(
			'className' => 'Buyer',
			'foreignKey' => 'buyer_id',
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
		),      
		'Trip' => array(
			'className' => 'Trip',
			'foreignKey' => 'trip_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
  
  public $hasOne = array(
    'Address' => array(
      'className' => 'Address',
      'foreignKey' => 'source_id',
      'dependent' => true,
      'conditions' => array(
        'Address.source_name' => 'itineraries'
      )
    )
  );
  
  public $validHeaders = array(
    1 => 'customer',
    2 => 'seller',
    3 => 'seller_affiliate',
    4 => 'client_buyer_code',
    5 => 'buyer_name',
    6 => 'it_remarks',
    7 => 'it_contact_person',
    8 => 'it_tel_no',
    9 => 'it_check_amount',
    10 => 'it_pick_up_address',
    11 => 'requestor',
    12 => 'trip_type',
    13 => 'mm_provl'
  );    
  
}
