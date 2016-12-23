<?php

error_reporting("E_ALL");
date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');



class SaveAccess extends Database
{
		
	public $conn;
	public $access;
	public $type;
	public $ua;
	public $mtc;
	public $ci;
	public $bk;
	public $wh;
	public $bol;
	public $blng;
	public $cco;
	public $pymt;
	public $rpts;

	public function __construct()
	{
		parent::__construct();
		$this->conn = $this->_connection;
		$this->populateData();
	}

	public function populateData(){
		if (isset($_POST['type'])) {
			$this->type = $_POST['type'];
			$this->ua = $_POST['ua'];
			$this->mtc = $_POST['mtc'];
			$this->ci = $_POST['ci'];
			$this->bk = $_POST['bk'];
			$this->wh = $_POST['wh'];
			$this->bol = $_POST['bol'];
			$this->blng = $_POST['blng'];
			$this->cco = $_POST['cco'];
			$this->pymt = $_POST['pymt'];
			$this->rpts = $_POST['rpts'];
		}

		$this->access = $this->ua.','.$this->mtc.','.$this->ci.','.$this->bk.','.$this->wh.','.$this->bol.','.$this->blng.','.$this->cco.','.$this->pymt.','.$this->rpts;
	}

	public function do_Query(){

			$sql = $this->conn->prepare("UPDATE `user_types` SET `access`=? WHERE `user_types`=?");
			$sql->bind_param('ss',$this->access,$this->type);
			$sql->execute();

			if ($sql) {
					return "1";
					$sql->close();
			}else{
					return $sql->error();
			}
	}
}

$SaveAccess = new SaveAccess();
echo $SaveAccess->do_Query();