<?php

session_start();
$_SESSION['page']="genSetting";


require_once('header.php');

?>

<head>
	<style type="text/css">
		#SearchBox{
		display: block;
	    width: 947px;
	    height: auto;
	    background-color: #eee;
	    /*background-image: url(/images/background.gif);*/

	    border: solid 1px #999;
	    display: block;
	    margin-left: auto;
	    margin-right: auto;
	    position: absolute;
	}

			.center{
			}
	</style>
	<script type="text/javascript">
		


		var selectModule =function (){
			$('#moduleChecker').val();
			var current_view = $('#moduleChecker').val();
			if (current_view=="Customer Info") {
				$('#csSet').css("display","block");
				$('#InboundSet').css("display","none");
				$('#BookSet').css("display","none");
			}else if(current_view=="Booking"){
				$('#csSet').css("display","none");
				$('#InboundSet').css("display","none");
				$('#BookSet').css("display","block");
			}else if(current_view=="Inbound Shipment"){
				$('#csSet').css("display","none");
				$('#InboundSet').css("display","block");
				$('#BookSet').css("display","none");
			}


		}



		var addItem = function(column,name,div,title){


				$('#'+div).append("<div id="+name+" style='display:none;' title='Add "+ title +"'></div>")
				$("#"+name).dialog({
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
				    height: 320,
				    buttons: {
				    	"Save":function(){

				    	},
				    	"Close":function(){

				    	}
				    }
				});

				$('#'+name).dialog('open');
		}
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
			<div style="float: left;">
			Your session will expire in <span id="timerContent"></span>
			</div>
			<div style="clear: left; float: left; width: 250px;">
			<select id="selPort" style="width: 110px;">
				<option value=""></option>
				<option value=""></option>
				<option value=""></option>
			</select><span id=""> </span><a style="cursor: pointer;text-decoration: underline;" id="switchPort" onclick="switchPortal();">[switch]</a>
			</div>

 		</div>
 		<br>
 		<div style="clear: left; width: 970px;height:610px;padding-bottom: 30px;margin-bottom: 100px; background-color: #fff; border: solid 1px #999;margin-top: 20px;position: absolute;">
 			<div style="margin-left: 50px;margin-bottom: 40px;"><h1 style="color:#999999">General Settings</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
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
						<div style="float: left; width: 921px; height: 20px;" class="boldTextSmall" align="left">
								<div class="buff3"><!-- --></div>


						</div>


				</div>
				</div>
				<div id="SearchBox" style="">
				<div id="1search" style="padding: 10px;">
					<div style="margin:20px;">
						<select id="moduleChecker" style="width: 160px" onchange="selectModule();">
											<option selected disabled>-- View Module Type --</option>
											<option  value="Customer Info">View Customer Info</option>
											<option  value="Booking">View Booking</option>	
											<option  value="Inbound Shipment">View Inbound Shipment</option>		
						</select>
					</div>
					<div id="csSet" style="float:left;display: none;width: auto;height:auto;border: dotted 1px #999;background-color: white;margin-bottom: 10px">
						<h3> Customer Info</h3>
						<div style="float: left;padding: 10px;">
						<table>
							<tbody>
								<tr>
									<td class="boldTextSmall" style="">Customer Type</td>
									<td>
									<select id="csCustype" style="width: 160px">
											<option selected disabled>-- View Customer Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="addItem('customer_info','customer_type','csSet','Customer Name');" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall" style="">Industry Type</td>
									<td>
									<select id="csIndtype" style="width: 160px">
											<option selected disabled>-- View Industry Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall" style="">Assistant Executive 1</td>
									<td>
									<select id="csAsse1type" style="width: 160px">
											<option selected disabled>-- View Assist. Executive 1 --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall" style="">Assistant Executive 2</td> 
									<td>
									<select id="csAsse2type" style="width: 160px">
											<option selected disabled>-- View Assist. Executive 2 --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall" style="">Tax Type</td>
									<td>
									<select id="csTaxtype" style="width: 160px">
											<option selected disabled>-- View Tax Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall" style="">Preferred Supplier</td>
									<td>
									<select id="cstaxtype" style="width: 160px">
											<option selected disabled>-- View Preferred Supplier --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr><td></td></tr>
								<tr>
									<td class="boldTextSmall" style="">Price List :</td>
								</tr>
								<tr>

									<td class="boldTextSmall center" style="">Domestic Sea</td>
									<td>
									<select id="csPdomstype" style="width: 160px">
											<option selected disabled>-- View Domestic Sea --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall center" style="">Domestic Air</td>
									<td>
									<select id="csPdomatype" style="width: 160px">
											<option selected disabled>-- View Domestic Air --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall center" style="">Domestic Trucking</td>
									<td>
									<select id="csPdomttype" style="width: 160px">
											<option selected disabled>-- View Trucking --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall center" style="">International</td>
									<td>
									<select id="csPintttype" style="width: 160px">
											<option selected disabled>-- View International --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall center" style="">International Sea</td>
									<td>
									<select id="csPintsttype" style="width: 160px">
											<option selected disabled>-- View Int. Sea --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr>
									<td class="boldTextSmall center" style="">International Air</td>
									<td>
									<select id="csPintattype" style="width: 160px">
											<option selected disabled>-- View Int. Air --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
								<tr><td></td></tr>
								<tr>
									<td class="boldTextSmall" style="">Bill Format</td>
									<td>
									<select id="csBilltype" style="width: 160px">
											<option selected disabled>-- View Bill Format --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
								</tr>
							</tbody>
						</table>
						</div>

						<div style="clear: both;"></div>
					</div>
					<div id="BookSet" style="float:left;
					display: none;width: auto;height:auto;border: dotted 1px #999;background-color: white;margin-bottom: 10px;margin-left: 20px;">
						<h3> Booking </h3>
						<div style="float: left;padding: 10px;">
						<table>
							<tbody>
							<tr>
									<td class="boldTextSmall center" style="">Area</td>
									<td>
									<select id="bookAreatype" style="width: 160px">
											<option selected disabled>-- View Are Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							<tr>
									<td class="boldTextSmall center" style="">Contact Person</td>
									<td>
									<select id="bookContacttype" style="width: 160px">
											<option selected disabled>-- View Contact Person --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							<tr>
									<td class="boldTextSmall center" style="">Mode of Shipping</td>
									<td>
									<select id="bookShiptype" style="width: 160px">
											<option selected disabled>-- View Mode of Shipping --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							<tr>
									<td class="boldTextSmall center" style="">Vehicle Type</td>
									<td>
									<select id="bookVehictype" style="width: 160px">
											<option selected disabled>-- View Vehicle Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							<tr>
									<td class="boldTextSmall center" style="">Status Type</td>
									<td>
									<select id="bookStatstype" style="width: 160px">
											<option selected disabled>-- View Status Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
						</tbody>
						</table>
						
				</div>
 				
 			</div>
 			<div id="InboundSet" style="float:left;
					display: none;width: auto;height:auto;border: dotted 1px #999;background-color: white;margin-bottom: 10px;margin-left: 20px;margin-top: 20px;">
						<h3> Inbound Shipment </h3>
						<div style="float: left;padding: 10px;">
						<table>
							<tbody>
								<tr>
									<td class="boldTextSmall center" style="">Customer Name</td>
									<td>
									<select id="inboundCustomtype" style="width: 160px">
											<option selected disabled>-- View Customer Name --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							<tr>
									<td class="boldTextSmall center" style="">Storage Type</td>
									<td>
									<select id="inboundStoragetype" style="width: 160px">
											<option selected disabled>-- View Storage Type --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							<tr>
									<td class="boldTextSmall center" style="">Sub Inventory Type</td>
									<td>
									<select id="inboundSubInvtype" style="width: 160px">
											<option selected disabled>-- View Sub Inventory --</option>		
									</select>
									</td>
									<td><input type="button" name="" value="Add"  onclick="" ></td>
									<td><input type="button" name="" value="Delete"  onclick="" ></td>
							</tr>
							</tbody>
						</table>
						</div>
			</div>

				</div> 

 			</div>


 		</div>
 		</div>
 		</div>
 		</body>