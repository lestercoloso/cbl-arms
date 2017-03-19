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
		$sql = "select 
		contact_person, 
		customer_name, 
		contact, 
		concat(format(`length`,0), ' x ', format(`width`,0), ' x ', format(`height`,0)) as dimension,
		round(`weight`,0) as weight,
		(select tin_no from customer_information where id=a.customer_id limit 1) as tin_no,
		area, 
		address 
		from booking a where id=$id and status=1";
		$select= $this->db->select_one($sql);
		$select['contact'] = json_decode($select['contact'], TRUE);
		jdie($select);
	}

	public function boldetails($id=''){
		$sql = "select * from bill_of_lading where id=$id and status=1";
		$select= $this->db->select_one($sql);
		jdie($select);
	}


	public function listall($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";		
		
		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		$where = $this->db->where_search(['status'=>1]);

		$sql = "select id, LPAD(`bill_no`, 10, '0') as bill_no, recipient, shipper, DATE_FORMAT(`created_date`,'%m/%d/%Y') as bill_date, FORMAT(`amount`, 2) as amount, ' - ' as bill_status
		    from bill_of_lading $where $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from bill_of_lading $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);

	}	

	public function delete($id){

		if($this->db->delete("bill_of_lading", "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}	

	public function save(){
		

		$shipper 	= json_decode($_POST['shipper_information'], TRUE)['shipper_name'];
		$recipient 	= json_decode($_POST['recipient_information'], TRUE)['recipient_name'];
		$quantity 	= json_decode($_POST['package_content'], TRUE)['total_package'];
		$amount 	= json_decode($_POST['additional_charges'], TRUE)['total_amount_due'];

		$data['shipper_information'] 	= $_POST['shipper_information'];
		$data['package_content'] 		= $_POST['package_content'];
		$data['charges'] 				= $_POST['charges'];
		$data['additional_charges'] 	= $_POST['additional_charges'];
		$data['recipient_information'] 	= $_POST['recipient_information'];
		$data['others'] 				= $_POST['others'];
		$data['bill_no'] 				= $_POST['d']['bill_no'];
		$data['client_id'] 				= $_POST['d']['client_id'];
		$data['book_id'] 				= $_POST['d']['booking_no'];
		$data['quantity'] 				= $quantity;
		$data['recipient'] 				= $recipient;
		$data['shipper'] 				= $shipper;
		$data['amount'] 				= $amount;
		// pdie($data);

		if($this->db->insert("bill_of_lading",$data)){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function update($id){
		

		$shipper 	= json_decode($_POST['shipper_information'], TRUE)['shipper_name'];
		$recipient 	= json_decode($_POST['recipient_information'], TRUE)['recipient_name'];
		$quantity 	= json_decode($_POST['package_content'], TRUE)['total_package'];
		$amount 	= json_decode($_POST['additional_charges'], TRUE)['total_amount_due'];

		$data['shipper_information'] 	= $_POST['shipper_information'];
		$data['package_content'] 		= $_POST['package_content'];
		$data['charges'] 				= $_POST['charges'];
		$data['additional_charges'] 	= $_POST['additional_charges'];
		$data['recipient_information'] 	= $_POST['recipient_information'];
		$data['others'] 				= $_POST['others'];
		$data['quantity'] 				= $quantity;
		$data['recipient'] 				= $recipient;
		$data['shipper'] 				= $shipper;
		$data['amount'] 				= $amount;
		// pdie($data);

		if($this->db->update("bill_of_lading",$data,"id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}


	
}






?>