<?php

/**
 * 
 */
class KelolaNomorSurat extends MY_Controller
{
	
	function __construct(){
		parent::__construct(array('title_page'=>'Kelola No Surat','akses'=>3));	 
		$this->load->model('kategori_model');
		$this->load->model('suratbaru_model');
		// echo "Sedang Maintenance";
		// die();
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'baru_surat_kelola',
			// 'kategori1' => $this->kategori_model->get_kat1(),
			'kodeorg' => $this->suratbaru_model->get_kode_organisasi(),
			'jenis'=> $this->suratbaru_model->getjenis2()
		);
		$data = array_merge($d,$this->data);
		$this->load->view('no_suratbaru/index',$data);
	}

	function dev(){
		$d = array(
			'sidebar_aktif'=>'baru_tambah_surat_kelola',
			'kategori1' => $this->kategori_model->get_kat1(),
		);
		if ($this->session->userdata('wilayah')->kode=='6300'){
			$kodeorg=array(
				'satker'=>array('63000' => 'Satuan kerja', '63510' => 'Umum')
			);
		} else {
			$kodeorg=array(
				'satker'=>array($this->session->userdata('wilayah')->kode => $this->session->userdata('wilayah')->nama)
			);
		}
		$jenis = array('jenissurat' => $this->suratbaru_model->getjenis()) ;
		
		$data = array_merge($jenis,$d,$kodeorg,$this->data);
		$this->load->view('no_suratbaru/add_form',$data);
	}



	public function add_form(){

		$d = array(
			'sidebar_aktif'=>'baru_tambah_surat_kelola',
			'kategori1' => $this->kategori_model->get_kat1(),
		);
		if ($this->session->userdata('wilayah')->kode=='6300' || substr($this->session->userdata('wilayah')->kode, 0, 3)=='635'){
			$kodeorg=array(
				'satker'=>array('63000' => 'Satuan kerja', '63510' => 'Umum')
			);
		} else {
			$kodeorg=array(
				'satker'=>array($this->session->userdata('wilayah')->kode => $this->session->userdata('wilayah')->nama)
			);
		}
		$jenis = array('jenissurat' => $this->suratbaru_model->getjenis()) ;
		
		$data = array_merge($jenis,$d,$kodeorg,$this->data);
		$this->load->view('no_suratbaru/add_form',$data);
	}

	function get_kat2($kat1=NULL){
		//harusnya di sanitize dulu.
		if($kat1==NULL){
			$kat1=$this->input->post('kat1');
		}

		echo json_encode($this->kategori_model->get_kat2($kat1));
	}

	function get_kat3($kat1=NULL,$kat2=NULL){
		//harusnya di sanitize dulu.
		if($kat1==NULL || $kat2==NULL){
			$kat1=$this->input->post('kat1');
			$kat2=$this->input->post('kat2');
		}

		echo json_encode($this->kategori_model->get_kat3($kat1,$kat2));
	}

	function get_kat4(){
		//harusnya di sanitize dulu.
			$kat1=$this->input->post('kat1');
			$kat2=$this->input->post('kat2');
			$kat3=$this->input->post('kat3');

		echo json_encode($this->kategori_model->get_kat4($kat1,$kat2,$kat3));
	}

	function get_kode_surat(){
		$kat1=$this->input->post('kat1');
		$kat2=$this->input->post('kat2');
		$kat3=$this->input->post('kat3');
		$kat4=$this->input->post('kat4');
		$kode=$this->kategori_model->get_kode_surat($kat1,$kat2,$kat3,$kat4);
		if($kat3=='Kosong'){
			$kode->kode=substr_replace($kode->kode, '00', -2);
		} else if ($kat4=='Kosong'){
			$kode->kode=substr_replace($kode->kode, '0', -1);
		}			
		echo json_encode($kode);

	}

	function get_nomor_surat(){
		$tahun=$this->input->post('tahun');
		$kodeorg=$this->input->post('kodeorg');
		$jenis=$this->input->post('jenis');
		$input = $this->suratbaru_model->get_nomor_surat($tahun,$kodeorg,$jenis);

		//kalau kosong, berarti belum ada surat, berarti kasih 0001
		if($input==NULL){
			// print_r($input);
			echo json_encode(array('nomor' => '1'));
		} else {
			// print_r($input);
			$date = strtotime($input->date_created);  // Convert the date variable to a Unix timestamp
			$now = time();  // Get the current Unix timestamp
			$date = date('Y-m-d', $date);  // Extract the date part of the $date timestamp
			$now = date('Y-m-d', $now);  // Extract the date part of the $now timestamp

			//kalau ada titiknya, dihilangkan dulu.
			$dot_position = strpos($input->nomor, ".");
			if ($dot_position !== false) {
				$input->nomor = substr($input->nomor, 0, $dot_position);
			}

			// kalau ini nomor baru di hari itu (nomor yg sudah ada, tanggalnya tanggal kemarin.), maka nomor +5, kata pak robimanto
			if ($date < $now) {
				// echo json_encode(array('nomor' => str_pad($input->nomor+5, 4, "0", STR_PAD_LEFT)));
				echo json_encode(array('nomor' => $input->nomor+5));
			} else {
				// echo json_encode(array('nomor' => str_pad($input->nomor+1, 4, "0", STR_PAD_LEFT)));
				echo json_encode(array('nomor' => $input->nomor+1));
			}
			
			

		}
	}


	function get_all(){
		echo $this->suratbaru_model->get_all($this->input->post());
	}

	function tambah(){
		if($this->input->post()){

			//digunakan kalau dynamic form nyala
			// $data = $this->input->post('num')['num'];
			// foreach ($data as $value) {
			// 	if(!$value['nomor']){
			// 		$value['nomor'] = $this->get_current_nomor('array',$value)['nomor'];
			// 		$value['is_edit_num'] = FALSE;
			// 	}else{
			// 		$value['is_edit_num'] = TRUE;
			// 	}

			// 	//print_r($value);
			// 	$this->no_surat_model->add($value,FALSE);
			// }
			// redirect('/kelola_no_surat');
			// exit();
				
			$post=$this->input->post();

			//sanitize si nomor, harus 4 digit.
			// if(strlen($post['nomor']) == 4){
			// 	// number already consists of 4 numbers, do nothing
			//   }else{
			// 	while(strlen($number) < 4){
			// 	  $number = "0" . $number;
			// 	}
			//   }
			
			//cek apakah nomor adalah number
			if(!is_numeric($post['nomor'])){
				$this->session->set_flashdata('danger', 'Nomor Surat harus berupa angka');
				redirect('/kelolanomorsurat/tambah');
				exit();
			}



			
			$adakah=$this->suratbaru_model->validate_nomor($post['nomor'],$post['tanggal'],$post['kode_organisasi'],$post['jenissurat']);
			if(!$adakah){
				$hasilnya=$this->suratbaru_model->tambah($post);
				$this->session->set_flashdata('success', 'Nomor Surat <b>'.$hasilnya.'</b> Berhasil ditambahkan. <a href="#" class="btn btn-sm btn-success" onclick="navigator.clipboard.writeText(\''.$hasilnya.'\')">Copy Nomor</a>&nbsp;<a href="'.base_url('/kelolanomorsurat').'" class="btn btn-sm btn-info">Lihat Daftar Surat</a>');

			} else {
				//diassign di model aja
				$this->session->set_flashdata('danger', 'Nomor sudah ada ('.$adakah->full_kode.') <a href="'.base_url('/kelolanomorsurat').'">Lihat Daftar Surat</a>');
				// $this->session->set_flashdata('danger', 'Nomor sudah ada. <a href="'.base_url('/kelolanomorsurat').'">Lihat Daftar Surat</a>');
			}
			redirect('kelolanomorsurat/add_form');

		} else {
			$this->session->set_flashdata('warning', 'No data');
			redirect('kelolanomorsurat/add_form');
		}
	}
	function edit(){
		$this->suratbaru_model->edit($this->input->post());
		$this->session->set_flashdata('success', 'Nomor Surat Berhasil diedit');
		redirect('kelolanomorsurat');
	}

	function delete(){
		$this->suratbaru_model->delete($this->input->get());
		redirect('kelolanomorsurat');
	}

	// function get_current_nomor($format = null,$post_data = null){

	// 	if($post_data){
	// 		$id = $post_data['jenis'];
	// 	}else{
	// 		$id = $this->input->get_post('jenis');
	// 	}

	// 	$this->db->where('id',$id);
	// 	$q = $this->db->get('jenis_surat');
	// 	$surat = $q->row();
	// 	if(in_array($this->session->userdata('wilayah')->kode, array('6351','6352','6353','6354','6355','6356','6300'))){
	// 		$setting = $this->system->get_set('spd_number_prov',TRUE);
	// 		$num = $setting[$surat->jenis]+1;
	// 	}else{
	// 		$setting = $this->system->get_set('spd_surat_number');
	// 		$num = $setting[$id]+1;
	// 	}
	// 	$replaces = array(
    //         '{NUM}' => sprintf("%03d", $num),
    //         '{BLN}' => date("m"),
    //         '{THN}' => date("Y"),
    //         );
    //     $nomor = str_ireplace(array_keys($replaces), array_values($replaces), $surat->template);
	// 	$data= array(
	// 		'status'=>'ok',
	// 		'nomor' => $nomor,
	// 	);

	// 	if($format){
	// 		return $data;
	// 	}else{
	// 		echo json_encode($data);
	// 	}
	// }
}