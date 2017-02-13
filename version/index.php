<br>
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="../bower_components/chosen/chosen.css"/>


<style>
body{
	background-image: url("includes/images.jpg");
}
* {
    white-space: nowrap;
}

select, input{
	padding: 0px 5px;
}

td{ padding: 5px; }
label{ float: left; }
.loader{
	display: none;
}
.patch_loader{
	display: none;
}
.result{
	 border: 1px solid #ccc!important;
	 border-radius: 16px!important;
	 padding: 15px;
	 height: 450px;
	 overflow: auto;
	 background: black;
	 color: white;
}

</style>
<link rel="stylesheet" type="text/css" href="includes/chosen.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="includes/jquery-ui.css"/>
<body>
<?php

$_COOKIE['server_path'] = isset($_COOKIE['server_path']) ? $_COOKIE['server_path'] : '';
$_COOKIE['gitusr'] = isset($_COOKIE['gitusr']) ? $_COOKIE['gitusr'] : '';
$_COOKIE['gitpss'] = isset($_COOKIE['gitpss']) ? $_COOKIE['gitpss'] : '';
$devmode = isset($_COOKIE['devmode']) ? $_COOKIE['devmode'] : '';

	$dbhost = isset($_COOKIE['dbhost']) ? $_COOKIE['dbhost'] : '';
	$db 	= isset($_COOKIE['db']) ? $_COOKIE['db'] : '';
	$dbusr 	= isset($_COOKIE['dbusr']) ? $_COOKIE['dbusr'] : '';
	$dbpss 	= isset($_COOKIE['dbpss']) ? $_COOKIE['dbpss'] : '';
?>
<div class="container col-sm-6">

	<div class="form-group col-sm-12 ">
		  <div class="col-sm-6">
			 <button type="button" class="btn btn-default hide" data-toggle="modal" data-target="#login-modal">Store your Github</button>
			 <button type="button" class="btn btn-default" data-toggle="modal" id="updatebutton">
			 <span class="glyphicon glyphicon-repeat fast-right-spinner fa-spin"> </span>Update <em></em></button>		
			 <?php 

if($devmode=='on'){
echo '<button type="button" class="btn btn-default" data-toggle="modal" id="updatebutton" onclick="dev_mode(\'off\')"> Dev Mode Off </button>';
}else{
echo '<button type="button" class="btn btn-default" data-toggle="modal" id="updatebutton" onclick="dev_mode(\'on\')"> Dev Mode On </button>';
}


			 ?>
		
		  </div>
	</div>


	

	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Application Branch : </label>
		  <div class="col-sm-8" id="branch_container">
			  <div class="col-sm-10 row"><select class="form-control" id="branch" placeholder="Select a branch" ></select></div>
			  <div class="col-sm-2 loader"> <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;position: relative;top: 4px;"></i></div>
		  </div>
	</div>

	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Database Patcher : </label>
		  <div class="col-sm-5" id="branch_container">
			  <div class="col-sm-10 row"><select class="form-control" id="patcher" placeholder="Select a version" ></select></div>
			 <div class="col-sm-2" >
		  	 	<button type="button" class="btn btn-success" id="patcher_button"> <span class="patch_loader glyphicon glyphicon-repeat fast-right-spinner fa-spin"> </span> Patch!</button>
		  	 </div>
		  </div>

	</div>



	<div class="col-sm-12" style="border-bottom:1px solid black;"">
	</div>

	<label class="col-sm-12"><br>Config<br><br></label>

	<div class="form-group col-sm-12">
	    <label class="col-sm-4" for="db_host">Database Status : </label>
	    <div class="col-sm-8 db_status">
			<b style='color:#b41011;'>Not Connected</b>
	    </div>
	</div>	





	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Database Version : </label>
		  <div class="col-sm-6" id="database_version">
			  <b>0.00</b>
		  </div>
	</div>

	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Host : </label>
		  <div class="col-sm-5">
			<input type="text" id="host" placeholder="Enter host" class="form-control">
		  </div>
	</div>

	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Database : </label>
		  <div class="col-sm-5">
			 <input type="text" id="database" placeholder="Enter database" class="form-control">
		  </div>
	</div>

	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Username : </label>
		  <div class="col-sm-5">
			 <input type="text" id="usr-config" placeholder="Enter username" class="form-control">
		  </div>
	</div>

	<div class="form-group col-sm-12">
		  <label for="stype" class="col-sm-4" >Password : </label>
		  <div class="col-sm-5">
			 <input type="password" id="pss-config" placeholder="Enter password" class="form-control">
		  </div>
	</div>

	<div class="form-group col-sm-12">
		  <div class="col-sm-6">
			 <button type="button" class="btn btn-success chngdb">Change Config</button>
		  </div>
	</div>


</div>



<div class="container col-sm-4  col-md-offset-1 result">



</div>







		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Store your github account</h1><br>
				  <form>
					<input type="text" class="col-sm-12" name="user" id="git-user" value="<?php echo $_COOKIE['gitusr']?>" placeholder="Username">
					<input type="password" class="col-sm-12" name="pass" id="git-pass" value="<?php echo $_COOKIE['gitpss']?>" placeholder="Password">
					<input type="button" name="login" class="login loginmodal-submit col-sm-12 store" value="Store" data-dismiss="modal" >
				  </form>
				</div>
			</div>
		  </div>






<script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../bower_components/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="includes/jquery-ui.js"></script>


<script>
var devmode = "<?php echo $devmode?>";
	function getbranch(){
		var path = $('#application_path').val();
		var content = "";
		$('#branch_container .loader').show();
		var error = '';
		var select = '';
		$('#branch').chosen('destroy');
		$.post("backend/getbranch",{path:path}, function(data){
		
		if(data.config){
			$('#host').val(data.config.host);
			$('#database').val(data.config.database);
			$('#usr-config').val(data.config.username);
			$('#pss-config').val(data.config.password);
			useDb();	
		}else{
			$('#host').val('');
			$('#database').val('');
			$('#usr-config').val('');
			$('#pss-config').val('');	
		}
		

			if(data.status==200){


				$.each(data.data, function( index, value ) {
					if(data.current_branch==value){
						select = 'selected';
					}else{
						select = '';
					}
					content += '<option value"'+value+'" '+select+'>'+value+'</option>';
				});	
			}else if(data.status==101){
				error = 'Invalid application path';
			}else if(data.status==100){
				error = 'Invalid file directory';
			}else{
				error = 'error';
			}
			if(path==''){
				error = '';
			}
			gitResult(data.git);
			useDb();
			$('#application_version').html("<b>"+data.version+"</b>");
			$('#application_path_error').html(error);
			$('#branch').html(content);
			$('#branch_container .loader').hide();
			$('#branch').chosen({search_contains: true, no_results_text: "add?"});
		});
	}

	function changeBranch(){
		var branch = $('#branch').val();
		var path = $('#application_path').val();
		$('#branch_container .loader').show();
		$.post("backend/changeBranch",{branch:branch, path:path}, function(data){
			
			$('#host').val(data.config.host);
			$('#database').val(data.config.database);
			$('#usr-config').val(data.config.username);
			$('#pss-config').val(data.config.password);

			gitResult(data.data);
			$('#application_version').html("<b>"+data.version+"</b>");
			$('#branch_container .loader').hide();
			checkUpdates();
			useDb();
		});
	}

	function useDb(t){
		var host 	 = $('#host').val();
		var database = $('#database').val();
		var username = $('#usr-config').val();
		var password = $('#pss-config').val();

		// document.cookie = "dbhost="+host;
		// document.cookie = "db="+database;
		// document.cookie = "dbusr="+username;
		// document.cookie = "dbpss="+password;
		var path = $('#application_path').val();
		$('.db_status').html('<b style="color: #348c34;">Connecting...</b>');
		$.post("backend/changeConfig",{t:t, path:path, host:host, database:database, username:username, password:password}, function(data){
			
			if(data){
				$('.db_status').html(data.status);
				$('#database_version b').html(data.version);
			}else{
				$('.db_status').html('<b style="color: #348c34;">Incompatible</b>');
				$('#database_version b').html('0.00');
			}
				getpatcher();		
		}).fail(function(){
			$('.db_status').html('<b style="color: #348c34;">Incompatible</b>');
			$('#database_version b').html('0.00');
		});

	}

	function gitResult(data){
		var content = '';
		$.each(data, function( index, value ) {
			content += value+"<br>";
		});	
		$('.result').html(content);

	}

	function checkUpdates(){
		$.post("backend/checkUpdates",{}, function(data){
			$('#updatebutton em').html(data);
		});
	}

	function gitUpdate(){
			$('#updatebutton span').show();
			var branch = $('#branch').val();
		$.post("backend/gitUpdate",{branch:branch}, function(data){
			gitResult(data);
			if(data.length==0){
				alert('Please store your correct github account.');
			}
			$('#updatebutton span').hide();
			checkUpdates();
			useDb();
		});
	}

	function getpatcher(){
		var version = $('#database_version b').html();
		var content = '';
		$.post("backend/getpatcher",{version:version}, function(data){
			$.each(data, function( index, value ) {
					var select = '';
				if(version==value){
					select = 'selected';
				}
				if(value>version || devmode=='on'){
					content += '<option value"'+value+'" '+select+'>'+value+'</option>';
				}
			});
			if(content.trim()==''){
				$('#patcher_button').hide();
			}
			$('#patcher').html(content);
		});
	}


	function patch(version){
		$('.patch_loader').show();
		$.post("backend/patch/"+version,{}, function(data){
			alert(data.status);
			if(data.status=="success"){
				$('#database_version b').html(version);
				$('.result').html(data.result);
			}
			$('.patch_loader').hide();
		});

	}

	function dev_mode(t){
		document.cookie = "devmode="+t;
		window.location="";
	}


	$('#application_path').bind('keydown, change', function(event){
		event.preventDefault();
		document.cookie = "server_path="+$(this).val();
		getbranch();
	});

	$('#patcher_button').click(function(){		
		patch($('#patcher').val());
	});

	$('.store').click(function(){
		document.cookie = "gitusr="+$('#git-user').val();
		document.cookie = "gitpss="+$('#git-pass').val();
	});
	$('#branch').change(function(){
		changeBranch();
	});

	$('.chngdb').click(function(){
		useDb('change');
	});
	$('#updatebutton').click(function(){
		gitUpdate();
	});
	$('#updatebutton span').hide();
	// useDb();
	checkUpdates();
	getbranch();




</script>