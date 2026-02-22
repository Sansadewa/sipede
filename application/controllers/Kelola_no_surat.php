<?php

/**
 * 
 */
class Kelola_no_surat extends MY_Controller
{
	
	function __construct(){
		parent::__construct(array('title_page'=>'Kelola No Surat','akses'=>3));	 
		$this->load->model('no_surat_model');
		$this->load->model('kegiatan_model');
		$this->load->model('jenis_surat_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'surat_kelola',
			'opsi_kegiatan' => $this->kegiatan_model->get_all(1),
			'opsi_jenis' => $this->jenis_surat_model->get_all()
		);
		$data = array_merge($d,$this->data);
		$this->load->view('no_surat/index',$data);
	}

	function get_all_table(){
		echo $this->no_surat_model->get_all_table($this->input->post());
	}

	public function add_form(){

		if($this->input->post()){
			print_r($this->input->post('num'));
			print_r($data);
			die();
			$data = $this->input->post('num')['num'];
			foreach ($data as $value) {
				if(!$value['nomor']){
					$value['nomor'] = $this->get_current_nomor('array',$value)['nomor'];
					$value['is_edit_num'] = FALSE;
				}else{
					$value['is_edit_num'] = TRUE;
				}

				//print_r($value);
				$this->no_surat_model->add($value,FALSE);
			}
			redirect('/kelola_no_surat');
			exit();
		}

		$d = array(
			'sidebar_aktif'=>'surat_kelola_tambah',
			'opsi_kegiatan' => $this->kegiatan_model->get_all(1),
			'opsi_jenis' => $this->jenis_surat_model->get_all()
		);

		$data = array_merge($d,$this->data);
		$this->load->view('no_surat/add_form',$data);
	}

	function add(){
		$this->no_surat_model->add($this->input->post());
	}

	function edit(){
		$this->no_surat_model->edit($this->input->post());
	}

	function delete(){
		$this->no_surat_model->delete($this->input->get());
	}

	function get_current_nomor($format = null,$post_data = null){

		if($post_data){
			$id = $post_data['jenis'];
		}else{
			$id = $this->input->get_post('jenis');
		}

		$this->db->where('id',$id);
		$q = $this->db->get('jenis_surat');
		$surat = $q->row();
		if(in_array($this->session->userdata('wilayah')->kode, array('6351','6352','6353','6354','6355','6356','6300'))){
			$setting = $this->system->get_set('spd_number_prov',TRUE);
			$num = $setting[$surat->jenis]+1;
		}else{
			$setting = $this->system->get_set('spd_surat_number');
			$num = $setting[$id]+1;
		}
		$replaces = array(
            '{NUM}' => sprintf("%03d", $num),
            '{BLN}' => date("m"),
            '{THN}' => date("Y"),
            );
        $nomor = str_ireplace(array_keys($replaces), array_values($replaces), $surat->template);
		$data= array(
			'status'=>'ok',
			'nomor' => $nomor,
		);

		if($format){
			return $data;
		}else{
			echo json_encode($data);
		}
	}
}