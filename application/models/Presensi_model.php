<?php

/**
 * 
 */
class Presensi_model extends CI_Model
{
	
	function __construct(){
		
	}



    public function get_rekap2(){

        $pegawai = $this->db->get('pegawai')->result();

        foreach ($pegawai as $value) {

            if(!$value->pin){
                continue;
            }
               $param = array(
                    'request' => 'presensi_bulanan',
                    'nip' => $value->pin,
                    'bulan' => date('m'),
                    'tahun' => date('Y'),
                );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://pbd.bps.go.id/presensi/forms/kaizala.php'.'?'.http_build_query($param));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $req = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($req,true);

            if(sizeof($data['data']) > 0){
                $this->db->where('Nipbps',$value->pin);
                $this->db->where('Tahun',date('Y'));
                $this->db->where('Bulan',date('m'));
                $this->db->delete('presensi_kaizala');
                $this->db->insert_batch('presensi_kaizala', $data['data'],'Id');
            }
        }

    }


    public function get_rekap($post_data){
        $pin = $post_data['id_absensi'];
        $number_days = cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']);
        $tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

        /*if($post_data['id_absensi']){
            $this->db->where('id_absensi',$pin);
            $q = $this->db->get('users');
            $pegawai = $q->row();
        }else{
            $pegawai = false;
        }*/
        

        $data = array();



        $param = array(
            'request' => 'presensi_bulanan',
            'nip' => $pin,
            'bulan' => (int)$post_data['bulan'],
            'tahun' => $post_data['tahun'],
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://pbd.bps.go.id/presensi/forms/kaizala.php'.'?'.http_build_query($param));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $req = curl_exec($ch);
        curl_close($ch);

        $data_absen = json_decode($req,true);

        if(sizeof($data_absen['data']) > 0){
            $this->db->where('Nipbps',$pin);
            $this->db->where('Tahun',$post_data['tahun']);
            $this->db->where('Bulan',(int)$post_data['bulan']);
            $this->db->delete('presensi_kaizala');
            $this->db->insert_batch('presensi_kaizala', $data_absen['data'],'Id');
        }


        for($i=1;$i<=$number_days;$i++){
            $tgl = $i;
            $this->db->where('Nipbps',$pin);
            $this->db->where('Tanggal',$tgl);
            $this->db->where('Bulan', (int)$post_data['bulan']);
            $this->db->where('Tahun', $post_data['tahun']);
            $q = $this->db->get('presensi_kaizala');
            $num_rows = $q->num_rows();
            $presensi = $q->row();

            if($num_rows == 0){
               $id = $pin;
               $in = '-';
               $out = '-';
               $jam_kerja = '-';
               $lebih_jam = '-';
            }else{
                $id = $presensi->Nipbps;
                $in = $presensi->Jamdatang;
                $out = $presensi->Jampulang;
                $jam_kerja = $this->hitungJamKerja($in,$out);
                $lebih_jam = $this->hitungLembur($i,$post_data['bulan'],$post_data['tahun'],$out);
            }

            $this->db->select('keg.nama as kegiatan,st.tugas as tugas');
            $this->db->from('matriks_kegiatan mtx');
            $this->db->join('kegiatan keg','keg.id=mtx.kegiatan','left');
            $this->db->join('surat_tugas st','st.id_matriks=mtx.id','left');
            $this->db->join('pegawai peg','mtx.nip=peg.nip','left');
            $this->db->where('mtx.tanggal_awal <=',strtotime($tgl.'-'.$post_data['bulan'].'-'.$post_data['tahun']));
            $this->db->where('mtx.tanggal_akhir >=',strtotime($tgl.'-'.$post_data['bulan'].'-'.$post_data['tahun']));
            $this->db->where('peg.pin',$pin);
            $q = $this->db->get();

            $ket = '';
            if($this->isWeekend($tgl.'-'.$post_data['bulan'].'-'.$post_data['tahun'])){
                $ket = 'Libur';
            }

            if($q->num_rows()==0 && !$presensi){
                $data[]=array(
                    'id' => $id,
                    'tanggal' => $i,
                    'jam_masuk' => '',
                    'jam_pulang' => '',
                    'jam_kerja' => '',
                    'lebih_jam' => '',
                    'sppd' => $ket?$ket:''
                );
                continue;
            }

            if($q->num_rows()>0 && $pin){
                $data[]=array(
                    'id' => $id,
                    'tanggal' => $i,
                    'jam_masuk' => $in,
                    'jam_pulang' => $out,
                    'jam_kerja' => $jam_kerja,
                    'lebih_jam' => $lebih_jam,
                    'sppd' => '<a href="#" data-toggle="tooltip" title="'.'['.$q->row()->kegiatan.']'.$q->row()->tugas.'"><i style="font-size:8pt;color:white">Kegiatan</i></a>'
                );
            }else{
                $data[]=array(
                    'id' => $id,
                    'tanggal' => $i,
                    'jam_masuk' => $in,
                    'jam_pulang' => $out,
                    'jam_kerja' => $jam_kerja,
                    'lebih_jam' => $lebih_jam,
                    'sppd' => $ket?$ket:''
                );
            }
        }

        $out = array(
            "draw"            => 0,
            "recordsTotal"    => sizeof($data),
            "recordsFiltered" => sizeof($data),
            "data"            => array_values($data),
        );
        return json_encode($out);

    }

   public function get_rekap3($post_data){
        $pin = $post_data['id_absensi'];
        $number_days = cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']);
        $tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

        $this->db->where('id_absensi',$pin);
        $q = $this->db->get('users');
        $pegawai = $q->row();

        $data = array();



        for($i=1;$i<=$number_days;$i++){
            $tgl = $i;
            if($i <10){
                $tgl = '0'.$i;
            }
            $this->db->where('id_absen',$pin);
            $this->db->where('datelog', $post_data['tahun'].'-'.$post_data['bulan'].'-'.$tgl);
            $q = $this->db->get('presensi');
            $num_rows = $q->num_rows();
            $presensi = $q->row();

            if($num_rows == 0){
                $id = $pin;
                $in = '-';
                $out = '-';
                $jam_kerja = '-';
                $lebih_jam = '-';
            }else{
                $id = $presensi->id_absen;
                $in = $this->db->query("SELECT * FROM presensi WHERE id_absen=".$pin." and datelog='".$post_data['tahun'].'-'.$post_data['bulan'].'-'.$tgl."' ORDER BY id asc LIMIT 1 ")->row()->timelog;
                $out = $this->db->query("SELECT * FROM presensi WHERE id_absen=".$pin." and datelog='".$post_data['tahun'].'-'.$post_data['bulan'].'-'.$tgl."' ORDER BY id desc LIMIT 1 ")->row()->timelog;
                $jam_kerja = $this->hitungJamKerja($in,$out);
                $lebih_jam = $this->hitungLembur($i,$post_data['bulan'],$post_data['tahun'],$out);
            }

            $this->db->select('keg.nama as kegiatan,st.tugas as tugas');
            $this->db->from('matriks_kegiatan mtx');
            $this->db->join('kegiatan keg','keg.id=mtx.kegiatan','left');
            $this->db->join('surat_tugas st','st.id_matriks=mtx.id','left');
            $this->db->join('pegawai peg','mtx.nip=peg.nip','left');
            $this->db->where('mtx.tanggal_awal <=',strtotime($tgl.'-'.$post_data['bulan'].'-'.$post_data['tahun']));
            $this->db->where('mtx.tanggal_akhir >=',strtotime($tgl.'-'.$post_data['bulan'].'-'.$post_data['tahun']));
            $this->db->where('peg.pin',$pin);
            $q = $this->db->get();

            $ket = '';
            if($this->isWeekend($tgl.'-'.$post_data['bulan'].'-'.$post_data['tahun'])){
                $ket = 'Libur';
            }

            if($q->num_rows()==0 && !$presensi){
                $data[]=array(
                    'id' => $id,
                    'tanggal' => $i,
                    'jam_masuk' => '',
                    'jam_pulang' => '',
                    'jam_kerja' => '',
                    'lebih_jam' => '',
                    'sppd' => $ket?$ket:''
                );
                continue;
            }

            if($q->num_rows()>0){
                $data[]=array(
                    'id' => $id,
                    'tanggal' => $i,
                    'jam_masuk' => $in,
                    'jam_pulang' => $out,
                    'jam_kerja' => $jam_kerja,
                    'lebih_jam' => $lebih_jam,
                    'sppd' => '<a href="#" data-toggle="tooltip" title="'.'['.$q->row()->kegiatan.']'.$q->row()->tugas.'"><i style="font-size:8pt;color:white">Tidak Absen</i></a>'
                );
            }else{
                $data[]=array(
                    'id' => $id,
                    'tanggal' => $i,
                    'jam_masuk' => $in,
                    'jam_pulang' => $out,
                    'jam_kerja' => $jam_kerja,
                    'lebih_jam' => $lebih_jam,
                    'sppd' => $ket?$ket:''
                );
            }
        }

        $out = array(
            "draw"            => 0,
            "recordsTotal"    => sizeof($data),
            "recordsFiltered" => sizeof($data),
            "data"            => array_values($data),
        );
        return json_encode($out);

    }

    private function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    private function hitungLembur($tgl,$month,$year,$p){
        $d = strtotime('16:00:00');
        $dif = strtotime($p)-$d;

        if($dif <= 0){
            return "0";
        }

        $jam = floor($dif/3600);
        $menit = round(($dif-(3600*$jam))/60);
        return $jam." jam ".$menit." menit";
    }

    private function hitungJamKerja($d,$p){
        $dif = strtotime($p)-strtotime($d);

        if($dif <= 0){
            return "0";
        }

        $jam = floor($dif/3600);
        $menit = round(($dif-(3600*$jam))/60);
        return $jam." jam ".$menit." menit";
    }   

}