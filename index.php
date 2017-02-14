<?php
// 	$method = isset($_GET['method']) ? $_GET['method'] : "";		
// if(!empty($method)){
// 	unset($_GET['method']);
// 	$method = explode('/', $method);
// 	require_once($method[0].'.php');
// 	die;	
// }
session_start();
$_SESSION['page']="home";

require_once('db_connect.php');
$css = [ bowerpath('bootstrap/dist/css/bootstrap.min.css'),bowerpath('font-awesome/css/font-awesome.min.css')];
construct_style($css);
require_once('header.php');


class Homepage extends Database{
	public $_conn;
	public $name;
	public $time;

	public function __construct(){
		
	}

	public function getTime(){

		$this->time = date("Y-m-d");
		return $this->time;
	}

}

$homepage = new Homepage();
$database = new Database();
$homesql = "select name, link, img from home_module where status=1 order by sort_order ASC";
$home = $database->select($homesql);
// pdie($home);
?>
<head>
</head>




 		<div class="container col-sm-12" style="height: auto; background-color: #fff; border: solid 1px #999;">
	 		<?php
	 			foreach ($home['data'] as $value) {
	 				$link = !empty($value['link']) ? "/".$value['link'].".php" : 'javascript:alert("Not Available")'; 
	 				echo "<div class='col-sm-3 module_container'>";
	 				echo "<a href='$link'>
	 						<span><img src='/img/new_icon/".$value['img']."' /></span>
	 						<span>".$value['name']."<span>
	 					  </a>";

	 				echo "</div>";

	 			}
	 		?>
<div class='col-sm-5' style="font-weight: 100; margin: 20px;">
<br><br>
The CBL Warehouse Management System (WMS) built to facilitate warehouse management for both CBL and its suppliers. by automating the procss this system helps improve accuracy, efficiency productivity and service levels of everyone concerned.
<br>
<i><b>This page is set as my homepage</b></i>

</div>

 		</div>



	<div id="view-dialog" title="Pick view">
    <div style="margin-left: 23px;">

    	

    </div>
	</div>


 	   		<div style="clear: both; width: 10px; height: 1px;"></div>
 		</div>
   		<div class="buff10"><!-- --></div>
   		<div class="buff10"><!-- --></div>
		<?
		// get the copyright text from the database
		
		$endtime = microtime();
		$endarray = explode(" ", $endtime);
		$endtime = $endarray[1] + $endarray[0];
		$totaltime = $endtime - $starttime;
		$totaltime = round($totaltime,5);
		?>
		<div style="clear: both; text-align: center;" class="normalTextSmall">
		Page loaded in <? echo $totaltime ?> seconds.<br />
		© Copyright 2010 - 2016 CBL Freight Forwarder and Courier Express Int'l, Inc. All rights reserved.<br />
		
		Powered by <!-- <a href="http://www.entuitivesolutions.com" target="_blank"> -->Komodo`Alil<!-- </a> -->
		</div>
   		<div class="buff10"><!-- --></div>
	</div>
</div>

</body>