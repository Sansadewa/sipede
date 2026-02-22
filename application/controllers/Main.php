<?php

class Main extends MY_Controller{

	function __construct(){
		parent::__construct(array('title_page'=>'Dashboard','akses'=>3));	 
		$this->load->model('progress_model');
		$this->load->model('surat_tugas_model');
	}
 
	function index(){
		$d = array(
            'tercetak' => $this->surat_tugas_model->get_status('2')->num_rows(),
            'dikumpulkan' => $this->surat_tugas_model->get_status('3')->num_rows(),
            'dibayar' => $this->surat_tugas_model->get_status('4')->num_rows(),
            'terdokumentasi' => $this->surat_tugas_model->get_status('5')->num_rows(), 
            'sidebar_aktif'=>'dashboard'
            );
		$data =array_merge($this->data,$d);
		$this->load->view('main',$data);
	}

	function get_table_progress(){
		echo $this->progress_model->get_all_table($this->input->post());
	}

	function grafik_bulanan(){
		$tercetak = array('name'=>'Tercetak');
		$dikumpulkan = array('name'=>'Dikumpulkan');
		$dibayar = array('name'=>'Dibayar');

		$bulan = array(
		    '01' => 'Januari',
		    '02' => 'Februari',
		    '03' => 'Maret',
		    '04' => 'April',
		    '05' => 'Mei',
		    '06' => 'Juni',
		    '07' => 'Juli',
		    '08' => 'Agustus',
		    '09' => 'September',
		    '10' => 'Oktober',
		    '11' => 'November',
		    '12' => 'Desember',
		 );
			
		$temp = array();
		foreach ($bulan as $key => $value) {
			$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$key.'-'.date('Y'))));
			$tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $key, date('Y')).'-'.$key.'-'.date('Y'))));
			$this->db->select('count(*) as jum');
			$this->db->from('surat_tugas st');
			$this->db->join('no_surat no','no.id=st.tanggal_surat');
			$this->db->join('pegawai  peg','peg.nip = st.nip');
			$this->db->where('no.tanggal >=', $tanggal_awal);
        	$this->db->where('no.tanggal <=', $tanggal_akhir);
        	$this->db->where('st.status',2);
        	$this->db->where('peg.wilayah',$this->session->userdata('wilayah')->kode);
        	$q = $this->db->get()->row();
        	$temp[] = (int)$q->jum;
		}
		$tercetak['data']=$temp;

		$temp = array();
		foreach ($bulan as $key => $value) {
			$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$key.'-'.date('Y'))));
			$tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $key, date('Y')).'-'.$key.'-'.date('Y'))));
			$this->db->select('count(*) as jum');
			$this->db->from('surat_tugas st');
			$this->db->join('no_surat no','no.id=st.tanggal_surat');
			$this->db->join('pegawai  peg','peg.nip = st.nip');
			$this->db->where('no.tanggal >=', $tanggal_awal);
        	$this->db->where('no.tanggal <=', $tanggal_akhir);
        	$this->db->where('st.status >=',3);
        	$this->db->where('peg.wilayah',$this->session->userdata('wilayah')->kode);
        	$q = $this->db->get()->row();
        	$temp[] = (int)$q->jum;
		}
		$dikumpulkan['data']=$temp;

		$temp = array();
		foreach ($bulan as $key => $value) {
			$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$key.'-'.date('Y'))));
			$tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $key, date('Y')).'-'.$key.'-'.date('Y'))));
			$this->db->select('count(*) as jum');
			$this->db->from('surat_tugas st');
			$this->db->join('no_surat no','no.id=st.tanggal_surat');
			$this->db->join('pegawai  peg','peg.nip = st.nip');
			$this->db->where('no.tanggal >=', $tanggal_awal);
        	$this->db->where('no.tanggal <=', $tanggal_akhir);
        	$this->db->where('st.status',4);
        	$this->db->where('peg.wilayah',$this->session->userdata('wilayah')->kode);
        	$q = $this->db->get()->row();
        	$temp[] = (int)$q->jum;
		}
		$dibayar['data']=$temp;

		echo(json_encode(array($tercetak,$dikumpulkan,$dibayar)));
	}


}