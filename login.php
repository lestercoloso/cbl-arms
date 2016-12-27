<?php

require_once("db_connect.php");
error_reporting("E_ALL");
error_reporting( E_ERROR );

ini_set( 'display_errors' , 'On' );
session_start();
date_default_timezone_set("Asia/Manila");
class Login {

	public  $usrname;
	public  $usrpass;
	public 	$valRet;
	public  $name;
	public  $statPos;
	public  $connection;


	public function __construct(){
		
			$this->populateData();

	}


	public function populateData(){

			if (isset($_POST['usr']) && isset($_POST['pss'])) {
				$this->usrname= $_POST['usr'];
				$this->usrpass= $_POST['pss'];
			}
	}

	public function validateData(){

			$this->usrpass = md5($this->usrpass);
			$this->connection = new MySQLi("localhost", "root", "121586", "cblarms");
			$this->valRet= array();
			
			//validate user and password and  then Get USER PROFILE + Save on Session.

			$sql = "SELECT * FROM user_account WHERE username='{$this->usrname}'";
			$result = $this->connection->query($sql);
			$row=$result->num_rows;
			if ($row==FALSE) {
							$this->valRet['feedback'] 	= "User Account does not exist.";
							$this->valRet['feedstatus'] = "0";
			}else{

				$sql = "SELECT * FROM user_account WHERE password='{$this->usrpass}'";
				$result = $this->connection->query($sql);
				$row=$result->num_rows;

				if ($row==FALSE) {

							$this->valRet['feedback'] 	= "The Password you entered was incorrect";
							$this->valRet['feedstatus'] = "1";
				}else{

			$sql 			= "SELECT * from `user_profiles` WHERE `key_value`=(SELECT `id` FROM `user_account` WHERE `username`='{$this->usrname}' AND `password`='{$this->usrpass}' AND `status`=1) AND `status`=1";
			$result 	= $this->connection->query($sql);
			$row			= $result->num_rows;
			
					if($row == FALSE){

							$this->valRet['feedback'] 	= "Invalid username or password.";
							$this->valRet['feedstatus'] = "3";
					}else{
							
							//GET DATAS
									$data = $result->fetch_assoc();
									$this->name 	= $data['fname']." ". $data['mname']." ". $data['lname'];
									$this->statPos 	= $data['user_type'];
									$this->key_value 	= $data['key_value'];

							//SET SESSION 
									$_SESSION['profilename']	= $this->name;
									$_SESSION['profilestats']	= $this->statPos;
									$_SESSION['accusrname']		= $this->usrname;
									$_SESSION['key_value']		= $this->key_value;
									$_SESSION['accfname']		= $data['fname'];
									$_SESSION['accmname']		= $data['mname'];
									$_SESSION['acclname']		= $data['lname'];
									$_SESSION['accmobile']		= $data['mobile'];
									$_SESSION['accemail']		= $data['email'];

							//RETURN VALUE
									$date_this = date("Y-m-d H:i:s");
									$this->valRet['feeback'] 	= "Success";
									$this->valRet['feedstatus'] = "2";
									$sql = " UPDATE `user_account` SET `last_login`='{$date_this}' WHERE `id`='{$this->key_value}'";
									$result 	= $this->connection->query($sql);

					}}}

			return $this->valRet;

	}
 
	public function returnVal(){

		//return "Hello!";

	}
}

 $login = new Login();
 echo json_encode($login->validateData());
