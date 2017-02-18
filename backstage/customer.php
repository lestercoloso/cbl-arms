<?php

class Customer{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}


	public function getcustomercode(){
		$select = $this->db->select_one('select max(customer_code) as newnumber from customer_information where status=1 limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,10,"0",STR_PAD_LEFT));
	}

	public function getcustomername(){
		$select = $this->db->select('select id, customer_name from customer_information where status=1' );
		jdie($select);
	}


	public function customerlist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";		
		
		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		if(!empty($searchdata)){
			$likedata['customer_name'] = $searchdata['customer_name'];	
			unset($searchdata['customer_name']);	
			$this->db->where_like($likedata);	
		}


		$this->db->where_search(['status'=>1]);
		
		
		$where = $this->db->where_search($searchdata);
		$sql = "select id, LPAD(`customer_code`, 10, '0') as customer_code, customer_name, industry_type, area_1, region, payment_terms, '0' as aging, credit_limit, '0.00' as outstanding_balance, '0.00' as amount_due from  customer_information $where $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from customer_information $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);
	}

	public function save(){
		$data = $_POST['d'];
		$contact = !empty($_POST['contact']) ? $_POST['contact'] : [];
		$address = !empty($_POST['address']) ? $_POST['address'] : [];



		$data['company_anniversary'] = date('Y-m-d', strtotime($data['company_anniversary']));
		$return['status'] = 100;
		if($this->db->insert("customer_information",$data)){
			// die($this->db->insert_id());
			$return['status'] = 200;
		}
		jdie($return);
	}





	
}






?>