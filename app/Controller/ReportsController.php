<?php
App::uses('AppController', 'Controller');
// App::import('Vendor', 'ExcelWriter/PHPExcel');
App::import('Vendor', 'ExcelWriter');
/**
 * Reports Controller
 *
 * @property Seller $Seller
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReportsController extends AppController {

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
      $this->uses = array();
      $data = array (

          'headers'  => array ('hello', 'world', 'hey'),
          'data'     => array ( 0 => array ('1', '3', '5'),
                                1 => array ('4', '3', '6') )
      );
      $report = new GenerateExcelReport($data, "test", "testing");
      $filename = $report->generate_report();
      $report->download();
    }

    public function admin_or_inventory() {
      $sellers = array();
      $customerId = null;
      $sellerAffiliates = array();
      $sellerId = null;
      $ORs = array();
      $this->loadModel('OfficialReceipt');

      if(isset($this->request->query['customer_id'])){
        $customerId = $this->request->query['customer_id'];
        $sellers = $this->OfficialReceipt->Seller->find('list', array(
          'conditions' => array(
            'Seller.customer_id' => $customerId,
            'Seller.seller_id' => ""
          )
        ));
        var_dump($sellers); exit;
      }
      if(isset($this->request->query['seller_id'])){
        $sellerId = $this->request->query['seller_id'];
        $sellerAffiliates = $this->OfficialReceipt->Seller->find('list', array(
          'conditions' => array(
            'Seller.seller_id' => $sellerId,
            'Seller.customer_id' => $customerId
          )
        ));
      }
      if ( $this->request->query) {
        $data = $this->request->query;
        $conditions = array();
        foreach($data as $key => $value){
          if($key != "prefix" && $key != "from" && $key != "to"){
            if($value){
              if($key == 'date_received'){
                $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
              }
              $conditions['OfficialReceipt.' . $key] = $value;
            }
          }
        }
        $ORfind = array();
        if((isset($data['from']) && $data['from']) || (isset($data['to']) && $data['to'])){
          $prefix = $data['prefix'];
          $length = strlen($data['from']);
          if(intval($data['to'])){
            for($x = intval($data['from']); $x <= intval($data['to']); $x ++){
              if(strlen($x) == $length){
                $ORfind[] = (($prefix) ? $prefix : "" ). $x;
              }
              else{
                $ORfind[] = (($prefix) ? $prefix : "" ) . str_pad((string)$x, $length, "0", STR_PAD_LEFT);
              }
            }
          }
          else if(intval($data['from'])){
            $ORfind[] = (($prefix) ? $prefix : "" ). $data['from'];
          }
        }
        if($ORfind){
          $conditions['OfficialReceipt.or_number'] = $ORfind;
        }
        $ORs = $this->OfficialReceipt->find('all',array(
          'conditions' => array(
            'OfficialReceipt.status' => OfficialReceipt::RECEIVED
          ) + $conditions
        ));
      }
      if($this->request->is('post')){
        $post = $this->request->data['ORDispatch'];
        $toSave = array();
        foreach($post['id'] as $id){
          if($id){
            $toSave[] = array(
              'id' => $id,
              'collector_id' => $post['collector_id'],
              'status' => OfficialReceipt::DISPATCHED
            );
          }
        }
        if($toSave){
          $this->OfficialReceipt->saveAll($toSave);
          $this->Session->setFlash("Selected OR(s) has been dispatched");
          $this->redirect(array('action' => 'index'));
        }
        else{
          $this->Session->setFlash("No OR(s) to save.");
        }
      }
      $collectors = $this->OfficialReceipt->Collector->find('list');
      $customers = $this->OfficialReceipt->Customer->find('list');
      $statuses = $this->OfficialReceipt->getStatuses();
      $this->set(compact('collectors', 'sellers', 'customers', 'statuses', 'customerId', 'sellerId', 'sellerAffiliates', 'ORs'));
    }

    public function admin_or_inventory_() {
      $this->loadModel('OfficialReceipt');
      // $ors = $this->OfficialReceipt->find('list');
      // $data = array (

      //     'headers'  => array ('Receipt Numbers'),
      //     'data'     => $ors
      // );
      // // echo $data['data'][1]; exit;
      // // var_dump($data); exit;
      // $report = new GenerateExcelReport($data, "OR", "official_receipts");
      // $filename = $report->generate_report();
      // $report->download();
      $ors = array();

      if($data = $this->request->query) {
        $seller_id = $data['seller_id'];
        $customer_id = $data['customer_id'];

        $or_from = $data['or_from'];
        $or_to = $data['or_to'];
        $or_range = array();

        if ($or_from) {
          $or_range = array_merge($or_range, array ('OfficialReceipt.or_number >=' => $or_from));
        }

        if ($or_to) {
          $or_range = array_merge($or_range, array ('OfficialReceipt.or_number >=' => $or_to));
        }

        $conditions = array(
          'OfficialReceipt.seller_id' => $seller_id,
          'OfficialReceipt.customer_id' => $customer_id,
        );

        if (count($or_range) > 0) {
          $conditions = array_merge($conditions, $or_range);
        }

        $ors = $this->OfficialReceipt->find('all', array(
          'fields' => array('OfficialReceipt.or_number',
                            'OfficialReceipt.created',
                            'OfficialReceipt.modified'),
          'conditions' => $conditions
        ));

        // TODO :
        // Pat, pakicheck to. Haha kaloka. Walang laman! Naglagay ako sample get params sa URL
        // pero walang result ?
        // var_dump($ors); exit;
      }

      $this->loadModel('Customer');
      $customers = $this->Customer->find('list');
      $this->set(compact('customers', 'sellerAffiliates'));
    }

    public function admin_ppm(){
      $sellerAffiliates = array();
      if($data = $this->request->query){

      }
      $this->loadModel('Customer');
      $customers = $this->Customer->find('list');
      $this->set(compact('customers', 'sellerAffiliates'));
    }

}