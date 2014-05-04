<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::import('Vendor', 'Spreadsheet_Excel_Reader', array('file' => 'Excel/reader.php'));

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $_isUserAdmin = false;
	
	public $components = array(
		'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'login'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
        ), 
		'Session',
		'Cookie'
	);
	function beforeRender(){
		parent::beforeRender();
		if($this->Cookie->read('Auth.user')){
			$this->Auth->login($this->Cookie->read('Auth.user'));
		}
		$user = $this->Auth->user();
		if ($this->params['prefix'] == 'admin' && $user){
			$this->loadModel('User');
			$admin_count = $this->User->find('count', array(
          'conditions' => array(
            'User.username' => $user['User']['username'],
            'User.user_type_id' => 1,
            'User.status' => 1
          ),
          'recursive' => -1
				)
			);
			if(!$admin_count){        
				$this->redirect('/');
			} else if(!$user){
				$this->redirect('/users/logout');
			}	
		}
    else {
      return $this->isAuthorized();
    }
	}

    function beforeFilter() {
      parent::beforeFilter();
      if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
          //$this->layout = 'admin';
      } 
    }
    
    
	

	public function isAuthorized($user = null) 
	{  
		return true;
	}
	
	protected function getCurrentUser(){
		$user = $this->Auth->user();
		if($user){
			$this->loadModel('User');
			$currUser = $this->User->find('first', array(
								'conditions' => array(
									'User.username' => $user['User']['username'],
									'User.status' => 1
								),
								'recursive' => -1
								)
						);
			return $currUser['User'];
		}
		return null;
	}  
	protected function _isAdmin($user =null){
		if($user == null){
			if(!$users){return false;}
			$user = $users['username'];
		}
		$count = $this->User->find('count', array(
			'conditions' => array(
				'User.username' => $user,
				'User.user_type_id'=>1
			), //array of conditions
			'recursive' => -1
		));
		if($count){
			return true;
		}
		return false;
	}  
  /**
  * Validate excel file
  */
  protected function _validateBuyerExcel($headers = array(), $validHeaders = array()){     
    if(count($headers) != count($validHeaders)){ 
      return false;
    }    
    foreach($headers as $key => $header){
      $check = strpos(strtolower($header), $validHeaders[$key-1]);
      if($check === false){
        return false;
      }
    }
    return true;
  }  
}
