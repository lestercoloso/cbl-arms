<?php

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
?>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="./libraries/styles.css?<?php echo rand();?>" type="text/css" />
<!-- <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" /> -->
<!-- <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/bower_components/jquery-ui/themes/blitzer/jquery-ui.css" />
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/blitzer/jquery-ui.css" /> -->
<script src="./js/jquery.countdown.js"></script>
<script type="text/javascript" src="./js/jquery.countdownTimer.js"></script>

<script type="text/javascript">
var hasMenu = 0;
var menuTimer;
var menuOffSpeed = 500;
var scrollbarOffset = 5;
var toolbarWidth = document.documentElement.clientWidth-scrollbarOffset;
var innerSpacing = toolbarWidth - 12;
var acc02 = 0;
var acc03 = 0;


$(document).ready(function(){
		$('#myAccountDialog').dialog({
			    modal: true,
			    autoOpen: false,
			    draggable: false,
			    resizable: false,
			    show: {
			    		effect:'blind'
			    },
			    hide: {
			    		effect:'blind'
			    },
			    width: 400,
			    height: 430,
			    buttons:{
			    	"Update Password":function(){

			    			var a = $('#txtAccID').val();
							var g = $('#txtAccpass').val();
			    			var h = $('#txtAccconpass').val();
			    				
			    			if(g==''){
			    					alert('Password is a required field.');
			    			}else if(h==''){
			    					alert('Confirm Password is a required field.');
			    			}else if(g.length < 5 && g.length >=1){
			    					alert('Min length is 5 characters.');
			    			}else if(h.length < 5 && h.length >=1){
			    					alert('Min length is 5 characters.');
			    			}else if(g != h ){
									alert('Password did not match.');
							}else{

									$.post('myAccount.php',{id:a,pass:g,def:0},function(data){

			    						if (data=="1") {

			    							alert("Password successfully updated.");
			    						//	getUserdatas();
			    						//$('#UpuserDialog').dialog('close');
			    					}
			    					})
							}
			    	},"Update User":function(){
			    			var a = $('#txtAccID').val();
							var b = $('#txtAccfname').val();
							var c = $('#txtAccmname').val();
							var d = $('#txtAcclname').val();
							var e = $('#txtAccmobile').val();
							var f = $('#txtAccemail').val();
							var g = $('#txtAccpass').val();
							var h = $('#txtAccconpass').val();
							if((g.length < 5 && g.length >=1)|| (h.length < 5 && h.length >=1)){
									alert('Password Min length is 5 characters.');
							}else if(b==""){
			    				alert("First Name is a required field.");
			    			}else if(d==""){
			    				alert("Last Name is a required field.");
			    			}else if(e==""){
			    				alert("Mobile Number is a required field.");
			    			}else if(f==""){
			    				alert("Email Address is a required field.");
			    			}else if (!ValidateEmail(f)) {
            						alert("Email Address must be in the format email@<domain name>.");
        					}else if(e.substring(0, 3)!="+63"){
			    				alert("Mobile Number format +63xxxxxxxxxx (e.g +639999999999).");
			    			}else if(e.length < 13){
			    				alert("Mobile Number format +63xxxxxxxxxx (e.g +639999999999).");
			    			}else{

							$.post('myAccount.php',{uid:a,fname:b,mname:c,lname:d,mobile:e,email:f,def:1},function(data){

									if (data=='1') {
										alert("Account Successfully Updated.");
										
									}else{

									}

							});
						}
			    	},
			    	"Cancel":function(){
			    		restoreAccount();
			    	}
			    }
			 
	});

	$("#timerContent").countdowntimer({
	    minutes : 20
	  });


	$(".regvalidation").on('keypress',function(event) {
	var regex = /^[A-Za-z0-9-_?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert("Login ID must be alphanumeric and special characters (-, _) only");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }

    if ($(this).val().length >=25) {
    	alert('Max length is 25 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
});

	$(".usrnamevalidation").on('keypress',function(event) {
	var regex = /^[A-Za-z0-9-_?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert("Username must be alphanumeric and special characters (-, _) only");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }

    if ($(this).val().length >50) {
    	alert('Max length is 50 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
});
	$("#txtPage").on('keypress',function(event) {
	var regex = /^[0-9?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert("Please use numeric entries.");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }

    
});
	

});

var restoreAccount = function(){

	$('#txtAccID').val('<?PHP echo  $usrname;?>');
	$('#txtAccfname').val('<?PHP echo  $fname;?>');
	$('#txtAccmname').val('<?PHP echo  $mname;?>');
	$('#txtAcclname').val('<?PHP echo  $lname;?>');
	$('#txtAccmobile').val('<?PHP echo  $mobile;?>');
	$('#txtAccemail').val('<?PHP echo  $email; ?>');
}

 var showDialogAccount = function(){
 	$('#myAccountDialog').dialog('open');
 }
document.write('<div id="toolbar" style="position: absolute; top: 0px; left: 0px; width: '+toolbarWidth+'px; height: 33px; overflow: hidden; z-index: 10;">');
document.write('	<div id="innerToolbar" style="width: '+innerSpacing+'px; height: 33px; background-image: url(\'./img/toolbar_ct.png\');">');
document.write('		<div class="tbDividerLeft"><!-- --></div>');
document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');

var page = "<?php echo $usr_type; ?>";



document.write('		<div class="toolbarCellLeft" title="Back to Home"><a href="homepage.php" class="tbTextSmall" style="color: #b00;">Home</a></div>');
document.write('		<div class="tbDividerLeft"><!-- --></div>');
document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
document.write('		<div class="toolbarCellLeft" title="Open your profile and other setting"><span onClick="showDialogAccount();" class="tbTextSmall" style="color: #b00;cursor:pointer"><b>My Account</span></div>');
document.write('		<div class="tbDividerLeft"><!-- --></div>');
document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
document.write('		<div class="toolbarCellLeft" title="" onMouseOver="showTools(\'toolsMenu\',1);" onMouseOut="showTools(\'toolsMenu\',0);showTools(\'Main_Menu\',0);"><a href="javascript:void(0);" class="tbTextSmall" style="color: #b00;">Applications</a></div>');
document.write('		<div class="tbDividerLeft"><!-- --></div>');
document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');

document.write('		<div class="toolbarCellRight" title="Logout from the SM Trade Portal"><a href="logout.php" class="tbTextSmall" style="color: #b00;">Logout</a></div>');
document.write('		<div class="tbDividerRightShadow"><!-- --></div>');
document.write('		<div class="tbDividerRight"><!-- --></div>');
document.write('	</div>');
document.write('</div>');

function updateToolbarPos()
	{
	// re-calculate the toolbar width
	var scrollbarOffset = 5;
	var toolbarWidth = document.documentElement.clientWidth-scrollbarOffset;
	var innerSpacing = toolbarWidth - 12;
	document.getElementById('toolbar').style.width = toolbarWidth + 'px';
	document.getElementById('innerToolbar').style.width = innerSpacing + 'px';
	}

function showTools(menuID, action)
	{
	if (action==0)
		{
		// switch off the tools menu
		// start timer for the switching off of the menu
                hasMenu=0;
		setTimeout('menuOff(\''+menuID+'\');', menuOffSpeed);
		$("#Main_Menu").fadeOut(100, "linear");
		}
	else
		{
		// switch on the tools menu
                hasMenu = 1;
                $("#"+menuID).fadeIn(200, "linear");
                // $("#"+menuID).slideDown(300, 'swing');
		}
	}

	function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };



function menuOff(menuID)
	{
        if (hasMenu==0)
		{
                $("#"+menuID).fadeOut(100, "linear");
                // $("#"+menuID).slideUp(300, 'swing');
		}
	}

var validateName = function(event,name,id) {
	var regex = /^[0-9A-Za-z- ?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert(name+" must be alphanumeric and special characters (-) only.");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }

    if ($('#'+id).val().length >=25) {
    	alert('Max length is 25 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
}
var validateFullName = function(event,name,id) {
	var regex = /^[A-Za-z ?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert(name+" must be alpha characters only.");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }

    if ($('#'+id).val().length >=25) {
    	alert('Max length is 25 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
}

var validateName1 = function(event,name,id) {
	var regex = /^[A-Za-z0-9 ?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert(name+" must be alphanumeric characters only.");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }

    if ($('#'+id).val().length >=25) {
    	alert('Max length is 25 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
}


var validateNumber = function(event,name,id) {
	var regex = /^[+0-9?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
    if(regex.test(key)==false) {
    	alert(name+" must be numberic characters only.");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }


    if ($('#'+id).val().length >=13) {
    	alert('Max length is 13 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
}
	var validateEmail = function(event,name,id) {
		var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
	
    if ($('#'+id).val().length >= 50) {
    	alert('Max length is 50 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
}
	var validatePassword= function(event,name,id) {
	var regex = /^[A-Za-z0-9?]$/;
    var _event = event || window.event;
    var key = _event.keyCode || _event.which;
    key = String.fromCharCode(key);
   /* if(regex.test(key)==false) {
    	alert(name+" must be in the format email@<domain name>.");
        _event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }*/

    if ($('#'+id).val().length >=15) {
    	alert('Max length is 15 characters.');
    	_event.returnValue = false;
        if (_event.preventDefault)
            _event.preventDefault();
    }
}

	
</script>
</head>


<div id="toolsMenu" style="position: absolute; top: 30px; left: 165px; width: 300px; height: auto; background-color: #bbb; z-index: 10; display: none;" onMouseOver="showTools('toolsMenu',1);" onMouseOut="showTools('toolsMenu',0);">
	
	<?php if($usr_type =="System Administrator"){
	?>
	<div style="color:#b00;" class="tbMenuItems" onClick="location.href='uaccess.php';">User Administration</div>
	<?php 
	}else{
	}?>
	<div style="color:#b00;" class="tbMenuItems" onClick="" onMouseOver="showTools('Main_Menu',1);" onMouseOut="showTools('Main_Menu',0);">Maintenance</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Customer Information</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Booking</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Warehouse</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Bill of Lading</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Billing</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Collection Call Out</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Payment</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Reports</div>
</div>
<div id="Main_Menu" style="position: absolute; top: 30px; left: 465px; width: 300px; height: auto; background-color: #bbb; z-index: 10; display: none;" onMouseOver="showTools('Main_Menu',1);" onmouseleave="showTools('Main_Menu',0);">
	<div style="color:#b00;" class="tbMenuItems" onClick="location.href='genSetting.php';">General Settings</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="location.href='driverProfile.php';">Driver Information</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="location.href='vehicle.php';">Vehicle Information</div>
	<div style="color:#b00;" class="tbMenuItems" onClick="">Location Management</div>
	
</div>


<div id='myAccountDialog' style='display:none;' title='My Account'>
	<table>
		<tbody>
			<tr>
				<td class='' style='width: 200px;'><h2>My Account</h2></td>
			</tr>
			</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">User ID</td>
				<td><input type="text" class="regvalidation"  id="txtAccID" name="" style="width: 150px;" value="<?php echo $usrname;?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">First name</td>
				<td><input type="text" id="txtAccfname" onkeypress="validateName(event,'First Name','txtAccfname');"  class="" style="width: 150px;" value="<?php echo $fname;?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">Middle name</td>
				<td><input type="text" id="txtAccmname" onkeypress="validateName(event,'Middle Name','txtAccmname');"  class="" style="width: 150px;" value="<?php echo $mname;?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">Last name</td>
				<td><input type="text" id="txtAcclname" onkeypress="validateName(event,'Last Name','txtAcclname');"  class="" style="width: 150px;" value="<?php echo $lname;?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">Mobile no.</td>
				<td><input type="text" id="txtAccmobile" onkeypress="validateNumber(event,'Mobile No.','txtAccmobile');" class="" style="width: 150px;" value="<?php echo $mobile;?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">Email Address</td>
				<td><input type="text" id="txtAccemail" onkeypress="validateEmail(event,'Email Address','txtAccemail');" class="" style="width: 150px;" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;"><span>  </span></td>
				
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">Password</td>
				<td><input type="Password" onkeypress="validatePassword(event,'Password','txtAccpass')" id="txtAccpass" class="" style="width: 150px;" value="<?php ?>"></td>
			</tr>
			<tr>
				<td class="boldTextSmall" style="width: 100px;">Confirm Password</td>
				<td><input type="Password" onkeypress="validatePassword(event,'Password','txtAccconpass')" id="txtAccconpass" class="" style="width: 150px;" value="<?php?>"></td>
			</tr>
		</tbody>
	</table>
</div>

