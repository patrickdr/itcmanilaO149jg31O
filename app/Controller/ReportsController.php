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

    public function admin_itd_report() {
      /*- Trip Date
      - Collector Name
      - Dispatch Number*/

      /*Customer.name
      Seller.code (Itinerary.seller_id)
      Buyer.name(Itinerary.buyer_id)
      Collection.collector_remarks
      Itinerary.contact_person
      Itinerary.contact_number
      Collection.check_amount
      Itinerary.address
      Itinerary.trip_type
      Itinerary.mm_provl
      Area.code ( From Buyer.area_id)
      Collector.name (From Itinerary.trip_id from Trip.collector_id)*/

      $this->loadModel('Collection');
      $this->loadModel('Itinerary');
      $error_msg = '';
      $success_msg = '';

      // get the rest of the filter values
      if ($this->request->query) {
        $requests = $this->request->query;
        $collector_id = $requests['collector_id'];
        $conditions = array();

        $conditions = array (
          'Itinerary.trip_id' => $requests['dispatch_number'],
          'Trip.collector_id' => $requests['collector_id']
        );

        foreach ($requests as $key => $value) {
          if ($value) {
              // format date as db-friendly
              //  TODO double check what columns this should really be
              // Collection.created or OfficialReceipt.date_receipt
              if ($key == 'date') { // $key == 'report_date'
                $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
                $conditions['Trip.' . $key . ' LIKE '] = '%' . $value . '%';
                break;
              }
          }
        }

        // var_dump($this->request->query);
        // var_dump($conditions); exit;

        // Columns that are commented are not yet on the return data
        try {
          $itineraries = $this->Itinerary->find('all', array(
            'fields' => array(
              'Customer.name',
              'Seller.name',
              'Buyer.code',
              'Buyer.area_id', // TODO area code
              'Itinerary.contact_person',
              'Itinerary.contact_number',
              'Itinerary.address',
              'Itinerary.trip_type',
              'Itinerary.mm_provl',
              'Collection.collector_remarks',
              'Collection.check_amount',
              'Trip.collector_id', // TODO Should be collector's name
              'Trip.date'
            ),
            'conditions' => $conditions
          ));

          // var_dump($itineraries);
          if ($itineraries) {
            // generate report
            $data = array (
                'headers'  => array ('Customer', 'Seller', 'Buyer Code', 'Area',
                                     'Contact Person', 'Contact Number', 'Address',
                                     'Trip Type', 'MM PROVL', 'Collector Remarks',
                                     'Check Amount', 'Collector Name', 'Trip Date'),
                'data'     => $itineraries
            );

            // set date, title prefix, dir name
            $report = new GenerateExcelReport($data, "ITD-Report", "ITD-Reports");
            $report_data = $report->generate_report();
            if ($report_data['filename']) {
              $success_msg = 'Report ' . $report_data['filename'] . ' saved to ' . $report_data['filepath'];
            }
            // $report->download();
          } else {
            // show empty record message
            if (sizeof($requests)  == 3) {
              $error_msg = 'No records found.';
            }
          }

        } catch (Exception $e) {
          $error_msg = $e->errorInfo[2];
          // echo $e->queryString;
        }
      }

      // var_dump($collections);
      // var_dump($this->Itinerary->find('all'));
      $collector_names = $this->Collection->Collector->find('list');
      $this->set(compact('collector_names', 'error_msg', 'success_msg', 'collector_id'));

    }

    public function admin_collection_report() {
      $this->loadModel('OfficialReceipt');
      $this->loadModel('Collection');

      $sellers = array();
      $customers = array();
      $seller_affiliates = array();
      $customer_id = null;
      $seller_id = null;
      $seller_affiliate_id = null;
      $collection_type = null;
      $error_msg = '';
      $success_msg = '';

      // if customer_id is set, get sellers
      if (isset($this->request->query['customer_id'])) {
        $customer_id = $this->request->query['customer_id'];
        $sellers = $this->Collection->Itinerary->Seller->find('list', array(
          'conditions' => array(
            'Seller.customer_id' => $customer_id,
            'Seller.seller_id' => null
          )
        ));
      }

      if (isset($this->request->query['seller_id'])) {
        $seller_id = $this->request->query['seller_id'];
        $seller_affiliates = $this->Collection->Itinerary->Seller->find('list', array(
          'conditions' => array(
            'Seller.seller_id' => $seller_id
          )
        ));
      }

      if (isset($this->request->query['collection_type'])) {
        $collection_type = $this->request->query['collection_type'];
      }

      if (isset($this->request->query['seller_affiliate_id'])) {
        $seller_affiliate_id = $this->request->query['seller_affiliate_id'];
      }

      // get the rest of the filter values
      if ($this->request->query) {
        $requests = $this->request->query;
        $conditions = array();

        $conditions = array (
            'Itinerary.customer_id' => $customer_id,
            'Itinerary.seller_id' => $seller_affiliate_id,
            'Collection.collection_type' => $collection_type
          );

        foreach ($requests as $key => $value) {
          if ($value) {
            // if ($requests['customer_id'] && $requests['seller_id']) {
              // format date as db-friendly
              //  TODO double check what columns this should really be
              // Collection.created or OfficialReceipt.date_receipt
              if ($key == 'date_received') { // $key == 'report_date'
                $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
                $conditions['Itinerary.' . $key . ' LIKE'] = $value;
                break;
              }
            // }
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
              'Itinerary.seller_id',
              'Itinerary.mm_provl',
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
            $report_data = $report->generate_report();
            // $report->download();
            if ($report_data['filename']) {
              $success_msg = 'Report ' . $report_data['filename'] . ' saved to ' . $report_data['filepath'];
            }
          } else {
            // show empty record message
            if (sizeof($requests)  == 5) {
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
                         'seller_affiliates', 'seller_affiliate_id',
                         'collection_types', 'collection_type', 'error_msg',
                         'success_msg'));
    }

    public function getStatusName($or_status_id) {
      $this->loadModel('OfficialReceipt');
      $or_statuses = $this->OfficialReceipt->getStatuses();

      return $or_statuses[$or_status_id];
    }

    public function admin_or_inventory() {
      $sellers = array();
      $customerId = null;
      $sellerAffiliates = array();
      $sellerId = null;
      $ORs = array();
      $report_data = array();
      $success_msg = '';
      $error_msg = '';
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
      if(isset($this->request->query['seller_affiliate_id'])){
        $sellerAffiliateId = $this->request->query['seller_affiliate_id'];
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
            'OfficialReceipt.status',
            'Customer.name',
            'Collection.check_pickup_date',
            'Seller.name'
          ),
          'conditions' => array(
          ) + $conditions
        ));

        // var_dump($ORs);
        $error_msg = '';

        if (sizeof($data) >= 4) {
          if ($ORs) {
            // convert status id to string
            // $new_ORs = Set::insert($ORs, 'OfficialReceipt', array('status_name' => ));

            $data = array(
                'headers' => array ('OR Number', 'OR Status', 'Customer Name', 'Pickup Date', 'Seller Name'),
                'data'    => $ORs
            );

            $report = new GenerateExcelReport($data, "OR_Inventory", "OR-Inventory");
            $report_data = $report->generate_report();
            // $report->download();

            if ($report_data['filename']) {
              $success_msg = 'Report ' . $report_data['filename'] . ' saved to ' . $report_data['filepath'];
            }
          } else {
            // show no results found message
            $error_msg = 'No results found.';

          }
        }
      }

      $customers = $this->OfficialReceipt->Customer->find('list');
      $this->set(compact('sellers', 'customers', 'customerId', 'sellerId',
                         'sellerAffiliateId', 'sellerAffiliates', 'success_msg',
                         'error_msg'));
    }

    public function admin_check_transmittal() {
      /*
        Customer
        Seller
        Seller Affiliate

        - Re [?]
        - Deposit Date
        - Collection Date

          Collections.check_type
          Collections.clearing_type_code
          Collections.bank
          Collections.check_number
          Collections.check_date
          Collections.check_amount

      */

      $this->loadModel('Collection');
      $this->loadModel('Customer');

      $sellers = array();
      $customers = array();
      $seller_affiliates = array();

      $customer_id = null;
      $seller_id = null;
      $error_msg = '';

      // if customer_id is set, get sellers
      if (isset($this->request->query['customer_id'])) {
        $customer_id = $this->request->query['customer_id'];
        $sellers = $this->Collection->Itinerary->Seller->find('list', array(
          'conditions' => array(
            'Seller.customer_id' => $customer_id
          )
        ));
      }
      // if seller id is present, get all seller affiliates
      if (isset($this->request->query['seller_id'])) {
        $seller_id = $this->request->query['seller_id'];
        $seller_affiliates = $this->Collection->Itinerary->Seller->find('list', array(
          'conditions' => array(
            'Seller.seller_id' => $seller_id
          )
        ));
      }

      // get the rest of the filter values
      if ($this->request->query) {
        $requests = $this->request->query;
        $conditions = array();

        $conditions = array (
            'Itinerary.customer_id' => $requests['customer_id'],
            'Itinerary.seller_id' => $requests['seller_id'],
            'OfficialReceipt.seller_affiliate_id' => $requests['seller_affiliate_id'],
            'Collection.deposit_channel' => $requests['deposit_channel_id']
          );

        foreach ($requests as $key => $value) {
          if ($value) {
              // format date as db-friendly
              //  TODO double check what columns this should really be
              // Collection.created or OfficialReceipt.date_receipt
              if ($key == 'deposit_date') { // $key == 'report_date'
                $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
                $conditions['Collection.' . $key] = $value;
              }
              if ($key == 'collection_date') { // $key == 'report_date'
                $value = $value['year'] . "-" . $value['month'] . "-" . $value['day'];
                $conditions['Collection.created LIKE'] = '%' . $value . '%';
              }
          }
        }

        // var_dump($this->request->query);
        // var_dump($conditions);

        try {
          $ctransmittal = $this->Collection->find('all', array(
            'fields' => array(
              'Collection.check_type',
              'Collection.clearing_type_code',
              'Collection.bank',
              'Collection.check_number',
              'Collection.check_date',
              'Collection.check_amount'
            ),
            'conditions' => $conditions
          ));

          // var_dump($collections);
          if ($ctransmittal) {
            // generate report
            $data = array (
                'headers'  => array ('Check Type', 'Clearing Type Code', 'Bank',
                                     'Check Number', 'Check Date', 'Check Amount'),
                'data'     => $ctransmittal
            );

            // set date, title prefix, dir name
            $report = new GenerateExcelReport($data, "CheckTransmittalReport", "CheckTransmittal-Reports");
            $report->generate_report();
            // $report->download();
          } else {
            // show empty record message
            if (sizeof($requests)  == 6) {
              $error_msg = 'No records found.';
            }
          }

        } catch (Exception $e) {
          $error_msg = $e->errorInfo[2];
        }
      }

      // var_dump($this->Collection->find('all'));
      $customers = $this->Collection->Itinerary->Customer->find('list');
      $deposit_channels = $this->Collection->getDepositChannels();

      $this->set(compact('sellers', 'customers', 'customer_id', 'seller_id',
                         'seller_affiliates', 'deposit_channels', 'error_msg'));
    }

    public function admin_ppm(){
      $sellerAffiliates = array();
      if($data = $this->request->query){

      }
      $this->loadModel('Customer');
      $customers = $this->Customer->find('list');
      $this->set(compact('customers', 'sellerAffiliates'));
    }

    public function admin_xls_ppm(){
      if($this->request->is('post')){
        // Inititialize Excel Reader
        $data = new Spreadsheet_Excel_Reader();
        // Set output Encoding.
        $data->setOutputEncoding('CP1251');
        $data->read($this->request->data['PPM']['file']['tmp_name']);
        
        $cells = (isset($data->sheets[0]['cells']) && $data->sheets[0]['cells']) ? $data->sheets[0]['cells'] : array();
        $string = "";
        $seller = "";
        foreach($cells as $key => $cell){
          foreach($cell as &$value){
            $value = preg_replace('/\s+/', '', $value);
          }
          if($cell && count($cell) >= 9 && $key > 1){
            $seller = $cell[5];
            $string .= str_pad("1", 10, " ", STR_PAD_RIGHT);
            $string .= str_pad($cell[1], 20, " ", STR_PAD_LEFT);
            $string .= str_pad("CHK", 10, " ", STR_PAD_LEFT);
            $string .= str_pad(number_format($cell[2], 2, '.', ''), 20, "0", STR_PAD_LEFT);
            $string .= $cell[3];
            $string .= $cell[4];
            $string .= str_pad(preg_replace('/\s+/', '', $cell[5]) , 30, " ", STR_PAD_LEFT); // Seller code
            $string .= $cell[6];
            $string .= str_pad($cell[7], 30, " ", STR_PAD_RIGHT);
            $string .= str_pad(" ", 30, " ", STR_PAD_RIGHT); // Currency Code
            $string .= str_pad($cell[8], 30, " ", STR_PAD_LEFT); // Clearing type code
            $string .= str_pad($cell[9], 30, " ", STR_PAD_LEFT);
            $string .= str_pad(str_pad($cell[10], 3, "0", STR_PAD_LEFT), 30, " ", STR_PAD_LEFT);
            $string .= str_pad($cell[11], 30, " ", STR_PAD_LEFT); // Drawee bank branch code
            $string .= str_pad(str_pad($cell[12], 9, "0", STR_PAD_LEFT), 30, " ", STR_PAD_LEFT); // Clearing location code
            $string .= str_pad("", 372, " ", STR_PAD_LEFT);
            $string .= str_pad($cell[13], 10, " ", STR_PAD_RIGHT);
            $string .= str_pad($cell[14], 35, " ", STR_PAD_RIGHT);
            $string .= "\r\n";            
          }
        }
        
        if($string){
          $this->loadModel('FileCount');
          $fileCounts = $this->FileCount->find('list');
          $fileCount = end($fileCounts);
          $file = new File( REPORTS_DIR . DS .'ppm' . DS . "HDR" . date('dmY') . $seller . date('dmY') . $fileCount . '.txt', true);
          $string = "HDR" . $file->name . "   010070062" . "\r\n" . $string;
          $string .= "TRL" . date("dmY") . count($cells);
          $file->write($string);
          $filename = $file->name;
          $file->close();
          if($filename){
            $this->response->file(
                REPORTS_DIR . DS .'ppm' . DS . $filename,
                array('download' => true, 'name' => $filename)
            );
            $this->FileCount->create();
            $this->FileCount->save();
            return;
          }
        }
      }
    }

}