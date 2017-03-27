<?php

class ItemMasterFile{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function itemno(){
		$select = $this->db->select_one('select max(item_id) as newnumber from item_master_file where status=1 limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,10,"0",STR_PAD_LEFT));

	}

	public function save(){
		$data = $_POST['d'];
		if($this->db->insert("item_master_file",$data)){
			$return['status'] = 200;
		}
		jdie($return);
	}
	public function delete($id){

		if($this->db->delete("item_master_file","id='$id'")){
			$return['status'] = 200;
			// $this->db->last_query();
		}
		jdie($return);
	}
	public function update($id){
		$data = $_POST['d'];
		if($this->db->update("item_master_file",$data, "id='$id'")){
			$return['status'] = 200;
		}
		jdie($return);
	}


	public function itemlist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
	

	// $this->db->where_search(['b.status'=>1]);
	$where = $this->db->where_search($searchdata);
	
		$sql = "select id,
			LPAD(`item_id`, 10, '0') as item_id, 
			product_code, 
			item_type, 
			concat(`uom_1`, '-', `uom_qty_1`, '/', `uom_2`, '-', `uom_qty_2`, '/', `uom_3`, '-', `uom_qty_3`) as uom,
			packaging,
			concat(`length`,' x ', `width`, ' x ', `height`) as dimension,
			storage_type,			
			unit_cost,			
			unit_price
			from item_master_file $where  $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from item_master_file $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}

	public function itemdetails($id){
			$sql = "select id,
			LPAD(`item_id`, 10, '0') as item_id, 
			product_code, 
			item_type, 
			bar_code, 
			case_bar_code, 
			uom_1, 
			uom_2, 
			uom_3, 
			uom_qty_1, 
			uom_qty_2, 
			uom_qty_3, 
			packaging,
			length,
			width,
			height,
			storage_type,			
			unit_cost,			
			unit_price,
			floor_level,
			ceiling_level
			from item_master_file where id=$id";
			$data = $this->db->select_one($sql);
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