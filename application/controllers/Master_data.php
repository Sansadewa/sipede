<?php

/**
 * 
 */
class Master_data extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Master Data','akses'=>1));	
		$this->load->model('setting_model');
		$this->load->model('pangkat_model');
		$this->load->model('jabatan_model');
		$this->load->model('akun_bayar_model');
		$this->load->model('jenis_surat_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'master_data',
			'setting' => $this->system->get_set('spd_setting'),
			'ip_mesin' =>$this->system->get_set2('spd_mesin_absen')
		);
		$data = array_merge($d,$this->data);
		$this->load->view('setting/master_data',$data);
	}

	function get_pangkat(){
		echo $this->pangkat_model->get_all_table();
	}

	function add_pangkat(){
		echo $this->pangkat_model->add($this->input->get());
	}

	function edit_pangkat(){
		echo $this->pangkat_model->edit($this->input->get());
	}

	function delete_pangkat(){
		$this->pangkat_model->delete($this->input->get());
	}

	function get_jabatan(){
		echo $this->jabatan_model->get_all_table();
	} 

	function add_jabatan(){
		echo $this->jabatan_model->add($this->input->get());
	}

	function edit_jabatan(){
		echo $this->jabatan_model->edit($this->input->get());
	}

	function delete_jabatan(){
		$this->jabatan_model->delete($this->input->get());
	}

	function get_akun_bayar(){
		echo $this->akun_bayar_model->get_all_table();
	} 

	function add_akun_bayar(){
		echo $this->akun_bayar_model->add($this->input->get());
	}

	function edit_akun_bayar(){
		echo $this->akun_bayar_model->edit($this->input->get());
	}

	function delete_akun_bayar(){
		$this->akun_bayar_model->delete($this->input->get());
	}

	function get_kategori_surat(){
		echo $this->jenis_surat_model->get_all_table();
	}
	function add_kategori_surat(){
		echo $this->jenis_surat_model->add($this->input->get());
	}

	function edit_kategori_surat(){
		echo $this->jenis_surat_model->edit($this->input->get());
	}

	function delete_kategori_surat(){
		$this->jenis_surat_model->delete($this->input->get());
	}

	function add_setting_umum(){
		$this->setting_model->add_setting($_POST,'spd_setting');
	}

	function add_setting_pejabat(){
		$this->setting_model->add_setting($_POST,'spd_setting');
	}

	function add_mesin(){
		$simpan = $this->setting_model->add_mesin($this->input->post(),'spd_mesin_absen');
		if($simpan){
			echo json_encode(array('status'=>true,'message'=>'Data berhasil disimpan','ip'=>$this->input->post('ip_mesin')));
		}else{
			echo json_encode(array('status'=>false,'message'=>'Data gagal disimpan'));
		}
	}
}