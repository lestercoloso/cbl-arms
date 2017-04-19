<?php
date_default_timezone_set('Asia/Manila');
// error_reporting("E_ALL");
// error_reporting( E_ERROR );

// ini_set( 'display_errors' , 'On' );

/*
* Mysql database class - only one connection alowed
*/

require_once(dirname(__file__).'/helper/utility_helper.php');

class Database {

	public $_connection;
	private static $_instance; //The single instance
	public $_host = "localhost";
	public $_username = "root";
	public $_password = "";
	public $_database = "cblarms";
	public $last_query = "";

	// Constructor
	public function __construct() {

		$this->where_search = "";
		// die(dirname(__file__).'/config.cnf');
		$dbconfig = get_config(dirname(__file__).'/config.cnf');
		$this->_connection = new MySQLi(trim($dbconfig['host']), trim($dbconfig['username']), trim($dbconfig['password']), trim($dbconfig['database']));
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	// Magic method clone is empty to prevent duplication of connection
	public function __clone() { }

	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}

	public function resultArray($result){
		$array = [];
		while($row = $result->fetch_assoc()) {
			$array[] = $row;
		}

		return $array;
	}

	public function select_one($sql=''){
		//$sql = "SELECT * FROM user_account";
		$result = $this->_connection->query($sql);
		$return = $result->fetch_assoc();
		return $return;

	}

	public function select($sql=''){
		//$sql = "SELECT * FROM user_account";
		$result = $this->_connection->query($sql);
		$return['count'] = $result->num_rows;
		$return['data'] = $this->resultArray($result);
		return $return;

	}

	public function insert($table='', $columns=[]){
		foreach($columns as $col => $val){
			$column[] = "`".$col."`";
			$value[] = "'".$val."'";

		}

		$sql = "insert into `$table` (".implode(',',$column).") values (".implode(',',$value).")";
		// die($sql);
		// if($_COOKIE['devmode']=='on'){
			// session_start();
			// $_SESSION['inser_sql'] = $sql;
		// }
		return $this->CheckResult($sql);
	}

	public function replace($table='', $columns=[]){
		foreach($columns as $col => $val){
			$column[] = "`".$col."`";
			$value[] = "'".$val."'";

		}

		$sql = "replace into `$table` (".implode(',',$column).") values (".implode(',',$value).")";
		return $this->CheckResult($sql);
	}

	public function last_query(){
		echo PHP_EOL.$this->last_query.PHP_EOL;
	}

	public function insert_id(){
		return $this->select_one('SELECT LAST_INSERT_ID() AS insert_id')['insert_id'];
	}

	public function delete($table='', $where=''){
		$where = !empty($where) ? ' where '.$where : '';
		$sql = "delete from $table $where";

		return $this->CheckResult($sql);

	}

	public function CheckResult($sql){

		$this->last_query = $sql;
		if ($this->_connection->query($sql) === TRUE) {
			return 1;
		} else {
			return "Error: " . $sql . "<br>" . $this->_connection->error;
		}

	}


	public function update($table,$data=[],$where=''){
		$where = !empty($where) ? ' where '.$where : '';
		$array = [];
		foreach($data as $col=>$val){
			$array[] = "`$col`='$val'";
		}

		$sql = "update $table set ".implode($array, ',')." $where";
			$this->last_query = $sql;
		if ($this->_connection->query($sql) === TRUE) {
			return 1;
		} else {
			return "Error: " . $sql . "<br>" . $this->_connection->error;
		}
	}

	public function where_search($array = []){
		if(is_array($array)){
			foreach ($array as $key => $value) {
				if($value!=""){
					$data = " ".$key."='".mysqli_real_escape_string($this->_connection,$value)."'";
					// $data = " `".$key."`='".mysql_real_escape_string($value)."'";
					$this->where_search .= (!empty($this->where_search)) ? " and ".$data : " where ".$data;				
				}
			}			
		}else{
			$this->where_search .= (!empty($this->where_search)) ? " and ".$array : " where ".$array;	
		}


		return $this->where_search;

	}

	public function where_like($array = []){

		foreach ($array as $key => $value) {
			if(!empty($value)){
				$data = " ".$key." like '%".mysqli_real_escape_string($this->_connection,$value)."%'";
				$this->where_search .= (!empty($this->where_search)) ? " and ".$data : " where ".$data;				
			}
		}

		return $this->where_search;

	}

	public function likedata($array=[], $array2=[]){


		return $array;
	}

	public function getconfig($particulars='',$type=''){
		$return = $this->select("select `description`, `id` from `maintenance` where particulars='$particulars'");
		$array = [];
		foreach($return['data'] as $r){
			if($type=='maintenance'){
				$array[$r['id']] = $r['description'];
			}else{
				$array[$r['description']] = $r['description'];				
			}

		}
		return $array;
	}


	public function radio_maintenance_html($particulars=''){
		$sql = "select `exp`, `batch` from `maintenance_table` where particulars='$particulars' and status=1 limit 1";
		// die($sql);
		$return = $this->select_one($sql);


		$expyes 	= ($return['exp']) 	? 'checked' : '';
		$expno 		= (!$return['exp']) ? 'checked' : '';
		$batchyes 	= ($return['batch']) 	? 'checked' : '';
		$batchno 	= (!$return['batch']) 	? 'checked' : '';

		$html = '<td class="radio-maintenace">
						<div class="radioexp"> <input type="radio" name="'.$particulars.'-exp" col="'.$particulars.'" value="1" '.$expyes.'> Yes 
						<input type="radio" name="'.$particulars.'-exp" col="'.$particulars.'" value="0" '.$expno.'> No </div>
					</td>
					<td class="radio-maintenace">
						<div class="radiobatch"> <input type="radio" name="'.$particulars.'-btch" col="'.$particulars.'" value="1" '.$batchyes.'> Yes 
						<input type="radio" name="'.$particulars.'-btch" col="'.$particulars.'" value="0" '.$batchno.'> No </div>
					</td> ';
		return $html;
	}

	public function pagination($page=1, $total=0, $limit=5){

			//PAGINATION//
			$counter = 1;
			$adjacents = 1;
			$targetpage = $_SERVER['PHP_SELF']; //your file name

			/* Setup page vars for display. */
			    if ($page == 0) $page = 1; //if no page var is given, default to 1.
			    $prev = $page - 1; //previous page is current page - 1
			    $next = $page + 1; //next page is current page + 1
			    $lastpage = ceil($total/$limit); //lastpage.
			    $lpm1 = $lastpage - 1; //last page minus 1

			/* CREATE THE PAGINATION */

			$pagination = "";
			if($lastpage > 1)
			{ 
			    $pagination .= "<ul class='pagination'>";
			    if ($page > $counter+1) {
			        $pagination.= "<li><span class='pagenumber' data-page='$prev'>&laquo;</span></li>"; 
			    }

			    if ($lastpage < 7 + ($adjacents * 2)) 
			    { 
			        for ($counter = 1; $counter <= $lastpage; $counter++)
			        {
			            if ($counter == $page)
			                $pagination.= "<li class='active'><span>$counter</span></li>";
			            else
			                $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</span></li>"; 
			        }
			    }
			    elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
			    {
			        //close to beginning; only hide later pages
			        if($page < 1 + ($adjacents * 2)) 
			        {
			            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
			            {
			                if ($counter == $page)
			                    $pagination.= "<li class='active'><span>$counter</span></li>";
			                else
			                    $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</span></li>"; 
			            }
			            $pagination.= "<li><span>...</span></li>";
			            $pagination.= "<li><span class='pagenumber' data-page='$1pm1'>$lpm1</span></li>";
			            $pagination.= "<li><span class='pagenumber' data-page='$lastpage'>$lastpage</span></li>"; 
			        }
			        //in middle; hide some front and some back
			        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			        {
			            $pagination.= "<li><span class='pagenumber' data-page='1'>1</span></li>";//here
			            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
			            {
			                if ($counter == $page)
			                    $pagination.= "<li class='active'><span>$counter</span></li>";
			                else
			                    $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</span></li>"; 
			            }
			            $pagination.= "<li><span>...</span></li>";
			            $pagination.= "<li><span class='pagenumber'  data-page='$1pm1'>$lpm1</span></li>";
			            $pagination.= "<li><span class='pagenumber'  data-page='$lastpage'>$lastpage</span></li>"; 
			        }
			        //close to end; only hide early pages
			        else
			        {
			            $pagination.= "<li class='pagenumber' data-page='1'><span>1</span></li>";
			            $pagination.= "<li class='pagenumber' data-page='2'><span>2</span></li>";
			            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; 
			            $counter++)
			            {
			                if ($counter == $page)
			                    $pagination.= "<li class='active'><span>$counter</span></li>";
			                else
			                    $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</spa></li>"; 
			            }
			        }
			    }

			    //next button
			    if ($page < $counter - 1) 
			        $pagination.= "<li><span class='pagenumber' data-page='$next'>&raquo;</span></li>";
			    else
			        $pagination.= "";
			    $pagination.= "</ul>\n"; 
			}

			return $pagination;


	}


}

?>
