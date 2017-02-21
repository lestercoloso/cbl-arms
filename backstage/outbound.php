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

	
	
}
?>