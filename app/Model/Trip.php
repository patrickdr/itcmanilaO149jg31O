<?php
App::uses('AppModel', 'Model');
/**
 * Trip Model
 *
 * @property Collector $Collector
 * @property Itinerary $Itinerary
 */
class Trip extends AppModel {


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
			'foreignKey' => 'trip_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
    'TripArea' => array(
			'className' => 'TripArea',
			'foreignKey' => 'trip_id',
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

}
