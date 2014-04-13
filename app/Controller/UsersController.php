<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
  
  
  function beforeFilter(){
    parent::beforeFilter();
    //$this->Auth->allow();
  }

	/*
	*Administrator's view login
	*
	*/
	public function admin_login(){
		debug($this->Auth->user());
		if($this->request->data){
			if($this->_isAdmin($this->request->data['User']['username'])){
				if($this->Auth->login()){
          
					$this->Auth->login($this->request->data);
					$this->Session->write('User.user_type', 'admin');
					$user = $this->getCurrentUser();
					$this->Session->write('User.user_id', $user['id']);
					if(isset($this->request->data['User']['remember']) && $this->request->data['User']['remember']){
						$this->Cookie->write('Auth.user', $this->Auth->user(), true, 1209600 );
					}
					if ($this->Session->check('Auth.redirect')){
						$this->redirect($this->Session->read('Auth.redirect'));
					}
					else{
						$this->redirect(array('controller' => 'users', 'action' => 'admin_index'));
					}					
				}
			}
			else{
				debug($this->Session->read('User.user_type'));
				$this->Session->setFlash(__('Invalid Username or Password'));
			}
		}
	}
	public function admin_logout() {
			$this->Session->delete('User.user_id');
			$this->Session->delete('User.user_id');
			$this->Cookie->delete('Auth.user');
			$this->redirect($this->Auth->logout());
			
	}  
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
    $userTypes = array();
    $userTypes = $this->User->UserType->find('list');
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
    $this->set(compact('userTypes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
