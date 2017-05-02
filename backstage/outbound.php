<?php

class Outbound{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	

	public function getOutbound($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		
	 	$searchdata['ex_date'] = (!empty($searchdata['ex_date'])) ? date('Y-m-d', strtotime($searchdata['ex_date'])) :'';
	    $searchdata['en_date'] = (!empty($searchdata['en_date'])) ? date('Y-m-d', strtotime($searchdata['en_date'])) :'';
	    $searchdata['pu_date'] = (!empty($searchdata['pu_date'])) ? date('Y-m-d', strtotime($searchdata['pu_date'])) :'';

	

	$this->db->where_search('a.id=b.inbound_id');
	$this->db->where_search(['b.status'=>1]);
	$where = $this->db->where_search($searchdata);
	
		$sql = "select b.id,
			(select `customer_name` from customer_information where id IN (select client_id from bill_of_lading where bill_no=a.bill_of_lading)) as customer_name, 
			LPAD(`bill_of_lading`, 10, '0') as bill_of_lading, 
			delivery_receipt, 
			invoice_no, 
			LPAD(`pallet_code`, 10, '0') as pallet_code, 
			b.qty as quantity, 
			b.location, 
			DATE_FORMAT(`ex_date`,'%m/%d/%Y') as ex_date,
			DATE_FORMAT(`pu_date`,'%m/%d/%Y') as pu_date,
			type_of_shipment
			from inbound_list a, outbound_list b $where  $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(b.id) as total from inbound_list a, outbound_list b $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}


	public function getrefno(){
		$sql = 'select max(outbound_no) as newnumber from outbound_shipment limit 1';
		$select = $this->db->select_one($sql);
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,8,"0",STR_PAD_LEFT));
	}
	
	public function getoutboundlist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
	
		if(!empty($searchdata)){

			$this->db->where_like(['concat(\'OB\',LPAD(`inbound_no`, 8, \'0\'))' => $searchdata['outbound_no']]);
			$this->db->where_like(['booked_by'=>$searchdata['booked_by']]);
			$this->db->where_search(['status'=>$searchdata['status']]);

			$requestfrom = !empty($searchdata['req_date_from']) ? date('Y-m-d', strtotime($searchdata['req_date_from'])) : '';
			$requesto = !empty($searchdata['req_date_to']) ? date('Y-m-d', strtotime($searchdata['req_date_to'])) : '';

			$this->db->where_search(['request_date>'=>$requestfrom]);
			$this->db->where_search(['request_date<'=>$requesto]);			

		}	

	$where = $this->db->where_search();
	
		$sql = "select id,
			concat('OB',LPAD(`outbound_no`, 8, '0')) as inbound_no, 
			DATE_FORMAT(`request_date`,'%m/%d/%Y') as request_date, 
			DATE_FORMAT(`estimated_arrival`,'%m/%d/%Y %h:%i%p') as eta, 
			booked_by, 
			status
			from outbound_shipment $where  $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from outbound_shipment $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);

		foreach($data['data'] as $k=>$d){
			if(!empty($d['storage_type'])){
				$dst = json_decode($d['storage_type']);
				$data['data'][$k]['storage_type'] = implode(',', $dst);
			}
		} 		
		jdie($data);

	}

	public function save($posted=1){

		session_start();
		$data = $_POST['d'];
		$data['outbound_no'] 		= substr($data['outbound_no'],2);
		$data['booked_by_id'] 		= $_SESSION['userid'];
		$data['status'] 			= $posted;
		$data['estimated_arrival'] 	= date('Y-m-d G:i:s', strtotime($data['estimated_arrival']));
		$data['request_date'] 		= date('Y-m-d', strtotime($data['request_date']));
		
		$return['status'] = 100;
		if($this->db->insert("outbound_shipment",$data)){
			$insert_id = $this->db->insert_id();

			foreach ($_POST['inventory'] as $value) {
				$value['outbound_id'] = $insert_id;
				$value['exp_date'] = save_date($value['exp_date']);
				$this->db->insert("outbound_shipment_list",$value);
			}

			$return['status'] = 200;
		}
		jdie($return);


	}		

	public function delete($outboundid=''){
		$data['status'] = 100;
		if($this->db->CheckResult("delete from outbound_shipment where id=$outboundid" )){
			$data['status'] = 200;
		}
		jdie($data);
	}

	public function update($updateid=""){
		session_start();
		$data = $_POST['d'];
		$data['outbound_no'] 		= substr($data['outbound_no'],2);
		$data['booked_by_id'] 		= $_SESSION['userid'];
		// $data['status'] 			= $posted;
		$data['estimated_arrival'] 	= date('Y-m-d G:i:s', strtotime($data['estimated_arrival']));
		$data['request_date'] 		= date('Y-m-d', strtotime($data['request_date']));
		
		$return['status'] = 100;
		if($this->db->update("outbound_shipment",$data, "id=$updateid")){

			$this->db->delete('outbound_shipment_list',"outbound_id=$updateid");
			foreach ($_POST['inventory'] as $value) {
				$value['outbound_id'] = $updateid;
				$value['exp_date'] = save_date($value['exp_date']);
				$this->db->insert("inbound_shipment_list",$value);
			}

			$return['status'] = 200;
		}
		jdie($return);


	}	

	public function edit($inboundid=''){
		$inboundid = explode('-', $inboundid);
		$id = $inboundid[1];

		$sql = "select 
				id, 
				concat('IB',LPAD(`outbound_no`, 8, '0')) as outbound_no,
				estimated_arrival,
				request_date,
				shipped_to,
				booked_by
				from outbound_shipment where id=$id limit 1";
				// die($sql);
		$data = $this->db->select_one($sql);
		$data['request_date'] = get_date($data['request_date']);
		$data['estimated_arrival'] = date('m/d/Y G:i A', strtotime($data['estimated_arrival']));

		
		$sql = "select 
				stock_no,
				box,
				carton,
				description,
				cbm,
				pieces,
				total_cbm,
				batch_code,
				DATE_FORMAT(`exp_date`,'%m/%d/%Y') as exp_date
				from outbound_shipment_list where status=1 and outbound_id=$id";
		$data['inventory'] = $this->db->select($sql)['data'];
		jdie($data);
	}	

	public function changestatus($id='', $status=''){
		if($this->db->update('outbound_shipment', ['status'=>$status], "id=$id")){
			$result['status'] = 200;
		}
		jdie($result);
	}


	public function masschangestatus($status=''){

		$ids = $_POST['ids'];
		$result['status'] = 100;
		foreach($ids  as $id){
			if($this->db->update('outbound_shipment', ['status'=>$status], "id=$id")){
				$result['status'] = 200;
			}
		}
		
		jdie($result);
	}		

}
?>