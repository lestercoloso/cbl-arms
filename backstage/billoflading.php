<?php

class Billoflading{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getbookingno(){
		$select= $this->db->select('select id, LPAD(`booking_no`, 10, \'0\') as booking_no from booking where status=1');
		jdie($select);
	}

	public function getbookingdetails($id=''){
		$select= $this->db->select_one('select contact_person, customer_name, contact, area, address from booking where id=\''.$id.'\' and status=1');
		$select['contact'] = json_decode($select['contact'], TRUE);
		jdie($select);
	}


	
}






?>