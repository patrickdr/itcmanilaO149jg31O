<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AreasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
  private $_h = array(
    1 => 'code',
    2 => 'description'
  );
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Area->recursive = 0;
		$this->set('areas', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Area->exists($id)) {
			throw new NotFoundException(__('Invalid area'));
		}
		$options = array('conditions' => array('Area.' . $this->Area->primaryKey => $id));
		$this->set('area', $this->Area->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Area->create();
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Area->exists($id)) {
			throw new NotFoundException(__('Invalid area'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Area.' . $this->Area->primaryKey => $id));
			$this->request->data = $this->Area->find('first', $options);
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
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Area->delete()) {
			$this->Session->setFlash(__('The area has been deleted.'));
		} else {
			$this->Session->setFlash(__('The area could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
  // Upload of multiple Areas
  public function admin_upload(){
    $data = new Spreadsheet_Excel_Reader();
    // Set output Encoding.
    $data->setOutputEncoding('CP1251');
    $cells = array();
    if ($this->request->is('post')) {
      $data->read($this->request->data['Area']['file']['tmp_name']);
      if(isset($data->sheets[0]['cells'])){
        $cells = $data->sheets[0]['cells'];
        $h = $this->_h;
        $post = array('Area' => array());
        foreach($cells as $key => $value){
          if($key > 6){
            if(isset($value[1]) && isset($value[2])){
              $post['Area'][] = array(
                $h[1] => $value[1],
                $h[2] => $value[2]
              );              
            }           
          }
        }
        if($this->Area->saveAll($post['Area'])){
          // Success
          $this->Session->setFlash(__('Contests has been saved'));
          $this->redirect(array('action' => 'index'));
        }
        else{
          // Failed
          $this->Session->setFlash(__('Contests could not be saved'));
        }
      }
    }
  }
}
