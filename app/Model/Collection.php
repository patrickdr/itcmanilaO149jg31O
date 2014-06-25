<?php
App::uses('AppModel', 'Model');
/**
 * Collection Model
 *
 * @property OfficialReceipt $OfficialReceipt
 * @property Collector $Collector
 */
class Collection extends AppModel {

  const TYPE_FOR_CREDIT = 1,
        TYPE_FOR_DEPOSIT = 2,
        TYPE_VIA_EDI_PAYMENT = 3,
        
        CHECK_CDC = 1,
        CHECK_PDC = 2,
        
        CURRENCY_USD = 1,
        CURRENCY_PHP = 2,
        
        DP_CHANNEL_CTBMNL = 1,
        DP_CHANNEL_BDU = 2,
        
        CLEARING_TYPE_LOC = 1,
        CLEARING_TYPE_RG1 = 2,
        CLEARING_TYPE_ICL = 3,
        CLEARING_TYPE_CFC = 4,
        CLEARING_TYPE_OUS = 5;
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
		),
    'Itinerary' => array(
			'className' => 'Itinerary',
			'foreignKey' => 'itinerary_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
  
  public function getCollectionTypes(){
    return array(
      self::TYPE_FOR_CREDIT => "For Credit",
      self::TYPE_FOR_DEPOSIT => 'For Deposit',
      self::TYPE_VIA_EDI_PAYMENT => 'Via EDI Payment'
    );
  }
  
  public function getClearingTypes(){
    return array(
      self::CLEARING_TYPE_CFC => 'CFC',
      self::CLEARING_TYPE_ICL => 'ICL',
      self::CLEARING_TYPE_LOC => 'LOC',
      self::CLEARING_TYPE_OUS => 'OUS',
      self::CLEARING_TYPE_RG1 => 'RG1'
    );
  }
  
  public function getDepositChannels(){
    return array(
      self::DP_CHANNEL_BDU => "DBU",
      self::DP_CHANNEL_CTBMNL => "CTBMNL"
    );
  }
  
  public function getCheckTypes(){
    return array(
      self::CHECK_CDC => 'CDC',
      self::CHECK_PDC => 'PDC'
    );
  }
  
  public function getCurrencies(){
    return array(
      self::CURRENCY_PHP => 'PHP',
      self::CURRENCY_USD => 'USD'
    );
  }
  
  public function afterFind($results, $primary = false){
    if($results){
      foreach($results as &$result){
        if(isset($result['Collection']['official_receipt_id']) && $result['Collection']['official_receipt_id']){
          $this->OfficialReceipt->recursive = -1;
          $OR = $this->OfficialReceipt->findById($result['Collection']['official_receipt_id']);
          $result['Collection']['or'] = $OR['OfficialReceipt']['or_number'];
        }
      }

    }
    return $results;
  }
  
  public function beforeSave($options = array()){
    
    if(isset($this->data['Collection']['or']) && $this->data['Collection']['or']){
      $or = $this->data['Collection']['or'];
      $this->OfficialReceipt->recursive = -1;
      $officialReceipt = $this->OfficialReceipt->findByOrNumber($or);
      if($officialReceipt){
        $orId = $officialReceipt['OfficialReceipt']['id'];
        $this->data['Collection']['official_receipt_id'] = $orId;
      }
    }
    return true;
  }
}
