<?php

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Manila');


require_once('db_connect.php');



class SelectInbound extends Database {

	public $results;
	public $customer;
	public $blading;
	public $receipt;
	public $pallet;
	public $quantity;
	public $desc;
	public $storage;
	public $inventory;
	public $exdatefrom;
	public $exdateto;
	public $endatefrom;
	public $endateto;
	public $pickdatefrom;
	public $pickdateto;
	public $max;
	public $page;
	public $sql_add;
	public $start;
	public $status;


	public function __construct(){

			parent::__construct();
			$this->populateData();
	}


	public function populateData(){

		if (isset($_POST['customer'])|| 
			isset($_POST['blading'])|| 
			isset($_POST['receipt'])|| 
			isset($_POST['pallet'])|| 
			isset($_POST['quantity'])|| 
			isset($_POST['desc'])|| 
			isset($_POST['storage'])|| 
			isset($_POST['inventory'])|| 
			isset($_POST['exdatefrom'])|| 
			isset($_POST['exdateto'])|| 
			isset($_POST['endatefrom'])||
			isset($_POST['endateto'])||
			isset($_POST['max'])||
			isset($_POST['page'])||
			isset($_POST['pickdatefrom'])|| 
			isset($_POST['pickdateto'])) {
			
				$this->customer = $_POST['customer'];
				$this->blading	= $_POST['blading'];
				$this->receipt  = $_POST['receipt'];
				$this->pallet   = $_POST['pallet'];
				$this->quantity = $_POST['quantity'];
				$this->desc     = $_POST['desc'];
				$this->storage  = $_POST['storage'];
				$this->inventory= $_POST['inventory'];
				$this->exdatefrom 	= $_POST['exdatefrom'] ? date("Y-m-d",strtotime($_POST['exdatefrom'])) : '';
				$this->exdateto 	= $_POST['exdateto'] ? date("Y-m-d",strtotime($_POST['exdateto'])) : '';
				$this->endatefrom   = $_POST['endatefrom'] ? date("Y-m-d",strtotime($_POST['endatefrom'])) : '';
				$this->endateto   	= $_POST['endateto'] ? date("Y-m-d",strtotime($_POST['endateto'])) : '';
				$this->pickdatefrom = $_POST['pickdatefrom'] ? date("Y-m-d",strtotime($_POST['pickdatefrom'])) : '';
				$this->pickdateto 	= $_POST['pickdateto'] ? date("Y-m-d",strtotime($_POST['pickdateto'])) : '';
				$this->max 			= $_POST['max'];
				$this->page 		= $_POST['page'];
				$this->status 		= $_POST['status'];



		}
	}


	public function searchCustomer($column,$variable){

			if ($variable !='') {
				$this->results = " `" . $column . "`='" . $variable . "'";
			}else{
				$this->results='';
			}

		return $this->results;
	}

	public function searchNormal($column,$variable){

			if($variable !=''){
				$this->results = " AND `" . $column . "`= '" . $variable . "'";
			}else{
				$this->results='';
			}
		return $this->results;	
	}

	public function searchDates($column,$value_from,$value_to){

			if($value_from != "" && $value_to != "")
			{
				$this->results = " AND (DATE(" . $column . ") <= '" . $value_to . "' AND DATE(" . $column . ") >= '" . $value_from . "')"; 
			}
			elseif($value_from == "" && $value_to != "")
			{
				$this->results = " AND (DATE(" . $column . ") <= '" . $value_to . "')"; 
			}
			elseif($value_from != "" && $value_to == "")
			{
				$this->results = " AND (DATE(" . $column . ") >= '" . $value_from . "')"; 
			}
			else
			{
				$this->results = "";
			}
		return $this->results;



	}

	public function add_sql(){

			$compose;
			$compose  = $this->searchCustomer("client",$this->customer);
			$compose .= $this->searchNormal("bill_of_blading",$this->blading);
			$compose .= $this->searchNormal("delivery_receipt",$this->receipt);
			$compose .= $this->searchNormal("pallet_code",$this->pallet);
			$compose .= $this->searchNormal("storage_type",$this->storage);
			$compose .= $this->searchNormal("inventory_type",$this->inventory);
			$compose .= $this->searchDates("expiration_date",$this->exdatefrom,$this->exdateto);
			$compose .= $this->searchDates("entry_date",$this->endatefrom,$this->endateto);
			$compose .= $this->searchDates("pick_date",$this->pickdatefrom,$this->pickdateto);

			return $compose;

	}


	public function createQuery(){

		$add_this = $this->add_sql();
		if ($add_this) {
			$add_this =" WHERE status='".$this->status . "' ". $this->add_sql();
		}else{
			$add_this =" WHERE status='".$this->status . "'";
		}
		$data_array=array();
		$mysqli = $this->_connection;

		$add_this2='';
		if($this->page){
			$this->start = ((int)$this->page-1) * (int)$this->max;
			$this->max= (int)$this->max;

			$add_this2 = " LIMIT ".$this->start ." , ".$this->max ." ";


		}


		$query1 = "SELECT * FROM inbound ".$add_this2;
		$result1 = $mysqli->query($query1);
		$result_count1 = $result1->num_rows;

		

		$query = "SELECT * FROM inbound " . $add_this . " ".$add_this2;
		$result = $mysqli->query($query);
		$result_count = $result->num_rows;
		$lastpage = ceil($result_count / $this->max);
  			$data_array['inboundrows']= $result_count1;
  			$data_array['totalrows']= $result_count;
  			$data_array['last_page']= $lastpage;
    		

    		while ($myrow = $result->fetch_array(MYSQLI_ASSOC)) {
    			$data_array[$myrow['id']]['id']= $myrow['id'];
    			$data_array[$myrow['id']]['client']= $myrow['client'];
    			$data_array[$myrow['id']]['blading']= $myrow['bill_of_blading'];
    			$data_array[$myrow['id']]['receipt']= $myrow['delivery_receipt'];
    			$data_array[$myrow['id']]['pallet']= $myrow['pallet_code'];	
    			$data_array[$myrow['id']]['quantity']= $myrow['quantity'];
    			$data_array[$myrow['id']]['desc']= $myrow['description'];
    			$data_array[$myrow['id']]['storage']= $myrow['storage_type'];
    			$data_array[$myrow['id']]['inventory']= $myrow['inventory_type'];
    			$data_array[$myrow['id']]['expiration']=  date("Y-m-d",strtotime($myrow['expiration_date']));
    			$data_array[$myrow['id']]['pick']=  date("Y-m-d",strtotime($myrow['pick_date']));
    			$data_array[$myrow['id']]['entry']=  date("Y-m-d",strtotime($myrow['entry_date']));
    			$data_array[$myrow['id']]['stats']=  $myrow['status'];
    		}
    		return $data_array;
	}






//end

}

$SelectInbound = new SelectInbound();
echo json_encode($SelectInbound->createQuery());

?>