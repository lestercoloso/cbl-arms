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

	public function information($id=''){
		$id = explode('-', $id);
		$result['customer'] = $this->db->select_one('select * from customer_information where id='.$id['1'].' and status=1' );
		$result['customer']['customer_code'] = str_pad($result['customer']['customer_code'],10,"0",STR_PAD_LEFT);
		$result['customer']['company_anniversary'] = date('m/d/Y', strtotime($result['customer']['company_anniversary']));
		$result['contact'] = $this->db->select('select DATE_FORMAT(`birth_date`,\'%m/%d/%Y\') as birth_date, contact_no, department, designation, email, first_name, last_name, middle_initial, mobile_no  from customer_contact where customer_id='.$id['1'].' and status=1' )['data'];
		$result['address'] = $this->db->select('select address, area, city, region, address_type  from customer_address where customer_id='.$id['1'].' and status=1' )['data'];
		jdie($result);
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
			$insert_id = $this->db->insert_id();

			foreach($contact as $c){
				$c['customer_id'] = $insert_id;
				$c['birth_date']  = date('Y-m-d', strtotime($c['birth_date']));
				$this->db->insert("customer_contact",$c);
			}

			foreach($address as $a){
				$a['customer_id'] = $insert_id;
				$this->db->insert("customer_address",$a);
			}

			$return['status'] = 200;
		}
		jdie($return);
	}

	public function update($id){
		$data = $_POST['d'];
		$contact = !empty($_POST['contact']) ? $_POST['contact'] : [];
		$address = !empty($_POST['address']) ? $_POST['address'] : [];

		$data['company_anniversary'] = date('Y-m-d', strtotime($data['company_anniversary']));
		unset($data['company_code']);
		
		$return['status'] = 100;
		if($this->db->update("customer_information",$data, 'id='.$id)){
			// $this->db->last_query();
			$this->db->CheckResult("delete from customer_contact where customer_id=$id" );
			foreach($contact as $c){
				$c['customer_id'] = $id;
				$c['birth_date']  = date('Y-m-d', strtotime($c['birth_date']));
				$this->db->insert("customer_contact",$c);
			}
			$this->db->CheckResult("delete from customer_address where customer_id=$id" );
			foreach($address as $a){
				$a['customer_id'] = $id;
				$this->db->insert("customer_address",$a);
			}

			$return['status'] = 200;
		}
		jdie($return);


	}
	public function delete($id){

		if($this->db->delete("customer_information", "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}




	
}






?>