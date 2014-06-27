<?php

App::uses('OfficialReceipt', 'Model');

class OfficialReceiptHelper extends AppHelper {

  private $_constants;
  
  public function __construct(View $view, $settings = array()) {
    parent::__construct($view, $settings);
    $this->_constants['status'] = array(
      OfficialReceipt::RECEIVED => __('RECEIVED'),
      OfficialReceipt::DISPATCHED => __('DISPATCHED'),
      OfficialReceipt::REMMITED => __('REMMITED'),
      OfficialReceipt::BALANCE => __('BALANCE'),
      OfficialReceipt::RETURNED => __('RETURNED')
    );
    
  }
  
  public function getStatuses(){
    return $this->_constants['status'];
  }
  
  public function stringify($type, $value = null) {
    if (isset($this->_constants[$type])) {
      return $this->_constants[$type][$value];
    }
    else {
      return parent::stringify($type, $value);
    }
  }

}