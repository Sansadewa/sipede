<?php

/**
 * 
 */
class Spd extends MY_Controller
{
	
	function __construct(){
		parent::__construct(array('title_page'=>'Kelola SPD','akses'=>3));	 
		$this->load->model('surat_tugas_model');
		$this->load->model('spd_model');
		$this->load->model('matriks_kegiatan_model');
		$this->load->model('surat_bayar_model');
		$this->load->model('akun_bayar_model');
		$this->load->model('no_surat_model');
		$this->load->model('kegiatan_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'spd_view',
		);
		$data = array_merge($d,$this->data);
		$this->load->view('spd/index',$data);
	}

	public function get_tujuan(){

		/*$this->db->select('nama');
		$this->db->like('nama',$this->input->get('query'));
		$q = $this->db->get('wilayah_tugas')->result_array();

		$data = array();
		foreach ($q as $value) {
			$data[] = ucwords(strtolower($value['nama']));
		}

		echo json_encode($data);*/
		$this->db->like('kode','63%');
		$q = $this->db->get('wilayah_tugas')->result_array();
		$text = '<option> --Pilih Indikator--</option>';

			foreach ($q as $value) {
				$text .= '<option value='.$value['id'].'>'.$value['nama'].'</option>';	
			}

			echo $text;

	}



	function print_spd(){
		$this->load->library('pdfgenerator');
		if($this->input->get('only_st')==1){
			$surat = $this->spd_model->get_print_spd($this->input->get('id'));

			$surat->akun_bayar = $this->kegiatan_model->get_kegiatan_lds($surat->akun_bayar,date('Y'))->nama;

			$this->db->where('id_st',$surat->st_id);
			$this->db->order_by('tj_urutan','asc');
			$q = $this->db->get('tujuan_spd');

			$this->db->where('id_st',$surat->st_id);
			$this->db->order_by('pengikut_id','asc');
			$pengikut = $this->db->get('pengikut_spd');

			$data = array(
				'spd_setting' => $this->system->get_set('spd_setting'),
				'surat' => $surat,
				'jangka_waktu_hari' => $surat->waktu." (".terbilang($surat->waktu).") hari",
				'jangka_waktu' => jangka_waktu($surat),
				'tujuan_spd' => $q->result_array(),
				'pengikut' =>  $pengikut->result_array()

			);
			if($this->input->get('dev')!=1){
				//$this->load->view('print/surat_sppd', $data);
		    	$html = $this->load->view('print/surat_sppd', $data, true);
		    	$filename = 'SPD_'.$surat->nama.'_'.$surat->kegiatan;
		    	$this->pdfgenerator->generate($html, $filename, true, 'A4s', 'portrait',$this->input->get('attachment'));	
			}else{
				$this->load->view('print/surat_sppd', $data);
			}
				
		}else{
			$surat = $this->spd_model->get_print_st($this->input->get('id'));

			$data = array(
				'spd_setting' => $this->system->get_set('spd_setting'),
				'surat' => $surat,
				'jangka_waktu_hari' => $surat->waktu." (".terbilang($surat->waktu).") hari",
				'jangka_waktu' => jangka_waktu($surat)

			);
			$this->load->view('print/surat_tugas', $data);
	    	$html = $this->load->view('print/surat_tugas', $data, true);
	    	$filename = 'ST_'.$surat->nama.'_'.$surat->kegiatan;
	    	$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait',$this->input->get('attachment'));
		}
	}

	function print_snappy(){
		$this->load->library('snappy');
		$surat = $this->spd_model->get_print_spd($this->input->get('id'));
		$data = array(
			'spd_setting' => $this->system->get_set('spd_setting'),
			'surat' => $surat,
			'jangka_waktu' => $surat->waktu." (".terbilang($surat->waktu).") hari"
		);
		$html = $this->load->view('print/surat_tugas', $data, true);
        $this->snappy->local_generate($html);
	}

	function kelola(){
		if($this->input->get()){
			$mtx = $this->matriks_kegiatan_model->get_byId($this->input->get('id'));
			$akun  = $this->kegiatan_model->get_kegiatan_lds($mtx->kode_kegiatan,date('Y'));
			if($mtx->is_spd == 1){
				$spd = $this->spd_model->get_byMtxId($mtx->id);
				$st = $this->surat_tugas_model->get_byMtxId($mtx->id);
				$sby = $this->surat_bayar_model->get_byMtxId($mtx->id,FALSE);
				
				$d = array(
					'sidebar_aktif'=>'spd_kelola',
					'matriks_kegiatan' => $this->matriks_kegiatan_model->get_byId($this->input->get('id'),TRUE),
					'akun_bayar' => $akun?$akun->nama:$this->akun_bayar_model->get_all(),
					'no_surat' => $this->no_surat_model->get_byIdKeg($mtx->kegiatan,1),
					'no_sppd' => $this->no_surat_model->get_byIdKeg($mtx->kegiatan,2),
					'perihal' => is_null($st)?'':$st->tugas,
					'no_surat_selected' =>is_null($st)?'':$st->tanggal_surat,
					'no_sppd_selected' =>is_null($st)?'':$st->tanggal_sppd,
					'kendaraan' => is_null($spd)?'':$spd->kendaraan,
					'berangkat' => is_null($spd)?'':$spd->berangkat,
					'tujuan' => is_null($spd)?'':$spd->tujuan,
					'akun_bayar_selected' => is_null($sby)?'':$sby->akun_bayar,
					'id_spd' => is_null($spd)?'':$spd->id,
					'id_st' => is_null($st)?'':$st->id,
					'id_sby' => is_null($sby)?'':$sby->id,
					'is_sppd' => is_null($st)?'':$st->is_sppd,
					'perkiraan_biaya' => is_null($spd)?'':$spd->perkiraan_biaya,
					'only_st' => $mtx->only_st,
					'only_st' => $mtx->only_st,
					'is_pengawasan' => is_null($st)?'':$st->is_pengawasan,
					'template' => $st->template,
					'no_ppk' => $st->no_ppk,
					'pagu' => $this->kegiatan_model->get_kegiatan_lds($mtx->kode_kegiatan,date('Y')),
					'pagu_realisasi' =>$this->kegiatan_model->get_kegiatan_realisasi($mtx->kode_kegiatan,date('Y')),
					'status' => $st->status,
					'visum_nama' => $st->visum_nama,
					'visum_nip' => $st->visum_nip,
					'visum_jabatan' => $st->visum_jabatan,
					'opsi_lembar4' => $st->opsi_lembar4
 				);
				if(date("Y", $mtx->tanggal_awal)>2022){
					$this->load->model('Suratbaru_model');
					$d['no_surat']=$this->suratbaru_model->get_all_surtug(1);
				}
			}else{
				$d = array(
					'sidebar_aktif'=>'spd_kelola',
					'matriks_kegiatan' => $this->matriks_kegiatan_model->get_byId($this->input->get('id'),TRUE),
					'akun_bayar' => $akun?$akun->nama:$this->akun_bayar_model->get_all(),
					'no_surat' => $this->no_surat_model->get_byIdKeg($mtx->kegiatan,1),
					'no_sppd' => $this->no_surat_model->get_byIdKeg($mtx->kegiatan,2),
					'perihal' => '',
					'no_surat_selected' =>'',
					'no_sppd_selected' =>'',
					'kendaraan' => '',
					'berangkat' =>'',
					'tujuan' =>'',
					'akun_bayar_selected' =>'',
					'id_spd' => '',
					'id_st' => '',
					'id_sby' => '',
					'is_sppd' => '',
					'perkiraan_biaya' => '',
					'only_st' => 0,
					'is_pengawasan' => 0,
					'template' => '',
					'no_ppk' => '',
					'pagu' => $this->kegiatan_model->get_kegiatan_lds($mtx->kode_kegiatan,date('Y')),
					'pagu_realisasi' =>$this->kegiatan_model->get_kegiatan_realisasi($mtx->kode_kegiatan,date('Y')),
					'status' => '',
					'visum_nama' => '',
					'visum_nip' => '',
					'visum_jabatan' => '',
					'opsi_lembar4' => ''
				);
				if(date("Y", $mtx->tanggal_awal)>2022){
					$this->load->model('Suratbaru_model');
					$d['no_surat']=$this->suratbaru_model->get_all_surtug(1);
				}
			}
			$data = array_merge($d,$this->data);
			// echo "<pre>"; print_r($data);
			$this->load->view('spd/create',$data);
		}else{
			
		$d = array(
			'sidebar_aktif'=>'spd_kelola',
		);
		$data = array_merge($d,$this->data);
		$this->load->view('spd/kelola',$data);
		}

	}

	function add(){
		$this->surat_tugas_model->add($this->input->post());
	}

	function add_tujuan(){
		$form_data = $this->input->post('form');

		$this->db->insert('tujuan_spd',array('tj_is_pp'=>$form_data['is_pp'],'tj_urutan'=>$form_data['urut'],'id_st'=>$form_data['id_st'],'tj_berangkat'=>$form_data['berangkat'],'tj_kembali'=>$form_data['kembali'],'tj_tanggal_berangkat'=>explode('-', $form_data['tanggal_tujuan'])[0],'tj_tanggal_kembali'=>explode('-', $form_data['tanggal_tujuan'])[1]));
		
		$this->get_table_tujuan();
	}

	function add_pengikut(){
		$form_data = $this->input->post('form');

		$this->db->insert('pengikut_spd',array('id_st'=>$form_data['id_st_pengikut'],'pengikut_nama'=>$form_data['pengikut_nama'],'pengikut_ttl'=>$form_data['tanggal_lahir'],'pengikut_ket'=>$form_data['pengikut_ket']));
		
		$this->get_table_pengikut();
	}

	function delete_pengikut(){
		$this->db->where('pengikut_id',$this->input->post('id'));
		$q = $this->db->delete('pengikut_spd');

		$data = array('data'=>'ok');

		echo json_encode($data);
	}	

	function delete_tujuan(){
		$this->db->where('tj_id',$this->input->post('id'));
		$q = $this->db->delete('tujuan_spd');

		$data = array('data'=>'ok');

		echo json_encode($data);
	}

	function get_table_pengikut(){
		$this->db->where('id_st',$this->input->post('id'));
		$q = $this->db->get('pengikut_spd');

		$data = array();

		foreach ( $q->result_array() as $value) {
            	$value['aksi'] ='<a href="javascript:;" type="button" class="btn-danger btn-sm"
                        data-toggle="modal" data-id="'.$value['pengikut_id'].'" data-nama="'.$value['pengikut_nama'].' - '.$value['pengikut_ket'].'" data-link="spd/delete_tujuan/'.$value['pengikut_id'].'/"
                            data-target="#modal-konfirmasi" onclick="delete_pengikut('.$value['pengikut_id'].')"
                            title="Hapus Item"> <i class="fa fa-remove"> </i> </a>
                            ';
				$data[]=$value;
          }

		echo json_encode(array('data'=>$data));

	}

	function get_table_tujuan(){
		$this->db->where('id_st',$this->input->post('id'));
		$q = $this->db->get('tujuan_spd');

		$data = array();

		foreach ( $q->result_array() as $value) {
				$value['tj_tanggal'] = $value['tj_tanggal_berangkat'].' - '.$value['tj_tanggal_kembali'];
            	$value['aksi'] ='<a href="javascript:;" type="button" class="btn-danger btn-sm"
                        data-toggle="modal" data-id="'.$value['tj_id'].'" data-nama="'.$value['tj_berangkat'].' - '.$value['tj_kembali'].'" data-link="spd/delete_tujuan/'.$value['tj_id'].'/"
                            data-target="#modal-konfirmasi" onclick="delete_tujuan('.$value['tj_id'].')"
                            title="Hapus Item"> <i class="fa fa-remove"> </i> </a>
                            ';
				$data[]=$value;
          }

		echo json_encode(array('data'=>$data));

	}
}