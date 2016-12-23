<?PHP 


date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');



class Type_Access extends Database{

	public $type;

	public function add_sql(){
		$sql='';
		if (isset($_POST['type'])) {
			$this->type= $_POST['types'];
			
			$sql = " AND user_types='".$this->type."'";

			return $sql;


		}else{
			
			return " ";
		}
	}
	public function do_Query(){



		$mysqli = $this->getConnection();
		$add_this = $this->add_sql();
		$query = $mysqli->query("SELECT * FROM user_types Where status =1".$add_this);
		$data_array = array();
		while ($myrow = $query->fetch_array(MYSQLI_ASSOC)) {

			$data_array[$myrow['id']]['type'] = $myrow['user_types'];
			$data_array[$myrow['id']]['access'] = $myrow['access'];
		}

		return $data_array;

	}

}

$access = new Type_Access();
echo json_encode($access->do_Query());