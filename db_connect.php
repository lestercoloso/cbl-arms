<?php

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



	// Constructor
	public function __construct() {
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
			$array = $row;
		}

		return $array;
	}

	public function test(){
		die('test');
	}


}

?>
