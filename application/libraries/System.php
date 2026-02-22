<?php


/**
 * 
 */
class System 
{
	
	function get_set($set_key,$all=FALSE){
        if($all){
            $CI =& get_instance();
            $CI->db->select('set_val');
            $CI->db->where('set_key',$set_key);
            $q = $CI->db->get('setting');
            $q = $q->row();
            return json_decode($q->set_val,true);
        }else{
            $CI =& get_instance();
            $CI->db->select('set_val');
            $CI->db->where('set_key',$set_key."_".$CI->session->userdata('wilayah')->kode);
            $q = $CI->db->get('setting');
            $q = $q->row();
            return json_decode($q->set_val,true);
        }
        
    }

    function get_set2($set_key){
        $CI =& get_instance();
        $CI->db->select('set_val');
            $CI->db->where('set_key',$set_key);
            $q = $CI->db->get('setting');
            $q = $q->row();
            return $q->set_val;
    }

    function set_setelan($set_key,$data,$all=FALSE){
        if($all){
            $CI =& get_instance();
            $CI->db->select('set_val');
            $q = $CI->db->get('setting');
            $q = $q->row();
            $q = json_decode($q->set_val,true);
            foreach ($data as $key => $value) {
                $q[$key] = $value;
            }
            $CI->db->where('set_key',$set_key."_".$CI->session->userdata('wilayah')->kode);
            $CI->db->update('setting',array('set_val'=>json_encode($q)));
            if($CI->db->affected_rows()){
                return json_encode(array('status'=>True,'message'=>'ok'));
            }else{
                return json_encode(array('status'=>False,'message'=>'failed'));
            }
        }else{
            $CI =& get_instance();
            $CI->db->select('set_val');
            $CI->db->where('set_key',$set_key."_".$CI->session->userdata('wilayah')->kode);
            $q = $CI->db->get('setting');
            $q = $q->row();
            $q = json_decode($q->set_val,true);
            foreach ($data as $key => $value) {
                $q[$key] = $value;
            }
            $CI->db->where('set_key',$set_key."_".$CI->session->userdata('wilayah')->kode);
            $CI->db->update('setting',array('set_val'=>json_encode($q)));
            if($CI->db->affected_rows()){
                return json_encode(array('status'=>True,'message'=>'ok'));
            }else{
                return json_encode(array('status'=>False,'message'=>'failed'));
            }
        }
    }
}