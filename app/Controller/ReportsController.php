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
      // $this->uses = array();
      // $data = array (

      //     'headers'  => array ('hello', 'world', 'hey'),
      //     'data'     => array ( 0 => array ('1', '3', '5'),
      //                           1 => array ('4', '3', '6') )
      // );
      // $report = new GenerateExcelReport($data, "test", "testing");
      // $filename = $report->generate_report();
      // $report->download();
    }

    public function admin_collection_report() {
      /*
        - Customer
        - Seller
        - Date of Collection
        - Type of Collection
        - Report Date
      */
      $this->loadModel('OfficialReceipt');
      $this->loadModel('Collection');

      $sellers = array();
      $customer_id = null;
      $seller_id = null;
      $collection_type = null;
      $error_msg = '';

      // if customer_id is set, get sellers
      if (isset($this->request->query['customer_id'])) {
        $customer_id = $this->request->query['customer_id'];
        $sellers = $this->OfficialReceipt->Seller->find('list', array(
          'conditions' => array(
            'Seller.customer_id' => $customer_id
          )
        ));
      }

      if (isset($this->request->query['seller_id'])) {
        $seller_id = $this->request->query['seller_id'];
      }

      if (isset($this->request->query['collection_type'])) {
        $collection_type = $this->request->query['collection_type'];
      }

      // get the rest of the filter values
      if ($this->request->query) {
        $requests = $this->request->query;
        $conditions = array();

        $conditions = array (
            'OfficialReceipt.customer_id' => $requests['customer_id'],
            'OfficialReceipt.seller_id' => $requests['seller_id'],
            'Collection.collection_type' => $requests['collection_type']
          );

        foreach ($requests as $key => $value) {
          if ($value) {
            if ($requests['customer_id'] && $requests['seller_id']) {
              // format date as db-friendly
              //  TODO double check what columns this should really be
              // Collection.created or OfficialReceipt.date_receipt
              if ($key == 'date_received') { // $key == 'report_date'
                $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
                $conditions['OfficialReceipt.' . $key] = $value;
                break;
              }
            }
          }
        }

        // var_dump($this->request->query);
        // var_dump($conditions); exit;

        // Columns that are commented are not yet on the return data
        try {
          $collections = $this->Collection->find('all', array(
            'fields' => array(
              // 'Buyer.code',
              'OfficialReceipt.or_number',
              'OfficialReceipt.seller_id',
              // 'Collection.mm_provl',
              'Collection.check_type',
              'Collection.bank',
              'Collection.check_number',
              'Collection.check_date',
              'Collection.check_amount',
              'Collection.invoice_number',
              'Collection.created'
            ),
            'conditions' => $conditions
          ));

          // var_dump($collections);
          if ($collections) {
            // generate report
            $data = array (
                'headers'  => array ('OR Number', 'Seller', 'Check Type', 'Bank',
                                     'Check Number', 'Check Date', 'Check Amount',
                                     'Invoice Number', 'Date Created'),
                'data'     => $collections
            );

            // set date, title prefix, dir name
            $report = new GenerateExcelReport($data, "CollectionReport", "Collection-Reports");
            $report->generate_report();
            $report->download();
          } else {
            // show empty record message
            if (sizeof($requests)  == 4) {
              $error_msg = 'No records found.';
            }
          }

        } catch (Exception $e) {
          $error_msg = $e->errorInfo[2];
          // echo $e->queryString;
        }
      }

      // var_dump($collections);

      $customers = $this->OfficialReceipt->Customer->find('list');
      $collection_types = $this->Collection->getCollectionTypes();

      $this->set(compact('sellers', 'customers', 'customer_id', 'seller_id',
                         'collection_types', 'collection_type', 'error_msg'));
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
        // var_dump($sellers); exit;
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
          'fields' => array(
            'OfficialReceipt.or_number',
            'Customer.name',
            'Collection.check_pickup_date',
            'Seller.name',
            'OfficialReceipt.status'
          ),
          'conditions' => array(
            // 'OfficialReceipt.status' => OfficialReceipt::RECEIVED
          ) + $conditions
        ));

        // var_dump($ORs);
        $error_msg = '';

        if ($ORs && $data['from'] && $data['to']) {
          $data = array(
              'headers' => array ('OR Number', 'OR Status', 'Customer Name', 'Pickup Date', 'Seller Name'),
              'data'    => $ORs
          );

          $report = new GenerateExcelReport($data, "OR_Inventory", "OR-Inventory");
          $report->generate_report();
          $report->download();
        } else {
          // show no results found message
          $error_msg = 'No results found.';

        }
        // $this->set('error_msg', $error_msg);
      }

      $customers = $this->OfficialReceipt->Customer->find('list');
      $this->set(compact('sellers', 'customers', 'customerId', 'sellerId'));
      // $this->set(compact('collectors', 'sellers', 'customers', 'statuses', 'customerId', 'sellerId', 'sellerAffiliates', 'ORs'));
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