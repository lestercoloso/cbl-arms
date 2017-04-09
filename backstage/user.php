<?php

class User{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}



	public function getcustomername(){
		$select = $this->db->select('select id, customer_name from customer_information where status=1' );
		jdie($select);
	}

	public function getUserList($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";		
		
		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		if(!empty($searchdata)){

			$this->db->where_like(['LPAD(`booking_no`, 10, \'0\')'=>$searchdata['booking_no']]);
			$this->db->where_like(['contact_person'=>$searchdata['contact_person']]);
			$this->db->where_like(['customer_name'=>$searchdata['customer_name']]);
			$this->db->where_search(['mode_of_shipping'=>$searchdata['mode_of_shipping']]);
			$this->db->where_search(['booking_status'=>$searchdata['booking_status']]);

			$datefrom = !empty($searchdata['date_from']) ? date('Y-m-d', strtotime($searchdata['date_from'])).' 00:00:00' : '';
			$dateto = !empty($searchdata['date_to']) ? date('Y-m-d', strtotime($searchdata['date_to'])).' 00:00:00' : '';

			$this->db->where_search(['created_date>'=>$datefrom]);
			$this->db->where_search(['created_date<'=>$dateto]);

		}
		
		$where = $this->db->where_search('a.id=b.key_value');


		$sql = "select a.id, a.username, DATE_FORMAT(a.`last_login`,'%a %b %d, %Y %h:%i:%s%p') as last_login , b.fname, b.mname, b.lname, b.email, b.mobile, a.user_type, a.status  from user_account a, user_profiles b
			 $where $additional";
		$data = $this->db->select($sql);	


		$datatotal = $this->db->select_one("select count(a.id) as total from user_account a, user_profiles b $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);


	}


	public function myaccount_update(){
		$return['status'] = 199;
		session_start();
		$key_value = $_SESSION['key_value'];
		$data = $_POST['d'];
		if($this->db->update('user_profiles', $data, "key_value='$key_value'")){
			
			$_SESSION['accfname'] = $data['fname'];
			$_SESSION['accmname'] = $data['mname'];
			$_SESSION['acclname'] = $data['lname'];
			$_SESSION['accmobile'] = $data['mobile'];
			$_SESSION['accemail'] = $data['email'];

			$return['status'] = 200;
		}
		jdie($return);
	}

	public function myaccount_changepassword(){
		$return['status'] = 199;
		session_start();
		$key_value = $_SESSION['key_value'];
		$data = $_POST['d'];

		$selectuser = $this->db->select_one("select password from user_account where id=$key_value" );
		if($selectuser['password']==md5($data['password'])){
			if($this->db->update('user_account', ['password'=>md5($data['npassword'])], "id=$key_value")){
				$return['status'] = 200;
			}else{
				$return['status'] = 101;
				$return['message'] = "Database error!.";	
			}

		}else{
			$return['status'] = 100;
			$return['message'] = "Incorrect current password.";
		}

		jdie($return);
		
	}

	
	
}






?>