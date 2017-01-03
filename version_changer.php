<?php 
error_reporting("E_ALL");
error_reporting( E_ERROR );
	require_once("db_connect.php");

	if(!empty($_POST)){
	// pdie($_POST);
		

		exec('git clean -df');
		exec('git checkout -- .');
		exec('git fetch');
		exec('git checkout '.$_POST['branch']);
		exec('git checkout '.$_POST['branch']);
		exec('git pull origin '.$_POST['branch']);

		$file = fopen("config.cnf","w");
		$content = 'host='.$_POST['host'].PHP_EOL.'username='.$_POST['username'].PHP_EOL .'password='.$_POST['password'].PHP_EOL .'database='.$_POST['database'];
		fwrite($file,$content);
		fclose($file);
	}

	class Version extends Database {

		public function getDBVersion(){
				$sql = "SELECT `version` FROM `version` where description='database'";
				$result = $this->_connection->query($sql);
				$row = $result->num_rows;
				if($row>0){
					return $this->resultArray($result)['version'];
				}else{
					return '0.00';
				}

		}

	}

	require_once('/helper/utility_helper.php');
		$dbconfig = get_config('config.cnf');
		$conn = new MySQLi(trim($dbconfig['host']), trim($dbconfig['username']), trim($dbconfig['password']), trim($dbconfig['database']));
		if(mysqli_connect_error()) {
			$connection_status = "<b style='color:#b41011;'>Not Connected</b>";
			$version = '0.00';
		}else{
			$connection_status = "<b style='color: #348c34;'>Connected</b>";
			$version = new Version;
			$version = $version->getDBVersion();
		}


	

	exec('git branch -r', $gitresult);
	unset($gitresult[0]);
	$gitresult;

	exec('git rev-parse --abbrev-ref HEAD', $currbranch);

?>

<br><br>


<style>
select, input{
	padding: 0px 5px;
}

td{ padding: 5px; }
</style>
<table>
	<form id="change_version"  method="post">
        <tr><td><label>Database Status </label></td><td>:</td><td><?=$connection_status?></td></tr>
        <tr><td><label>Database Version </label></td><td>:</td><td><span><?=$version?></span></td></tr>
        <tr><td><label>Application Version </label><td>:</td></td>
        	<td><em>
        	<select name="branch">
        	<?php
	        	foreach($gitresult as $branch){
	        		$branch = trim(str_replace('origin/','',$branch));
	        		if($currbranch[0]==$branch) { $selected = 'selected'; } else { $selected = '';}
	        		echo '<option value"'.$branch.'" '.$selected.'>'.$branch.'</option>';
	        	}
        	?>
        	</select>
        </em></td></tr>

        <tr><td><label>Host</label></td><td>:</td><td><input type="text" name="host" value="<?=$dbconfig['host']?>"></td></tr>
        <tr><td><label>Username</label></td><td>:</td><td><input type="text" name="username" value="<?=$dbconfig['username']?>"></td></tr>
        <tr><td><label>Password</label></td><td>:</td><td><input type="text" name="password" value="<?=$dbconfig['password']?>"></td></tr>
        <tr><td><label>Database</label></td><td>:</td><td><input type="text" name="database" value="<?=$dbconfig['database']?>"></td></tr>

        <tr><td colspan="2">&nbsp;</td><td><input type="submit" value=" Change "></td></tr>
</form>

