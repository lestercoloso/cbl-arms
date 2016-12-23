<?php

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Manila');


require_once('db_connect.php');

class Add_Driver extends Database{



	public $code;
	public $name;
	public $birth;
	public $age;
	public $address;
	public $type;
	public $conn;
	public $status;

	public function __construct(){

			parent::__construct();
			$this->populateData();
			
	}

	public function populateData(){

		if (isset($_POST['code'])) {
			
			$this->code = $_POST['code'];
			$this->name = $_POST['name'];
			$this->birth = date("Y-m-d",strtotime($_POST['birth']));
			$this->age = $_POST['age'];
			$this->address = $_POST['address'];
			$this->type = $_POST['type'];
		}
	}



	public function doQuery(){

		$this->status = '1';
		$this->conn = $this->_connection;
		$query = $this->conn->prepare("INSERT INTO driver_profile(code,name,birthday,age,address,vehicle_type,status) VALUES(?,?,?,?,?,?,?)");
		$query->bind_param('ssssssi',$this->code,$this->name,$this->birth,$this->age,$this->address,$this->type,$this->status);
		$query->execute();

		if ($query) {
			return "Success";
		}
		$query->close();
	}
}


$addDriver = new Add_Driver();
echo $addDriver->doQuery();