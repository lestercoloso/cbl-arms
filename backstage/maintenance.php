<?php

class Maintenance{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function save(){

		$data = $_POST['input'];
		if($this->db->insert("maintenance",$data)){
			$return['status'] = 200;
			$return['id'] = $this->db->insert_id();
		}
		jdie($return);
	}
	public function delete($id){

		if($this->db->delete("maintenance","id='$id'")){
			$return['status'] = 200;
			// $this->db->last_query();
		}
		jdie($return);
	}
	public function update($id){
		$data = $_POST['input'];
		if($this->db->update("maintenance",$data, "id='$id'")){
			$return['status'] = 200;
			// $this->db->last_query();
		}
		jdie($return);
	}


	
}






?>