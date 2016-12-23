<?PHP
error_reporting(E_ALL);
date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');

class Edit_Driver extends Database{

	public $conn;
	public $code;
	public $name;
	public $type;
	public $result;
	public $sql;
	public $id;


	public function __construct(){

		parent::__construct();
		$this->populateData();
		$this->conn = $this->_connection;

	}


	public function populateData(){
		if (isset($_POST['id'])) {
			
		}
	}

}