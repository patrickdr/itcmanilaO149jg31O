<?php
App::uses('AppModel', 'Model');
/**
 * Seller Model
 *
 * @property Customer $Customer
 * @property Area $Area
 * @property Seller $Seller
 * @property Buyer $Buyer
 * @property Seller $Seller
 */
class Seller extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public $validate = array(
    'code' => array(
      'isUnique' => array(
        'rule' => array('isUnique'),
        'message' => "duplicate is not allowed."
      )
    ),
    'name' => array(
      'isUnique' => array(
        'rule' => array('isUnique'),
        'message' => "duplicate is not allowed."
      )
    )
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
    'ParentSeller' => array(
			'className' => 'Seller',
			'foreignKey' => 'seller_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Buyer' => array(
			'className' => 'Buyer',
			'foreignKey' => 'seller_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SellerAffiliate' => array(
			'className' => 'Seller',
			'foreignKey' => 'seller_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OfficialReceipts' => array(
			'className' => 'OfficialReceipts',
			'foreignKey' => 'seller_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
  
  public $hasOne = array(
    'Address' => array(
      'className' => 'Address',
      'foreignKey' => 'source_id',
      'dependent' => true,
      'conditions' => array(
        'Address.source_name' => 'sellers'
      )
    )
  );
  
  public function findSellers($type, $options = array()){
    $options['conditions']['seller_id'] = "";
    return $this->find($type, $options);
  }

}
