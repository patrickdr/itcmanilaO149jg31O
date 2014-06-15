<?php
App::uses('AppController', 'Controller');
/**
 * OfficialReceipts Controller
 *
 * @property OfficialReceipt $OfficialReceipt
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OfficialReceiptsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
  public $helpers = array('OfficialReceipt');
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->OfficialReceipt->recursive = 0;
		$this->set('officialReceipts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->OfficialReceipt->exists($id)) {
			throw new NotFoundException(__('Invalid official receipt'));
		}
		$options = array('conditions' => array('OfficialReceipt.' . $this->OfficialReceipt->primaryKey => $id));
		$this->set('officialReceipt', $this->OfficialReceipt->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
    $sellers = array();
    $customerId = null;
    $sellerAffiliates = array();
    $sellerId = null;
    if(isset($this->request->query['customer_id'])){
      $customerId = $this->request->query['customer_id'];
      $sellers = $this->OfficialReceipt->Seller->find('list', array(
        'conditions' => array(
          'Seller.customer_id' => $customerId,
          'Seller.seller_id' => ""
        )
      ));
    }
    if(isset($this->request->query['seller_id'])){
      $sellerId = $this->request->query['seller_id'];
      $sellerAffiliates = $this->OfficialReceipt->Seller->find('list', array(
        'conditions' => array(
          'Seller.seller_id' => $sellerId,
          'Seller.customer_id' => $customerId
        )
      ));
    }
		if ($this->request->is('post')) {
      $start = $this->request->data['OfficialReceipt']['from'];
      $end = $this->request->data['OfficialReceipt']['to'];
      $status = $this->request->data['OfficialReceipt']['status'];
      $seller = $this->request->data['OfficialReceipt']['seller_id'];
      $sellerAffiliate = $this->request->data['OfficialReceipt']['seller_affiliate'];
      $customer = $this->request->data['OfficialReceipt']['customer_id'];
      //$collector = $this->request->data['OfficialReceipt']['collector_id'];
      $length = strlen($start);
      $prefix = $this->request->data['OfficialReceipt']['prefix'];
      $ORs = array();
         
      for($x = $start; $x <= $end; $x++){
        $newOR = array(
          'status' => $status,
          'seller_id' => $seller,
          'seller_affiliate_id' => $sellerAffiliate,
          'customer_id' => $customer,
          'date_received' => $this->request->data['OfficialReceipt']['date_received']
        );
           
        if(strlen($x) == $length){
          $newOR += array(
            'or_number' => (($prefix) ? $prefix : "" ). $x,
          );
        }
        else{
          $or = str_pad((string)$x, $length, "0", STR_PAD_LEFT);
          $newOR += array(
            'or_number' => (($prefix) ? $prefix : "" ). $or,
          );
        }
        if($this->_validateOR($newOR)){
          $ORs[] = $newOR;
        }
      }
      if($ORs){
        $this->OfficialReceipt->saveAll($ORs);
        $this->Session->setFlash(count($ORs) . " official receipts has been saved.");
        $this->redirect(array('action' => 'index'));
      }
      else{
        $this->Session->setFlash("No official receipts has been saved.");
      }
		}
		
		$customers = $this->OfficialReceipt->Customer->find('list');
    $statuses = $this->OfficialReceipt->getStatuses();
		$this->set(compact('collectors', 'sellers', 'customers', 'statuses', 'customerId', 'sellerId', 'sellerAffiliates'));
	}
  
  public function admin_dispatch(){
    $sellers = array();
    $customerId = null;
    $sellerAffiliates = array();
    $sellerId = null;
    $ORs = array();
    if(isset($this->request->query['customer_id'])){
      $customerId = $this->request->query['customer_id'];
      $sellers = $this->OfficialReceipt->Seller->find('list', array(
        'conditions' => array(
          'Seller.customer_id' => $customerId,
          'Seller.seller_id' => ""
        )
      ));
    }
    if(isset($this->request->query['seller_id'])){
      $sellerId = $this->request->query['seller_id'];
      $sellerAffiliates = $this->OfficialReceipt->Seller->find('list', array(
        'conditions' => array(
          'Seller.seller_id' => $sellerId,
          'Seller.customer_id' => $customerId
        )
      ));
    }
		if ( $this->request->query) {
      $data = $this->request->query;
      $conditions = array();
      foreach($data as $key => $value){
        if($key != "prefix" && $key != "from" && $key != "to"){
          if($value){
            if($key == 'date_received'){
              $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
            }
            $conditions['OfficialReceipt.' . $key] = $value;
          }
        }
      }
      $ORfind = array();
      if((isset($data['from']) && $data['from']) || (isset($data['to']) && $data['to'])){
        $prefix = $data['prefix'];
        $length = strlen($data['from']);
        if(intval($data['to'])){
          for($x = intval($data['from']); $x <= intval($data['to']); $x ++){
            if(strlen($x) == $length){
              $ORfind[] = (($prefix) ? $prefix : "" ). $x;
            }
            else{
              $ORfind[] = (($prefix) ? $prefix : "" ) . str_pad((string)$x, $length, "0", STR_PAD_LEFT);
            }            
          }
        }
        else if(intval($data['from'])){ 
          $ORfind[] = (($prefix) ? $prefix : "" ). $data['from'];
        }
      }
      if($ORfind){
        $conditions['OfficialReceipt.or_number'] = $ORfind;
      }
      $ORs = $this->OfficialReceipt->find('all',array(
        'conditions' => array(
          'OfficialReceipt.status' => OfficialReceipt::RECEIVED
        ) + $conditions
      ));
		}
    if($this->request->is('post')){
      $post = $this->request->data['ORDispatch'];
      $toSave = array(); 
      foreach($post['id'] as $id){
        if($id){
          $toSave[] = array(
            'id' => $id,
            'collector_id' => $post['collector_id'],
            'status' => OfficialReceipt::DISPATCHED
          );
        }
      }
      if($toSave){
        $this->OfficialReceipt->saveAll($toSave);
        $this->Session->setFlash("Selected OR(s) has been dispatched");
        $this->redirect(array('action' => 'index'));
      }
      else{
        $this->Session->setFlash("No OR(s) to save.");
      }
    }
		$collectors = $this->OfficialReceipt->Collector->find('list');
		$customers = $this->OfficialReceipt->Customer->find('list');
    $statuses = $this->OfficialReceipt->getStatuses();
		$this->set(compact('collectors', 'sellers', 'customers', 'statuses', 'customerId', 'sellerId', 'sellerAffiliates', 'ORs'));  
  }
  
  
  public function admin_remit(){
    $sellers = array();
    $customerId = null;
    $sellerAffiliates = array();
    $sellerId = null;
    $ORs = array();
    if(isset($this->request->query['customer_id'])){
      $customerId = $this->request->query['customer_id'];
      $sellers = $this->OfficialReceipt->Seller->find('list', array(
        'conditions' => array(
          'Seller.customer_id' => $customerId,
          'Seller.seller_id' => ""
        )
      ));
    }
    if(isset($this->request->query['seller_id'])){
      $sellerId = $this->request->query['seller_id'];
      $sellerAffiliates = $this->OfficialReceipt->Seller->find('list', array(
        'conditions' => array(
          'Seller.seller_id' => $sellerId,
          'Seller.customer_id' => $customerId
        )
      ));
    }
		if ( $this->request->query) {
      $data = $this->request->query;
      $conditions = array();
      foreach($data as $key => $value){
        if($key != "prefix" && $key != "from" && $key != "to"){
          if($value){
            if($key == 'date_received'){
              $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
            }
            $conditions['OfficialReceipt.' . $key] = $value;
          }
        }
      }
      $ORfind = array();
      if((isset($data['from']) && $data['from']) || (isset($data['to']) && $data['to'])){
        $prefix = $data['prefix'];
        $length = strlen($data['from']);
        if(intval($data['to'])){
          for($x = intval($data['from']); $x <= intval($data['to']); $x ++){
            if(strlen($x) == $length){
              $ORfind[] = (($prefix) ? $prefix : "" ). $x;
            }
            else{
              $ORfind[] = (($prefix) ? $prefix : "" ) . str_pad((string)$x, $length, "0", STR_PAD_LEFT);
            }            
          }
        }
        else if(intval($data['from'])){ 
          $ORfind[] = (($prefix) ? $prefix : "" ). $data['from'];
        }
      }
      if($ORfind){
        $conditions['OfficialReceipt.or_number'] = $ORfind;
      }      
      $ORs = $this->OfficialReceipt->find('all',array(
        'conditions' => array(
          'OfficialReceipt.status' => OfficialReceipt::DISPATCHED
        ) + $conditions
      ));
		}
    if($this->request->is('post')){
      $post = $this->request->data['ORDispatch'];
      $toSave = array(); 
      foreach($post['id'] as $id){
        if($id){
          $toSave[] = array(
            'id' => $id,
            'status' => OfficialReceipt::REMMITED
          );
        }
      }
      if($toSave){
        $this->OfficialReceipt->saveAll($toSave);
        $this->Session->setFlash("Selected OR(s) has been remitted");
        $this->redirect(array('action' => 'index'));
      }
      else{
        $this->Session->setFlash("No OR(s) to remit.");
      }
    }
		$collectors = $this->OfficialReceipt->Collector->find('list');
		$customers = $this->OfficialReceipt->Customer->find('list');
    $statuses = $this->OfficialReceipt->getStatuses();
		$this->set(compact('collectors', 'sellers', 'customers', 'statuses', 'customerId', 'sellerId', 'sellerAffiliates', 'ORs'));  
  }
  
  private function _validateOR($OR){
    $ORcount = $this->OfficialReceipt->find('count', array(
      'conditions' => array(
        'OfficialReceipt.or_number' => $OR['or_number'],
        'OfficialReceipt.seller_id' => $OR['seller_id'],
        'OfficialReceipt.customer_id' => $OR['customer_id']
      )
    ));
    if($ORcount){
      return false;
    }
    return true;
  }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->OfficialReceipt->exists($id)) {
			throw new NotFoundException(__('Invalid official receipt'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OfficialReceipt->save($this->request->data)) {
				$this->Session->setFlash(__('The official receipt has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The official receipt could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OfficialReceipt.' . $this->OfficialReceipt->primaryKey => $id));
			$this->request->data = $this->OfficialReceipt->find('first', $options);
		}
		$collectors = $this->OfficialReceipt->Collector->find('list');
		$sellers = $this->OfficialReceipt->Seller->find('list');
		$customers = $this->OfficialReceipt->Customer->find('list');
		$this->set(compact('collectors', 'sellers', 'customers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->OfficialReceipt->id = $id;
		if (!$this->OfficialReceipt->exists()) {
			throw new NotFoundException(__('Invalid official receipt'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OfficialReceipt->delete()) {
			$this->Session->setFlash(__('The official receipt has been deleted.'));
		} else {
			$this->Session->setFlash(__('The official receipt could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
