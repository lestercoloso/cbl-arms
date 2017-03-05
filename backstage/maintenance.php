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


	public function vehiclelist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
	

	// $this->db->where_search(['b.status'=>1]);
	$where = $this->db->where_search($searchdata);
	
		$sql = "select id,
			LPAD(`vehicle_no`, 8, '0') as vehicle_no, 
			vehicle_desc, 
			plate_no, 
			type, 
			status
			from vehicle $where  $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from vehicle $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}	

	public function driverlist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
	

	// $this->db->where_search(['b.status'=>1]);
	$where = $this->db->where_search($searchdata);
	
		$sql = "select id,
			LPAD(`code`, 8, '0') as code, 
			name, 
			vehicle_type
			from driver_profile $where  $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from driver_profile $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}	

	public function deletevehicle($id){
		if($this->db->delete("vehicle","id='$id'")){
			$return['status'] = 200;
			// $this->db->last_query();
		}
		jdie($return);
	}

	public function deletedriver($id){
		if($this->db->delete("driver_profile","id='$id'")){
			$return['status'] = 200;
			// $this->db->last_query();
		}
		jdie($return);
	}

	public function vehicleno(){
		$select = $this->db->select_one('select max(vehicle_no) as newnumber from vehicle limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,8,"0",STR_PAD_LEFT));
	}	

	public function drivercode(){
		$select = $this->db->select_one('select max(code) as newnumber from driver_profile limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,8,"0",STR_PAD_LEFT));
	}	

	public function savevehicle(){
		$data = $_POST['d'];
		if($this->db->insert("vehicle",$data)){
			$return['status'] = 200;
		}
		jdie($return);
	}
	public function updatevehicle($id){
		$data = $_POST['d'];
		if($this->db->update("vehicle",$data, "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function vehicledelete($id){
		if($this->db->delete("vehicle","id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function driverdelete($id){
		if($this->db->delete("driver_profile","id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function savedriver(){
		$data = $_POST['d'];
		$data['birthday'] = save_date($data['birthday']);
		if($this->db->insert("driver_profile",$data)){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function updatedriver($id){
		$data = $_POST['d'];
		$data['birthday'] = save_date($data['birthday']);
		if($this->db->update("driver_profile",$data, "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function vehicledetail($id){
			$sql = "select id,
			LPAD(`vehicle_no`, 8, '0') as vehicle_no, 
			vehicle_desc, 
			plate_no, 
			type, 
			status
			from vehicle where id=$id";
			$data = $this->db->select_one($sql);
			jdie($data);
	}

	public function driverdetail($id){
			$sql = "select id,
			LPAD(`code`, 8, '0') as code, 
			DATE_FORMAT(`birthday`,'%m/%d/%Y') as birthday, 
			name, 
			age, 
			address,
			vehicle_type
			from driver_profile where id=$id";

			// die($sql);
			$data = $this->db->select_one($sql);
			jdie($data);
	}

	
}






?>