<?php

	error_reporting(0);
set_time_limit(0);

class system{


function getbranch(){
	$return = [];
		$return['version'] = '0.00';
	if(is_dir($_POST['path'])){
		chdir($_POST['path']);
		exec("git branch -r" , $output);
		exec('git rev-parse --abbrev-ref HEAD', $currbranch);
		exec('git status', $status);
		$return['current_branch'] = $currbranch;
		$return['version'] = getversion($_POST['path'], 'version');

		foreach($output as $branch){
			if(trim($branch)!='origin/HEAD -> origin/master'){
				$return['data'][] = trim(str_replace('origin/','',$branch));		
			}
		}

		$return['git'] = $status;
		if(!empty($return['data'])){
			$return['status'] = 200;
		}else{
			$return['status'] = 101;	
		}

	}else{
		$return['status'] = 100;
	}
	jdie($return);


}

function changeBranch(){
		// $gitusr = isset($_COOKIE['gitusr']) ? $_COOKIE['gitusr'] : '';
		// $gitpss = isset($_COOKIE['gitpss']) ? $_COOKIE['gitpss'] : '';
		// $repo = 'https://'.$gitusr.':'.$gitpss.'@github.com/nelsoft/nelsoft_inventory.git';
		chdir($_POST['path']);
		exec('git clean -df');
		exec('git checkout -- .');
		// exec('git fetch '.$repo);
		exec('git checkout '.$_POST['branch'], $data);
		// exec('git pull '.$repo.' '.$_POST['branch'], $data);

		$return['version'] = '0.00';
		$return['version'] = getversion($_POST['path'], 'version');	
		$return['data'] = $data;

		jdie($return);
}

function changeConfig(){
	$server_path = isset($_COOKIE['server_path']) ? $_COOKIE['server_path'] : '';

	$dbhost = isset($_COOKIE['dbhost']) ? $_COOKIE['dbhost'] : '';
	$db = isset($_COOKIE['db']) ? $_COOKIE['db'] : '';
	$dbusr = isset($_COOKIE['dbusr']) ? $_COOKIE['dbusr'] : '';
	$dbpss = isset($_COOKIE['dbpss']) ? $_COOKIE['dbpss'] : '';


	$fileName = $server_path."/nelsoft/backstage/config.xml";
	$fileContent = file($fileName);
	foreach($fileContent as $key=>$line){
		if (strpos($line, '<database>') !== false) {
			$fileContent[$key] = "<database>$db</database>\n";
		}		
		if (strpos($line, '<host>') !== false) {
			$fileContent[$key] = "<host>$dbhost</host>\n";
		}		
		if (strpos($line, '<user>') !== false) {
			$fileContent[$key] = "<user>$dbusr</user>\n";
		}		
		if (strpos($line, '<password>') !== false) {
			$fileContent[$key] = "<password>$dbpss</password>\n";
		}

	}
		file_put_contents ($fileName, implode("", $fileContent));
		$conn = new MySQLi(trim($dbhost), trim($dbusr), trim($dbpss), trim($db));
		$status = '<b style="color:#b41011;">Not Connected</b>';
		if(!mysqli_connect_error()) {
			$status = '<b style="color: #348c34;">Connected</b>';
		}

		die($status);

}

	function checkUpdates(){
		$server_path = isset($_COOKIE['server_path']) ? $_COOKIE['server_path'] : '';
		chdir($server_path);
		exec('git rev-parse --abbrev-ref HEAD', $currbranch);
		exec('git status', $result);
			$status = str_replace("Your branch is behind 'origin/".$currbranch[0]."' by ",'', $result[1]);
			$status = str_replace(" commits, and can be fast-forwarded.",'', $status);
			if(is_numeric($status)){
				die("(".$status.")");
			}else{
				die(0);
			}
	}

	function gitUpdate(){
		$server_path = isset($_COOKIE['server_path']) ? $_COOKIE['server_path'] : '';
		chdir($server_path);
		$gitusr = isset($_COOKIE['gitusr']) ? $_COOKIE['gitusr'] : '';
		$gitpss = isset($_COOKIE['gitpss']) ? $_COOKIE['gitpss'] : '';
		$repo = 'https://'.$gitusr.':'.$gitpss.'@github.com/nelsoft/nelsoft_inventory.git';	
		exec('git clean -df');
		exec('git checkout -- .');	
		exec('git fetch '.$repo, $data1);
		exec('git pull '.$repo.' '.$_POST['branch'], $data2);
		jdie(array_merge($data1,$data2));

	}




}

?>