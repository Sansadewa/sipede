<?php

/**
 * 
 */
class Kegiatan extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Kelola Kegiatan','akses'=>3));	
		$this->load->model('kegiatan_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'mtx_kegiatan',
		);

		$data = array_merge($d,$this->data);
		$this->load->view('kegiatan/index',$data);
	}

	function add(){
		echo $this->kegiatan_model->add($this->input->post());
	}

	function edit(){
		echo $this->kegiatan_model->edit($this->input->post());
	}

	function delete(){
		$this->kegiatan_model->delete($this->input->get('id'));
	}

	function get_all(){
		echo $this->kegiatan_model->get_all_table($this->input->post());
	}

	function get_all_lds(){
		echo $this->kegiatan_model->get_all_table_lds($this->input->post());	
	}
}