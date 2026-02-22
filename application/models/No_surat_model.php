<?php

/**
 * 
 */
class No_surat_model extends CI_Model
{
	
	function __construct(){
		$this->load->library('datatables');
	}


	function get_all(){
		$q = $this->db->get('no_surat');
		return $q->result(); 
	}

	function get_byId($id){
		$this->db->where('id',$id);
		$q = $this->db->get('no_surat');
		return $q->row(); 
	}

	function get_byIdKeg($id,$jenis){
		$prov = array('6300','6351','6352','6353','6354','6355','6356');
		$this->db->select('no.id as id, no.nomor as nomor, no.perihal as perihal,no.tanggal as tanggal');
		$this->db->from('no_surat no');
		$this->db->join('matriks_kegiatan mtx','mtx.kegiatan=no.kegiatan','left');
		$this->db->join('kegiatan keg','keg.id=no.kegiatan','left');
		$this->db->join('jenis_surat jen','jen.id = no.jenis');
		$this->db->where('jen.jenis',$jenis);
		$this->db->where('no.kegiatan',$id);
		// if (in_array($this->session->userdata('wilayah')->kode, $prov)) {
		 if ($this->session->userdata('wilayah') == '6300') {

		 	$this->db->where('(no.wilayah = "6351" OR no.wilayah = "6352" OR no.wilayah = "6353" OR no.wilayah = "6354" OR no.wilayah = "6355" OR no.wilayah = "6356" OR no.wilayah = "6300")');

		 	/*if($jenis == 1 && $id != 1){
		 		$this->db->where('keg.wilayah',$this->session->userdata('wilayah')->kode);
		 	}else{
		 		$this->db->where('no.wilayah',$this->session->userdata('wilayah')->kode);
		 	}*/
		 }else{
			$this->db->where('no.wilayah',$this->session->userdata('wilayah')->kode);
		}
		$this->db->group_by('id');
		$q = $this->db->get();
	//print_r($this->db->last_query());exit();
		return $q->result();
	}

	function get_all_table($post_data){
		$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		$tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		$this->datatables->select('num.id as id,num.nomor as nomor, keg.nama as kegiatan, keg.id as id_keg, num.perihal as perihal,num.tujuan as tujuan,jen.nama as jenis,jen.id as id_jenis,num.tanggal as tanggal');
		$this->datatables->from('no_surat as num');
		$this->datatables->join('kegiatan keg','keg.id = num.kegiatan');
		$this->datatables->join('jenis_surat jen','num.jenis = jen.id');
		$this->datatables->where('( from_unixtime(num.tanggal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(num.tanggal,"%m") >= '.$post_data['bulan'].')');
        $this->datatables->where('from_unixtime(num.tanggal,"%Y")', $post_data['tahun']);
		/*$this->datatables->where('num.tanggal >=', $tanggal_awal);
        $this->datatables->where('num.tanggal <=', $tanggal_akhir);*/
        if($this->session->userdata('wilayah')->kode == '6300'){
            $this->db->where('(jen.wilayah = "6351" OR jen.wilayah = "6352" OR jen.wilayah = "6353" OR jen.wilayah = "6354" OR jen.wilayah = "6355" OR jen.wilayah = "6356" OR jen.wilayah = "6300")');
        }else{
            $this->db->where('jen.wilayah',$this->session->userdata('wilayah')->kode);
        }
        if($post_data['jenis'] != 0){
        	$this->datatables->where('jen.id',$post_data['jenis']);
    	}
		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
			data-toggle="modal" data-id="$1" data-nomor="$2" data-kegiatan="$3" data-perihal="$4" data-jenis="$5" data-tanggal="$6" data-tujuan="$7"
                            data-target="#modal-edit"
                            title="Edit Nomor"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
                            data-toggle="modal" data-id="$1" data-nomor="$2"
                            data-target="#modal-konfirmasi"
                            title="Hapus No Surat"> <i class="fa fa-remove"> </i> </a>', 'id,nomor,id_keg,perihal, id_jenis,date("d-m-Y",tanggal),tujuan');
		$this->datatables->edit_column('tanggal', '$1','date("d-m-Y",tanggal)');
		return $this->datatables->generate();
	}

	function add($post_data,$redirect=TRUE){
		$data = array(
			'nomor' => $post_data['nomor'],
			'kegiatan' => $post_data['kegiatan'],
			'perihal' => $post_data['perihal'],
			'jenis' => $post_data['jenis'],
			'tujuan' => $post_data['tujuan'],
			'tanggal' => strtotime($post_data['tanggal']),
			'wilayah' => $this->session->userdata('wilayah')->kode
		);

		$insert = $this->db->insert('no_surat',$data);

		if(!$post_data['is_edit_num']){
			if(in_array($this->session->userdata('wilayah')->kode, array('6351','6352','6353','6354','6355','6356','6300'))){
				$this->db->where('id',$post_data['jenis']);
				$no_s = $this->db->get('jenis_surat')->row();
				$setting = $this->system->get_set('spd_number_prov',TRUE);
				$setting[$no_s->jenis] =  $setting[$no_s->jenis]+1;
				$this->db->where('set_key','spd_number_prov');
				$this->db->update('setting',array('set_val'=>json_encode($setting)));
            }else{
				$setting = $this->system->get_set('spd_surat_number');
				$setting[$post_data['jenis']] =  $setting[$post_data['jenis']]+1;
				$this->db->where('set_key','spd_surat_number_'.$this->session->userdata('wilayah')->kode);
				$this->db->update('setting',array('set_val'=>json_encode($setting)));
			}
		}
		if($insert){
			if($redirect){
				$this->session->set_flashdata('success', 'Input data berhasil');
            	redirect('/kelola_no_surat');  
			}else{
				return TRUE;
			}
        }else{
         	if($redirect){
         		$this->session->set_flashdata('failed', 'Input data gagal');
            	redirect('/kelola_no_surat');
         	}else{
         		return FALSE;
         	}  
        }    
        

	}


	function edit($post_data){
		$this->db->where('id',$post_data['id']);
		$q = $this->db->update('no_surat',array('nomor'=>$post_data['nomor_edit'],'kegiatan'=>$post_data['kegiatan_edit'],'tanggal'=>strtotime($post_data['tanggal_edit']),
			'perihal'=>$post_data['perihal_edit'],'jenis'=>$post_data['jenis_edit'],'tujuan'=>$post_data['tujuan_edit']
		));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'No surat berhasil diedit');
            redirect('/kelola_no_surat');  
        }else{
         	$this->session->set_flashdata('error', 'Edit data gagal');
            redirect('/kelola_no_surat');  
        } 

	}

	function delete($post_data){
		$this->db->delete('no_surat', array('id' => $post_data['id']));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'No surat berhasil dihapus');
            redirect('/kelola_no_surat');  
        }else{
         	$this->session->set_flashdata('error', 'Hapus data gagal');
            redirect('/kelola_no_surat');  
        } 
	}
}