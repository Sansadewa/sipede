<?php

/**
 * 
 */
class Master_aplikasi extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Master Aplikasi','akses'=>1));	
		$this->load->model('setting_model');
	}

	function index(){
		$setting = $this->system->get_set('spd_setting');
		if(!isset($setting['bps_head_prov2'])){
			$setting['bps_head_prov2'] = '';
		}
		$d = array(
			'sidebar_aktif'=>'master_aplikasi',
			'setting' => $setting,
			'kode' => $this->system->get_set2('spd_kode_wilayah')
		);
		$data = array_merge($d,$this->data);
		$this->load->view('setting/master_aplikasi',$data);
	}

	function add_setting_umum(){
		$this->setting_model->add_setting($_POST,'spd_setting');
	}

	function add_setting_pejabat(){
		$this->setting_model->add_setting($_POST,'spd_setting');
	}

	function add_wilayah(){
		$simpan = $this->setting_model->add_wilayah($this->input->post(),'spd_kode_wilayah');
		if($simpan){
			echo json_encode(array('status'=>true,'message'=>'Data berhasil disimpan','kode'=>$this->input->post('kode')));
		}else{
			echo json_encode(array('status'=>false,'message'=>'Data gagal disimpan'));
		}
	}
}