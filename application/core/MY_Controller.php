<?php

class MY_Controller extends CI_Controller{

	protected $user;
	protected $data;
	function __construct($param){
		parent::__construct();	
		$this->load->model('m_login');
		$this->load->helper('form');
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('failed', 'Silahkan login terlebih dahulu.');
			redirect(base_url("login"));
		}	
		$this->inisialisasi($param);
		
		if($this->user->permission > $param['akses']){
			redirect();
		}

		$this->set_timezone();
	}

	private function inisialisasi($param){
		$this->user = $this->m_login->get_user($this->session->userdata('username'));
		$this->data = array(
			'title_page' => $param['title_page'],
		);
	}

	private function set_timezone() {
        date_default_timezone_set($this->system->get_set('spd_timezone',TRUE)['timezone']);
    }
 

}