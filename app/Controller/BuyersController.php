<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'Spreadsheet_Excel_Reader', array('file' => 'Excel/reader.php'));
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
    'name' => 1,
    'client_buyer_code' => 2,
    'customer_buyer_code' => 3,
    'address' => 4,
    'ittype' => 5,
    'contact_number' => 6,
    'contact_person' => 7,
    'area' => 8
  );

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Buyer->recursive = 0;
		$this->set('buyers', $this->Paginator->paginate());
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
			if ($this->Buyer->save($this->request->data)) {
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
    $cells = array();
    if ($this->request->is('post')) {
      $data->read($this->request->data['Buyer']['file']['tmp_name']);
      if(isset($data->sheets[0]['cells'])){
        $cells = $data->sheets[0]['cells'];
        $h = $this->_h;
        foreach($cells as $key => $value){
          if($key > 3){
            $data = array(
              'Buyer' => array(
                
              )
            );
            $this->Buyer;
            //$this->Buyer->save
          }
        }
      }
    }
    
  }
}
