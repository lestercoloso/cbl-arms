<?php

class Booking{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getbookingno($type){
		$select = $this->db->select_one('select max(booking_no) as newnumber from booking where status=1 limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,10,"0",STR_PAD_LEFT));
	}





	
}






?>