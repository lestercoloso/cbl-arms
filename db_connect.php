<?php

error_reporting("E_ALL");
error_reporting( E_ERROR );

ini_set( 'display_errors' , 'On' );

/*
* Mysql database class - only one connection alowed
*/
class Database {

	public $_connection;
	private static $_instance; //The single instance
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "";
	private $_database = "cblarms";



	// Constructor
	public function __construct() {
		$this->_connection = new MySQLi($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
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


}


//Add another connection using some methods


   /* $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "SELECT * FROM user_account";
    $result = $mysqli->query($sql_query);
    $myrow = $result->fetch_array(MYSQLI_ASSOC);

  echo $aValue=$myrow['username'];
*/
    //echo $row[1];

  //  $db = Database::getInstance();
   // $mysqli = $db->getConnection(); 
?>
