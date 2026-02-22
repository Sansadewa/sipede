<?php 

/**
 *  
 */
class Pegawai extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Kelola Pegawai','akses'=>1));	
		$this->load->model('pegawai_model');
		$this->load->model('pangkat_model');
		$this->load->model('jabatan_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'user_pegawai',
			'opsi_jabatan' => $this->jabatan_model->get_all(),
			'opsi_pangkat' => $this->pangkat_model->get_all()
		);

		$data = array_merge($d,$this->data);
		$this->load->view('pegawai/index',$data);
	}

	function get_pegawai(){
		echo $this->pegawai_model->get_all_table();
	}

	function add_pegawai(){
		$this->pegawai_model->add_pegawai($this->input->post());
	}

	function delete(){
		$this->pegawai_model->delete($this->input->get('nip'));
	}

	function edit(){
		$this->pegawai_model->edit($this->input->post());
	}

}