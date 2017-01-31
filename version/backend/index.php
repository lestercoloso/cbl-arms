<?php



require_once("func.php");	
require_once("get_branch.php");	
		$method = isset($_GET['method']) ? $_GET['method'] : "";
		$method = explode('/', $method);
		$method2 = !empty($method[0]) ? $method[0] : 'index';

		$parameter= [];
		if(count($method)>1){
			$parameter = array_slice($method, 1); 		
		}
			$me = new system;

call_user_func_array([$me, $method2], $parameter);
$main = new main;




?>