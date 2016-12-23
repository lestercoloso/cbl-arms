<?php

error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
session_start();
date_default_timezone_set("Asia/Manila");

require_once("db_connect.php");
require_once("header.php");


/**
* 
*/
class VehicleClass extends Database
{
	
	function __construct()
	{
	//	parent::__construct();
	}


	//public function
}

?>

<head>
	<style type="text/css">
		
		.class{
			text-align: center;
		}
	</style>
	<script type="text/javascript">

	


	$(document).ready(function(){
		
		getVehicle();
	})

	var updateVehicle = function(id,vno,vdesc,type,pno,stats){
		$('#upVno').val(vno);
		$('#upVdesc').val(vdesc);
		$('#upVstatus').val(stats);
		$('#upPlateno').val(pno);
		$('#UpVehicleDialog').dialog('open');
	}
	var getVehicle = function(){
		var a = $('#txtVno').val();
		var b = $('#txtPno').val();
		var c = $('#txtSVectype').val();
		var d = $('#txtVstats').val();

		$.post('addVehicle.php',{action:"SEARCH",svno:a,spno:b,stype:c,sstats:d},function(data){

			var back = 0;
			var color ='#F2F2F2';
			$('#tblVehicle tbody').empty();
			$.each(data,function(index,value){

				if (back==0){
       					color ='#FFF9F9';
       					back=1;
				}else{
						color= "#F2F2F2";	
						back=0;
				}
				$('#tblVehicle tbody').append("<tr style='background-color:"+color+"'><td>"+value.vno+"</td><td>"+value.vdesc+"</td><td>"+value.type+"</td><td>"+value.pno+"</td><td>"+value.stats+"</td><td><input type='button' name='' value='Edit' class='search' onclick='updateVehicle(\""+value.id+"\",\""+value.vno+"\",\""+value.vdesc+"\",\""+value.type+"\",\""+value.pno+"\",\""+value.stats+"\");'></td></tr>");

				
			})

		},"JSON");
	}
	var clearThis = function(){
		$('#SearchBox').find('input:text').val('');
		$('#SearchBox').find('input:checkbox').val('');

	}
	var addVehicle = function(){
		$('#addVehicleDialog').dialog("open");
	}
		
		$(function(){
			$('#UpVehicleDialog').dialog({
		
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
			    width: 350,
			    height: 300,
			    buttons: {
			    	"Update ":function(){
			    		var a = $('#upVno').val();
			    		var b = $('#upVdesc').val();
			    		var c = $('#upPlateno').val();
			    		var d;
			    			$('input:radio[name=upcheck]').each(function() 
							{    
	   								 if($(this).is(':checked'))
	     							d = $(this).val();
							});

						var e = $('#upVstatus').val();

						$.post('addVehicle.php',{action:"UPDATE_DATA",upvno:a,upvdesc:b,uppno:c,upvtype:d,upstats:e},function(data){

						})
			    	},
			    	"Cancel":function(){

			    	}
			    }})
			$('#addVehicleDialog').dialog({
		
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
			    width: 350,
			    height: 300,
			    buttons: {
			    	"Save":function(){
			    			var a = $('#addVno').val();
			    			var b = $('#addVdesc').val();
			    			var c = $('#addPlateno').val();
			    			var d;
			    			$('input:radio[name=Addcheck]').each(function() 
							{    
	   								 if($(this).is(':checked'))
	     							d = $(this).val();
							});
							var e = $('#addVstatus').val();

							$.post('addVehicle.php',{action:"INSERT_DATA",vno:a,vdesc:b,pno:c,vtype:d,stats:e},function(data){
									alert(data);		
							})
			    	},
			    	"Cancel":function(){
			    		$(this).dialog('close');
			    	}
			    }
			    })
		})
	</script>
</head>


<body onResize="updateToolbarPos();">
	<div class="scrollingContainer">
	<div class="subContainer">
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div style="clear: left; float: left;"><a href="homepage.php"><img src="" width=445 height=70 alt="" title="" border=0></a></div><br>
 		<div style="clear: left; padding-left: 5px; height: 30px;" class="normalTextSmall"><br>

 			Welcome <b><?php echo $_SESSION['profilename'];?></b> <?php echo " (" .$_SESSION['profilestats'] . ")" ; ?>
			<br>
			<div style="clear: left; float: left; width: 250px;">
			Last Login: <span id="head_lastlogin"></span><a href="">[view log]</a>
			</div>
 			<div style="clear: left; float: left; width: 250px;">
			System Date/Time: <span id="systemTimeContent"><?php echo $system_time ;?></span>
			</div>
			<!--<div style="float: left;">
			Your session will expire in <span id="timerContent"><?php echo "NEED HEADER HERE"; ?>:00</span>
			</div>-->
			<div style="clear: left; float: left; width: 250px;">
			<select id="selPort" style="width: 110px;">
				<!--<option value="outbound.php">Outboud</option>
				<option value="inbound.php" selected>Inbound</option>
				<option value="warehouse.php">Warehouse</option>-->
			</select><span id=""> </span><a onclick="switchPortal();" id="switchPort" style="cursor: pointer;text-decoration: underline;">[switch]</a>
			</div>

 		</div>
 		<br>
 		<div style="clear: left; width: 970px;padding-bottom: 30px;
    margin-bottom: 100px; background-color: #fff; border: solid 1px #999;margin-top: 20px;">
 			<div style="margin-left: 50px;margin-bottom: 40px;"><h1 style="color:#999999">Vehicle Information</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
 			<div>
 				<div align="center" style="margin-left: auto;margin-right: auto;clear: left; width: 948px; height: auto; border: solid 1px #ddd; background-color: #eee; background-image: url('../images/background.gif');">

			<!-- Header of Search FORM  -->
				<div class="boldTextSmall" style="clear: left; width: 948px; height: 20px; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;">

					<!-- Archive and Live Link at the Top of Search FORM -->
						<div style="clear: left; float: left; width: 5px;"><!-- --></div>

					<!-- Archive and Live Link at the Top of Search FORM -->

						<div style="clear: left; width: 948px; height: 20px; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;" class="boldTextSmall">
						<div style="clear: left; float: left; width: 5px;"><!-- --></div>
						<div style="float: left; width: 7px; height: 20px; background-image: url('../images/left_handle.gif');"><!-- --></div>
				</div>
			
				</div>
					<div id="SearchBox" style="">
					<div id="1search" style="float:left;padding: 10px;">
				<table>
							<tbody>
							<tr>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Vehicle No.</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="txtVno" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Plate No.</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="txtPno" name="">
												</td>
											</tr>
											
										</tbody>
									</table>
								</td>
								<td width="300px">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Vehicle Type</td>
												<td class="boldTextSmall">
												<select id="txtSVectype" name="">
													<option selected disabled>-- Select Vehicle Type --</option>
													<option >Vehicle A</option>
												</select> 
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Status</td>
												<td class="boldTextSmall">
												<select id="txtVstats" name="">
													<option selected disabled>-- Select Status --</option>
													<option >Status A</option>
												</select> 
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
											<td>
												<input type="button" name="" value="Search" class="search" onclick="getVehicle();"><span> </span><span> </span>	<input type="button" name="" value="Cancel" class="search" onclick="clearThis();">
											</td> 
											<td>
											<input type="button" name="" value="Add Vehicle" class="search" onclick="addVehicle();">
											</td>
											</tr>
											<tr>
												<td>
													
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>

				</div>
				<div style="clear:both"></div>
				</div>

			</div>
			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div  style="    margin-left: 11px;margin-right: 11px;">
			<table class="tbl" id="tblVehicle" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
			<thead class="listHeaders">
			<tr style="cursor:pointer;color: #464646;">
			<th style="border-right: 1px solid #fff;height: 20px">Vehicle No</th>
			<th style="border-right: 1px solid #fff;">Vehicke Description</th>
			<th style="border-right: 1px solid #fff;">Plate No</th>
			<th style="border-right: 1px solid #fff;">Vehicle Type</th>
			<th style="border-right: 1px solid #fff;">Status</th>
			<th style="border-right: 1px solid #fff;">Action</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
</div>

			<!-- DIALOG-->

			<div style="display: none;" id="addVehicleDialog" title="Add New Vehicle">
				<table>
						<tbody>
							<tr>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Vehicle No</td>
												<td class="boldTextSmall"><input class="boldTextSmall" type="text" id="editID" name="" style="display: none">
												<input class="boldTextSmall" type="text" id="addVno" name="" >
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Vehicle Description</td>
												<td class="boldTextSmall">
												<textarea class="boldTextSmall" id="addVdesc" style="resize: none;"></textarea>
												</td>
												
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Plate No</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="addPlateno" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Vehicle Type</td>
												<td class="boldTextSmall">
												<input type="radio" name="Addcheck" value="1"><span style="width: 30px">Type 1</span>
												<input type="radio" name="Addcheck" value="2"><span>Type 2</span>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Status</td>
												<td class="boldTextSmall">
												<select id="addVstatus" style="width: 150px;">
													<option selected disabled>-- Select Status --</option>
													<option>Status A</option>
													<option>Status B</option>
													<option>Status C</option>
												</select>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>	
			</div>
		<div style="display: none;" id="UpVehicleDialog" title="Add New Vehicle">
				<table>
						<tbody>
							<tr>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Vehicle No</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="upVno" name="" disabled>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Vehicle Description</td>
												<td class="boldTextSmall">
												<textarea class="boldTextSmall" id="upVdesc" style="resize: none;"></textarea>
												</td>
												
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Plate No</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="upPlateno" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Vehicle Type</td>
												<td class="boldTextSmall">
												<input type="radio" name="upcheck" value="1"><span style="width: 30px">Type 1</span>
												<input type="radio" name="upcheck" value="2"><span>Type 2</span>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Status</td>
												<td class="boldTextSmall">
												<select id="upVstatus" style="width: 150px;">
													<option>Status A</option>
													<option>Status B</option>
													<option>Status C</option>
												</select>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>	
			</div>
</body>
