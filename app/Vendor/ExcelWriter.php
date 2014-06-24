<?php

App::import('Vendor', 'ExcelWriter/PHPExcel');

class GenerateExcelReport {
  private $author = 'Admin';
  public $active_sheet_idx = 0;
  public $header_start = 'A';
  public $header_startnum = '1';
  public $headers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  public $column_startnum = 2;

  public $cell_vals = array();
  public $header_vals = array();
  public $title = '';
  public $description = '';

  public function __construct($data, $title, $description) {
    $this->header_vals = $data['headers'];
    $this->cell_vals = $data['data'];
    $this->title = $title;
    $this->description = $description;

    // Must be from config
    $this->author = "Admin";

    //  TODO get excel file path from config
  }

  // public function generate_filename() {
  //   // based on date, type of report
  //   return;
  // }

  public function generate_report() {
    $excel_writer = new PHPExcel();

    $excel_writer->getProperties()->setCreator($this->author)
                                  ->setTitle($this->title)
                                  ->setDescription($this->description);

    $excel_writer->setActiveSheetIndex($this->active_sheet_idx);

    // set header values
    for ($i = 0; $i < sizeof($this->header_vals); $i++) {
      $column = $this->header_start . $this->header_startnum;
      $cell_value = $this->header_vals[$i];
      $excel_writer->getActiveSheet()
                   ->setCellValue($column, $cell_value);
      $this->header_start++;
    }

    // Set cell values
    $start_row = 2; // A2, B2, ... Z2

    for ($i = 0; $i < sizeof($this->cell_vals); $i++) {
      for ($j = 0; $j < sizeof($this->cell_vals[$i]); $j++) {
          $excel_writer->getActiveSheet()
                       ->setCellValue($this->headers[$j] . $start_row, $this->cell_vals[$i][$j]);
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