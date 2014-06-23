<?php

App::import('Vendor', 'ExcelWriter/PHPExcel');

class GenerateExcelReport {
	public function generate_report() {
        $excel_writer = new PHPExcel();
        $title = "PHPExcel Test Document";
        $description = "Test document for PHPExcel, generated using PHP classes.";
        $author = "Admin";
        $active_sheet_idx = 0;

        $headers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $data = array (
                'headers'  => array ('hello', 'world', 'hey'),
                'data'     => array ( 0 => array ('1', '3', '5'),
                                      1 => array ('4', '3', '6') )
            );

        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        $excel_writer->getProperties()->setCreator($author)
                             ->setTitle($title)
                             ->setDescription($description);
        $excel_writer->setActiveSheetIndex($active_sheet_idx);

        // Add some data
        // Set header
        echo date('H:i:s') , " Add some data" , EOL;

        $excel_writer->getActiveSheet();
        for ($i = 0; $i < sizeof($data['headers']); $i++) {
            $col = $i;
            $column = $headers[$i] . ($col + 1);
            $cell_value = $data['headers'][$i];
            $excel_writer->getActiveSheet()->setCellValue($column, $cell_value);
        }

        // $excel_writer->getActiveSheet()
        //                  ->setCellValue('A1', 'fsdfas')
        //                  ->setCellValue('B1', 'gdgdf')
        //                  ->setCellValue('C1', 'grtjyjdse');

        // Set cell values
        $start_row = 2; // A2, B2, ... Z2

        for ($i = 0; $i < sizeof($data['data']); $i++) {

            for ($j = 0; $j < sizeof($data['data'][$i]); $j++) {
                $excel_writer->getActiveSheet()
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
}

?>