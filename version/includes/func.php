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

	$config = $path."/Nelsoft/backstage/config.xml";
	if(is_file($config)){

		$xmlstring = file_get_contents($config);
		$xml = simplexml_load_string($xmlstring);
		$newxml = (array) $xml;
		$return = !empty($newxml['version']) ? $newxml['version'] : '0.00';
	}else{
		$return = '0.00';
	}
    return $return;
}

?>