<?php

require_once("db_connect.php");
error_reporting("E_ALL");
error_reporting( E_ERROR );

ini_set( 'display_errors' , 'On' );
session_start();


class My_Account extends Database{

	public $key_value;
	public $_conn;
	public $uid;
	public $fname;
 	public $mname;
    public $lname;
    public $mobile;
    public $email;
    public $fullname;
    public $pass;
    public $def;



	public function __construct(){
		parent::__construct();
		$this->_conn = $this->_connection;
		$this->populateData();

	}

	public function populateData(){

		if (isset($_POST['def'])) {
			# code...
		
		if ($_SESSION['key_value'] !='') {
			
			$this->key_value = $_SESSION['key_value'];
			$this->fname = 	   $_POST['fname'];
			$this->mname = 	   $_POST['mname'];
			$this->lname = 	   $_POST['lname'];
			$this->mobile =    $_POST['mobile'];
			$this->email = 	   $_POST['email'];
			$this->uid = 	   $_POST['uid'];
			$this->fullname = $this->lname.', '.$this->fname.' '.$this->mname;
		}
		if (isset($_POST['pass'])) {
			$this->pass = md5($_POST['pass']);
		}

		$this->def = $_POST['def'];
	}

	}

	public function do_Query(){

		$sql = $this->_conn->prepare("UPDATE user_profiles SET `fname`=?,`mname`=?,`lname`=?,`mobile`=?,`email`=? WHERE `key_value`=?");
		$sql->bind_param('ssssss',$this->fname,$this->mname,$this->lname,$this->mobile,$this->email,$this->key_value);
		$sql->execute();

		if ($sql) {
			
			$sql1 = $this->_conn->prepare('UPDATE user_account SET name=?, username=? WHERE id=?');
			$sql1->bind_param('sss',$this->fullname,$this->uid,$this->key_value);
			$sql1->execute();

			/*if (isset($this->pass)) {
				$sql2 = $this->_conn->prepare("UPDATE user_account SET password=? WHERE id=?");
				$sql2->bind_param('ss',$this->pass,$this->key_value);
				$sql2->execute();
			}*/

				//|UPDATE SESSSSIONNN!
			$_SESSION['profilename'] = $this->fname.' '.$this->mname.' '.$this->lname;
			$_SESSION['accfname'] =  $this->fname;
			$_SESSION['accmname'] =  $this->mname;
			$_SESSION['acclname'] =  $this->lname;
			$_SESSION['accfname'] =  $this->fname;
			$_SESSION['accmobile'] = $this->mobile;
			$_SESSION['accemail'] =  $this->email;


			return "1";
		}
	}

	public function do_Query_pass(){

		$sql1 = $this->_conn->prepare('UPDATE user_account SET name=? WHERE id=?');
		$sql1->bind_param('ss',$this->fullname,$this->key_value);
		$sql1->execute();

		if ($sql1) {
			return "1";
		}
	}

	public function select_Query(){

		if ($this->def == 0) {

			return $this->do_Query_pass();

		}else if($this->def==1){

			return $this->do_Query();
		}

	}
}

$My_Account = new My_Account();
echo $My_Account->select_Query();