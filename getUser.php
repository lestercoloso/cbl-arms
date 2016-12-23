<?php


error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Manila');


require_once('db_connect.php');


class GetUser extends Database{

	public $utype;
	public $logid;
	public $uname;
	public $result;
	public $add_sql;
	public $page;
	public $max =20;
	public $start;

	public function __construct(){

			parent::__construct();
			$this->populateData();
	}


	public function populateData(){

			if (isset($_POST['utype']) || isset($_POST['logid']) || isset($_POST['uname'])) {
				
				$this->utype = $_POST['utype'];
				$this->logid = $_POST['logid'];
				$this->uname = $_POST['uname'];
				$this->page = $_POST['page'];
			}

	}


	public function searchNormal($column,$variable){

			
			if ($variable !='') {
				$this->result = " AND `".$column."`='".$variable."'";
				
			}else{
				$this->result =' ';
			}

			return $this->result;
	}

	public function searchLike($column,$variable){

			
			if ($variable !='') {
				$this->result = " AND `".$column."`LIKE '%".$variable."%'";
				
			}else{
				$this->result =' ';
			}

			return $this->result;
	}

	public function searchType($column,$variable){

			if ($variable !='') {
				$this->result = " AND `".$column."`='".$variable."'";
			}else{
				$this->result ='';
			}

			return $this->result;
	}


	public function createSql(){

			$this->add_sql=' ';
			$this->add_sql .= $this->searchNormal('username',$this->logid);
			$this->add_sql .= $this->searchLike('name',$this->uname);
			$this->add_sql .= $this->searchType('user_type',$this->utype);

			return $this->add_sql;

	}


	public function doQuery(){

		$add_this2='';
		if($this->page){
			$this->start = ((int)$this->page-1) * (int)$this->max;
			$this->max= (int)$this->max;

			$add_this2 = " LIMIT ".$this->start ." , ".$this->max ." ";


		}
		$add_this = $this->createSql();
		$mysqli   = $this->_connection;
		$query    = "SELECT * FROM user_account WHERE `status`=1 ".$add_this. " ".$add_this2;
		$result   = $mysqli->query($query);
		$result_count = $result->num_rows;
		$lastpage = ceil($result_count / $this->max);

		$data_array = array();
		$id = '';

		while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
				$id  = $row['id'];
				$data_array[$row['id']]['totalrows']= $result_count;
				$data_array[$row['id']]['lastpage']= $lastpage;
				$data_array[$row['id']]['id']= $row['id'];
				$data_array[$row['id']]['uname']= $row['name'];
				$data_array[$row['id']]['logid']= $row['username'];
				$data_array[$row['id']]['utype']= $row['user_type'];
				if (!isset($row['last_login'])) {
					$data_array[$row['id']]['last_login']= "N/A (no login yet).";
				}else{
				$data_array[$row['id']]['last_login']= date(" l F d, Y  h:i:sa",strtotime($row['last_login']));
			}
				$query1    = "SELECT * FROM user_profiles WHERE `key_value`='{$id}'";
				$result1   = $mysqli->query($query1);

				while ($row1=$result1->fetch_array(MYSQLI_ASSOC)) {

				$data_array[$id]['fname']	= $row1['fname'];
				$data_array[$id]['mname']	= $row1['mname'];
				$data_array[$id]['lname']	= $row1['lname'];
				$data_array[$id]['mobile']	= $row1['mobile'];
				$data_array[$id]['email']	= $row1['email'];
				$data_array[$id]['dept']	= $row1['dept'];
				$data_array[$id]['position']	= $row1['position'];
				}

		}



		return $data_array;

	}




}

$GetUser = new GetUser();
echo json_encode($GetUser->doQuery());