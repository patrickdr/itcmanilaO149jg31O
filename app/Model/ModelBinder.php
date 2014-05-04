<?php

/**
 * @todo Move to utilities?
 */
App::uses('ClassRegistry', 'Utility');

interface iModelBinder extends Object {
  /**
   * Works like Controller::uses. 
   */
  public $uses = array(),
         $useAll = false;

  public function __isset($name) {
    return $this->_isset($name);
  }

  public function __get($name) {    
    if ($this->_isset($name)) {
      return $this->loadModel($name);
    }
  }

  protected function loadModel($name) {
    return ($this->{$name} = ClassRegistry::init($name));
  }

  private function _isset($name) {
    return $this->useAll || (in_array($name, $this->uses) && App::import('Model', $name));
  }
}