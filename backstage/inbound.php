<?php

class Inbound{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function billoflading(){
		$sql = "select LPAD(`bill_no`, 10, '0') as lading_number, 
				(select `customer_name` from customer_information where id=a.client_id) as customer_name 
				from bill_of_lading a where bill_no!=0 and bill_no not in (select bill_of_lading from inbound_list where status=1)";

		$select = $this->db->select($sql);
		jdie($select);
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
			LPAD(`bill_of_lading`, 8, '0') as bill_of_lading, 
			delivery_receipt, 
			pallet_code, 
			quantity, 
			description, 
			IF(`storage_type`=1,'Ambiant Storage','Cool Storage') as storage_type,
			inventory_type, 
			DATE_FORMAT(`ex_date`,'%y-%m-%d') as ex_date,
			DATE_FORMAT(`en_date`,'%y-%m-%d') as en_date,
			DATE_FORMAT(`pu_date`,'%y-%m-%d') as pu_date
			from inbound_list a $where $additional";

		$data = $this->db->select($sql);

		$datatotal = $this->db->select_one("select count(id) as total from inbound_list a $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
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

	public function save(){

		$data = json_decode($_POST['d'], TRUE);
		$data['bill_of_lading'] = (int) $data['bill_of_lading'];
		$data['ex_date'] = date('Y-m-d', strtotime($data['ex_date']));
		$data['en_date'] = date('Y-m-d', strtotime($data['en_date']));
		$data['pu_date'] = date('Y-m-d', strtotime($data['pu_date']));


		$return['status'] = 100;
		if($this->db->insert("inbound_list",$data)){
			$return['status'] = 200;
		}
		jdie($return);


	}

	public function delete($inboundid=''){
		$inboundid = explode('-', $inboundid);
		$id = $inboundid[1];
		$data['status'] = 100;
		if($this->db->CheckResult("delete from inbound_list where id=$id" )){
			$data['status'] = 200;
		}
		jdie($data);
	}

	public function edit($inboundid=''){
		$inboundid = explode('-', $inboundid);
		$id = $inboundid[1];
		$data = $this->db->select_one("select * from inbound_list a where status=1 and id=$id limit 1" );
		jdie($data);
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