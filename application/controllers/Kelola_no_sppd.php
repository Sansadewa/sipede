<?php

/**
 * 
 */
class Kelola_no_sppd extends MY_Controller
{
	
	function __construct(){
		parent::__construct(array('title_page'=>'Kelola No SPPD','akses'=>3));	 
		$this->load->model('no_sppd_model');
		$this->load->model('kegiatan_model');
		$this->load->model('jenis_surat_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'spd_view',
			'opsi_kegiatan' => $this->kegiatan_model->get_all(),
			'opsi_jenis' => $this->jenis_surat_model->get_all()
		);
		$data = array_merge($d,$this->data);
		$this->load->view('no_surat_sppd/index',$data);
	}

	function get_all_table(){
		echo $this->no_sppd_model->get_all_table();
	}

	function add(){
		$this->no_sppd_model->add($this->input->post());
	}

	function edit(){
		$this->no_sppd_model->edit($this->input->post());
	}

	function delete(){
		$this->no_sppd_model->delete($this->input->get());
	}
}