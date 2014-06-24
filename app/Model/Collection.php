<?php
App::uses('AppModel', 'Model');
/**
 * Collection Model
 *
 * @property OfficialReceipt $OfficialReceipt
 * @property Collector $Collector
 */
class Collection extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'OfficialReceipt' => array(
			'className' => 'OfficialReceipt',
			'foreignKey' => 'official_receipt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Collector' => array(
			'className' => 'Collector',
			'foreignKey' => 'collector_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
