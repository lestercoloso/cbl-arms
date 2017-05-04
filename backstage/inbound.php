<?php

class Inbound{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function billoflading(){
		$sql = "select LPAD(`bill_no`, 10, '0') as lading_number, quantity, 
				(select `customer_name` from customer_information where id=a.client_id) as customer_name 
				from bill_of_lading a where bill_no!=0 and bill_no not in (select bill_of_lading from inbound_list where status=1)";

		$select = $this->db->select($sql);
		jdie($select);
	}
	public function getrefno(){
		$sql = 'select max(inbound_no) as newnumber from inbound_shipment limit 1';
		$select = $this->db->select_one($sql);
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,8,"0",STR_PAD_LEFT));
	}

	public function getpallet(){
		$select = $this->db->select_one('select max(pallet_code) as newnumber from inbound_list where status=1 limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,10,"0",STR_PAD_LEFT));
	}

	public function getInbound($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		
	 	$searchdata['ex_date'] = (!empty($searchdata['ex_date'])) ? date('Y-m-d', strtotime($searchdata['ex_date'])) :'';
	    $searchdata['en_date'] = (!empty($searchdata['en_date'])) ? date('Y-m-d', strtotime($searchdata['en_date'])) :'';
	    $searchdata['pu_date'] = (!empty($searchdata['pu_date'])) ? date('Y-m-d', strtotime($searchdata['pu_date'])) :'';

	

	$this->db->where_search(['status'=>1]);
	$where = $this->db->where_search($searchdata);
	
		$sql = "select id,
			(select `customer_name` from customer_information where id IN (select client_id from bill_of_lading where bill_no=a.bill_of_lading)) as customer_name, 
			LPAD(`bill_of_lading`, 10, '0') as bill_of_lading, 
			delivery_receipt, 
			LPAD(`pallet_code`, 10, '0') as pallet_code, 
			(quantity - (select COALESCE(sum(qty),0) from outbound_list where inbound_id=a.id)) as quantity, 
			description, 
			#IF(`storage_type`=1,'Ambiant Storage','Cool Storage') as storage_type,
			storage_type,
			inventory_type, 
			DATE_FORMAT(`ex_date`,'%y-%m-%d') as ex_date,
			DATE_FORMAT(`en_date`,'%y-%m-%d') as en_date,
			DATE_FORMAT(`pu_date`,'%y-%m-%d') as pu_date
			from inbound_list a $where having quantity>0 $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from inbound_list a $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}


	public function getinboundlist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
	
		if(!empty($searchdata)){

			$this->db->where_like(['concat(\'IB\',LPAD(`inbound_no`, 8, \'0\'))' => $searchdata['inbound_no']]);
			$this->db->where_like(['booked_by'=>$searchdata['booked_by']]);
			$this->db->where_search(['status'=>$searchdata['status']]);

			$requestfrom = !empty($searchdata['req_date_from']) ? date('Y-m-d', strtotime($searchdata['req_date_from'])) : '';
			$requesto = !empty($searchdata['req_date_to']) ? date('Y-m-d', strtotime($searchdata['req_date_to'])) : '';

			$this->db->where_search(['request_date>'=>$requestfrom]);
			$this->db->where_search(['request_date<'=>$requesto]);			

		}	

	$where = $this->db->where_search();
	
		$sql = "select id,
			concat('IB',LPAD(`inbound_no`, 8, '0')) as inbound_no, 
			DATE_FORMAT(`request_date`,'%m/%d/%Y') as request_date, 
			DATE_FORMAT(`estimated_arrival`,'%m/%d/%Y %h:%i%p') as eta, 
			booked_by, 
			status
			from inbound_shipment $where  $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from inbound_shipment $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);

		foreach($data['data'] as $k=>$d){
			if(!empty($d['storage_type'])){
				$dst = json_decode($d['storage_type']);
				$data['data'][$k]['storage_type'] = implode(',', $dst);
			}
		} 		
		jdie($data);

	}	

	public function getcode($type){
		$additional = '';
		if($type=='rack'){
			$additional = ", no_rack_level";
		}

		$select = $this->db->select("select LPAD(`code`, 10, '0') as code $additional from ".$type."_storage where status=1");
		jdie($select);
	}

	public function customer(){
		$select = $this->db->select("select id, customer_name from customer_information where status=1");
		jdie($select);
	}

	public function pullout($id=''){
		$data = $_POST['d'];
		$data['inbound_id'] = $id;

		$return['status'] = 100;
		if($this->db->insert("outbound_list",$data)){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function save($posted=1){

		session_start();
		$data = $_POST['d'];
		$data['inbound_no'] 		= substr($data['inbound_no'],2);
		$data['booked_by_id'] 		= $_SESSION['userid'];
		$data['status'] 			= $posted;
		$data['estimated_arrival'] 	= date('Y-m-d G:i:s', strtotime($data['estimated_arrival']));
		$data['request_date'] 		= date('Y-m-d', strtotime($data['request_date']));
		
		$return['status'] = 100;
		if($this->db->insert("inbound_shipment",$data)){
			$insert_id = $this->db->insert_id();

			foreach ($_POST['inventory'] as $value) {
				$value['inbound_id'] = $insert_id;
				$value['exp_date'] = save_date($value['exp_date']);
				$this->db->insert("inbound_shipment_list",$value);
			}

			$return['status'] = 200;
		}
		jdie($return);


	}

	public function update($updateid=""){
		session_start();
		$data = $_POST['d'];
		$data['inbound_no'] 		= substr($data['inbound_no'],2);
		$data['booked_by_id'] 		= $_SESSION['userid'];
		// $data['status'] 			= $posted;
		$data['estimated_arrival'] 	= date('Y-m-d G:i:s', strtotime($data['estimated_arrival']));
		$data['request_date'] 		= date('Y-m-d', strtotime($data['request_date']));
		
		$return['status'] = 100;
		if($this->db->update("inbound_shipment",$data, "id=$updateid")){

			$this->db->delete('inbound_shipment_list',"inbound_id=$updateid");
			foreach ($_POST['inventory'] as $value) {
				$value['inbound_id'] = $updateid;
				$value['exp_date'] = save_date($value['exp_date']);
				$this->db->insert("inbound_shipment_list",$value);
			}

			$return['status'] = 200;
		}
		jdie($return);


	}

	public function receive($updateid=""){
		session_start();
		// pdie($_POST);
		$data = $_POST['d'];
		$data['inbound_no'] 		= substr($data['inbound_no'],2);
		$data['booked_by_id'] 		= $_SESSION['userid'];
		$data['status'] 			= 4;
		$data['estimated_arrival'] 	= date('Y-m-d G:i:s', strtotime($data['estimated_arrival']));
		$data['request_date'] 		= date('Y-m-d', strtotime($data['request_date']));
		$data['entry_date'] 		= date('Y-m-d', strtotime($data['entry_date']));
		
		$return['status'] = 100;
		if($this->db->update("inbound_shipment",$data, "id=$updateid")){

			foreach ($_POST['inventory'] as $value) {

				$inventoryid = $value['updateid'];
				unset($value['updateid']);
				$this->db->update("inbound_shipment_list",$value, "id=$inventoryid");
			}

			$return['status'] = 200;
		}
		jdie($return);


	}

	public function delete($inboundid=''){
		$data['status'] = 100;
		if($this->db->CheckResult("delete from inbound_shipment where id=$inboundid" )){
			$data['status'] = 200;
		}
		jdie($data);
	}

	public function edit($inboundid=''){
		$inboundid = explode('-', $inboundid);
		$id = $inboundid[1];

		$sql = "select 
				id, 
				concat('IB',LPAD(`inbound_no`, 8, '0')) as inbound_no,
				estimated_arrival,
				request_date,
				booked_by
				from inbound_shipment where id=$id limit 1";
				// die($sql);
		$data = $this->db->select_one($sql);
		$data['request_date'] = get_date($data['request_date']);
		$data['estimated_arrival'] = date('m/d/Y G:i A', strtotime($data['estimated_arrival']));

		
		$sql = "select 
				id,
				stock_no,
				box,
				carton,
				description,
				cbm,
				pieces,
				total_cbm,
				batch_code,
				wh_storage,
				storage_type,
				wh_status,
				pallet_position_code,
				DATE_FORMAT(`exp_date`,'%m/%d/%Y') as exp_date
				from inbound_shipment_list where status=1 and inbound_id=$id";
		$data['inventory'] = $this->db->select($sql)['data'];
		jdie($data);
	}

	public function getitemmasterfile(){
		// ((length*0.01)*(width*0.01)*(height*0.01)*(uom_qty_1*uom_qty_2*uom_qty_3)) as cbm,
		$sql = "select 
		LPAD(`item_id`, 10, '0') as item_id,
		cbm,
		item_description,
		stock_no,
		uom_qty_2 as box,
		uom_qty_1 as carton,
		
		(
		CASE WHEN uom_qty_1 > '0' THEN `uom_qty_1` ELSE '1' END * 
		CASE WHEN uom_qty_2 > '0' THEN `uom_qty_2` ELSE '1' END *
		CASE WHEN uom_qty_3 > '0' THEN `uom_qty_3` ELSE '1' END 
		) as pieces,

		concat(
	    CASE WHEN uom_qty_1 > '0' THEN concat(`uom_1`, '-', `uom_qty_1`) ELSE '' END,
	    CASE WHEN uom_qty_2 > '0' THEN concat('/',`uom_2`, '-', `uom_qty_2`) ELSE '' END,
	    CASE WHEN uom_qty_3 > '0' THEN concat('/',`uom_3`, '-', `uom_qty_3`) ELSE '' END) as uom

		from item_master_file where status=1";
		$data = $this->db->select($sql);
		jdie($data);	

	}

	public function changestatus($id='', $status=''){
		if($this->db->update('inbound_shipment', ['status'=>$status], "id=$id")){
			$result['status'] = 200;
		}
		jdie($result);
	}	

	public function masschangestatus($status=''){

		$ids = $_POST['ids'];
		$result['status'] = 100;
		foreach($ids  as $id){
			if($this->db->update('inbound_shipment', ['status'=>$status], "id=$id")){
				$result['status'] = 200;
			}
		}
		
		jdie($result);
	}
	
}



	
		// $sql = "select a.id,
		// 	(select `customer_name` from customer_information where id=b.client_id) as customer_name, 
		// 	LPAD(a.`bill_of_lading`, 8, '0') as bill_of_lading, 
		// 	LPAD(a.`delivery_receipt`, 8, '0') as delivery_receipt, 
		// 	LPAD(a.`pallet_code`, 8, '0') as pallet_code, 
		// 	a.quantity, 
		// 	a.description, 
		// 	IF(a.`storage_type`=1,'Ambiant Storage','Cool Storage') as storage_type,
		// 	a.inventory_type, 
		// 	DATE_FORMAT(a.`ex_date`,'%y-%m-%d') as ex_date,
		// 	DATE_FORMAT(a.`en_date`,'%y-%m-%d') as en_date,
		// 	DATE_FORMAT(a.`pu_date`,'%y-%m-%d') as pu_date
		// 	from inbound_list a, bill_of_lading b $where $additional";


?>