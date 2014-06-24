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
        // $this->ExcelWriter();
        $data = array (
            'headers'  => array ('hello', 'world', 'hey'),
            'data'     => array ( 0 => array ('1', '3', '5'),
                                  1 => array ('4', '3', '6') )
        );
        $report = new GenerateExcelReport($data, "test", "wala lang");
        $report->generate_report();
    }

}