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
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
		)
	);
  
  public $hasOne = array(
    'Address' => array(
      'className' => 'Address',
      'foreignKey' => 'source_id',
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
			'dependent' => false,
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
  
  public function beforeSave(){
    
    parent::beforeSave();
  }

}
