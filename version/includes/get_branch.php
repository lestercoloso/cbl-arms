<?php
require_once('func.php');
$return = [];
	$return['version'] = '0.00';
if(is_dir($_POST['path'])){
	chdir($_POST['path']);
	exec("git branch -r" , $output);
	exec('git rev-parse --abbrev-ref HEAD', $currbranch);
	$return['current_branch'] = $currbranch;
	$return['version'] = getversion($_POST['path']);

	foreach($output as $branch){
		if(trim($branch)!='origin/HEAD -> origin/master'){
			$return['data'][] = trim(str_replace('origin/','',$branch));		
		}
	}
	if(!empty($return['data'])){
		$return['status'] = 200;
	}else{
		$return['status'] = 101;	
	}

}else{
	$return['status'] = 100;
}
jdie($return);

?>