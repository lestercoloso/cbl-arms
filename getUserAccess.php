<?PHP require_once("db_connect.php");
error_reporting("E_ALL");
error_reporting( E_ERROR );

ini_set( 'display_errors' , 'On' );
session_start();


/**
* 
*/
class GetUserAccess extends Database
{

		public $_conn;
		public $id;
	
	public function __construct()
	{
		parent::__construct();
		$this->_conn = $this->_connection;

	}



	public function getData(){

		if (isset($_POST['id'])) {
			$this->id = $_POST['id'];
		}

		$result= $this->_conn->query("SELECT * FROM user_module WHERE user_id='{$this->id}'");
		$data_array= array();
		
		while ($row=$result->fetch_array(MYSQLI_ASSOC)) {

			$data_array[$row['id']]['m'] = $row['main_module'];
			$data_array[$row['id']]['s1'] = $row['submodule_1'];
			$data_array[$row['id']]['s2'] = $row['submodule_2'];
			$data_array[$row['id']]['s3'] = $row['submodule_3'];
			$data_array[$row['id']]['s4'] = $row['submodule_4'];
			$data_array[$row['id']]['s5'] = $row['submodule_5'];
			$data_array[$row['id']]['s6'] = $row['submodule_6'];
			$data_array[$row['id']]['s7'] = $row['submodule_7'];
			$data_array[$row['id']]['s8'] = $row['submodule_8'];
			$data_array[$row['id']]['s9'] = $row['submodule_9'];
			$data_array[$row['id']]['s10'] = $row['submodule_10'];
		}

		return $data_array;
		$query->close();


	}
}

$GetUserAccess = new GetUserAccess();
echo json_encode($GetUserAccess->getData());