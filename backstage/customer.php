<?php

class Customer{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function save(){
		
		pdie($_POST['d']);
		$return['status'] = 100;
		if($this->db->insert("customer_info",$data)){
			$return['status'] = 200;
		}
		jdie($return);


	}





	
}






?>