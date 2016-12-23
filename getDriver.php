<?php

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Manila');


require_once('db_connect.php');

class Get_Driver extends Database{

	public $conn;
	public $code;
	public $name;
	public $type;
	public $result;
	public $sql;


	public function __construct(){

		parent::__construct();
		$this->populateData();
		$this->conn = $this->_connection;

	} 


	public function populateData(){

		if (isset($_POST['name'])||isset($_POST['type'])||isset($_POST['code'])) {
			
					$this->code = $_POST['code'];
					$this->name = $_POST['name'];
					$this->type = $_POST['type'];

		}


	}

	public function searchLike($column,$value){

		if ($value !='') {
			$this->result = " AND ".$column." LIKE '%".$value."%'";
		}else{
			$this->result = ' ';
		}
		return $this->result;
	}


	public function searchNormal($column,$value){

		if ($value !='') {
			$this->result = " AND ".$column."='".$value."'";
		}else{
			$this->result = ' ';
		}
		return $this->result;
	}

	public function createQuery(){

		$this->sql = '';
		$this->sql .= $this->searchLike("name",$this->name);
		$this->sql .= $this->searchNormal("code",$this->code);
		$this->sql .= $this->searchNormal("vehicle_type",$this->type);

		return $this->sql;

	}


	public function InsertData(){

		$add_sql = $this->createQuery();
		$query = "SELECT * FROM `driver_profile` WHERE `status`=1 ".$add_sql;
		$result = $this->conn->query($query);

		$data_array = array();
		
		while ($myrow = $result->fetch_array(MYSQLI_ASSOC)) {
			$data_array[$myrow['id']]['id'] = $myrow['id'];
			$data_array[$myrow['id']]['code'] = $myrow['code'];
			$data_array[$myrow['id']]['name'] = $myrow['name'];
			$data_array[$myrow['id']]['type'] = $myrow['vehicle_type'];
			$data_array[$myrow['id']]['birth'] = $myrow['birthday'];
			$data_array[$myrow['id']]['age'] = $myrow['age'];
			$data_array[$myrow['id']]['address'] = $myrow['address'];

		}

		return $data_array;

	}
}

$getDriver = new Get_Driver();
echo json_encode($getDriver->InsertData());