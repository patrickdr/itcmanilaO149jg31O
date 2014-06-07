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
    $itineraries = $this->Trip->Itinerary->find('all', array(
      'conditions' => array(
        'Itinerary.trip_id' => $id
      )
    ));
		$this->set('trip', $this->Trip->find('first', $options));
    $this->set('itineraries', $itineraries);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
      //SBdump($this->request->data); exit;
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
    $this->set('itineraries', $this->Trip->Itinerary->find('all'));
    //$itineraries = 
		$this->set(compact('collectors', 'areas'));
	}
  
  public function admin_search_area(){
    //$this->autoRender = false;
    $this->layout = false;
    if($this->request->is('ajax') && ($this->request->is('post') || $this->requeswt->is('put'))){
      $areas = $this->request->data['area_id'];
      $this->loadModel('Itinerary');
      $itineraries = $this->Itinerary->find('all', array(
        'contain' => array(
          'Buyer' => array(
            'conditions' => array(
              'Buyer.area_id' => $areas
            )
          )
        ),
        'conditions' => array(
          'Itinerary.trip_id' => ""
        )
      ));
      $this->set(compact('itineraries'));
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
    $areas = $this->Trip->TripArea->Area->find('list');
    $this->set('itineraries', $this->Trip->Itinerary->find('all'));
    //$itineraries = 
    $trips = $this->Trip->Itinerary->find('all', array(
      'conditions' => array(
        'Itinerary.trip_id' => $id
      )
    ));
    
    $this->set('trips', $trips);
		$this->set(compact('collectors', 'areas'));    
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
