<?php

/**
 * 
 */
class Export_model extends CI_model
{
	
	function spd_rekap($tahun){
		$this->load->library('phpspreadsheet');
		$inputFileName = './assets/excel_template/template_spd.xlsx';
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

		$query="select pegawai.nip,pegawai.nama,tugas,no_ppk,surat_bayar.akun_bayar,(surat_bayar.uang_total+surat_bayar.uang_total_cc) as uang_total,
		FROM_UNIXTIME(matriks_kegiatan.tanggal_awal,'%d-%m-%Y') AS tanggal_awal,
		FROM_UNIXTIME(matriks_kegiatan.tanggal_akhir,'%d-%m-%Y') AS tanggal_akhir,
		surat_tugas.is_bayar
		from surat_tugas
		left join matriks_kegiatan on matriks_kegiatan.id = surat_tugas.id_matriks
		left join kegiatan on kegiatan.id = surat_tugas.id_kegiatan
		left join surat_bayar on surat_bayar.id_matriks = surat_tugas.id_matriks
		LEFT JOIN pegawai ON pegawai.nip = surat_tugas.nip
		where YEAR(surat_tugas.created_at) ='".$tahun."' 
		and MONTH(surat_tugas.created_at) < 12";

		if($this->session->userdata('wilayah')->kode == '6300'){
			$query .= " AND (matriks_kegiatan.wilayah = '6300' OR matriks_kegiatan.wilayah = '6351' OR matriks_kegiatan.wilayah = '6352' 
		OR matriks_kegiatan.wilayah = '6353'OR matriks_kegiatan.wilayah = '6354'OR matriks_kegiatan.wilayah = '6355'OR matriks_kegiatan.wilayah = '6356')";
		}else{
			$query .= " AND matriks_kegiatan.wilayah = '".$this->session->userdata('wilayah')->kode."'";
		}


		$data = $this->db->query($query);
		$fields = $data->list_fields();
		$data = $data->result_array();
		$i=0;
		$row = 1;
		foreach ($fields as $field)
		{
			$spreadsheet->setActiveSheetIndex(0)
							->setCellValue(get_alpabhet($i).'1',$field);   
			$i++;
		}
		$row++;
		foreach ($data as $value) {
			$i=0;
			foreach ($fields as $field){
				$spreadsheet->setActiveSheetIndex(0)
								->setCellValue(get_alpabhet($i).$row,$value[$field]);   
				$i++;
			}
			$row++;
		}

		if(is_array($data)){

		}else{
			redirect('/export/spd');
		}
		$this->phpspreadsheet->get_content($spreadsheet,'Ekspor Rekap Perjalanan Dinas');
	}

	function spd_realisasi($tahun){
		$this->load->library('phpspreadsheet');
		$inputFileName = './assets/excel_template/template_spd.xlsx';
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		$wilayah = '';

		$prov = array('6300','6351','6352','6353','6354','6355','6356');
	    if (in_array($this->session->userdata('wilayah')->kode, $prov)) {
	    	$wilayah .= " where kegiatan_anggaran.wilayah = '6300'";
	    }else{
	    	$wilayah .= " where kegiatan_anggaran.wilayah = '".$this->session->userdata('wilayah')->kode."'";

	    }

		/*if($this->session->userdata('wilayah')->kode == '6300'){
			$wilayah .= " AND (kegiatan_anggaran.wilayah = '6300' OR kegiatan_anggaran.wilayah = '6351' OR kegiatan_anggaran.wilayah = '6352' 
		OR kegiatan_anggaran.wilayah = '6353'OR kegiatan_anggaran.wilayah = '6354'OR kegiatan_anggaran.wilayah = '6355'OR kegiatan_anggaran.wilayah = '6356')";
		}else{
			$wilayah .= " AND kegiatan_anggaran.wilayah = '".$this->session->userdata('wilayah')->kode."'";
		}*/

		$query = "SELECT kegiatan_anggaran.nama AS deskripsi,
		(SELECT SUM(surat_bayar.uang_total + surat_bayar.uang_total_cc) AS total FROM surat_bayar
		LEFT JOIN surat_tugas on surat_bayar.id_spd = surat_tugas.id
			WHERE surat_bayar.akun_bayar = kegiatan_anggaran.id AND YEAR(surat_tugas.created_at) ='".$tahun."'"." GROUP BY surat_bayar.akun_bayar,kegiatan_anggaran.nama
		) AS realisasi,
		kegiatan_anggaran.pagu 
		FROM kegiatan_anggaran
		".$wilayah;

		
		$data = $this->db->query($query);
		$fields = $data->list_fields();
		$data = $data->result_array();
		$i=0;
		$row = 1;
		foreach ($fields as $field)
		{
			$spreadsheet->setActiveSheetIndex(0)
							->setCellValue(get_alpabhet($i).'1',$field);   
			$i++;
		}
		$row++;
		foreach ($data as $value) {
			$i=0;
			foreach ($fields as $field){
				$spreadsheet->setActiveSheetIndex(0)
								->setCellValue(get_alpabhet($i).$row,$value[$field]);   
				$i++;
			}
			$row++;
		}

		if(is_array($data)){

		}else{
			redirect('/export/spd');
		}
		$this->phpspreadsheet->get_content($spreadsheet,'Ekspor Rekap Realisasi');

	}
}