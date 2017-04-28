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


	public function detail($id){
			$sql = "select id,
			LPAD(`code`, 10, '0') as code, 
			location, 
			address, 
			storage_type
			from location_management where id=$id";
			$data = $this->db->select_one($sql);
			$data['storage_type'] = json_decode($data['storage_type']);
			jdie($data);
	}


	public function storagelist($whid=''){
		$sql = "select id, block, code, storage, sections, levels, status from storage where location=$whid ";
		$data = $this->db->select($sql);
		jdie($data);
	}

	public function changestatusstorage($id, $status){
		if($this->db->update("storage",['status'=>$status], "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
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

	public function update($id){

		$data = $_POST['d'];
		$data['storage_type'] = (!empty($data['storage_type'])) ? json_encode($data['storage_type']) : "";

		if($this->db->update("location_management",$data, "id=$id")){
			$return['status'] = 200;
			// $return['id'] = $this->db->insert_id();
		}
		jdie($return);
	}

	public function changestatus($id, $status){

		
		if($this->db->update("location_management",['status'=>$status], "id=$id")){
			// $this->db->last_query();
			$return['status'] = 200;
		}
		jdie($return);
	}



	public function delete($id=''){
		$data['status'] = 100;
		if($this->db->delete("location_management", "id=$id" )){
			$data['status'] = 200;
		}
		jdie($data);
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
		$datatotal = $this->db->select_one("select count(id) as total from location_management $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);

		foreach($data['data'] as $k=>$d){
			if(!empty($d['storage_type'])){
				$dst = json_decode($d['storage_type']);
				$data['data'][$k]['storage_type'] = implode(',', $dst);
			}
		} 		
		jdie($data);

	}

	
}






?>