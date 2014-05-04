<?php
App::uses('AppController', 'Controller');
/**
 * Buyers Controller
 *
 * @property Buyer $Buyer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BuyersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
  private $_h = array(
    1 => 'name',
    2 => 'code', // client buyer code
    3 => 'customer_buyer_code', // citi buyer code
    4 => 'address',
    5 => 'it_type',
    6 => 'contact_number',
    7 => 'contact_person',
    8 => 'area_id',
  );

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Buyer->recursive = 0;
    $customers = $this->Buyer->Customer->find('list');
    $sellers = array();
    $conditions = array();
    if(isset($this->request->query['customer_id']) && $this->request->query['customer_id']){
      $sellers = $this->Buyer->Seller->find('list', array('conditions' => array('Seller.customer_id' => $this->request->query['customer_id'])));
      $conditions['Buyer.customer_id'] = $this->request->query['customer_id'];
    }
    if(isset($this->request->query['seller_id']) && $this->request->query['seller_id']){
      $conditions['Buyer.seller_id'] = $this->request->query['seller_id'];      
    }
    if(isset($this->request->query['name']) && $this->request->query['name']){
      $conditions['Buyer.name LIKE'] = "%".$this->request->query['name']."%";      
    }
    $this->set(compact('customers', 'sellers'));
    $this->paginate = array(
      'conditions' => $conditions,
      'limit' => 30
    );
		$this->set('buyers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Buyer->exists($id)) {
			throw new NotFoundException(__('Invalid buyer'));
		}
		$options = array('conditions' => array('Buyer.' . $this->Buyer->primaryKey => $id));
		$this->set('buyer', $this->Buyer->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Buyer->create();
			if ($this->Buyer->save($this->request->data)) {
				$this->Session->setFlash(__('The buyer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The buyer could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Buyer->Customer->find('list');
		$areas = $this->Buyer->Area->find('list');
		$this->set(compact('customers', 'areas'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Buyer->exists($id)) {
			throw new NotFoundException(__('Invalid buyer'));
		}
    
		if ($this->request->is(array('post', 'put'))) {
      $address = $this->Buyer->Address->find('first', array(
        'conditions' => array(
          'Address.source_id' => $this->request->data['Buyer']['id'],
          'Address.source_name' => 'buyers'
        ),
        'fields' => array('Address.id', 'Address.source_id', 'Address.source_name')
      ));
      if($address){
        $this->request->data['Address'] += $address['Address'];
      }
      else{
        $this->request->data['Address'] = array('source_name' => 'buyers');
      }
			if ($this->Buyer->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The buyer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The buyer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Buyer.' . $this->Buyer->primaryKey => $id));
			$this->request->data = $this->Buyer->find('first', $options);
		}
		$customers = $this->Buyer->Customer->find('list');
		$areas = $this->Buyer->Area->find('list');
		$this->set(compact('customers', 'areas'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Buyer->id = $id;
		if (!$this->Buyer->exists()) {
			throw new NotFoundException(__('Invalid buyer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Buyer->delete()) {
			$this->Session->setFlash(__('The buyer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The buyer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
  
  public function admin_upload(){
    $data = new Spreadsheet_Excel_Reader();
    // Set output Encoding.
    $data->setOutputEncoding('CP1251');
    $customers = $this->Buyer->Customer->find('list');
    $areas = $this->Buyer->Area->find('list', array('fields' => array('Area.code', 'Area.id')));
    $sellers = array();
    $customerId = isset($this->request->query['customer_id']) ? $this->request->query['customer_id'] : "";
    $cells = array();
    if($customerId){
      $sellers = $this->Buyer->Seller->find('list', array(
        'conditions' => array(
          'Seller.customer_id' => $customerId
        )
      ));
    }    
    if ($this->request->is('post')) {
      $data->read($this->request->data['Buyer']['file']['tmp_name']);
      $headers = isset($data->sheets[0]['cells'][3]) ? $data->sheets[0]['cells'][3] : array();
      if(isset($data->sheets[0]['cells']) && $this->_validateBuyerExcel($headers, $this->Buyer->validHeaders)){
        $cells = $data->sheets[0]['cells'];
        $h = $this->_h;
        $saved = 0;
        $notSaved = 0;        
        foreach($cells as $key => $value){          
          if($key > 3){
            $data = array('Buyer' => array());
            $toPush = array();
            $toPush['area_id'] = "";
            foreach($value as $x => $y){               
              if($h[$x] == 'area_id'){
                $toPush['area_id'] = isset($areas[$y]) ? $areas[$y] : null;
              }
              else if($h[$x] == 'address' && $y){
                $data['Address']['address'] = $y;
                $data['Address']['source_name'] = 'buyers';
              }
              else{
                $toPush[$h[$x]] = $y;
              }              
            }            
            $toPush['seller_id'] = $this->request->data['Buyer']['seller_id'];
            $toPush['customer_id'] = $this->request->data['Buyer']['customer_id'];
            $data['Buyer'] = $toPush;
            $this->Buyer->set($data);
            if($this->Buyer->saveAssociated()){
              $saved++;
            }
            else{
              $notSaved++;
            }
          }          
        }
        if($saved && !$notSaved){
          $this->Session->setFlash(__("All buyers are saved."));
        }
        else if($saved && $notSaved){
          $this->Session->setFlash(__("Buyers has been saved but some are not saved."));
        } 
        else if(!$saved && $notSaved){
          $this->Session->setFlash(__("Buyers could not be saved."));
        }
      }
      else{
        $this->Session->setFlash(__("Buyers could not be saved. Invalid Excel file."));
      }
    }
    
    $this->set(compact('sellers', 'customers', 'customerId', 'areas'));
  }
}
