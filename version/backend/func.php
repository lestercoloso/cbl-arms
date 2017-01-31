<?php
function jdie($array){
	header('Content-Type: application/json');
	die(json_encode($array));
}

function pdie($array){
	echo '<pre>';
	print_r($array);
	die();
}

function getversion($path){

	$config = dirname(dirname(dirname(__FILE__)))."/config.cnf";
	if(is_file($config)){

		$config = file_get_contents($config);
		$config = explode(PHP_EOL, $config);
		
		$return['config']['database'] 	= !empty($config[3]) ? explode('=',$config[3])[1] : '';
		$return['config']['host'] 		= !empty($config[0]) 	? explode('=',$config[0])[1] : '';
		$return['config']['username'] 	= !empty($config[1]) ? explode('=',$config[1])[1] : '';
		$return['config']['password'] 	= !empty($config[2]) ? explode('=',$config[2])[1] : '';
		
	}else{
		$return = [];
	}
    return $return;
}

?>