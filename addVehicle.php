<?php
error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
session_start();
date_default_timezone_set("Asia/Manila");

require_once("db_connect.php");


/**
* 
*/
class VehicleClass extends Database
{
	public $vno;
	public $vdesc;
	public $pno;
	public $vtype;
	public $stats;
	public $conn;
	public $action;
	public $svno;
	public $spno;
	public $stype;
	public $sstats;
	public $upvno;
	public $upvdesc;
	public $uppno;
	public $upvtype;
	public $upstats;
	
	function __construct()
	{
		parent::__construct();
		$this->populateData();
		$this->conn = $this->_connection;
	}


	public function populateData(){	

		// FOR INSERT
		$this->vno 		= $_POST['vno'];
		$this->vdesc 	= $_POST['vdesc'];
		$this->pno 		= $_POST['pno'];
		$this->vtype 	= $_POST['vtype'];
		$this->stats    = $_POST['stats'];

		// FOR SEARCH
		$this->svno 	= $_POST['svno'];
		$this->spno 	= $_POST['spno'];
		$this->stype 	= $_POST['stype'];
		$this->sstats   = $_POST['sstats'];

		// FOR UPDATE
		$this->upvno 	= $_POST['upvno'];
		$this->upvdesc 	= $_POST['upvdesc'];
		$this->uppno 	= $_POST['uppno'];
		$this->upvtype 	= $_POST['upvtype'];
		$this->upstats  = $_POST['upstats'];


		$this->action   = $_POST['action'];



	}

	public function Insert_Query(){

		$query = $this->conn->prepare("INSERT INTO `Vehicle`(`vehicle_no`,`vehicle_desc`,`plate_no`,`type`,`status`) VALUES (?,?,?,?,?)");
		$query->bind_param('sssss',$this->vno,$this->vdesc,$this->pno,$this->vtype,$this->stats);
		$query->execute();

		if ($query) {
			return "Vehicle successfully saved.";
		}
		$query->close();

	}

	public function getQuery(){

		$query = "SELECT `id`,`vehicle_no`,`vehicle_desc`,`type`,`plate_no`,`status` FROM Vehicle WHERE `id` IS NOT NULL ";
		if (!empty($this->svno)) {
			$query .="AND `vehicle_no`='".$this->svno."' ";
		}
		if(!empty($this->spno)){
			$query .="AND `plate_no`= '".$this->spno."' "; 
		}
		if(!empty($this->stype)){
			$query .="AND `type`= '".$this->stype."' ";
		}
		if(!empty($this->sstats)){
			$query .="AND `status`= '".$this->sstats."' ";
		}

		$do_query = $this->conn->prepare($query);
		$do_query->execute();
		
		$do_query->bind_result($id,$vno,$vdesc,$type,$pno,$stats);
		$data_array = array();
		//if ($do_query->num_rows >0) {
			
		while ($do_query->fetch()) {
			$data_array[$id]['id'] = $id;
			$data_array[$id]['vno'] = $vno;
			$data_array[$id]['vdesc'] = $vdesc;
			$data_array[$id]['type'] = $type;
			$data_array[$id]['pno'] = $pno;
			$data_array[$id]['stats'] = $stats;
		}
	//}
		return $data_array;
	}

	public function Update_Query(){

	}


	public function doQuery(){
		if ($this->action == "INSERT_DATA") {
			$this->Insert_Query();
		}else if ($this->action == "SEARCH"){
			return $this->getQuery();
		}else if ($this->action == "UPDATE_DATA"){
			
		}
	}
}


$VehicleClass = new VehicleClass();
echo json_encode($VehicleClass->doQuery());

?>