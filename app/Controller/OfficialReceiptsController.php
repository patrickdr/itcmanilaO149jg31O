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
			$this->OfficialReceipt->create();
			if ($this->OfficialReceipt->save($this->request->data)) {
				$this->Session->setFlash(__('The official receipt has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The official receipt could not be saved. Please, try again.'));
			}
		}
		$collectors = $this->OfficialReceipt->Collector->find('list');
		$sellers = $this->OfficialReceipt->Seller->find('list');
		$customers = $this->OfficialReceipt->Customer->find('list');
		$this->set(compact('collectors', 'sellers', 'customers'));
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
