<?php

defined('BASEPATH') or exit('No direct script access allowed');

function format_size($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } else {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }

    return $bytes;
}

function get_alpabhet($indeks){
    $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ');

    return $alphabet[$indeks];
}

function get_romawi($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}

function concat_keg($keg_nama,$kode_kegiatan){
    return $keg_nama.' '.$kode_kegiatan;
}

function compareByTimeStamp($a, $b) 
{ 
   if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
} 

function getStatusSt($status,$pencetak){
    if(strlen($status) == 0){
        return 'Belum isi rincian';
    }else{
        if($pencetak){
            return $status.'('.$pencetak.')';
        }
        return $status;
    }
}

function getBulan($id){
    $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    return $bulan[$id];
}

function jangka_waktu($surat,$full=TRUE){
    $lama = $surat->waktu;

    $jangka_waktu = '';
    $jangka_waktu_aja ='';

    if($surat->array_tanggal){
        $jadwal = json_decode($surat->array_tanggal,true);
        
        $temp = array();

        foreach ($jadwal as $value) {
            $bln = intval(date("m",strtotime($value)))-1;   
            $temp[$bln][] =  date("j",strtotime($value));
        }

        $cur_bln ;
        foreach ($temp as $key => $value) {
            $jangka_waktu .="(";
            $str=implode(',', $value);
            $cur_bln = $key;
          /* foreach ($value as $hari) {
               $str .= $hari.',';
           }*/
           if($key != $cur_bln){
                $jangka_waktu .= $str.") ".getBulan($key).' ';
           }else{
                $jangka_waktu .= $str.") ".getBulan($key).' ';
           }
        }

        $jangka_waktu .=date("Y",strtotime($jadwal[sizeof($jadwal)-1]));
        $jangka_waktu_aja = $jangka_waktu;
        $jangka_waktu = $lama." (".terbilang($lama).") hari ".$jangka_waktu;

    }else{
        $blna = intval(date("m",$surat->tanggal_awal))-1;
        $blnb = intval(date("m",$surat->tanggal_akhir))-1;
        if($blna != $blnb){
            $jangka_waktu = $lama." (".terbilang($lama).") hari ".date("j",$surat->tanggal_awal)." ".getBulan(intval(date("m",$surat->tanggal_awal))-1)." s/d ".date("j",$surat->tanggal_akhir)." ".getBulan(intval(date("m",$surat->tanggal_akhir))-1)." ".date("Y",$surat->tanggal_awal);
            return $jangka_waktu;
        }

        if($full){
            if($lama == 1){
                $jangka_waktu = $lama." (".terbilang($lama).") hari"." ".date("j",$surat->tanggal_awal)." ".
                getBulan(intval(date("m",$surat->tanggal_awal))-1)." ".date("Y",$surat->tanggal_awal);
            }else{
                $jangka_waktu = $lama." (".terbilang($lama).") hari"." ".date("j",$surat->tanggal_awal)." s.d ".date("j",$surat->tanggal_akhir)." ".getBulan(intval(date("m",$surat->tanggal_awal))-1)." ".date("Y",$surat->tanggal_awal);
            }
        }else{
            if($lama == 1){
                $jangka_waktu = date("j",$surat->tanggal_awal)." ".
                getBulan(intval(date("m",$surat->tanggal_awal))-1)." ".date("Y",$surat->tanggal_awal);
            }else{
                $jangka_waktu = date("j",$surat->tanggal_awal)." s.d ".date("j",$surat->tanggal_akhir)." ".getBulan(intval(date("m",$surat->tanggal_awal))-1)." ".date("Y",$surat->tanggal_awal);
            }
        }
    }

    if(!$full && $jangka_waktu_aja){
        return $jangka_waktu_aja;
    }else{
        return $jangka_waktu;
    }

}


function array_assoc_by($key, $array) {
    $new = array();
    foreach ($array as $v) {
        if (!array_key_exists($v[$key], $new))
            $new[$v[$key]] = $v;
    }
    return $new;
}

function uri_to_assoc($params = array())
{
    $vars = array();
    array_unshift($params, "/");
    for ($i = 0; $i < count($params); $i++) {
        if ($i % 2)
            $vars[$params[$i]] = isset($params[$i + 1]) ? $params[$i + 1] : '';
    }
    return $vars;
}

function get_thumb($str, $default_image = '')
{
    preg_match('/\<img(.*?)src=\"(.*?)\"(.*?)\>/i', $str, $matches,
        PREG_OFFSET_CAPTURE);
    if ($matches) {
        return strip_tags($matches[2][0]);
    }
    return $default_image;
}
function remove_tags($str)
{
    $str = str_replace('<', ' <', $str);
    $str = strip_tags($str);
    $str = preg_replace('!\s+!', ' ', $str);
    return trim($str);
}
function str_link($str, $sep = '-')
{
    setlocale(LC_ALL, 'en_US.UTF8');
    $plink = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $plink = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $plink);
    $plink = strtolower(trim($plink, $sep));
    $plink = preg_replace("/[\/_| -]+/", $sep, $plink);
    return $plink;
}

function format_uang($rupiah, $rate = 0, $tpl = 'Rp {INT}', $round = 2)
{
    if ($rate)
        return str_ireplace('{INT}', round($rupiah / $rate, $round), $tpl);
    return str_ireplace('{INT}', number_format($rupiah, 0, '', '.'), $tpl);
}

function format_uang2($nilai)
{
    return number_format($nilai, 0, '', '.');
}

function terbilang($x){
   $ambil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
   if ($x < 12)
    return " " . $ambil[$x];
elseif ($x < 20)
    return terbilang($x - 10) . " belas";
elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
elseif ($x < 200)
    return " seratus" . terbilang($x - 100);
elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
elseif ($x < 2000)
    return " seribu" . terbilang($x - 1000);
elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}

function cek_tanggal($tanggal_awal,$tanggal_akhir){
    if(strtotime($tanggal_awal)>strtotime($tanggal_akhir)){
        return false;
    }else{
        return true;
    }
}

function format_tanggal($var, $full = false)
{
    //$var = strtotime($var);
    $shift = 8 * 3600;
    if ($full != false) {
        $tanggal = strtr(date(" j #m Y", $var + $shift), array(
            '-1' => 'Senin',
            '-2' => 'Selsa',
            '-3' => 'Rabu',
            '-4' => 'Kamis',
            '-5' => 'Jum&quot;at',
            '-6' => 'Sabtu',
            '-7' => 'Minggu',
            '#01' => 'Januari',
            '#02' => 'Februari',
            '#03' => 'Maret',
            '#04' => 'April',
            '#05' => 'Mei',
            '#06' => 'Juni',
            '#07' => 'Juli',
            '#08' => 'Agustus',
            '#09' => 'September',
            '#10' => 'Oktober',
            '#11' => 'November',
            '#12' => 'Desember',
            ));
        return $tanggal ;
    }
    return date("d-m-Y", $var + $shift);
}
if (!function_exists('lang')) {
    /**
     * Lang
     *
     * Fetches a language variable and optionally outputs a form label
     *
     * @param	string	$line		The language line
     * @param	string	$for		The "for" value (id of the form element)
     * @param	array	$attributes	Any additional HTML attributes
     * @return	string
     */
    function lang($line, $for = '', $attributes = array())
    {
        $line = get_instance()->lang->line($line);

        if ($for !== '') {
            $line = '<label for="' . $for . '"' . _stringify_attributes($attributes) . '>' .
                $line . '</label>';
        }

        return $line;
    }
}

