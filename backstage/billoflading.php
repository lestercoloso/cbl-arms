<?php

class Billoflading{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getbookingno(){
		$select= $this->db->select('select id, LPAD(`booking_no`, 10, \'0\') as booking_no, customer_id from booking where status=1 and booking_no not in (select bill_no from bill_of_lading where status=1)');
		jdie($select);
	}

	public function getbookingdetails($id=''){
		$select= $this->db->select_one('select contact_person, customer_name, contact, area, address from booking where id=\''.$id.'\' and status=1');
		$select['contact'] = json_decode($select['contact'], TRUE);
		jdie($select);
	}


	public function listall($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";		
		
		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		$where = $this->db->where_search(['status'=>1]);

		$sql = "select id, LPAD(`bill_no`, 10, '0') as bill_no, recipient, shipper, DATE_FORMAT(`created_date`,'%m/%d/%Y') as bill_date, '0.00' as amount, ' - ' as bill_status
		    from bill_of_lading $where $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from bill_of_lading $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}	

	public function save(){
		

		$shipper 	= json_decode($_POST['shipper_information'], TRUE)['shipper_name'];
		$recipient 	= json_decode($_POST['recipient_information'], TRUE)['recipient_name'];

		$data['shipper_information'] 	= $_POST['shipper_information'];
		$data['package_content'] 		= $_POST['package_content'];
		$data['charges'] 				= $_POST['charges'];
		$data['additional_charges'] 	= $_POST['additional_charges'];
		$data['recipient_information'] 	= $_POST['recipient_information'];
		$data['others'] 				= $_POST['others'];
		$data['bill_no'] 				= $_POST['d']['bill_no'];
		$data['client_id'] 				= $_POST['d']['client_id'];
		$data['book_id'] 				= $_POST['d']['booking_no'];
		$data['recipient'] 				= $recipient;
		$data['shipper'] 				= $shipper;
		// pdie($data);

		if($this->db->insert("bill_of_lading",$data)){
			$return['status'] = 200;
		}
		jdie($return);
	}


	
}






?>