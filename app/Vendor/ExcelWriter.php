<?php

App::import('Vendor', 'ExcelWriter/PHPExcel');

class GenerateExcelReport {
	public function generate_report($data) {
        $excel_writer = new PHPExcel();
        $title = "PHPExcel Test Document";
        $description = "Test document for PHPExcel, generated using PHP classes.";
        $author = "Admin";
        $active_sheet_idx = 0;

        $header_start = 'A';
        $headers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $col = 1;

        $excel_writer->getProperties()->setCreator($author)
                             ->setTitle($title)
                             ->setDescription($description);
        $excel_writer->setActiveSheetIndex($active_sheet_idx);

        // Add some data
        // Set header
        for ($i = 0; $i < sizeof($data['headers']); $i++) {
            $column = $header_start . $col;
            $cell_value = $data['headers'][$i];
            $excel_writer->getActiveSheet()
                         ->setCellValue($column, $cell_value);
            $header_start++;
        }

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