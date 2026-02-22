<?php

/**
 * 
 */
class Test extends CI_Controller
{
	
	function index(){

		$this->load->model('Presensi_model');
		$this->Presensi_model->get_rekap2();


		exit();
		$this->load->library('phpspreadsheet');
		$inputFileName = './assets/excel_template/template_spd.xlsx';
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

		$kab = array('6301','6302','6303','6304','6305','6306','6307','6308','6309','6310','6311','6371','6372');

		$url = 'http://10.63.0.234/wa_shbj/assets/json/prod_bs_6301sp2020.geojson';

		$jsonData = json_decode(file_get_contents($url),true);

		$i=0;
		$row = 1;

		$data = array();

		foreach ($jsonData['features'] as $value) {
			$data[]=$value['properties'];
		}

		$field = array();

		foreach ($data[0] as $key=>$value) {
			$spreadsheet->setActiveSheetIndex(0)
							->setCellValue(get_alpabhet($i).'1',$key); 
			//print_r($key);
			$field[] =$key;
			$i++;
		}
		//print_r('<br>');

		$row++;

		foreach ($kab as $value) {
			$url = 'http://10.63.0.234/wa_shbj/assets/json/prod_bs_'.$value.'sp2020.geojson';
			$jsonData = json_decode(file_get_contents($url),true);
			$data = array();

			foreach ($jsonData['features'] as $value) {
				$data[]=$value['properties'];
			}

			foreach ($data as $value) {
				for ($j=0;$j<$i;$j++){
					//print_r($value[$field[$j]]);
					//print_r('<br>');
					$spreadsheet->setActiveSheetIndex(0)->setCellValue(get_alpabhet($j).$row,$value[$field[$j]]);   
				}
				$row++;
			}
		}

		

		
		$this->phpspreadsheet->get_content($spreadsheet,'Rekap BS');    
  }


}