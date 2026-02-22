<?php

/**
 * 
 */
class Matriks_kegiatan extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Kelola Matriks','akses'=>3));	
		$this->load->model('matriks_kegiatan_model');
		$this->load->model('kegiatan_model');
		$this->load->model('pegawai_model');
		$this->load->model('spd_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'mtx_main',
			'opsi_kegiatan' => $this->kegiatan_model->get_all(),
			'opsi_pegawai' => $this->pegawai_model->get_all()
		);

		$data = array_merge($d,$this->data);
		$this->load->view('matriks_kegiatan/index',$data);
	}

	function edit_matriks(){
		
	}

	public function add_form(){

		if($this->input->post()){
			$data = $this->input->post()['matriks']['matriks'];
			foreach ($data as $value) {
				if($value['daterange']){
					$value['periode_waktu_awal'] = explode("-", $value['daterange'])[0];
					$value['periode_waktu_akhir'] = explode("-", $value['daterange'])[1];
					$value['cek'] = 1;
				}else{
					$value['cek'] = 0;
				}
				$data['output']=json_decode($this->matriks_kegiatan_model->add($value),true);
			}
			redirect('/matriks_kegiatan');
		}

		$d = array(
			'sidebar_aktif'=>'mtx_main',
			'opsi_kegiatan' => $this->kegiatan_model->get_all(),
			'opsi_pegawai' => $this->pegawai_model->get_all()
		);

		$data = array_merge($d,$this->data);
		$this->load->view('matriks_kegiatan/add',$data);
	}

	public function get_kegiatan(){
		$prov = array('6300','6351','6352','6353','6354','6355','6356');
		if($this->input->post('type') == 1){
				$opsi_kegiatan = $this->kegiatan_model->get_all_lds();
		echo json_encode($opsi_kegiatan);
		}else{
				$opsi_kegiatan = $this->kegiatan_model->get_all();
		echo json_encode($opsi_kegiatan);
		}
		
	}

	public function validasi_tanggal(){
		$value = $this->input->post();
		if($value['daterange']){
			$value['periode_waktu_awal'] = explode("-", $value['daterange'])[0];
			$value['periode_waktu_akhir'] = explode("-", $value['daterange'])[1];
			$value['cek'] = 1;
		}else{
			$value['cek'] = 0;
		}
echo json_encode(array('status'=>'success','message'=>'Tanggal sudah diisi kegiatan lain.'));
		//echo $this->matriks_kegiatan_model->validasi_tanggal($value);
	}

	function show_matriks(){
        $number_days = cal_days_in_month(CAL_GREGORIAN, (int)$this->input->post('bulan'), $this->input->post('tahun'));
		$data = array(
			'matriks_kegiatan' => $this->matriks_kegiatan_model->get_matriks_array($this->input->post(),$number_days),
			'number_days' => $number_days,
			'kegiatan' => $this->kegiatan_model->get_all_array()
		);

		$this->load->view('matriks_kegiatan/table_matriks',$data);
	}

	function show_matriks_wilayah(){
        $number_days = cal_days_in_month(CAL_GREGORIAN, (int)$this->input->post('bulan'), $this->input->post('tahun'));
		$data = array(
			'matriks_kegiatan' => $this->matriks_kegiatan_model->get_matriks_array($this->input->post(),$number_days),
			'number_days' => $number_days,
			'kegiatan' => $this->kegiatan_model->get_all_array()
		);

		$this->load->view('matriks_kegiatan/table_matriks_wilayah',$data);
	}

	function to_excel(){
		 $number_days = cal_days_in_month(CAL_GREGORIAN, (int)$this->input->get('bulan'), $this->input->get('tahun'));
		 return $this->matriks_kegiatan_model->to_excel($this->input->get(),$number_days);
	}

	function add(){
		echo $this->matriks_kegiatan_model->add($this->input->post());
	}

	function edit(){
		echo $this->matriks_kegiatan_model->edit($this->input->post());
	}

	function delete(){
		$this->matriks_kegiatan_model->delete($this->input->get('id'));
	}

	function get_all(){
		echo $this->matriks_kegiatan_model->get_all_table($this->input->post(),false);
	}

	function get_all_kelola_spd(){
		echo $this->matriks_kegiatan_model->get_all_table($this->input->post(),TRUE);
	}

	function get_all_kelola_spd_ppk(){
		echo $this->matriks_kegiatan_model->get_all_table($this->input->post(),TRUE,TRUE);
	}
}