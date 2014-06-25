<?php
App::uses('AppController', 'Controller');
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
        'Itinerary.trip_id !=' => null 
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
