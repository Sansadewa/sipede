<?php

/**
 * 
 */
class Laporan extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('title_page'=>'Laporan kegiatan','akses'=>2));	
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'laporan_index',
		);

		$data = array_merge($d,$this->data);
		$this->load->view('laporan/index',$data);
	} 

}