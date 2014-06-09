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
		if ($this->request->is('post')) {
			
      $start = $this->request->data['OfficialReceipt']['from'];
      $end = $this->request->data['OfficialReceipt']['to'];
      $status = $this->request->data['OfficialReceipt']['status'];
      $seller = $this->request->data['OfficialReceipt']['seller_id'];
      $customer = $this->request->data['OfficialReceipt']['customer_id'];
      $collector = $this->request->data['OfficialReceipt']['collector_id'];
      $length = strlen($start);
      $prefix = $this->request->data['OfficialReceipt']['prefix'];
         
      for($x = $start; $x <= $end; $x++){
        $newOrs = array(
          'status' => $status,
          'seller_id' => $seller,
          'collector_id' => $collector,
          'customer_id' => $customer
        );
        $ORs[] = &$newOrs;   
        if(strlen($x) == $length){
          $newOrs += array(
            'or_number' => (($prefix) ? $prefix : "" ). $x,
          );
        }
        else{
          $or = str_pad((string)$x, $length, "0", STR_PAD_LEFT);
          $newOrs += array(
            'or_number' => (($prefix) ? $prefix : "" ). $or,
          );
        }
        
      }
      $this->OfficialReceipt->saveAll($ORs);
		}
		$collectors = $this->OfficialReceipt->Collector->find('list');
		$sellers = $this->OfficialReceipt->Seller->find('list');
		$customers = $this->OfficialReceipt->Customer->find('list');
    $statuses = $this->OfficialReceipt->getStatuses();
		$this->set(compact('collectors', 'sellers', 'customers', 'statuses'));
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
