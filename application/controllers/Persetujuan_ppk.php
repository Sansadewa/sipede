<?php

/**
 * 
 */
class Persetujuan_ppk extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Master Data','akses'=>2));	
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'spd_ppk',
		);
		$data = array_merge($d,$this->data);
		$this->load->view('spd/ppk',$data);
	}
}