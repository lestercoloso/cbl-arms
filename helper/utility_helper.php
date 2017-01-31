<?php

function pdie($array){
	echo '<pre>';
	print_r($array);
	die();
}

function jdie($array){
	header('Content-Type: application/json');
	die(json_encode($array));
}


function get_config($file){
	$configfile = fopen($file, "r") or die("Unable to open file!");
	$dbconfig = array();
		while($row = fgets($configfile)) {
			$num = explode("=", $row);
			$dbconfig[$num[0]] = $num[1];
		}
	fclose($configfile);
	return $dbconfig;
}



?>