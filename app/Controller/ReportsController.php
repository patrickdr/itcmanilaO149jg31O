<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
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

    private function ExcelWriter() {
        $excel_writer = new PHPExcel();
        $title = "PHPExcel Test Document";
        $description = "Test document for PHPExcel, generated using PHP classes.";
        $author = "Admin";
        $active_sheet_idx = 0;

        $headers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $data = array (
                'headers'  => array ('test', 'test1', 'test2'),
                'data'     => array ( 0 => array ('1', '3', '5'),
                                      1 => array ('4', '3', '6') )
            );

        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        $excel_writer->getProperties()->setCreator($author)
                             ->setTitle($title)
                             ->setDescription($description);;

        // Add some data
        // Set header
        echo date('H:i:s') , " Add some data" , EOL;

        for ($i = 0; $i < sizeof($data['headers']); $i++) {
            $col = $i;
            $column_num = $col + 1;
            $excel_writer->setActiveSheetIndex($active_sheet_idx)
                         ->setCellValue($headers[$i] . $column_num, $data['headers'][$i]);            
        }

        // Set cell values
        $start_row = 2; // A2, B2, ... Z2

        for ($i = 0; $i < sizeof($data['data']); $i++) {

            for ($j = 0; $j < sizeof($data['data'][$i]); $j++) {
                $excel_writer->setActiveSheetIndex(0)
                             ->setCellValue($headers[$j] . $start_row, $data['data'][$i][$j]);    
            }
            
            // next row
            $start_row++;
        }

        $_writer = PHPExcel_IOFactory::createWriter($excel_writer, 'Excel2007');
        // set new folder path here TODO
        $_writer->save(dirname(__FILE__) . $title . '.xlsx');

        echo "successful!";
    }

    public function admin_index() {
        $this->uses = array();
        $this->ExcelWriter();
    }
    
}