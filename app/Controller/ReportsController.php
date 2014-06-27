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
      $sellerAffiliates = array();
      if($data = $this->request->query) {
        $seller_id = $data['seller_id'];
        $customer_id = $data['customer_id'];

        $ors = $this->OfficialReceipt->find('list', array(
          'fields' => array('id', 'OfficialReceipt.or_number', 'OfficialReceipt.created', 'OfficialReceipt.modified'),
          'conditions' => array(
            'OfficialReceipt.seller_id' => $seller_id,
            'OfficialReceipt.customer_id' => $customer_id
          )
        ));
        var_dump($ors); exit;
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