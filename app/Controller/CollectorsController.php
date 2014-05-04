<?php
App::uses('AppController', 'Controller');
/**
 * Collectors Controller
 *
 * @property Collector $Collector
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CollectorsController extends AppController {

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
		$this->Collector->recursive = 0;
		$this->set('collectors', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Collector->exists($id)) {
			throw new NotFoundException(__('Invalid collector'));
		}
		$options = array('conditions' => array('Collector.' . $this->Collector->primaryKey => $id));
		$this->set('collector', $this->Collector->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Collector->create();
			if ($this->Collector->save($this->request->data)) {
				$this->Session->setFlash(__('The collector has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collector could not be saved. Please, try again.'));
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
		if (!$this->Collector->exists($id)) {
			throw new NotFoundException(__('Invalid collector'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Collector->save($this->request->data)) {
				$this->Session->setFlash(__('The collector has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collector could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Collector.' . $this->Collector->primaryKey => $id));
			$this->request->data = $this->Collector->find('first', $options);
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
		$this->Collector->id = $id;
		if (!$this->Collector->exists()) {
			throw new NotFoundException(__('Invalid collector'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Collector->delete()) {
			$this->Session->setFlash(__('The collector has been deleted.'));
		} else {
			$this->Session->setFlash(__('The collector could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
