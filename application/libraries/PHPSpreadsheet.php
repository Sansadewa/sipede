<?php
// Load library phpspreadsheet
require_once('./vendor/PhpSpreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Phpspreadsheet {

  
  public function get_spreadsheet(){
  	return new Spreadsheet();
  }

  public function get_content($spreadsheet,$filename=null){
  	// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if($filename){
			header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		}else{
			header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
		}
		
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0


		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');

		/*header('Content-Type: application/pdf');
		header('Content-Disposition: attachment;filename="Report Excel.pdf"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Dompdf');
		$writer->save('php://output');*/
		return $writer;
  }
}