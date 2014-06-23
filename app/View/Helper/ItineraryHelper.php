<?php

App::import('Model', 'Itinerary');

class ItineraryHelper extends AppHelper {
  
  private $_constants;
  
  public function __construct(View $view, $settings = array()){
    parent::__construct($view, $settings);
    $this->_constants = array_fill_keys(array('results'), array());
    
    $itinerary = new Itinerary();
    $this->_constants['results'] = $itinerary->getResultStatuses();
  }
  
  public function stringify($type, $value = null) {
    if (isset($this->_constants[$type])) {
      if(isset($this->_constants[$type][$value])){
        return $this->_constants[$type][$value];
      }
      return "N/A";
    }
    else {
      return parent::stringify($type, $value);
    }
  }  
}