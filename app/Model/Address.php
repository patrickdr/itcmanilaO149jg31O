<?php
App::uses('AppModel', 'Model');
/**
 * Address Model
 *
 */
class Address extends AppModel {
  
  public $validate = array(
    'source_id' => array(
      'UniqueAddress' => array(
        'rule' => 'UniqueAddress',
        'message' => "Invalid Entry of address"
      ),
      'notEmpty'
    )
  );
  
  public function UniqueAddress($check){
    $address = array();
    if(!isset($this->data['Address']['id']) || !$this->data['Address']['id']){
      $address = $this->find('first', array(
        'conditions' => array(
          'source_name' => $this->data['Address']['source_name'],
          'source_id' => $this->data['Address']['source_id']
        )
      ));
    }    
    if($address){
      return false;
    }
    return true;
  }
}
