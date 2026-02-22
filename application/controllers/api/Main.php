<?php

/**
 * 
 */
class Main extends CI_Controller
{

	function __construct()
	{
		parent::__construct();	
		$this->load->model('matriks_kegiatan_model');
		$this->load->model('kegiatan_model');
		$this->load->model('pegawai_model');
		$this->load->model('spd_model');
		$this->load->model('m_login');
		$login = $this->m_login->aksi_login($this->input->get_post('username'),$this->input->get_post('password'));
		if(!$login['status']){
			echo 'Forbidden';
			exit();
		}
	}

	public function get_matriks(){
		$number_days = cal_days_in_month(CAL_GREGORIAN, (int)$this->input->get_post('bulan'), $this->input->get_post('tahun'));
		$data = array(
			'matriks_kegiatan' => $this->matriks_kegiatan_model->get_matriks_array(($this->input->post())?$this->input->post():$this->input->get(),$number_days),
			'number_days' => $number_days,
			'kegiatan' => $this->kegiatan_model->get_all_array()
		);

		
		return $this->_show_output(array(
                'success' => true,
                'message' => 'success',
                'data' =>$this->matriks_kegiatan_model->get_matriks_array(($this->input->post())?$this->input->post():$this->input->get(),$number_days)
                ));
	}

	public function get_kegiatan(){	
		return $this->_show_output(array(
                'success' => true,
                'message' => 'success',
                'data' =>$this->kegiatan_model->get_all_bymonth(($this->input->post())?$this->input->post():$this->input->get())
                ));
	}

	protected function _show_output($payloads){
        $this->output->set_content_type('application/json', 'UTF-8');
        $this->output->set_output(json_encode($payloads));
        $this->output->_display();
        exit();
    }

}