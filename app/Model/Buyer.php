<?php
App::uses('AppModel', 'Model');
/**
 * Buyer Model
 *
 * @property Customer $Customer
 * @property Area $Area
 * @property Itinerary $Itinerary
 */
class Buyer extends AppModel {

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
		'code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
      'isUnique'
		),
    'name' => 'notEmpty',
    'customer_id' => array(
      'notEmpty',
      'validateId' => array(
        'rule' => array('validateId', 'customer'),
        'message' => 'Invalid Customer'
      )
    ),
    'seller_id' => array(
      'notEmpty',
      'validateId' => array(
        'rule' => array('validateId', 'seller'),
        'message' => 'Invalid Sellers'
      )
    ),
    'area_id' => array(
      'notEmpty',
      'validateId' => array(
        'rule' => array('validateId', 'area'),
        'message' => 'Invalid Area'
      )
    ),
    'customer_buyer_code' => 'isUnique'
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
    'Seller' => array(
			'className' => 'Seller',
			'foreignKey' => 'seller_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
  
  public $hasOne = array(
    'Address' => array(
      'className' => 'Address',
      'foreignKey' => 'source_id',
      'dependent' => true,
      'conditions' => array(
        'Address.source_name' => 'buyers'
      )
    )
  );
  

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Itinerary' => array(
			'className' => 'Itinerary',
			'foreignKey' => 'buyer_id',
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
  public $validHeaders = array(
    'buyername',
    'clientbuyercode',
    'buyercode',
    'buyeraddress',
    'ittype',
    'contactnum',
    'contactperson',
    'areacode'
  );  
  
  public function beforeSave($options = array()){
    
    parent::beforeSave($options);
  }
  public function validateId($check, $table){
    $id = intval($check[$table.'_id']);
    $sql = "SELECT * FROM {$table}s WHERE id=".$id;
    $area = $this->query($sql);
    if($area){
      return true;
    }
    return false;
  }
  
}
