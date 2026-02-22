<?php

/**
 * 
 */
class Matriks_kegiatan_model extends CI_Model
{
	
	function get_all_table($post_data,$kelola=false,$ppk = false){
        $tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		if(isset($post_data['bulan']) & isset($post_data['tahun']) & $kelola){
            if($this->session->userdata('wilayah')->kode == '6300'){
                $this->datatables->select('mtx.id as id,mtx.kode_kegiatan,peg.nama,peg.nip,keg.nama as keg_nama,mtx.tipe,
                keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,mtx.only_st as only_st,sts.deskripsi as status,st.no_ppk,st.pencetak as pencetak');
                $this->datatables->from('matriks_kegiatan mtx');
                $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
                $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan','left');
                $this->datatables->join('surat_tugas st','st.id_matriks=mtx.id','left');
                $this->datatables->join('status_spd sts','sts.id=st.status','left');
                if($ppk){
                    $this->datatables->where('st.is_sppd', 1);
                }
                if(isset($post_data['tipe'])){
                    $this->datatables->where('mtx.tipe', $post_data['tipe']);
                }
                $this->datatables->where('( from_unixtime(tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(tanggal_awal,"%Y")', $post_data['tahun']);
              //  $this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
               // $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);
                $this->datatables->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
                $this->datatables->add_column('checkbox','$1'.'_'.'$2','id,only_st');
                $this->datatables->add_column('aksi', '<a href="'.base_url('spd').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Tugas"> <i class="fa fa-edit"> </i></a>
                    <a href="javascript:form_print($2,$1,$3);" id="$1$2" data-target="#modal-konfirmasi" data-tipe="$4" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Tugas"> <i class="fa fa-print"> </i></a>
                    <a href="javascript:form_bayar($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-success" title="Set SPPD Siap Bayar"> <i class="fa fa-money"> </i></a>', 'id,is_spd,only_st,tipe');
                $this->datatables->edit_column('keg_nama', '$1','concat_keg(keg_nama,kode_kegiatan)');
                $this->datatables->edit_column('status', '$1','getStatusSt(status,pencetak)');
                $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
                $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
                return $this->datatables->generate();
            }else{
                $this->datatables->select('mtx.id as id,mtx.kode_kegiatan,peg.nama,peg.nip,keg.nama as keg_nama,mtx.tipe,
                keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,mtx.only_st as only_st,sts.deskripsi as status,st.no_ppk,st.pencetak as pencetak');
                $this->datatables->from('matriks_kegiatan mtx');
                $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
                $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
                $this->datatables->join('surat_tugas st','st.id_matriks=mtx.id','left');
                $this->datatables->join('status_spd sts','sts.id=st.status','left');
                if($ppk){
                    $this->datatables->where('st.is_sppd', 1);
                }
                if(isset($post_data['tipe']))
                $this->datatables->where('mtx.tipe', $post_data['tipe']);
                $this->datatables->where('( from_unixtime(tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(tanggal_awal,"%Y")', $post_data['tahun']);
                //$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
                //$this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);
                $this->datatables->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);
                $this->datatables->add_column('checkbox','$1'.'_'.'$2','id,only_st');
                if($post_data['tipe'] ==1){
                    $aksi = '<a href="'.base_url('spd').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Tugas"> <i class="fa fa-edit"> </i></a>
                    <a href="javascript:form_print($2,$1,$3);" id="$1$2" data-target="#modal-konfirmasi" data-tipe="$4" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Tugas"> <i class="fa fa-print"> </i></a>
                    <a href="javascript:form_bayar($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-success" title="Set SPPD Siap Bayar"> <i class="fa fa-money"> </i></a>';
                }else{
                    $aksi = '<a href="'.base_url('spd').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Tugas"> <i class="fa fa-edit"> </i></a>
                    <a href="javascript:form_print($2,$1,$3);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Tugas"> <i class="fa fa-print"> </i></a>';
                }
                $this->datatables->edit_column('keg_nama', '$1','concat_keg(keg_nama,kode_kegiatan)');
                $this->datatables->add_column('aksi', $aksi,'id,is_spd,only_st,tipe');
                $this->datatables->edit_column('status', '$1','getStatusSt(status,pencetak)');
                $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
                $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
                return $this->datatables->generate();
            }
        }else{
            if($this->session->userdata('wilayah')->kode == '6300'){
                $this->datatables->select('mtx.id as id,mtx.kode_kegiatan,mtx.array_tanggal,peg.nama,peg.nip,keg.nama as keg_nama,mtx.tipe,
                keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,sts.deskripsi as status,st.pencetak as pencetak');
                $this->datatables->from('matriks_kegiatan mtx');
                $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
                $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
                $this->datatables->join('surat_tugas st','st.id_matriks=mtx.id','left');
                $this->datatables->join('status_spd sts','sts.id=st.status','left');
                $this->datatables->where('( from_unixtime(tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(tanggal_awal,"%Y")', $post_data['tahun']);

                if(isset($post_data['tipe']))
                $this->datatables->where('mtx.tipe', $post_data['tipe']);
                /*$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
                $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
                $this->datatables->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
                $this->datatables->add_column('checkbox','$1'.'_'.'$2','id,only_st');
                $this->datatables->add_column('aksi', "<a href='javascript:;' type='button' class='btn-sm btn-warning' 
                    data-toggle='modal' data-id='$1' data-keg='$2' data-periode_waktu_awal='$3' data-periode_waktu_akhir='$4' data-tipe='$9' data-kode_kegiatan='$6' data-nip='$5' data-array_tanggal='$8' data-nama='$7' data-keg_nama='$6'
                                    data-target='#modal-edit'
                                    title='Edit Matriks'> <i class='fa fa-edit'> </i></a><a href='javascript:;' type='button' class='btn-danger btn-sm'
                                    data-toggle='modal' data-id='$1' data-nama='$7' data-keg_nama='$6' data-edit='$7' data-array_tanggal='$8'
                                    data-target='#modal-konfirmasi'
                                    title='Hapus Matriks'> <i class='fa fa-remove'> </i> </a>", 'id,keg_id,date("m/d/Y",periode_waktu_awal),date("m/d/Y",periode_waktu_akhir),nip,kode_kegiatan,nama,array_tanggal,tipe');
                $this->datatables->edit_column('keg_nama', '$1','concat_keg(keg_nama,kode_kegiatan)');
                $this->datatables->edit_column('status', '$1','getStatusSt(status,pencetak)');
                $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
                $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
                return $this->datatables->generate();
            }else{
                $this->datatables->select('mtx.id as id,mtx.kode_kegiatan,mtx.array_tanggal,peg.nama,peg.nip,keg.nama as keg_nama,mtx.tipe,
                keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,sts.deskripsi as status,st.pencetak as pencetak');
                $this->datatables->from('matriks_kegiatan mtx');
                $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
                $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
                $this->datatables->join('surat_tugas st','st.id_matriks=mtx.id','left');
                $this->datatables->join('status_spd sts','sts.id=st.status','left');
                $this->datatables->where('( from_unixtime(tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(tanggal_awal,"%Y")', $post_data['tahun']);

                if(isset($post_data['tipe']))
                $this->datatables->where('mtx.tipe', $post_data['tipe']);
                /*$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
                $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
                $this->datatables->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);
                $this->datatables->add_column('checkbox','$1'.'_'.'$2','id,only_st');
                $this->datatables->add_column('aksi', "<a href='javascript:;' type='button' class='btn-sm btn-warning' 
                    data-toggle='modal' data-id='$1' data-keg='$2' data-periode_waktu_awal='$3' data-periode_waktu_akhir='$4' data-tipe='$9' data-kode_kegiatan='$6' data-nip='$5' data-array_tanggal='$8' data-nama='$7' data-keg_nama='$6'
                                    data-target='#modal-edit'
                                    title='Edit Matriks'> <i class='fa fa-edit'> </i></a><a href='javascript:;' type='button' class='btn-danger btn-sm'
                                    data-toggle='modal' data-id='$1' data-nama='$7' data-keg_nama='$6' data-edit='$7' data-array_tanggal='$8'
                                    data-target='#modal-konfirmasi'
                                    title='Hapus Matriks'> <i class='fa fa-remove'> </i> </a>", 'id,keg_id,date("m/d/Y",periode_waktu_awal),date("m/d/Y",periode_waktu_akhir),nip,kode_kegiatan,nama,array_tanggal,tipe');
                $this->datatables->edit_column('keg_nama', '$1','concat_keg(keg_nama,kode_kegiatan)');
                $this->datatables->edit_column('status', '$1','getStatusSt(status,pencetak)');
                $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
                $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
                return $this->datatables->generate();
            }
        }
	}

	function get_all($with_join=FALSE){
        if($with_join){
            $this->db->select('mtx.id as id,mtx.nip as nip, peg.nama as nama, keg.nama as kegiatan,mtx.tanggal_awal,mtx.tanggal_akhir,mtx.is_spd');
            $this->db->from('matriks_kegiatan mtx');
            $this->db->join('pegawai peg','peg.nip=mtx.nip');
            $this->db->join('kegiatan keg','keg.id=mtx.kegiatan');
            $this->db->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);
            $q = $this->db->get('matriks_kegiatan');
            return $q->result();
        }else{
            $q = $this->db->get('matriks_kegiatan');
            return $q->result(); 
        }
	}

    function get_byId($id,$with_join=FALSE){
        if($with_join){
            $this->db->select('mtx.id as id,mtx.kode_kegiatan,mtx.nip as nip,mtx.tipe as tipe, peg.nama as nama, keg.nama as kegiatan,keg.id as keg_id,mtx.tanggal_awal,mtx.tanggal_akhir,mtx.is_spd,mtx.only_st,mtx.is_transport_st');
            $this->db->from('matriks_kegiatan mtx');
            $this->db->join('pegawai peg','peg.nip=mtx.nip');
            $this->db->join('kegiatan keg','keg.id=mtx.kegiatan');
            $this->db->where('mtx.id',$id);
            $q = $this->db->get('matriks_kegiatan');
            return $q->row();
        }else{
            $this->db->where('id',$id);
            $q = $this->db->get('matriks_kegiatan');
            return $q->row(); 
        }
    }


	function get_matriks_array($post_data,$number_days){
        $tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime($number_days.'-'.$post_data['bulan'].'-'.$post_data['tahun'])));
        $this->db->distinct('mtx.nip');
        $this->db->select('mtx.nip as nip, peg.nama as nama');
		$this->db->from('matriks_kegiatan mtx');
		$this->db->join('pegawai peg','peg.nip=mtx.nip');
		
        if($this->session->userdata('wilayah')->kode == '6300'){
            $this->db->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
        }else{
            $this->db->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);
        }
        $this->db->where('( from_unixtime(mtx.tanggal_awal ,"%m") <= '.$post_data['bulan'].' AND from_unixtime(mtx.tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
        $this->db->where('from_unixtime(mtx.tanggal_akhir,"%Y")', $post_data['tahun']);
        //$this->db->where('mtx.tanggal_awal >=', $tanggal_awal);
        //$this->db->where('mtx.tanggal_akhir <=', $tanggal_akhir);
        $q = $this->db->get('matriks_kegiatan');
        $peg = $q->result();

        $data = array();
        $i=0;

        $matriks_kegiatan =array();
		foreach ($peg as $key) {
			$this->db->select('mtx.nip as nip, peg.nama as nama,mtx.kegiatan as kegiatan,mtx.tanggal_awal,mtx.tanggal_akhir,mtx.array_tanggal');
			$this->db->from('matriks_kegiatan mtx');
			$this->db->join('pegawai peg','peg.nip=mtx.nip');
            $this->db->where('( from_unixtime(mtx.tanggal_awal ,"%m") <= '.$post_data['bulan'].' AND from_unixtime(mtx.tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
        $this->db->where('from_unixtime(mtx.tanggal_akhir,"%Y")', $post_data['tahun']);
			/*$this->db->where('mtx.tanggal_awal >=', $tanggal_awal);
            $this->db->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
        	$this->db->where('mtx.nip',$key->nip);
            if($this->session->userdata('wilayah')->kode == '6300'){
                $this->db->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
            }else{
                $this->db->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);
            }
        	$q = $this->db->get('matriks_kegiatan');
        	$pegawai = $q->result();

            $arrayKeg = $this->makeArrayDate($pegawai);
            $nip = $key->nip;
            for($j=0;$j<=$number_days;$j++){
                if($j==0){
                   $matriks_kegiatan[$i][$j] = $key->nama;
                }else{
                   if(in_array($j,$arrayKeg[0])){
                    $matriks_kegiatan[$i][$j] = $arrayKeg[1][$j]."";
                }else{
                    $matriks_kegiatan[$i][$j] = " ";
                } 
                }
            }
            $i++;
        }  
        return $matriks_kegiatan;
	}

	private function makeArrayDate($pegawai){
        $arrayDate=array();
        $arrayKegiatan=array();
        $retur=array();
        $k=0;

        foreach ($pegawai as $key){
            if($key->array_tanggal){
                foreach(json_decode($key->array_tanggal,true) as $value){
                    $tgl = date("j",strtotime($value));
                    $arrayDate[] = $tgl;
                    $arrayKegiatan[$tgl ] = $key->kegiatan;
                }
            }else{
                $dawal = date("j",$key->tanggal_awal);
                $dakhir = date("j",$key->tanggal_akhir);
                for($i=0;$i<=($dakhir-$dawal);$i++){
                    $arrayDate[] = $dawal+$i;
                    $arrayKegiatan[$dawal+$i ] = $key->kegiatan;
                }
            }
        }

        $retur[0] = $arrayDate;
        $retur[1] = $arrayKegiatan;
        return $retur;
    }

	function delete($id){
		$this->db->delete('matriks_kegiatan', array('id' => $id));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Matriks berhasil dihapus');
            redirect('/matriks_kegiatan');  
        }else{
         	$this->session->set_flashdata('failed', 'Hapus matriks gagal');
            redirect('/matriks_kegiatan');  
        } 
	}

    function validasi_tanggal($post_data){
        if($post_data['cek'] ==0){
            if(!$this->cek_tanggal_lompat($post_data['kegiatan'],$post_data['periode_terus'])){
                return json_encode(array('status'=>'failed','message'=>'Tanggal SPD diluar range waktu kegiatan.'));
            }
            if($this->cek_jadwal_loncat($post_data['nip'],$post_data['periode_terus'],FALSE)){
                 return json_encode($this->cek_jadwal_loncat($post_data['nip'],$post_data['periode_terus'],FALSE));
            }else{
                return json_encode(array('status'=>'failed','message'=>'Tanggal sudah diisi kegiatan lain.'));
            }
        }else{
            if(!cek_tanggal($post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
                return json_encode(array('status'=>'failed','message'=>'Tanggal awal harus kurang dari tanggal akhir.'));
            }
            if(!$this->cek_tanggal_kegiatan($post_data['kegiatan'],$post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
                return json_encode(array('status'=>'failed','message'=>'Tanggal SPD diluar range waktu kegiatan.'));
            }
            if($this->cek_jadwal($post_data['nip'],$post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'],FALSE)){
                 return json_encode($this->cek_jadwal($post_data['nip'],$post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'],FALSE));
            }else{
                return json_encode(array('status'=>'failed','message'=>'Tanggal sudah diisi kegiatan lain.'));
            }
        }
    }

	function add($post_data){

        $prov = array('6300','6351','6352','6353','6354','6355','6356');
		if($post_data){

            if($post_data['cek'] ==0){
                if($this->cek_jadwal_loncat($post_data['nip'],$post_data['periode_terus'],FALSE)){
                    $jadwal = explode(',', $post_data['periode_terus']);
                    usort($jadwal, "compareByTimeStamp");
                    $tanggal_awal = strtotime($jadwal[0]);
                    $tanggal_akhir = strtotime($jadwal[sizeof($jadwal)-1]);
                    if($post_data['type'] ==1 ){

                        $this->db->where('tipe',1);
                        if(in_array($this->session->userdata('wilayah')->kode, $prov)){
                            $this->db->where('wilayah','6300');
                        }else{
                            $this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
                        }
                        $keg = $this->db->get('kegiatan')->row();

                        $data = array(
                            'kegiatan' => $keg->id,
                            'kode_kegiatan' => $post_data['kegiatan'],
                            'nip' => $post_data['nip'],
                            'tanggal_awal' => $tanggal_awal,
                            'tanggal_akhir' => $tanggal_akhir,
                            'array_tanggal' => json_encode($jadwal),
                            'tipe' => $post_data['type'],
                            'wilayah' => $this->session->userdata('wilayah')->kode
                        );
                    }else{
                         if(!$this->cek_tanggal_lompat($post_data['kegiatan'],$post_data['periode_terus'])){
                            return json_encode(array('status'=>'failed','message'=>'Tanggal SPD diluar range waktu kegiatan.'));
                        }
                        $data = array(
                            'kegiatan' => $post_data['kegiatan'],
                            'nip' => $post_data['nip'],
                            'tanggal_awal' => $tanggal_awal,
                            'tanggal_akhir' => $tanggal_akhir,
                            'array_tanggal' => json_encode($jadwal),
                            'tipe' => $post_data['type'],
                            'wilayah' => $this->session->userdata('wilayah')->kode
                        );
                    }

                    $this->db->insert('matriks_kegiatan',$data);

                    if($this->db->affected_rows()){
                        return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan'));
                    }else{
                        return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database')); 
                    } 
                }else{
                    return json_encode(array('status'=>'failed','message'=>'Tanggal sudah diisi kegiatan lain.'));
                }

            }else{
                if(!cek_tanggal($post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
                    return json_encode(array('status'=>'failed','message'=>'Tanggal awal harus kurang dari tanggal akhir.'));
                }
                
                 //  if($this->cek_jadwal($post_data['nip'],$post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'],FALSE)){
                if(true){
                    if($post_data['type'] ==1){
                        $this->db->where('tipe',1);
                        if(in_array($this->session->userdata('wilayah')->kode, $prov)){
                            $this->db->where('wilayah','6300');
                        }else{
                            $this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
                        }
                        $keg = $this->db->get('kegiatan')->row();

                        $data = array(
                            'kegiatan' => $keg->id,
                            'kode_kegiatan' => $post_data['kegiatan'],
                            'nip' => $post_data['nip'],
                            'tanggal_awal' => strtotime($post_data['periode_waktu_awal']),
                            'tanggal_akhir' => strtotime($post_data['periode_waktu_akhir']),
                            'tipe' => $post_data['type'],
                            'wilayah' => $this->session->userdata('wilayah')->kode
                        );
                    }else{
                        if(!$this->cek_tanggal_kegiatan($post_data['kegiatan'],$post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
                            return json_encode(array('status'=>'failed','message'=>'Tanggal SPD diluar range waktu kegiatan.'));
                        }
                        $data = array(
                            'kegiatan' => $post_data['kegiatan'],
                            'nip' => $post_data['nip'],
                            'tanggal_awal' => strtotime($post_data['periode_waktu_awal']),
                            'tanggal_akhir' => strtotime($post_data['periode_waktu_akhir']),
                            'tipe' => $post_data['type'],
                            'wilayah' => $this->session->userdata('wilayah')->kode
                        );
                    }
                    //print_r($data);
                    //exit();

                    $this->db->insert('matriks_kegiatan',$data);

                    if($this->db->affected_rows()){
                        return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan'));
                    }else{
                        return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database')); 
                    }    
                }else{
                    return json_encode(array('status'=>'failed','message'=>'Tanggal sudah diisi kegiatan lain.'));
                }
            }


			
		}
	}

	function edit($post_data){
		if($post_data){
            if($post_data['cek'] ==0){
                 

                if($this->cek_jadwal_loncat($post_data['nip'],$post_data['periode_terus'],TRUE,$post_data['id'])){
                    $jadwal = explode(',', $post_data['periode_terus']);
                    usort($jadwal, "compareByTimeStamp");
                    $tanggal_awal = strtotime($jadwal[0]);
                    $tanggal_akhir = strtotime($jadwal[sizeof($jadwal)-1]);
                    if($post_data['type_edit'] ==1){
                        $data = array(
                            'nip' => $post_data['nip_edit'],
                            'tanggal_awal' => $tanggal_awal,
                            'tanggal_akhir' => $tanggal_akhir,
                            'array_tanggal' => json_encode($jadwal),
                            'wilayah' => $this->session->userdata('wilayah')->kode
                        );
                    }else{
                        if(!$this->cek_tanggal_lompat($post_data['kegiatan'],$post_data['periode_terus'])){
                            return json_encode(array('status'=>'failed','message'=>'Tanggal SPD diluar range waktu kegiatan.'));
                        }
                        $data = array(
                            'nip' => $post_data['nip_edit'],
                            'tanggal_awal' => $tanggal_awal,
                            'tanggal_akhir' => $tanggal_akhir,
                            'array_tanggal' => json_encode($jadwal),
                            'wilayah' => $this->session->userdata('wilayah')->kode
                        );
                    }

                    $this->db->where('id',$post_data['id']);
                    $this->db->set('nip',$post_data['nip_edit']);
                    $this->db->update('surat_tugas');

                    $this->db->where('id',$post_data['id']);
                    $this->db->update('matriks_kegiatan',$data);

                    if($this->db->affected_rows()){
                        return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan'));
                    }else{
                        return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database')); 
                    } 
                }else{
                    return json_encode(array('status'=>'failed','message'=>'Tanggal sudah diisi kegiatan lain.'));
                }
            }else{
                if(!cek_tanggal($post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
                return json_encode(array('status'=>'failed','message'=>'Tanggal awal harus kurang dari tanggal akhir.'));
                }
                
                
                if($this->cek_jadwal($post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'],TRUE,$post_data['id'])){

                    if($post_data['type_edit'] ==1){
                        $data = array(
                            'nip' => $post_data['nip_edit'],
                            'kegiatan' => 1,
                            'kode_kegiatan' => $post_data['kegiatan'],
                            'tanggal_awal' => strtotime($post_data['periode_waktu_awal']),
                            'tanggal_akhir' => strtotime($post_data['periode_waktu_akhir'])
                        );
                    }else{
                        if(!$this->cek_tanggal_kegiatan($post_data['kegiatan'],$post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
                            return json_encode(array('status'=>'failed','message'=>'Tanggal SPD diluar range waktu kegiatan.'));
                        }
                        $data = array(
                            'nip' => $post_data['nip_edit'],
                            'kegiatan' => $post_data['kegiatan'],
                            'tanggal_awal' => strtotime($post_data['periode_waktu_awal']),
                            'tanggal_akhir' => strtotime($post_data['periode_waktu_akhir'])
                        );
                    }

                    $this->db->where('id',$post_data['id']);
                    $this->db->set('nip',$post_data['nip_edit']);
                    $this->db->update('surat_tugas');
                    
                    $this->db->where('id',$post_data['id']);
                    $this->db->update('matriks_kegiatan',$data);

                    

                    if($this->db->affected_rows()){
                        return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan')); 
                    }else{
                        return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database')); 
                    }    
                }else{
                    return json_encode(array('status'=>'failed','message'=>'Tanggal sudah diisi kegiatan lain'));
                }
            }
			
		}
	}

    function cek_tanggal_lompat($kegiatan,$tanggal){

        $this->db->where('id',$kegiatan);
        $q= $this->db->get('kegiatan');
        $kegiatan = $q->row();

        $tanggal_awal_kegiatan = $kegiatan->periode_waktu_awal;
        $tanggal_akhir_kegiatan = $kegiatan->periode_waktu_akhir;

        foreach (explode(',', $tanggal) as $value) {
            if( $tanggal_awal_kegiatan < strtotime($value) && strtotime($value)<$tanggal_akhir_kegiatan){
                continue;
            }else{
                return FALSE;
            }
        }

        return TRUE;
    }

	function cek_tanggal_kegiatan($kegiatan,$periode_waktu_awal,$periode_waktu_akhir){
		$tanggal_awal = strtotime($periode_waktu_awal);
        $tanggal_akhir = strtotime($periode_waktu_akhir);
        $this->db->where('id',$kegiatan);
        $q= $this->db->get('kegiatan');
        $kegiatan = $q->row();

        $tanggal_awal_kegiatan = $kegiatan->periode_waktu_awal;
        $tanggal_akhir_kegiatan = $kegiatan->periode_waktu_akhir;

        if($tanggal_awal<$tanggal_awal_kegiatan || $tanggal_akhir>$tanggal_akhir_kegiatan){
        	return FALSE;
        }else{
        	return TRUE;
        }

	}

    function cek_jadwal_loncat($pgawai,$jadwal,$is_edit=TRUE,$id_matriks=0){
        $jadwal = explode(',', $jadwal);
        usort($jadwal, "compareByTimeStamp");
        $tanggal_awal = strtotime($jadwal[0]);
        $tanggal_akhir = strtotime($jadwal[sizeof($jadwal)-1]);

        if($is_edit){
            $this->db->where('nip',$pgawai);
            $this->db->group_start();
            $this->db->where('tanggal_awal >=',$tanggal_awal);
            $this->db->or_where('tanggal_akhir <=',$tanggal_akhir);
            $this->db->or_where('array_tanggal is not null ');
            $this->db->group_end();
            $this->db->where('id !=',$id_matriks);
            $q = $this->db->get('matriks_kegiatan');
            $matriks = $q->result();
        }else{
            $this->db->where('nip',$pgawai);
            $this->db->group_start();
            $this->db->where('tanggal_awal >=',$tanggal_awal);
            $this->db->or_where('tanggal_akhir <=',$tanggal_akhir);
            $this->db->or_where('array_tanggal is not null ');
            $this->db->group_end();
            $q = $this->db->get('matriks_kegiatan');
            $matriks = $q->result();
        }

        $kondisi=TRUE;
        $pesan = '';
        for ($i=0; $i < sizeof($matriks) ; $i++) {
            foreach ($jadwal as $value) {
                if($matriks[$i]->array_tanggal){
                    if(in_array($value, json_decode($matriks[$i]->array_tanggal,true))){
                        $kondisi = FALSE;
                        break;
                    }
                }else{
                    if( $matriks[$i]->tanggal_awal <= strtotime($value) && strtotime($value) <= $matriks[$i]->tanggal_akhir){
                        $pesan = $matriks[$i]->id." ".$value;
                        $kondisi = FALSE;
                        break;
                    }
                }
            }

            if(!$kondisi){
                break;
            }
        }

       return $kondisi;
    }

	function cek_jadwal($pgawai,$dAwal,$dAkhir,$is_edit=TRUE,$id_matriks=0){
        $tanggal_awal = strtotime($dAwal);
        $tanggal_akhir = strtotime($dAkhir);

        if($is_edit){
            $this->db->where('nip',$pgawai);
            $this->db->group_start();
            $this->db->where('tanggal_awal >=',$tanggal_awal);
            $this->db->or_where('tanggal_akhir <=',$tanggal_akhir);
             $this->db->group_end();
            $this->db->where('id !=',$id_matriks);
            $q = $this->db->get('matriks_kegiatan');
            $matriks = $q->result();
        }else{
            $this->db->where('nip',$pgawai);
            $this->db->group_start();
            $this->db->where('tanggal_awal >=',$tanggal_awal);
            $this->db->or_where('tanggal_akhir <=',$tanggal_akhir);
             $this->db->group_end();
            $q = $this->db->get('matriks_kegiatan');
            $matriks = $q->result();
        }
        $kondisi=TRUE;
        $pesan = '';


        for ($i=0; $i < sizeof($matriks) ; $i++) {
            /*$dawalMatriks = date("j",$matriks[$i]->tanggal_awal);
            $mawalMatriks = date("m",$matriks[$i]->tanggal_awal);
            $dakhirMatriks = date("j",$matriks[$i]->tanggal_akhir); 
            $makhirMatriks = date("m",$matriks[$i]->tanggal_akhir);*/

            $dawalMatriks = $matriks[$i]->tanggal_awal;
            $dakhirMatriks = $matriks[$i]->tanggal_akhir;

            $pesan = '';
            $pesan = $matriks[$i]->id." ".$dawalMatriks." ".$dakhirMatriks." ".$tanggal_awal." ".$tanggal_akhir;
            if($tanggal_akhir < $dawalMatriks){
                continue;
            }

            if($tanggal_awal > $dakhirMatriks){
                continue;
            }
            if(($tanggal_awal<=$dakhirMatriks) && ($tanggal_awal>= $dawalMatriks)){
                $kondisi = false;
                break;
            }

            if(($tanggal_akhir<=$dakhirMatriks) && ($tanggal_akhir>= $dawalMatriks)){
                $kondisi = false;
                break;
            }

            if(($tanggal_awal<=$dawalMatriks) && ($tanggal_akhir>= $dakhirMatriks)){
                $kondisi = false;
                break;
            }

        }
        return $kondisi;
    }

    function to_excel($post_data,$number_days){
         // Starting the PHPExcel library
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/iofactory');
 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $pegawai = $this->db->get('pegawai')->result();

        $matriks = $this->get_matriks_array($post_data,$number_days);
        $col = 0;

        $objPHPExcel->getActiveSheet()->mergeCells('A2:AF2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2','Matrks Kegiatan Pegawai Bulan '.@getBulan((int)$post_data['bulan']-1));
        for($i=0;$i<=$number_days;$i++)
        {
            if($col==0){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, 'Nama');
            }
            if($col==1){
                $objPHPExcel->getActiveSheet()->mergeCells('B4:AF4');
                $objPHPExcel->getActiveSheet()->setCellValue('B4', 'Tanggal');
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $i);
            }elseif($col!=0){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $i);
            }
            $col++;
        }
 
        // Fetching the table data
        $row = 6;
        for($i=0;$i<sizeof($matriks);$i++)
        {
            $col = 0;
            for($j=0;$j<sizeof($matriks[0]);$j++)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $matriks[$i][$j]);
                $col++;
            }
            $row++;
        }

        $tanggal_awal = strtotime(date('d-m-Y 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'].' 00:00:00')));
        $tanggal_akhir = strtotime(date('d-m-Y 00:00:00',strtotime($number_days.'-'.$post_data['bulan'].'-'.$post_data['tahun'].' 00:00:00')));
        $this->db->distinct();
        $this->db->select('keg.id as id, keg.nama as nama');
        $this->db->from('matriks_kegiatan mtx');
        $this->db->join('kegiatan keg','keg.id=mtx.kegiatan');
        $this->db->where('mtx.tanggal_awal >=', $tanggal_awal);
        $this->db->where('mtx.tanggal_akhir <=', $tanggal_akhir);
        $q = $this->db->get();
        $keg = $q->result();

        $row=$row+2;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, 'Keterangan: ');
        $row++;
        $col2=0;
        foreach ($keg as $key) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $key->nama.'('.$key->id.')');
            /*if($row2%1==0){
                $col2++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row2, $key->nama.'('.$key->id.')');
            }else{
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row2, $key->nama.'('.$key->id.')');
            }   */ 
            $row++;
        }

        foreach($this->getcolumnrange('A','AF') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Matriks Kegiatan'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');

    }

    private function getcolumnrange($min,$max){
      $pointer=strtoupper($min);
      $output=array();
      while($this->positionalcomparison($pointer,strtoupper($max))<=0){
         array_push($output,$pointer);
         $pointer++;
      }
      return $output;
    }

   private function positionalcomparison($a,$b){
       $a1=$this->stringtointvalue($a); $b1=$this->stringtointvalue($b);
       if($a1>$b1)return 1;
       else if($a1<$b1)return -1;
       else return 0;
    }

    private function stringtointvalue($str){
       $amount=0;
       $strarra=array_reverse(str_split($str));

       for($i=0;$i<strlen($str);$i++){
          $amount+=(ord($strarra[$i])-64)*pow(26,$i);
       }
       return $amount;
    }

}