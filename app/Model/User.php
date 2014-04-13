<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	//Validation
  public $belongsTo = array(
		'UserType' => array(
			'className' => 'UserType',
			'foreignKey' => 'user_type_id',
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
	public $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Alphabets, Numbers and Underscore only.'
			),
			'between' => array(
                'rule' => array('between', 8, 45),
                'message' => 'Between 8 to 45 characters'
            ),
			'isUnique' => array(
				'rule'=>'isUnique',
				'message' => 'Username is not available.'
			)
		),
		'password' => array(
			'between' => array(
				'rule' => array('between', 8, 45),
				'message' => 'Between 8 to 45 characters'
			),
			// 'confirmPasswords' => array(
				// 'rule' => array('confirmPasswords'),
				// 'message' => 'Passwords do not match'
			// ),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please a valid password'
			)
		),
		// 'confirm_email' => 'notEmpty',
		// 'valid_age' => array(
			// 'rule'    => array('comparison', 'equal to', 1),
			// 'message' => 'You should be 18 years old and above'
		// ),
		// 'confirm_password' => 'notEmpty',
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Email address is not valid.'
			),
			'isUnique' => array(
				'rule'=>'isUnique',
				'message' => 'Email address is not available.'
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a valid email'
			),
			// 'confirmEmails' => array(
				// 'rule' => array('confirmEmails'),
				// 'message' => 'Email addresses do not match'
			// )
		)
	);
  /**
  * Custom Validation functions
  *
  */
	public function confirmPasswords($check) {
		return strcmp((string) reset($check), $this->data['User']['confirm_password']) == 0;
	}
	
	public function confirmEmails($check) {
		return strcmp((string) reset($check), $this->data['User']['confirm_email']) == 0;
	}
	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}       
		return true;
	}  
}
