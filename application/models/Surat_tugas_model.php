<?php

class Surat_tugas_model extends CI_model
{
	
	function get_status($status){
		$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.'01'.'-'.date('Y'))));
		$tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime('31-'.'12'.'-'.date('Y'))));

		$this->db->select('*');
		$this->db->from('surat_tugas st');
		$this->db->join('matriks_kegiatan  mtx','mtx.id = st.id_matriks');
		$this->db->where('st.status',$status);
		$this->db->where('mtx.tanggal_awal >=', $tanggal_awal);
        $this->db->where('mtx.tanggal_akhir <=', $tanggal_akhir);
        if($this->session->userdata('wilayah')->kode == '6300'){
        $this->db->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
        }else{
			$this->db->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);
        }
		$q = $this->db->get();
		return $q;
	}

	function get_byMtxId($id){
		$this->db->select('st.id,st.nip,st.id_kegiatan,st.id_matriks,st.waktu,st.tugas,st.status,st.tanggal_surat,st.tanggal_sppd,st.is_bayar,st.is_sppd,no.nomor as no_sppd,st.is_pengawasan,st.template,st.no_ppk,st.visum_nama,st.visum_nip,st.visum_jabatan,st.opsi_lembar4');
		$this->db->from('surat_tugas st');
		$this->db->join('no_surat no','no.id=st.tanggal_surat');
		$this->db->where('st.id_matriks',$id);
		$q= $this->db->get('surat_tugas');
		return $q->row();
	}

	function add($post_data){
		if($post_data){
			$cek = $this->db->where('id',$post_data['id_st'])->get('surat_tugas')->row();

			if($cek){
				$data_st = array(
				'id' => $post_data['id_st'],
				'nip' => $post_data['nip'],
				'id_kegiatan' => $post_data['id_kegiatan'],
				'id_matriks' => $post_data['id_matriks'],
				'tugas' => $post_data['perihal'],
				'waktu' => $this->hitung_waktu($post_data['id_matriks']),
				'tanggal_surat' =>$post_data['no_surat'],
				'tanggal_sppd' =>isset($post_data['no_sppd'])?$post_data['no_sppd']:'',
				'status' => 1,
				'is_sppd' => isset($post_data['is_sppd'])?1:0,
				'is_pengawasan' => isset($post_data['is_pengawasan'])?1:0,
				'template' => $post_data['template'],
				'no_ppk' => isset($post_data['no_ppk'])?$post_data['no_ppk']:'',
				'visum_nama' => $post_data['visum_nama'],
				'visum_nip' => $post_data['visum_nip'],
				'visum_jabatan' => $post_data['visum_jabatan'],
				'opsi_lembar4' => $post_data['opsi_lembar4']

			);

				$this->db->where('id',$post_data['id_st']);
				$this->db->update('surat_tugas',$data_st);
				$insert_id = $post_data['id_st'];
			}else{
				$data_st = array(
				'id' => $post_data['id_st'],
				'nip' => $post_data['nip'],
				'id_kegiatan' => $post_data['id_kegiatan'],
				'id_matriks' => $post_data['id_matriks'],
				'tugas' => $post_data['perihal'],
				'waktu' => $this->hitung_waktu($post_data['id_matriks']),
				'tanggal_surat' =>isset($post_data['no_surat'])?$post_data['no_surat']:'',
				'tanggal_sppd' =>isset($post_data['no_sppd'])?$post_data['no_sppd']:'',
				'status' => 1,
				'is_sppd' => isset($post_data['is_sppd'])?1:0,
				'is_pengawasan' => isset($post_data['is_pengawasan'])?1:0,
				'template' => $post_data['template'],
				'no_ppk' => $post_data['no_ppk'],
				'visum_nama' => $post_data['visum_nama'],
				'visum_nip' => $post_data['visum_nip'],
				'visum_jabatan' => $post_data['visum_jabatan'],
				'opsi_lembar4' => $post_data['opsi_lembar4']
			);

			$this->db->insert('surat_tugas',$data_st);
			$insert_id = $this->db->insert_id();
			}

			if($post_data['mtx_tipe'] ==1){
				$data_spd = array(
					'id' => $post_data['id_spd'],
					'id_matriks' => $post_data['id_matriks'],
					'kendaraan' => $post_data['kendaraan'],
					'berangkat' =>$post_data['berangkat'],
					'perkiraan_biaya' =>$post_data['perkiraan_biaya'],
					'tujuan' =>$post_data['tujuan'],
				);

				$data_sby = array(
					'id' => $post_data['id_sby'],
					'id_spd' => $insert_id,
					'akun_bayar' => $post_data['akun_bayar'],
					'id_matriks' => $post_data['id_matriks'],
					'lama_hari' => $this->hitung_waktu($post_data['id_matriks'])
				);
			}elseif(isset($post_data['is_transport'])){
				$prov = array('6300','6351','6352','6353','6354','6355','6356');
				$lokasi = $this->session->userdata('wilayah')->kode;
				if(in_array($this->session->userdata('wilayah')->kode, $prov)){
					$lokasi = 'Banjarbaru';
				}else{
					$lokasi = $this->system->get_set('spd_setting')['bps_city'.'_'.$post_data['template']];
				}

				$data_spd = array(
					'id' => $post_data['id_spd'],
					'id_matriks' => $post_data['id_matriks'],
					'kendaraan' => $post_data['kendaraan'],
					'berangkat' =>$post_data['berangkat'],
					'perkiraan_biaya' =>$post_data['perkiraan_biaya'],
					'tujuan' =>$lokasi,
				);

				$data_sby = array(
					'id' => $post_data['id_sby'],
					'id_spd' => $insert_id,
					'akun_bayar' => $post_data['akun_bayar'],
					'id_matriks' => $post_data['id_matriks'],
					'lama_hari' => $this->hitung_waktu($post_data['id_matriks'])
				);
			}

			if($insert_id){
				if($post_data['mtx_tipe'] ==1){
					$this->db->replace('surat_perjalanan',$data_spd);
					$this->db->replace('surat_bayar',$data_sby);
					$save=true;
				}
				$this->db->where('id',$post_data['id_matriks']);
				$this->db->update('matriks_kegiatan',array('is_spd'=>1,'only_st'=>$post_data['mtx_tipe'] ==1?1:0));
				if($insert_id || $save){
					$this->session->set_flashdata('success', 'Input data berhasil');
		            redirect('/spd/kelola?id='.$post_data['id_matriks']);  
		        }else{
		         	$this->session->set_flashdata('failed', 'Input data gagal');
		            redirect('/spd/kelola?id='.$post_data['id_matriks']);   
		        }   
			}else{
				if($insert_id){
					$this->session->set_flashdata('success', 'Input data berhasil');
		            redirect('/spd/kelola?id='.$post_data['id_matriks']);  
				}
				$this->session->set_flashdata('failed', 'Input data gagal');
				redirect('/spd/kelola?id='.$post_data['id_matriks']);  
			}
		}
	}

	private function hitung_waktu($id){
		$this->db->where('id',$id);
		$mtx = $this->db->get('matriks_kegiatan')->row();
		$waktu = 0;

		if($mtx->array_tanggal){
			$waktu = sizeof(json_decode($mtx->array_tanggal,true));
		}else{
			$datediff = abs($mtx->tanggal_akhir - $mtx->tanggal_awal);
			$waktu = round($datediff / (60 * 60 * 24))+1;
		}

		return $waktu;
	}
}