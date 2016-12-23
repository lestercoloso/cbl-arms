<?PHP require_once("db_connect.php");
error_reporting("E_ALL");
error_reporting( E_ERROR );

ini_set( 'display_errors' , 'On' );
session_start();


/**
* 
*/
class UpdateAccess extends Database
{
	public $main = array();
	public $id;
	public $_conn;
	public $main_module;
	public $string_module;
	public $s1;
	public $s2;
	public $s3;
	public $s4;
	public $s5;
	public $s6;
	public $name;
	public $s7;
	public $s8;
	public $s9;
	public $s10;

	function __construct()
	{
		parent::__construct();
		$this->populateData();
		$this->chopArrdata();
		$this->_conn = $this->_connection;
	}

	public function populateData(){
		$this->main = $_POST['main'];
		$this->id = $_POST['id'];
		$this->name = $_POST['name'];

	}

	public function chopArrdata(){
		
			foreach ($this->main as $key => $value) {
				$this->string_module .= $value;
			}

			$this->main_module = substr($this->string_module, 0,1).','.substr($this->string_module, 10,1).','.substr($this->string_module, 37,1).','.substr($this->string_module, 44,1).','.substr($this->string_module, 53,1).','.substr($this->string_module, 74,1).','.substr($this->string_module, 86,1).','.substr($this->string_module, 95,1).','.substr($this->string_module, 99,1).','.substr($this->string_module, 107,1);
			$this->s1 = substr($this->string_module, 1,9);
			$arr = str_split($this->s1, "1"); 
			$this->s1 = implode(",", $arr);
			$this->s2 = substr($this->string_module, 11,26);
			$arr = str_split($this->s2, "1"); 
			$this->s2 = implode(",", $arr);
			$this->s3 = substr($this->string_module, 38,6);
			$arr = str_split($this->s3, "1"); 
			$this->s3 = implode(",", $arr);
			$this->s4 = substr($this->string_module, 45,8);
			$arr = str_split($this->s4, "1"); 
			$this->s4 = implode(",", $arr);
			$this->s5 = substr($this->string_module, 54,20);
			$arr = str_split($this->s5, "1"); 
			$this->s5 = implode(",", $arr);
			$this->s6 = substr($this->string_module, 75,11);
			$arr = str_split($this->s6, "1"); 
			$this->s6 = implode(",", $arr);
			$this->s7 = substr($this->string_module, 87,8);
			$arr = str_split($this->s7, "1"); 
			$this->s7 = implode(",", $arr);
			$this->s8 = substr($this->string_module, 96,3);
			$arr = str_split($this->s8, "1"); 
			$this->s8 = implode(",", $arr);
			$this->s9 = substr($this->string_module, 100,7);
			$arr = str_split($this->s9, "1"); 
			$this->s9 = implode(",", $arr);
			$this->s10 = substr($this->string_module, 108,6);
			$arr = str_split($this->s10, "1"); 
			$this->s10 = implode(",", $arr);
	}


	public function do_Query(){

		$query = $this->_conn->prepare("UPDATE `user_module` SET `main_module`=?,`submodule_1`=?,`submodule_2`=?,`submodule_3`=?,`submodule_4`=?,`submodule_5`=?,`submodule_6`=?,`submodule_7`=?,`submodule_8`=?,`submodule_9`=?,`submodule_10`=? WHERE `user_id`=? ");
		$query->bind_param('ssssssssssss',$this->main_module,$this->s1,$this->s2,$this->s3,$this->s4,$this->s5,$this->s6,$this->s7,$this->s8,$this->s9,$this->s10,$this->id);
		
		$query->execute();

		if ($query) {
			return "The settings for user ".$this->name." were successfully saved.";
		}else{
			return $query->error();
		}
		
		//return $this->s2 ." ".$this->id;
	}
}


$asd = new UpdateAccess();
echo $asd->do_Query();

