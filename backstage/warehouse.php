<?php

class Warehouse{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getcode($type){
		$select = $this->db->select_one('select max(code) as newcode from '.$type.'_storage limit 1' );
		$newcode = !empty($select['newcode']) ? $select['newcode'] : 0;
		jdie(str_pad($newcode+1,10,"0",STR_PAD_LEFT));
	}

	public function saveStorage($type){
		$data['code'] = 1;
		$data['rack_length'] = 20;
		$this->db->insert("rack_storage",$data);

	}


}

?>