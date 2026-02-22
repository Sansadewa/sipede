<?php

/**
 * 
 */
class Export extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct(array('title_page'=>'Master Aplikasi','akses'=>1));	
		$this->load->model('export_model');
	}

	function spd(){
		$d = array(
			'sidebar_aktif'=>'export',
			'setting' => $this->system->get_set('spd_setting'),
			'kode' => $this->system->get_set2('spd_kode_wilayah'),
			'tahun' => date('Y')
		);
		$data = array_merge($d,$this->data);
		$this->load->view('export/spd',$data);
	}

	function list_export_spd(){
		$data = array(
			array(
				'id' => 1,
				'nama'=> 'Download Rekap Perjalanan Dinas',
				'aksi'=> '<a href="javascript:" class="btn btn-success" data-link="#" data-url="'.base_url('export/spd_rekap').'" data-toggle="modal" data-target="#myModalCetak" ><i class="fa fa-download">Download</i></a>',
				'url' => base_url('export/spd_rekap')
			),
			array(
				'id' => 2,
				'nama'=> 'Download Rekap Realisasi Anggaran',
				'aksi'=> '<a href="javascript:" class="btn btn-success" data-link="#" data-url="'.base_url('export/spd_realisasi').'" data-toggle="modal" data-target="#myModalCetak" ><i class="fa fa-download">Download</i></a>',
				'url' => base_url('export/spd_realisasi')
			)
		);

		$output = array(
            "draw" => 1,
            "recordsTotal" => sizeof($data),
            "recordsFiltered" => 0,
            "data" => $data,
        );

		echo json_encode($output);
	}

	function spd_rekap(){
		$this->export_model->spd_rekap($this->input->get('tahun'));
	}

	function spd_realisasi(){
		$this->export_model->spd_realisasi($this->input->get('tahun'));
	}


}