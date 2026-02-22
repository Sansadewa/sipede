<?php

/**
 * 
 */
class Surat_bayar extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Kelola Surat Bayar','akses'=>2));	
		$this->load->model('spd_model');
		$this->load->model('matriks_kegiatan_model');
		$this->load->model('surat_tugas_model');
		$this->load->model('surat_bayar_model');
		$this->load->model('no_surat_model');
		$this->load->model('kegiatan_model');
	}

	function index(){
		$d = array(
			'sidebar_aktif'=>'spd_bayar',
		);

		$data = array_merge($d,$this->data);
		$this->load->view('surat_bayar/index',$data);
	}

	function set_bisa_bayar(){
		echo $this->surat_bayar_model->set_bisa_bayar($this->input->post());
	}

	function set_bisa_bayar_ppk(){
		echo $this->surat_bayar_model->set_bisa_bayar_ppk($this->input->post());
	}

	function get_all_table(){
		echo $this->surat_bayar_model->get_all_table($this->input->post());
	}

	function get_all_table_ppk(){
		echo $this->surat_bayar_model->get_all_table_ppk($this->input->post());
	}

	function kelola(){
		if($this->input->get()){
			$st = $this->surat_tugas_model->get_byMtxId($this->input->get('id'));
			$spd = $this->spd_model->get_byMtxId($this->input->get('id'));
			if($st->is_bayar == 1){
				$sby = $this->surat_bayar_model->get_byMtxId($this->input->get('id'),FALSE);
				$d = array(
					'sidebar_aktif'=>'spd_bayar',
					'matriks_kegiatan' => $this->matriks_kegiatan_model->get_byId($this->input->get('id'),TRUE),
					'no_sppd' =>$st->no_sppd,
					'no_sby' =>$this->no_surat_model->get_byIdKeg($st->id_kegiatan,3),
					'no_sby_selected' => $sby->no_surat_bayar,
					'waktu_harian' => $sby->waktu_harian,
					'uang_harian' => $sby->uang_harian,
					'waktu_harian' => $sby->waktu_harian,
					'waktu_fullboard' => $sby->waktu_fullboard,
					'uang_harian_fullboard' => $sby->uang_harian_fullboard,
					'uang_transport' =>$sby->uang_transport,
					'waktu_penginapan' => $sby->waktu_penginapan,
					'uang_penginapan' =>$sby->uang_penginapan,
					'waktu_penginapan_kwitansi' => $sby->waktu_penginapan_kwitansi,
					'uang_penginapan_kwitansi' =>$sby->uang_penginapan_kwitansi,
					'uang_representatif' =>$sby->uang_representatif,
					'id_spd' => $spd->id,
					'id_st' => $st->id,
					'id_sby' => $sby->id,
					'tanggal_dibuat' => $sby->tanggal_dibuat,
					'opsi_cc' => $sby->opsi_cc,
					'is_pernyataan_tdk_menginap' => $sby->is_pernyataan_tdk_menginap,
					'penginapan_cc' =>$sby->penginapan_cc,
					'transport_cc' =>$sby->transport_cc,
				);
				$data = array_merge($d,$this->data);
				$this->load->view('surat_bayar/create',$data);
			}else{
				$sby = $this->surat_bayar_model->get_byMtxId($this->input->get('id'),false);
				$d = array(
					'sidebar_aktif'=>'spd_bayar',
					'matriks_kegiatan' => $this->matriks_kegiatan_model->get_byId($this->input->get('id'),TRUE),
					'perihal' => '',
					'no_sppd' =>$st->no_sppd,
					'no_sby' => $this->no_surat_model->get_byIdKeg($st->id_kegiatan,3),
					'no_sby_selected' => '',
					'waktu_harian' => '',
					'uang_harian' =>'',
					'waktu_fullboard' => '',
					'uang_harian_fullboard' => '',
					'uang_transport' => '',
					'waktu_penginapan' => '',
					'uang_penginapan' =>'',
					'waktu_penginapan_kwitansi' => '',
					'uang_penginapan_kwitansi' =>'',
					'uang_representatif' =>'',
					'tujuan' =>'',
					'id_spd' => $spd->id,
					'id_st' => $st->id,
					'id_sby' => $sby->id,
					'tanggal_dibuat' => '',
					'opsi_cc' => $sby->opsi_cc,
					'is_pernyataan_tdk_menginap' => 0,
					'penginapan_cc' => 0,
					'transport_cc' => 0
				);
			$data = array_merge($d,$this->data);
			$this->load->view('surat_bayar/create',$data);
			}
		}
	}

	function print_sby(){
		$this->load->library('pdfgenerator');
		$surat = $this->surat_bayar_model->get_print_sby($this->input->get('id'));
		$akun_bayar_lengkap = $this->kegiatan_model->get_kegiatan_lds($surat->akun_bayar,date('Y'))->nama;

		$nosur = $this->no_surat_model->get_byId($surat->no_surat_bayar);
		$tgl = ($nosur->tanggal > 0)?@format_tanggal($nosur->tanggal,true):'...........................';
		switch ($surat->opsi_cc) {
			case '1':
				$teks = 'Biaya Pesawat dan Hotel';
				break;
			case '2':
				$teks = 'Biaya Pesawat';
				break;
			case '3':
				$teks = 'Biaya Hotel';
				break;
			default:
				$teks = '';
				break;
		}

		$data = array(
			'spd_setting' => $this->system->get_set('spd_setting'),
			'surat_bayar' => $surat,
			'akun_bayar_lengkap' => $akun_bayar_lengkap,
			'tanggal_bayar' => $tgl,
			'no_surat_bayar' => ($nosur)?$nosur->nomor:'.................................',
			'th_anggaran' => date('Y',$surat->tanggal_sppd),
			'jangka_waktu_hari' => $surat->waktu." (".terbilang($surat->waktu).") hari",
			'jangka_waktu' => jangka_waktu($surat,false),
			'rincian_tambahan' => $this->db->where('id_surat_bayar',$surat->id_sby)->get('uraian_bayar')->result_object(),
			'teks' => $teks
		); 

		$this->db->set('flag','cetak');
		$this->db->where('id',$surat->id_sby);
		$q = $this->db->update('surat_bayar');

		$this->db->set('status',4);
		$this->db->where('id',$surat->id_st);
		$q = $this->db->update('surat_tugas');
		//$this->load->view('print/surat_bayar',$data);

		if($this->input->get('dev')!=1){
			$html = $this->load->view('print/surat_bayar', $data, true);
    		$filename = 'SBY_'.time();
    		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
		}else{
			$this->load->view('print/surat_bayar', $data);
		}

    	
	}

	function print_snappy(){
		$this->load->library('snappy');
		$surat = $this->surat_bayar_model->get_print_sby($this->input->get('id'));
		$data = array(
			'spd_setting' => $this->system->get_set('spd_setting'),
			'surat_bayar' => $surat,
			'tanggal_bayar' => @format_tanggal($this->no_surat_model->get_byId($surat->no_surat_bayar)->tanggal,true),
			'no_surat_bayar' => $this->no_surat_model->get_byId($surat->no_surat_bayar)->nomor,
			'th_anggaran' => explode('-', $this->no_surat_model->get_byId($surat->no_surat_bayar)->tanggal)[2],
			'jangka_waktu_hari' => $surat->waktu." (".terbilang($surat->waktu).") hari",
			'jangka_waktu' => jangka_waktu($surat,false)
		); 
		$html = $this->load->view('print/surat_bayar',$data,true);
        $this->snappy->local_generate($html);
	}

	function delete(){
		$this->surat_bayar_model->delete($this->input->get('nip'));
	}

	function delete_tambahan(){
		echo json_encode($this->surat_bayar_model->delete_tambahan($this->input->post('id')));
	}

	function edit(){
		$this->surat_bayar_model->edit($this->input->post());
	}

	function add(){
		$this->surat_bayar_model->add($this->input->post());
	}

	function add_tambahan(){
		echo json_encode($this->surat_bayar_model->add_tambahan($this->input->post()));
	}

	function get_table_tambahan(){
		$this->db->where('id_surat_bayar',$this->input->post('id'));
		$q = $this->db->get('uraian_bayar');
		$data = array();

		foreach ( $q->result_array() as $value) {
            	$value['aksi'] ='<a href="javascript:;" type="button" class="btn-danger btn-sm"
                        data-toggle="modal" data-id="'.$value['id_surat_bayar'].'" data-nama="'.$value['rincian'].'" data-link="surat_bayar/delete_tambahan/'.$value['id_uraian_bayar'].'/"
                            data-target="#modal-konfirmasi" onclick="delete_tambahan('.$value['id_uraian_bayar'].')"
                            title="Hapus Item"> <i class="fa fa-remove"> </i> </a>
                            ';
				$data[]=$value;
          }

		echo json_encode(array('data'=>$data));
	}
}