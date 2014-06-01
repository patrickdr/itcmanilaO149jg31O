<?php
App::uses('AppController', 'Controller');
/**
 * Sellers Controller
 *
 * @property Seller $Seller
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SellersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Seller->recursive = 0;
    $this->paginate = array(          
      'conditions' => array(
          'Seller.seller_id' => null
      )
    );      
    $this->set('affiliate', false);
		$this->set('sellers', $this->paginate('Seller'));
	}
	public function admin_affiliates() {
    $this->view = 'admin_index';
		$this->Seller->recursive = 0;
    $this->paginate = array(          
      'conditions' => array(
          'Seller.seller_id !=' => null
      )
    ); 
    $this->set('affiliate', true);
		$this->set('sellers', $this->paginate('Seller'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Seller->exists($id)) {
			throw new NotFoundException(__('Invalid seller'));
		}
		$options = array('conditions' => array('Seller.' . $this->Seller->primaryKey => $id));
		$this->set('seller', $this->Seller->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Seller->create();
			if ($this->Seller->save($this->request->data)) {
				$this->Session->setFlash(__('The seller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seller could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Seller->Customer->find('list');
		$areas = $this->Seller->Area->find('list');
		$sellers = $this->Seller->find('list');
		$this->set(compact('customers', 'areas', 'sellers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Seller->exists($id)) {
			throw new NotFoundException(__('Invalid seller'));
		}
		if ($this->request->is(array('post', 'put'))) {
      $address = $this->Seller->Address->find('first', array(
        'conditions' => array(
          'Address.source_id' => $this->request->data['Seller']['id'],
          'Address.source_name' => 'sellers'
        ),
        'fields' => array('Address.id', 'Address.source_id', 'Address.source_name')
      ));
      if($address){
        $this->request->data['Address'] += $address['Address'];
      }
      else{
        $this->request->data['Address'] += array('source_name' => 'sellers');
      }
			if ($this->Seller->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The seller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seller could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Seller.' . $this->Seller->primaryKey => $id));
			$this->request->data = $this->Seller->find('first', $options);
		}
		$customers = $this->Seller->Customer->find('list');
		$areas = $this->Seller->Area->find('list');
		$sellers = $this->Seller->find('list', array('conditions' => array('Seller.id !=' => $id)));
		$this->set(compact('customers', 'areas', 'sellers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Seller->id = $id;
		if (!$this->Seller->exists()) {
			throw new NotFoundException(__('Invalid seller'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Seller->delete()) {
			$this->Session->setFlash(__('The seller has been deleted.'));
		} else {
			$this->Session->setFlash(__('The seller could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
