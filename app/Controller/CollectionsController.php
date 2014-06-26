<?php
App::uses('AppController', 'Controller');

App::uses('File', 'Utility');

/**
 * Collections Controller
 *
 * @property Collection $Collection
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CollectionsController extends AppController {

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
		//$this->Collection->recursive = 0;
    $this->loadModel('Itinerary');
    $this->paginate = array(
      'contain' => array(
        'Customer',
        'Seller',
        'SellerAffiliate',
        'Buyer',
        'Trip' => array(
          'Collector'
        ),
        'Collection' => array(
          'OfficialReceipt'
        )
      ),
      'conditions' => array(
        'Itinerary.trip_id !=' => null 
      )
    );
		$this->set('collections', $this->paginate('Itinerary'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Collection->exists($id)) {
			throw new NotFoundException(__('Invalid collection'));
		}
		$options = array('conditions' => array('Collection.' . $this->Collection->primaryKey => $id));
		$this->set('collection', $this->Collection->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Collection->create();
			if ($this->Collection->save($this->request->data)) {
				$this->Session->setFlash(__('The collection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.'));
			}
		}
		$officialReceipts = $this->Collection->OfficialReceipt->find('list');
		$collectors = $this->Collection->Collector->find('list');
		$this->set(compact('officialReceipts', 'collectors'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Collection->Itinerary->exists($id)) {
			throw new NotFoundException(__('Invalid collection'));
		}
    $collection = $this->Collection->Itinerary->find('first', array(
      'contain' => array(
        'Customer',
        'Seller',
        'SellerAffiliate',
        'Buyer',
        'Trip' => array(
          'Collector'
        ),
        'Collection' => array(
          'OfficialReceipt'
        )
      ),
      'conditions' => array(
        'Itinerary.trip_id !=' => null,
        'Itinerary.id' => $id
      )      
    ));
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Collection->save($this->request->data)) {
				$this->Session->setFlash(__('The collection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Collection.' . $this->Collection->primaryKey => $collection['Collection']['id']));
			$this->request->data = $this->Collection->find('first', $options);
		}
		$officialReceipts = $this->Collection->OfficialReceipt->find('list', array(
      'conditions' => array(
        'OfficialReceipt.status' => OfficialReceipt::DISPATCHED
      )
    ));
		$collectors = $this->Collection->Collector->find('list');
    $collectionTypes = $this->Collection->getCollectionTypes();
    $clearingTypeCodes = $this->Collection->getClearingTypes();
    $checkTypes = $this->Collection->getCheckTypes();
    $depositChannels = $this->Collection->getDepositChannels();
    $currencies = $this->Collection->getCurrencies();
		$this->set(compact('officialReceipts', 'collectors', 'collection', 'collectionTypes', 'clearingTypeCodes', 'checkTypes', 'depositChannels', 'currencies'));
	}
  
  public function admin_ppm($customerId = null){
    $this->loadModel('Customer');
    $this->autoRender = false;
    if (!$this->Customer->exists($customerId)) {
			throw new NotFoundException(__('Invalid collection'));
		}
    $collections = $this->Collection->Itinerary->find('all', array(
      'contain' => array(
        'Customer',
        'Seller',
        'SellerAffiliate' => array(
          'ParentSeller'
        ) ,
        'Buyer',
        'Trip' => array(
          'Collector'
        ),
        'Collection' => array(
          'OfficialReceipt'
        )
      ),
      'conditions' => array(
        'Itinerary.customer_id' => $customerId
      )      
    ));    
    //SBdump($collections); exit;
    $depositChannels = $this->Collection->getDepositChannels();
    $currencies = $this->Collection->getCurrencies();
    $clearingTypeCodes = $this->Collection->getClearingTypes();
    $file = new File( REPORTS_DIR . DS .'ppm' . DS . time().'.txt', true);
    $string = "";
    foreach($collections as $collection){
      if(isset($collection['Collection']['id']) && $collection['Collection']['id']){
        $seller = ($collection['SellerAffiliate']['ParentSeller']['code']) ? $collection['SellerAffiliate']['ParentSeller']['code'] : $collection['Seller']['code'];
        $string .= str_pad("1", 10, " ", STR_PAD_RIGHT);
        $string .= str_pad($collection['Collection']['check_number'], 20, " ", STR_PAD_LEFT); 
        $string .= str_pad("CHK", 10, " ", STR_PAD_LEFT); 
        $string .= str_pad($collection['Collection']['check_amount'], 20, "0", STR_PAD_LEFT); 
        $string .= date('dmY', strtotime($collection['Collection']['check_date']));
        $string .= date('dmY', strtotime($collection['Collection']['deposit_date']));
        $string .= str_pad($seller , 30, " ", STR_PAD_LEFT); 
        $string .= date('dmY', strtotime($collection['Collection']['check_pickup_date']));
        $string .= str_pad($depositChannels[$collection['Collection']['deposit_channel']], 30, " ", STR_PAD_RIGHT);
        $string .= str_pad(" ", 30, " ", STR_PAD_RIGHT);
        $string .= str_pad($currencies[$collection['Collection']['currency']], 30, " ", STR_PAD_LEFT);
        $string .= str_pad($clearingTypeCodes[$collection['Collection']['clearing_type_code']], 30, " ", STR_PAD_LEFT);
        $string .= str_pad($collection['Collection']['drawee_bank_code'], 30, " ", STR_PAD_LEFT);
        $string .= str_pad($collection['Collection']['drawee_bank_branch_code'], 30, " ", STR_PAD_LEFT);
        $string .= "\n";
        
      }
    }
    $file->write($string);
    $file->close();
  }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Collection->id = $id;
		if (!$this->Collection->exists()) {
			throw new NotFoundException(__('Invalid collection'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Collection->delete()) {
			$this->Session->setFlash(__('The collection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The collection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
