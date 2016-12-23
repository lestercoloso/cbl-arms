<?PHP

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');


class Deactivate_user extends Database{

	public $id;
	public $status;
	public function __construct(){
		parent::__construct();
		$this->getID();
	}

	public function getID(){

		if (isset($_POST['id'])) {
			$this->id = $_POST['id'];
		}
	}

	public function deactivate(){

		$mysqli = $this->_connection;

		$this->status = 0;
		$query = $mysqli->prepare("UPDATE user_account SET status=? WHERE id=?");
		$query->bind_param('is',$this->status,$this->id);
		$query->execute();
		$query->close();

		if ($query) {
			return "User Account Successfully Deactivated.";
		}
	}
}




$deactivate = new Deactivate_user();
echo $deactivate->deactivate();