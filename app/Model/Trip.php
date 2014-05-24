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
  
  public function afterSave($created, $options = array()){
    if(isset($this->data['Itinerary']['select']) && $this->data['Itinerary']['select']){
      $itineraryIds = array_filter($this->data['Itinerary']['select']);
      $tripAreas = array();
      if($itineraryIds){
        $itineraries = $this->Itinerary->find('all', array(
          'contain' => array('Buyer'),
          'conditions' => array(
            'Itinerary.id' => $itineraryIds
          )
        ));
        foreach($itineraries as &$itinerary){
          $itinerary['Itinerary']['trip_id'] = $this->data['Trip']['id'];
          $tripAreas['TripArea'][] = array(
            'area_id' => $itinerary['Buyer']['area_id'],
            'trip_id' => $this->data['Trip']['id']
          );
          $this->Itinerary->saveAssociated($itinerary, array('validate' => false));
        }
        $this->TripArea->saveAll($tripAreas['TripArea'], array('validate' => false));
      }
    }
    parent::afterSave($created, $options);
  }

}
