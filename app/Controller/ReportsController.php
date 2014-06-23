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
        $report = new GenerateExcelReport();
        $report->generate_report();
    }
    
}