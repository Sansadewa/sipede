<?php

require_once("./application/libraries/tad/vendor/autoload.php");
//require 'tad/vendor/autoload.php';

use TADPHP\TAD;
use TADPHP\TADFactory;

class Presensi {

  function getPresensi($pin,$start,$end){
  //$comands = TAD::commands_available();

  /*$options = [
    'ip' => '10.63.0.212',   // '169.254.0.1' by default (totally useless!!!).
    'internal_id' => 100,    // 1 by default.
    'com_key' => 123,        // 0 by default.
    'description' => 'TAD1', // 'N/A' by default.
    'soap_port' => 8080,     // 80 by default,
    'udp_port' => 4370,      // 4370 by default.
    'encoding' => 'utf-8'    // iso8859-1 by default.
  ];
  
  $tad_factory = new TADFactory($options);
  //$tad = $tad_factory->get_instance();
  $tad = (new TADFactory(['ip'=>'10.63.0.212', 'com_key'=>0]))->get_instance();

  $logs = $tad->get_att_log(['pin'=>$pin]);

  $filtered_att_logs = $logs->filter_by_date(
      ['start' => $start,'end' => $end]
    )->to_array();*/
    var_dump($this->tempo());
    //return $this->temp();

}

function getAllPresensi($start,$end){
  //$comands = TAD::commands_available();

  $tad = (new TADFactory(['ip'=>'10.163.2.121', 'com_key'=>0]))->get_instance();

  $logs = $tad->get_att_log();

  $filtered_att_logs = $logs->filter_by_date(
      ['start' => $start,'end' => $end]
    )->to_array();

    return $filtered_att_logs;

}
}