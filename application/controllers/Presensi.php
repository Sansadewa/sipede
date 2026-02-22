<?php 

/**
 * 
 */
class Presensi extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Data Presensi','akses'=>3));	
		$this->load->model('presensi_model');
		$this->load->model('pegawai_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'presensi_rekap',
			'setting' => $this->system->get_set('spd_setting'),
			'sinkronisasi' => $this->system->get_set('spd_presensi'),
			'pegawai' => $this->pegawai_model->get_by_wil($this->session->userdata('wilayah')->kode)
		);
		$data = array_merge($d,$this->data);
		$this->load->view('presensi/index',$data);
	}

	function get_rekap(){
		if($this->input->get()){
			$this->output->set_content_type('application/json', 'UTF-8');
	        $this->output->set_output($this->presensi_model->get_rekap($this->input->get()));
	        $this->output->_display();
	        exit();
		}else{
			$this->output->set_content_type('application/json', 'UTF-8');
	        $this->output->set_output($this->presensi_model->get_rekap($this->input->post()));
	        $this->output->_display();
	        exit();
		}
	}

	function get_kegiatan(){
		$this->db->select('st.nip, st.tugas,mk.tanggal_awal,mk.tanggal_akhir,mk.array_tanggal,k.nama');
		$this->db->join('matriks_kegiatan mk','mk.id = st.id_matriks');
		$this->db->join('kegiatan k','k.id = st.id_kegiatan');
		$this->db->where('st.nip',$this->input->get('nip'));
		$this->db->where('( from_unixtime(mk.tanggal_awal,"%m") <= '.$this->input->get('bulan').' AND from_unixtime(mk.tanggal_akhir,"%m") >= '.$this->input->get('bulan').')');
		$q = $this->db->get('surat_tugas st')->result_array();

		$this->output->set_content_type('application/json', 'UTF-8');
	    $this->output->set_output(json_encode($q));
	    $this->output->_display();
	    exit();
	}

	public function sync(){
		$sdate  = date('Y-m-d',mktime(0,0,0,date("m"),'1',date("Y")));
		$edate  = date("Y-m-d");
		if(isset($_GET['tgl_mulai'])){
			$sdate  = $_GET['tgl_mulai'];
			$edate  = $_GET['tgl_akhir'];
		}
		$number = "";
		for($i=1;$i<=200;$i++){
			$number.=($i.",");
		}
		$number=substr($number,0,strlen($number)-1);
		$url = "http://".$this->system->get_set2('spd_mesin_absen')."/form/Download?uid=".$number."&sdate=".$sdate."&edate=".$edate."";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		$data = array();
		$record = explode("\n",$server_output);
		foreach($record as $r){
			$r = str_replace("\t"," ",$r);
			$isi = explode(" ",$r);
			array_push($data, $isi);
		}

		for($i=0;$i<count($data);$i++){
			$total    = 0;
			for($j=0;$j<=3;$j++){
				if (!isset($data[$i][$j])) {
					$data[$i][$j] = null;
				}
			}
			if($data[$i][0]<>null || $data[$i][2]<>null || $data[$i][3]<>null){
				if(substr($data[$i][3],0,4)>1000){
					$nick         = $data[$i][2];
					$data[$i][2]  = $data[$i][3];
					$data[$i][3]  = $data[$i][4];
					$data[$i][4]  = $data[$i][5];
				}
				$datetime = $data[$i][2]." ".$data[$i][3];
				if($datetime<>' ' && $total==0){
					$hash = hash('md5', $data[$i][0] . $data[$i][2]. $data[$i][3] . $data[$i][4].$datetime);
					$this->db->where(array('key' => $hash));
                	$query = $this->db->get('presensi');
                	if ($query->num_rows() == 0) {
						$insert = array(
							'key' => $hash,
							'id_absen' => $data[$i][0],
							'datelog' =>$data[$i][2],
							'timelog' =>$data[$i][3],
							'function_key' =>$data[$i][4],
							'date' =>$datetime
						);

						$this->db->insert('presensi',$insert);
                	}
				}
			}
		}
		$this->db->where('set_key','spd_presensi_'.$this->session->userdata('wilayah')->kode);
		$this->db->set('set_val',json_encode(array('last_run'=>time())));
		$this->db->update('setting');
		
		print_r(json_encode(array('status'=>true,'message'=>'Sinkronisasi Selesai')));

	}

	
}