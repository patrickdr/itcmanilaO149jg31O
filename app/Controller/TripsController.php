<?php
App::uses('AppController', 'Controller');
/**
 * Trips Controller
 *
 * @property Trip $Trip
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TripsController extends AppController {

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
		$this->Trip->recursive = 0;
		$this->set('trips', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Trip->exists($id)) {
			throw new NotFoundException(__('Invalid trip'));
		}
		$options = array('conditions' => array('Trip.' . $this->Trip->primaryKey => $id));
		$this->set('trip', $this->Trip->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Trip->create();
			if ($this->Trip->save($this->request->data)) {
				$this->Session->setFlash(__('The trip has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trip could not be saved. Please, try again.'));
			}
		}
		$collectors = $this->Trip->Collector->find('list');
    $areas = $this->Trip->TripArea->Area->find('list');
    //$itineraries = 
		$this->set(compact('collectors', 'areas'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Trip->exists($id)) {
			throw new NotFoundException(__('Invalid trip'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Trip->save($this->request->data)) {
				$this->Session->setFlash(__('The trip has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trip could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Trip.' . $this->Trip->primaryKey => $id));
			$this->request->data = $this->Trip->find('first', $options);
		}
		$collectors = $this->Trip->Collector->find('list');
		$this->set(compact('collectors'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Trip->id = $id;
		if (!$this->Trip->exists()) {
			throw new NotFoundException(__('Invalid trip'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Trip->delete()) {
			$this->Session->setFlash(__('The trip has been deleted.'));
		} else {
			$this->Session->setFlash(__('The trip could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
