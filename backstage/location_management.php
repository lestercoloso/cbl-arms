<?php

class Location_management{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getno(){
		$select = $this->db->select_one('select max(code) as newnumber from location_management limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,10,"0",STR_PAD_LEFT));
	}


	public function save(){

		$data = $_POST['d'];
		$data['storage_type'] = (!empty($data['storage_type'])) ? json_encode($data['storage_type']) : "";

		if($this->db->insert("location_management",$data)){
			$return['status'] = 200;
			$return['id'] = $this->db->insert_id();
		}
		jdie($return);
	}



	public function getlist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
	
		if(!empty($searchdata)){

			$this->db->where_like(['LPAD(`code`, 10, \'0\')'=>$searchdata['code']]);
			$this->db->where_like(['location'=>$searchdata['location']]);
			$this->db->where_like(['storage_type'=>$searchdata['storage_type']]);
			$this->db->where_search(['status'=>$searchdata['status']]);

		}	

	$where = $this->db->where_search();
	
		$sql = "select id,
			LPAD(`code`, 10, '0') as code, 
			location, 
			address, 
			storage_type,
			status
			from location_management $where  $additional";
		$data = $this->db->select($sql);


		
		foreach($data['data'] as $k=>$d){
			if(!empty($d['storage_type'])){
				$dst = json_decode($d['storage_type']);
				$data['data'][$k]['storage_type'] = implode(',', $dst);
			}
		} 

		$datatotal = $this->db->select_one("select count(id) as total from item_master_file $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}

	
}






?>