<?php

// error_reporting(0);

	
class Main{



	public function __construct(){

		$this->test = 1;

		$method = isset($_GET['method']) ? $_GET['method'] : "";
		$method = explode('/', $method);
		$method2 = !empty($method[1]) ? $method[1] : 'index';

		$parameter= [];
		if(count($method)>2){
			$parameter = array_slice($method, 2); 		
		}

		require_once(dirname(dirname(__file__))."/db_connect.php");	
		$db = new database;
		$this->db = $db;

		if(file_exists($method[0].".php")){
			require_once($method[0].".php");
			call_user_func_array([$method[0], $method2], $parameter);

		}else{
			$error = 100;
			die('error!');
		}

	}
}
$main = new main;

// $system;



?>