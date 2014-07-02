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
  public $description = 'Report';
  // public $report_path = Configure::load('Report.path');
  public $base_path = 'files/';
  public $report_path = 'reports/';
  public $report_filename = '';

  private $_writer;
  private $excel_writer;

  private function format_cell_data($data) {
    $cell_data = array();
    $data = Set::flatten($data);

    foreach ($data as $k => $v) {
      $temp_key = explode('.', $k);
      $key_id = $temp_key[0];
      $key_value = $temp_key[1] . '.' .  $temp_key[2];
      $val = $v;

      $cell_data[$key_id][] = $val;
    }

    return $cell_data;
  }

  public function __construct($data, $title, $report_path='', $description='') {
    $this->header_vals = $data['headers'];
    $this->cell_vals = $this->format_cell_data($data['data']);
    $this->title = $title . '_' . date('Y-m-d_H.i.s');

    if ($description) {
      $this->description = $description;
    }

    // create report directory
    $this->report_path = $this->base_path . $this->report_path;

    if ($report_path) {
      $temp_rpath = $this->base_path . $report_path . '/';
      if (!is_dir($temp_rpath)) {
        mkdir($temp_rpath);
        $this->report_path = $temp_rpath;
      } else {
        $this->report_path = $temp_rpath;
      }
    } else if (!is_dir($this->report_path)) {
      mkdir($this->report_path);
    }

    // Must be from config
    $this->author = "Admin";
  }


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
    // var_dump($this->cell_vals);
    for ($i = 0; $i < count($this->cell_vals); $i++) {
      if (is_array($this->cell_vals[$i])) {
        for ($j = 0; $j < count($this->cell_vals[$i]); $j++) {
            $excel_writer->getActiveSheet()
                         ->setCellValue($this->headers[$j] . $start_row, $this->cell_vals[$i][$j]);
        }
      } else {
        for ($j = 0; $j < count($this->cell_vals[$i]); $j++) {
            $excel_writer->getActiveSheet()
                         ->setCellValue($this->headers[$j] . $start_row, $this->cell_vals[$i]);
        }
      }

      // next row
      $start_row++;
    }

    // $_writer = PHPExcel_IOFactory::createWriter($excel_writer, 'Excel2007');
    // $this->_writer = $_writer;
    $this->excel_writer = $excel_writer;
    // TO DO : replace file if it already exists [?] OR
    // throw exception message
    $this->report_filename = $this->report_path . $this->title . '.xlsx';
    // $_writer->save($this->report_filename);

    return array (
      'filename'  => $this->report_filename
    );
  }



  public function download() {
    $filename = $this->title . '.xlsx';
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: ' . gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $this->_writer = PHPExcel_IOFactory::createWriter($this->excel_writer, 'Excel2007');
    $this->_writer->save('php://output');
  }

}

?>