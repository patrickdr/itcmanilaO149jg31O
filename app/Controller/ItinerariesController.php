<?php
App::uses('AppController', 'Controller');
/**
 * Itineraries Controller
 *
 * @property Itinerary $Itinerary
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ItinerariesController extends AppController {

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
		$this->Itinerary->recursive = 0;
    $this->paginate = array(
      'contain' => array(        
        'Buyer',
        'SellerAffiliate' => array(
          'ParentSeller'
        )        
      )
    );
		$this->set('itineraries', $this->paginate('Itinerary'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Itinerary->exists($id)) {
			throw new NotFoundException(__('Invalid itinerary'));
		}
		$options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $id));
		$this->set('itinerary', $this->Itinerary->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Itinerary->create();
			if ($this->Itinerary->save($this->request->data)) {
				$this->Session->setFlash(__('The itinerary has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The itinerary could not be saved. Please, try again.'));
			}
		}
		$buyers = $this->Itinerary->Buyer->find('list');
		$trips = $this->Itinerary->Trip->find('list');
		$this->set(compact('buyers', 'trips'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Itinerary->exists($id)) {
			throw new NotFoundException(__('Invalid itinerary'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Itinerary->save($this->request->data)) {
				$this->Session->setFlash(__('The itinerary has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The itinerary could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $id));
			$this->request->data = $this->Itinerary->find('first', $options);
		}
		$buyers = $this->Itinerary->Buyer->find('list');
		$trips = $this->Itinerary->Trip->find('list');
		$this->set(compact('buyers', 'trips'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Itinerary->id = $id;
		if (!$this->Itinerary->exists()) {
			throw new NotFoundException(__('Invalid itinerary'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Itinerary->delete()) {
			$this->Session->setFlash(__('The itinerary has been deleted.'));
		} else {
			$this->Session->setFlash(__('The itinerary could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
  
  public function admin_upload(){
    
    $data = new Spreadsheet_Excel_Reader();
    // Set output Encoding.
    $data->setOutputEncoding('CP1251');
    $customers = $this->Itinerary->Buyer->Customer->find('list');
    $sellers = array();
    $customerId = isset($this->request->query['customer_id']) ? $this->request->query['customer_id'] : "";
    $sellerId = isset($this->request->query['seller_id']) ? $this->request->query['seller_id'] : "";
    $cells = array();
    $sellerAffiliates = array();
    if($customerId){
      $sellers = $this->Itinerary->Buyer->Seller->findSellers('list', array(
        'conditions' => array(
          'Seller.customer_id' => $customerId,
        )
      ));
      
      if($sellerId){
        $sellerAffiliates = $this->Itinerary->Buyer->Seller->find('list', array(
          'conditions' => array(
            'Seller.customer_id' => $customerId,
            'Seller.seller_id' => $sellerId
          )
        ));        
      }
    }      
    if($this->request->is('post')){
      $dr = &$this->request->data['Itinerary']['date_received'];
      $dateReceived = $dr['year']."-".$dr['month']."-".$dr['day'];
      $dateReceived = date('Y-m-d H:i:s', strtotime($dateReceived));
      $data->read($this->request->data['Itinerary']['file']['tmp_name']);
      $headers = isset($data->sheets[0]['cells'][2]) ? $data->sheets[0]['cells'][2] : array();
      foreach($headers as &$header){
        $header = strtolower(Inflector::slug($header));
      }
      if(isset($data->sheets[0]['cells']) && $this->_validateBuyerExcel($headers, $this->Itinerary->validHeaders)){
        $cells = $data->sheets[0]['cells'];
        $h = $this->Itinerary->validHeaders;
        $saved = 0;
        $notSaved = 0;
        foreach($cells as $key => $value){          
          if($key > 2){
            $data = array('Itinerary' => array());
            $toPush = array();
            $buyer = $this->Itinerary->Buyer->findByBuyerCode($value[4]);
            if($buyer){
              // Todo later
              $toPush['buyer_id'] = $buyer['Buyer']['id'];
            }
            $toPush['trip_type'] = isset($value[12]) ? $value[12] : "";
            $toPush['remarks'] = isset($value[6]) ? $value[6] : "";
            $toPush['contact_person'] = isset($value[7]) ? $value[7] : "";
            $toPush['contact_number'] = isset($value[8]) ? $value[8] : "";
            $toPush['date_received'] = $dateReceived;
            //Address Model
            $data['Address']['address'] = isset($value[10]) ? $value[10] : "";
            $data['Address']['source_name'] = 'itineraries';
            
            // This will save to Itinerary table
            $toPush['requestor'] = isset($value[11]) ? $value[11] : "";
            $toPush['amount'] = isset($value[9]) ? $value[9] : "";
            $toPush['mm_provl'] = isset($value[13]) ? $value[13] : "";
            // If seller affiliate is available, seller will be saved as an affiliate
            $toPush['seller_id'] = ($this->request->data['Itinerary']['seller_affiliate']) ? $this->request->data['Itinerary']['seller_affiliate'] : $this->request->data['Itinerary']['seller_id'];
            $toPush['customer_id'] = $this->request->data['Itinerary']['customer_id'];
            $toPush['itinerary_number'] = $this->request->data['Itinerary']['itinerary_number'];
            
            // Save associated models for itineraries
            $data['Itinerary'] = $toPush;
            $this->Itinerary->set($data);
            if($this->Itinerary->saveAssociated()){
              $saved++;
            }
            else{
              $notSaved++;
            }
          }
        }
        exit;
        if($saved && !$notSaved){
          $this->Session->setFlash(__("All Itineraries are saved."));
          
        }
        else if($saved && $notSaved){
          $this->Session->setFlash(__("Itineraries has been saved but some are not saved."));
        } 
        else if(!$saved && $notSaved){
          
          $this->Session->setFlash(__("Itineraries could not be saved."));
          return $this->redirect(array('action' => 'upload'));
        }
        return $this->redirect(array('action' => 'index'));
      }
    }
    $this->set(compact('customers', 'sellers', 'customerId', 'sellerAffiliates'));
  }
}
