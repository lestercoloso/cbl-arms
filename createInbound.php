<?php
error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);

date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');



class createInbound extends Database{

	public $customer;
	public $blading;
	public $receipt;
	public $pallet;
	public $quantity;
	public $desc;
	public $storage;
	public $inventory;
	public $exdate;
	public $endate;
	public $pickdate;
	public $datecreated;



	public function __construct(){

			parent::__construct();
			$this->populateData();
	}


	public function populateData(){

		if (isset($_POST['customer'])&& 
			isset($_POST['blading'])&& 
			isset($_POST['receipt'])&& 
			isset($_POST['pallet'])&& 
			isset($_POST['quantity'])&& 
			isset($_POST['desc'])&& 
			isset($_POST['storage'])&& 
			isset($_POST['inventory'])&& 
			isset($_POST['exdate'])&& 
			isset($_POST['endate'])&& 
			isset($_POST['pickdate'])) {
			
				$this->customer = $_POST['customer'];
				$this->blading	= $_POST['blading'];
				$this->receipt  = $_POST['receipt'];
				$this->pallet   = $_POST['pallet'];
				$this->quantity = $_POST['quantity'];
				$this->desc     = $_POST['desc'];
				$this->storage  = $_POST['storage'];
				$this->inventory= $_POST['inventory'];
				$this->exdate 	= date("Y-m-d",strtotime($_POST['exdate']));
				$this->endate   = date("Y-m-d",strtotime($_POST['endate']));
				$this->pickdate = date("Y-m-d",strtotime($_POST['pickdate']));
				$this->datecreated = date("Y-m-d ");


		}
	}


		public function insertDatas(){

			 $mysqli = $this->_connection;
			 $query  = "INSERT INTO inbound (`client`,`bill_of_blading`,`delivery_receipt`,`pallet_code`,`quantity`,`description`,`storage_type`,`inventory_type`,`expiration_date`,`entry_date`,`pick_date`,`status`,`datecreated`) VALUES('{$this->customer}','{$this->blading}','{$this->receipt}','{$this->pallet}','{$this->quantity}','{$this->desc}','{$this->storage}','{$this->inventory}','{$this->exdate}','{$this->endate}','{$this->pickdate}','1','{$this->datecreated}')";
			 
			 if ($mysqli->query($query)) {
			 		return "Success";
			 }else{
			 		return "Failed";
			 }
			
		}
	}



$inbound = new createInbound();
echo $inbound->insertDatas();













?>