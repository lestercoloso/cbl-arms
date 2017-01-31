<?php

// error_reporting(0);

	
class Main{

	public $db;

	public function __construct(){
		$method = isset($_GET['method']) ? $_GET['method'] : "";
		$method = explode('/', $method);
		$method2 = !empty($method[1]) ? $method[1] : 'index';

		$parameter= [];
		if(count($method)>2){
			$parameter = array_slice($method, 2); 		
		}

		require_once(dirname(dirname(__file__))."/db_connect.php");	
		$db = new database;
		$GLOBALS['db'] = $db;

		if(file_exists($method[0].".php")){
			include $method[0].".php";
			$me = new $method[0];
			call_user_func_array([$me, $method2], $parameter);

		}else{
			$error = 100;
			die('error!');
		}

	}

}
$main = new main;
// $main;
// class test{
// 	public function __construct(){
// 		die('he');
// 	}

// }
// $test = new test;

// call_user_func_array(['test', ''], '');
// $test;
// $system;



?>