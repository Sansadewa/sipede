<?php 

/**
 *  
 */
class Kabps extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Kelola Pegawai','akses'=>1));	
		$this->load->model('user_model');
		$this->load->model('permission_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'user_pengguna',
			'permission' => $this->permission_model->get_all()
		);

		$data = array_merge($d,$this->data);
		$this->load->view('user/index',$data);
	}

	function get_user(){
		echo $this->user_model->get_all();
	}

	function add_user(){
		$this->user_model->add_user($this->input->post());
	}

	function delete(){
		$this->user_model->delete($this->input->get('nip'));
	}

	function edit(){
		$this->user_model->edit($this->input->post());
	}

}