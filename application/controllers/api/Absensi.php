<?php


class Absensi extends CI_Controller{

	public function index(){
		$sdate  = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-1,date("Y")));
		$edate  = date("Y-m-d");
		if(isset($_GET['tgl_mulai'])){
			$sdate  = $_GET['tgl_mulai'];
			$edate  = $_GET['tgl_akhir'];
		}
		$number = "";
		for($i=1;$i<=200;$i++){
			$number.=($i.",");
		}
		$number=substr($number,0,strlen($number)-1);
		$url = "http://".$this->system->get_set2('spd_mesin_absen')."/form/Download?uid=".$number."&sdate=".$sdate."&edate=".$edate."";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		$data = array();
		$record = explode("\n",$server_output);
		foreach($record as $r){
			$r = str_replace("\t"," ",$r);
			$isi = explode(" ",$r);
			array_push($data, $isi);
		}

		for($i=0;$i<count($data);$i++){
			$total    = 0;
			for($j=0;$j<=3;$j++){
				if (!isset($data[$i][$j])) {
					$data[$i][$j] = null;
				}
			}
			if($data[$i][0]<>null || $data[$i][2]<>null || $data[$i][3]<>null){
				if(substr($data[$i][3],0,4)>1000){
					$nick         = $data[$i][2];
					$data[$i][2]  = $data[$i][3];
					$data[$i][3]  = $data[$i][4];
					$data[$i][4]  = $data[$i][5];
				}
				$datetime = $data[$i][2]." ".$data[$i][3];
				if($datetime<>' ' && $total==0){
					$hash = hash('md5', $data[$i][0] . $data[$i][2]. $data[$i][3] . $data[$i][4].$datetime);
					$this->db->where(array('key' => $hash));
                	$query = $this->db->get('presensi');
                	if ($query->num_rows() == 0) {
						$insert = array(
							'key' => $hash,
							'id_absen' => $data[$i][0],
							'datelog' =>$data[$i][2],
							'timelog' =>$data[$i][3],
							'function_key' =>$data[$i][4],
							'date' =>$datetime
						);

						$this->db->insert('presensi',$insert);
                	}
				}
			}
		}
		print_r('OK');
	}

}