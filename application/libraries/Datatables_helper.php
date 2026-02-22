<?php


/**
 * 
 */
class Datatables_helper 
{
	
	public function generate($result){

		$row = sizeof($result);

		$out = array(
            "draw"            => 0,
            "recordsTotal"    => $row,
            "recordsFiltered" => $row,
            "data"            => $result,
        );
        return json_encode($out);
	}
}