<?php
date_default_timezone_set('Asia/Manila');
error_reporting("E_ALL");
error_reporting( E_ERROR );

ini_set( 'display_errors' , 'On' );
mysql_free_result($timezone_query);
// set the default timezone
date_default_timezone_set($timezone_name);

// get the system date and time
$system_time = date("m/d/Y H:i:s A");
$systime_month = date ("m");
$systime_day = date ("d");
$systime_year = date ("Y");
$systime_hour = date ("H");
$systime_minute = date ("i");
$systime_second = date ("s");
session_start();


//check if logged-in
 if(empty($_SESSION['profilestats'])){
 	header('Location: user_login.php');
 }




 $usr_type 		= $_SESSION['profilestats'];
 $fname			= $_SESSION['accfname'];
 $mname			= $_SESSION['accmname'];
 $lname			= $_SESSION['acclname'];
 $mobile		= $_SESSION['accmobile'];
 $email		    = $_SESSION['accemail'];
 $usrname		= $_SESSION['accusrname'];

 require_once('config/main.php');
 require_once('config/links.php');

?>

<script>
	var datetoday = '<?php echo date('m/d/Y');?>';
	var timenow = '<?php echo date('h:i A');?>';

    var myaccount_fname = "<?php echo $fname;?>";
    var myaccount_lname = "<?php echo $lname;?>";
    var myaccount_mname = "<?php echo $mname;?>";
    var myaccount_mobile = "<?php echo $mobile;?>";
    var myaccount_email = "<?php echo $email;?>";
</script>	
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />		
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />        
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />		

<link rel="stylesheet" href="./libraries/styles.css?<?php echo rand();?>" type="text/css" />
<link rel="stylesheet" href="./assets/css/main.css?<?php echo rand();?>" type="text/css" />
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/bower_components/jquery-ui/themes/blitzer/jquery-ui.css" />
<script src="./js/jquery.countdown.js"></script>
<script type="text/javascript" src="./js/jquery.countdownTimer.js"></script>




<script type="text/javascript">
	
</script>
</head>



<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li id="homepage"><a href="/">Home</a></li>
        <li id="myaccount"><a>My Account</a></li>
        <li class="dropdown">
          <a dp href="javascript:void(0);">Applications <span class="caret"></span></a>
          <div class="dropdown-open-backdrop"></div>
          <ul class="dropdown-menu">
       <?php
      	foreach ($config['links'] as $name => $value) {
		  	 $link = !empty($value['link']) ? $value['link'].'.php' : 'javascript:dpremove();';
    			if(count($value['options'])>0){
    				  echo '<li class="dropdown"><a dp href="javascript:void(0);">'.$name.' <i class="fa fa-caret-right"></i></a><ul class="dropdown-menu sub-link">';
    			 	foreach($value['options'] as $subname => $subvalue){
    			 		$sublink = !empty($subvalue) ? $subvalue.'.php' : 'javascript:dpremove();';
    					echo '<li><a href="'.$sublink.'">'.$subname.'</a></li>';				 		
    			 	}
    				echo '</ul></li>';		
    			}else{
    				echo '<li><a href="'.$link.'">'.$name.'</a></li>';				        			
    			}

      	}
       ?>
            
          </ul>

        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
         <?php 
            foreach ($config['right_links'] as $name => $value) {
              echo '<li><a href="'.$value['link'].'.php">'.$name.'</a></li>';
            }
         ?>
         
         
         <li logout><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div id="myaccountmodal" class="modal fade col-sm-12 " role="dialog">
    <div class="modal-dialog custom-class">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">My Account</h4>
            </div>

            <div class="modal-body myaccountupdate">
            <form>
            <fieldset>
                <?php   echo construct_form($config['myaccount']);    ?>          
            </fieldset>
            </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="updatemyaccount">
                    <i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Update
                </button>
                <button type="button" class="btn btn-default" id="changepwmyaccount">Change Password</button>
                <button type="button" class="btn btn-default" id="resetmyaccount">Reset</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>   


<div id="mypasswordmodal" class="modal fade col-sm-12 " role="dialog">
    <div class="modal-dialog custom-class">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>

            <div class="modal-body myaccount_password">
            <form>
            <fieldset>
                <?php   echo construct_form($config['mypassword']);    ?>          
            </fieldset>
            </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="updatemypassword">
                    <i class="fa fa-circle-o-notch fa-spin hide" style=""></i>Change Password
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>   

<body>


	<div class="scrollingContainer">
	<div class="subContainer" style="width: 80%;">
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div style="" class="header-container">

			<a href="homepage.php"  class="col-sm-2">
			<img src="./img/CBL.png" alt="" title="" border=0>
			</a>

			<h2 class="moduletitle col-sm-10">Warehouse Management System (WMS)</h2>

		</div>
 		<div style="clear: left; padding-left: 5px; height: 30px;" class="normalTextSmall">
 			Welcome!
			<br>
 			<div style="clear: left; float: left; width: 250px;">
			System Date/Time: <span id="systemTimeContent"><? echo $system_time ;?></span>
			</div>
			<div style="float: left;">
			
			Your session will expire in <span id="timerContent"></span>
			
			</div>
 		</div>



    