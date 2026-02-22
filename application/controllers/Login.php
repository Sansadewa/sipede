<?php

class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		$this->load->view('login_page');
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->m_login->aksi_login($username,$password);
		if($cek['status']){
 
			redirect(base_url("main"));
 
		}else{
			$this->session->set_flashdata('failed', 'Periksa username dan password');
			redirect(base_url('login'));
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}