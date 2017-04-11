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

			$this->db->where_like(['a.username'=>$searchdata['username']]);
			$this->db->where_like(['concat(b.`lname`, \', \', b.`fname`, \' \', b.`mname`)'=>$searchdata['name']]);

			$this->db->where_search(['a.user_type'=>$searchdata['user_type']]);
			$this->db->where_search(['a.status'=>$searchdata['status']]);

			$datefrom = !empty($searchdata['date_from']) ? date('Y-m-d', strtotime($searchdata['date_from'])) : '';
			$dateto = !empty($searchdata['date_to']) ? date('Y-m-d', strtotime($searchdata['date_to'])) : '';

			$this->db->where_search(['a.datecreated>'=>$datefrom]);
			$this->db->where_search(['a.datecreated<'=>$dateto]);

		}
		session_start();
		$key_value = $_SESSION['key_value'];

		$this->db->where_search('a.id=b.key_value');
		$where = $this->db->where_search('a.id!='.$key_value);


		$sql = "select a.id, a.username, DATE_FORMAT(a.`last_login`,'%a %b %d, %Y %h:%i:%s%p') as last_login , b.fname, b.mname, b.lname, b.email, b.mobile, a.user_type, b.dept, b.position, a.status  from user_account a, user_profiles b
			 $where $additional";

			 // die($sql);
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


	public function save(){
		$user_profiles	= $_POST['user_profiles'];
		$user_account	= $_POST['user_account'];
		$user_account['password'] = md5($user_account['password']);
		$return['status'] = 100;		
		if($this->is_userexist($user_account['username'])){
			$return['status'] 		= 11;
			$return['message'] 		= 'Username already exist.';
			$return['error_col'] 	= 'create_username_container';
		}else{
			if($this->db->insert("user_account",$user_account)){
				$insert_id = $this->db->insert_id();
				$user_profiles['key_value'] = $insert_id;
				$this->db->insert("user_profiles",$user_profiles);
				$return['status'] = 200;
			}
		}
		jdie($return);

	}

	public function update($id=''){
		$user_profiles	= $_POST['d'];
		$user_account	=['user_type' => $user_profiles['user_type']];
		unset($user_profiles['user_type']);
		if($this->db->update("user_profiles",$user_profiles, "key_value=$id")){

			$this->db->update("user_account",$user_account, "id=$id");
			// $this->db->last_query();
			$return['status'] = 200;
		}
		
		jdie($return);

	}

	public function activate($id='', $action=0){
		$return['status'] = 100;
		if($this->db->update("user_account",['status'=>$action], "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}

	private function is_userexist($user_name=''){
		$sql = "select id from user_account where username='$user_name' limit 1";
		$return = $this->db->select($sql);
		return $return['count'];
	}


	
	
}






?>