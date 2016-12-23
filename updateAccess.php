<?php

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Manila');


require_once('db_connect.php');


class UpdateAccess extends Database{


	public $id;
	public $logid;
	public $fname;
	public $mname;
	public $lname;
	public $type;
	public $pos;
	public $dept;
	public $pass1;
	public $_conn;
	public $mobile;
	public $pass2;
	public $email;
	public $name;
	public $def;


	public function __construct(){

		parent::__construct();
		$this->_conn = $this->_connection;
		$this->populateData();
	}

	public function populateData(){


		if (isset($_POST['def'])) {
			$this->id 	 = $_POST['id'];
			$this->logid = $_POST['login'];
			$this->email = $_POST['email'];
			$this->mobile = $_POST['mobile'];
			$this->fname = $_POST['fname'];
			$this->mname = $_POST['mname'];
			$this->lname = $_POST['lname'];
			$this->type  = $_POST['type'];
			$this->pos   = $_POST['pos'];
			$this->dept  = $_POST['dept'];
			$this->pass1 = md5($_POST['pass1']);
			$this->pass2 = $_POST['pass2'];

		}

		$this->def = $_POST['def'];
	}


	public function doQuery(){

		

		$query = $this->_conn->prepare("UPDATE user_profiles SET fname=?,email=?,mobile=?,mname=?,lname=?,user_type=?,position=?,dept=? WHERE key_value=?");
		$query->bind_param('sssssssss',$this->fname,$this->email,$this->mobile,$this->mname,$this->lname,$this->type,$this->pos,$this->dept,$this->id);
		$query->execute();
		
		$this->name= $this->lname.', '.$this->fname.' '.$this->mname;
		$query = $this->_conn->prepare("UPDATE user_account SET name=?,username=?,user_type=? WHERE id=?");
		$query->bind_param('ssss',$this->name,$this->logid,$this->type,$this->id);
		$query->execute();

		
		if ($query==true) {
			return "Success";
		}else{
			return $query->error();
		}
		$query->close();
	}

	public function do_Query_pass(){


		if (isset($this->pass1) && $this->pass1 !='') {
			$query = $this->_conn->prepare("UPDATE user_account SET password=? WHERE id=?");
			$query->bind_param('ss',$this->pass1,$this->id);
			$query->execute();
		}
		
		if ($query==true) {
			return "Success";
		}else{
			return $query->error();
		}
		$query->close();


	}

	public function select_Query(){

		if ($this->def == 0) {

			return $this->do_Query_pass();

		}else if($this->def==1){

			return $this->doQuery();
		}

	}
	
}


$edit = new UpdateAccess();
echo $edit->select_Query();