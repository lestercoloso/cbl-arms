<?php

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);

date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');

class AddUser extends Database{

	public $logid;
	public $date;
	public $stats;
	public $fname;
	public $mname;
	public $lname;
	public $mobile;
	public $email;
	public $dept;
	public $utype;
	public $position;
	public $pass;
	public $cpass;
	public $_conn;
	public $uniq;
	public $access;
	public $username;
	public $subAccess;


	public function __construct(){

			parent::__construct();
			$this->populateData();
			$this->_conn = $this->_connection;
	}



	public function populateData(){
		if (isset($_POST['logid'])) {
			
			$this->logid = $_POST['logid'];
			$this->fname = $_POST['fname'];
			$this->mname = $_POST['mname'];
			$this->lname = $_POST['lname'];
			$this->mobile= $_POST['mobile'];
			$this->email = $_POST['email'];
			$this->dept  = $_POST['dept'];
			$this->utype = $_POST['utype'];
			$this->position= $_POST['position'];
			$this->pass  = $_POST['pass'];
			$this->cpass = $_POST['cpass']; 


		}
	}

	public function InsertMainAccess(){

		

		if ($this->utype=="System Administrator") {
			$this->access = "1,1,1,1,1,1,1,1,1,1";
		}else{
			$this->access = "0,1,1,1,1,1,1,1,1,1";
		}

		$query = $this->_conn->prepare("INSERT INTO `user_module`(`user_id`,`main_module`) VALUES (?,?)");
		$query->bind_param('ss',$this->uniq,$this->access);
		$query->execute();
		$query->close();

		return $query;
	}


	public function InsertSubAccess(){

		$string_access = explode(',', $this->access);
		$cnt = 1;
		$module = "";
		$query="";

		foreach ($string_access as $key => $value) {
			$module = "submodule_";	
			switch ($cnt) {

				case '1':

					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0,0,0";
					}
					break;

				case '2':

					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
					}
					break;

				case '3':

					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0";
					}
					break;

				case '4':

					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0,0";
					}
					break;

				case '5':

					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
					}
					break;

				case '6':
					
					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0,0,0,0,0";
					}
					break;

				case '7':
					
					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0,0";
					}
					break;

				case '8':
					
					if ($value==1) {
						$this->subAccess = "1,1,1";
					}else{
						$this->subAccess = "0,0,0";
					}
					break;

				case '9':
					
					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0,0";
					}
					break;

				case '10':
					
					if ($value==1) {
						$this->subAccess = "1,1,1,1,1,1";
					}else{
						$this->subAccess = "0,0,0,0,0,0";
					}
					break;
			
			}

		$sql = "UPDATE `user_module` SET `".$module.$cnt."`=? WHERE `user_id`=?";

		$query = $this->_conn->prepare($sql);
		$query->bind_param('ss',$this->subAccess,$this->uniq);
		$query->execute();
		$query->close();


		$cnt++;
		}
		return $query;
	}

	public function InsertData(){

		$this->date = date("Y-m-d h:i:sa");
		$this->stats = 1;
		$this->uniq = uniqid();
		
		$query = $this->_conn->prepare("INSERT INTO `user_profiles`(`key_value`,
			`fname`,
			`mname`,
			`lname`,
			`mobile`,
			`email`,
			`user_type`,
			`dept`,
			`position`,
			`date_cretated`,
			`status`) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		$query->bind_param('ssssssssssi',$this->uniq,$this->fname,$this->mname,$this->lname,$this->mobile,$this->email,$this->utype,$this->dept,$this->position,$this->date,$this->stats);
		$query->execute();
		$this->username= $this->lname." ".$this->mname. " ". $this->fname;
		$query2 = $this->_conn->prepare("INSERT INTO `user_account` (`id`,`name`,`username`,`password`,`datecreated`,`status`,`user_type`) VALUES(?,?,?,?,?,?,?)");
		$query2->bind_param('sssssis',$this->uniq,$this->username,$this->logid,md5($this->pass),$this->date,$this->stats,$this->utype);
		$query2->execute();


		
		if (($query==true) && ($query2==true)) {

			
			$this->InsertMainAccess();
			$this->InsertSubAccess();
			return "Added New User Successfully.";
		}else{
			return $query->error." ". $query2->error;
		}
		$query2->close();
		$query->close();
	}


}


$AddUser = new AddUser();
echo $AddUser->InsertData();