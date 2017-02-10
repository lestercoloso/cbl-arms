<?php

error_reporting(0);
set_time_limit(0);

class system{


function getbranch(){
	$return = [];
		$return['version'] = '0.00';

		$getconfig = getversion('');
		$return['version'] = $getconfig['version'];
		$return['config'] = $getconfig['config'];
		
	

		chdir(dirname(dirname(dirname(__FILE__))));
		exec("git fetch" , $status);
		exec("git branch -r" , $output);
		exec('git rev-parse --abbrev-ref HEAD', $currbranch);
		exec('git status', $status);
		$return['current_branch'] = $currbranch;



		// pdie($return);

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


	jdie($return);


}

function changeBranch(){
		// $gitusr = isset($_COOKIE['gitusr']) ? $_COOKIE['gitusr'] : '';
		// $gitpss = isset($_COOKIE['gitpss']) ? $_COOKIE['gitpss'] : '';
		// $repo = 'https://'.$gitusr.':'.$gitpss.'@github.com/nelsoft/nelsoft_inventory.git';
		chdir(dirname(dirname(dirname(__FILE__))));
		exec('git clean -df');
		exec('git checkout -- .');
		// exec('git fetch '.$repo);
		exec('git checkout '.$_POST['branch'], $data);
		// exec('git pull '.$repo.' '.$_POST['branch'], $data);

		$getconfig = getversion($_POST['path']);
		$return['version'] = $getconfig['version'];
		$return['config'] = $getconfig['config'];
		
		$return['data'] = $data;

		jdie($return);
}

function changeConfig(){
	$server_path = !empty($_POST['path']) ? $_POST['path'] : '';
	$dbhost = !empty($_POST['host']) ? $_POST['host'] : '';
	$db = !empty($_POST['database']) ? $_POST['database'] : '';
	$dbusr = !empty($_POST['username']) ? $_POST['username'] : '1';
	$dbpss = !empty($_POST['password']) ? $_POST['password'] : '';
	$t = !empty($_POST['t']) ? $_POST['t'] : '';


	if($t=='change'){
		$config = dirname(dirname(dirname(__FILE__)))."/config.cnf";
		$file = fopen($config,"w");
		$content = 'host='.$dbhost.PHP_EOL.'username='.$dbusr.PHP_EOL .'password='.$dbpss.PHP_EOL .'database='.$db;
		fwrite($file,$content);
		fclose($file);
	}

		$status['version'] = '-';
		$conn = new MySQLi(trim($dbhost), trim($dbusr), trim($dbpss), trim($db));
			$status['status'] = '<b style="color:#b41011;">Not Connected</b>';
		if(!mysqli_connect_error()) {
			$status['status'] = '<b style="color: #348c34;">Connected</b>';

			$result = $conn->query("select `version` from version where description='database'");
			$return['count'] = $result->num_rows;
			$row = $result->fetch_assoc();
			$status['version'] = $row['version'];
		}

		jdie($status);

}

	function checkUpdates(){
		$server_path = dirname(dirname(dirname(__FILE__)));
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
		$server_path = dirname(dirname(dirname(__FILE__)));
		chdir($server_path);
		$gitusr = isset($_COOKIE['gitusr']) ? $_COOKIE['gitusr'] : '';
		$gitpss = isset($_COOKIE['gitpss']) ? $_COOKIE['gitpss'] : '';
		// $repo = 'https://'.$gitusr.':'.$gitpss.'@github.com/nelsoft/nelsoft_inventory.git';	
		exec('git clean -df');
		exec('git checkout -- .');	
		exec('git fetch ', $data1);
		exec('git pull '.$_POST['branch'], $data2);
		jdie(array_merge($data1,$data2));

	}

	function getpatcher(){
		$server_path = dirname(dirname(dirname(__FILE__)));
		chdir($server_path."/sql");
		$patch = glob('*');
		jdie($patch);
	}

	function patch($version){
		$server_path = dirname(dirname(dirname(__FILE__)));
		chdir($server_path."/sql/".$version);
		$sqls = glob('*');
			foreach ($sqls as $key => $sql) {
				$patch .= file_get_contents($sql);
			}
			
			$getconfig = getversion('');
			$db = $getconfig['config'];
			
			$conn = new MySQLi(trim($db['host']), trim($db['username']), trim($db['password']), trim($db['database']));
			$conn->query("update `version` set `version`='$version' where `description`='database'");
			if(!mysqli_connect_error()) {
				if(mysqli_multi_query($conn,$patch)){
					
					jdie('success');						
					

				}
			}

			

	}



}

?>