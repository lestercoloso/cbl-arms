<?php
session_start();
$_SESSION['page']="outbound";
require_once('header.php');
require_once('db_connect.php');


?>


<head>
	<style type="text/css">


	#SearchBox{
		display: block;
	    width: 950px;
	    height: 140px;
	    background-color: #cccccc;
	    background-image: url(/images/background.gif);
	    display: block;
	    margin-left: auto;
	    margin-right: auto;
	}
	.center{
		text-align:center;
	}
</style>
	<script type="text/javascript">
		

	$(document).ready(function(){

		switchPortal();
		selectOutbound();

		createDatePickerRange('txtExdateFrom','txtExdateTo','from');
		createDatePickerRange('txtExdateFrom','txtExdateTo','to');



	});

	var selectOutbound = function(){

			var a = $('#txtClient').val();
       		var b = $('#txtBlading').val();
       		var c = $('#txtReceipt').val();
       		var d = $('#txtPallet').val();
       		var e = $('#txtQuantity').val();
       		var f = $('#txtDescription').val();
       		var g = $('#txtLoc').val();
       		var h = $('#txtShipment').val();
       		var i = $('#txtExdateFrom').val();
       		var j = $('#txtExdateTo').val();
       		var o = $('#max_count').val();
       		var p = $('#txtPage').val();



       		$.post('selectInbound.php',{customer:a,blading:b,receipt:c,pallet:d,quantity:e,desc:f,storage:g,inventory:h,exdatefrom:i,exdateto:j,max:o,page:p,status:"outbound"},function(data){
       			var total_rows = parseInt(data.totalrows);
       			$('#tblOutbound tbody').empty();
       			$('#resultFound').html(data.totalrows+' Outbound Shipment were found');
       			$('#resultCount').html('Displaying Outbound Shipment 1 to '+data.totalrows);
				var back = 0;
				var color ='#F2F2F2';
				var status = "";
       			$.each(data,function(index,value){

       				if (value.stats=="outbound") {

       					status="RECEIVED"
       				}
       				if (index >2) {


       					
       				if (back==0){
       					color ='#F2F2F2';
       					back=1;
					}else{
						color= "#FFF9F9";	
						back=0;
					}
       				$('#tblOutbound tbody').append("<tr style='background-color:"+color+"'><td class='normalTextSmall center'>"+value.blading+"</td><td class='normalTextSmall center'>"+value.receipt+"</td><td class='normalTextSmall center'></td><td class='normalTextSmall center'>"+value.pallet+"</td><td class='normalTextSmall center'>"+value.quantity+"</td><td class='normalTextSmall center'>"+value.desc+"</td><td class='normalTextSmall center'></td><td class='normalTextSmall center'>"+value.expiration+"</td><td class='normalTextSmall center'>"+value.pick+"</td><td class='normalTextSmall center'></td><td class='normalTextSmall center'>"+status+"</td><td class='center'><input type='button' name='edit' value='Edit' class='' onclick=''></td></tr>");

       			}
       			
       			})
       			

       		},'json')
		}

	var createDatePickerRange =	function(id_from,id_to,type)
	{
		if(type == "from")
		{
			$( "#" + id_from ).datepicker({
				showOn: "button",
				changeMonth: true,
				buttonImage: "img/icon_calendar.png",
				dateFormat: "mm/dd/yy",
				buttonImageOnly: true,
				beforeShow: function(input, obj) {
				$(input).after($(input).datepicker('widget'));
				}
			});
		}
		else if(type == "to")
		{
			$( "#" + id_to ).datepicker({
				showOn: "button",
				changeMonth: true,
				buttonImage: "img/icon_calendar.png",
				dateFormat: "mm/dd/yy",
				buttonImageOnly: true,
				beforeShow: function(input, obj) {
				$(input).after($(input).datepicker('widget'));
				}
			});
		}
		else
		{
			// do nothing
		}
	}

		var switchPortal = function(){
			var port = $('#selPort').val();

			$('#switchPort').on('click',function(){

				window.location.assign(port);
			})
		}


		var toggleSearchBox = function(){

			if ($('#SearchBox').css("display")=="none") {

				$('#SearchBox').css({"display":"block"});
				$('#titleBarStatus').html('-');
			}else{
				$('#SearchBox').css({"display":"none"});
				$('#titleBarStatus').html('+');
			}
		}
		var clearOutbound = function(){
			$('#SearchBox').find('input:text').val('');
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
			<!--<div style="float: left;">
			Your session will expire in <span id="timerContent"><?php echo "NEED HEADER HERE"; ?>:00</span>
			</div>-->
			<div style="clear: left; float: left; width: 250px;">
			<select id="selPort" style="width: 110px;">
				<option value="outbound.php">Outboud</option>
				<option value="inbound.php" selected>Inbound</option>
				<option value="warehouse.php">Warehouse</option>
			</select><span id=""> </span><a onclick="switchPortal();" id="switchPort" style="cursor: pointer;text-decoration: underline;">[switch]</a>
			</div>

 		</div>
 		<br>
 		<div style="clear: left; width: 970px;padding-bottom: 30px;
    margin-bottom: 100px; background-color: #fff; border: solid 1px #999;margin-top: 20px;">
 			<div style="margin-left: 50px;margin-bottom: 40px;"><h1 style="color:#999999">Outbound Shipment</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
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
								<div id="titleBarDescription" onmouseover="document.body.style.cursor='pointer';" onmouseout="document.body.style.cursor='auto';" onclick="toggleSearchBox();"  style="float:right">Click here to minimize</div>

						</div>

						<div style="float: right; width: 20px; height: 20px;" onmouseover="document.body.style.cursor='pointer';" onmouseout="document.body.style.cursor='auto';" onclick="toggleSearchBox();" class="boldText">
								<div id="titleBarStatus" style="font-size: 14px; clear: left; width: 20px; height: 1px;">-</div>
						</div>
				</div>
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
												<td class="boldTextSmall" style="width: 100px;">Customer</td>
												<td class="boldTextSmall">
												<select id="txtClient" style="width: 150px;">
													<option selected disabled>-- Select Customer --</option>
													<option>Customer A</option>
													<option>Customer B</option>
													<option>Customer C</option>
												</select>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">Bill of Lading</td>
												<td><input type="text" id="txtBlading" name="" style="width: 150px;"></td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">Delivery Reciept</td>
												<td><input type="text" id="txtReceipt" name="" style="width: 150px;"></td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">Pallet Code</td>
												<td><input type="text" id="txtPallet" name="" style="width: 150px;"></td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">Location</td>
												<td><input type="text" id="txtLoc" name="" style="width: 150px;"></td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">Results</td>
												<td><select id="max_count">
													<option>10</option>
													<option>25</option>
													<option>50</option>
													<option>100</option>
													<option>500</option>
													<option>1000</option>
												</select></td>
											</tr>

										</tbody>
									</table>
								</td>
								<td  width="400px;" valign="top" style="padding-left: 20px;">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Type of Shipment</td>
												<td><select id="txtShipment" style="width: 180px;">
													<option selected disabled>-- Select Type of Shipment--</option>
													<option>Shipment A</option>
													<option>Shipment B</option>
													<option>Shipment C</option>
												</select>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Expiration Date</td>
												<td>
													<input type="text" id="txtExdateFrom" name="" style="width: 100px;">
													<input type="text" id="txtExdateTo" name="" style="width: 100px;">
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td valign="top">
									<table>
										<tbody>

											<tr style="height: 100px;">
												<td>
												<input type="button" name="no_submit" value="Search" class="search" onclick="selectOutbound();"><span> </span>
												<input type="button" name="clear" value="Clear" class="clear" onclick="clearOutbound();" style="margin-left: 15px;">
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							</tbody>
						</table>
				</div>
				</div>
				</div>
			<div style="">
 			<div style="float:left;margin-left: 11px;">
 			<span><p class="boldTextSmall" id="resultFound"></p></span>
 			<span><p class="boldTextSmall" id="resultCount"></p></span>
 			</div>
 			<div style="float:right;margin-right: 11px;">
 			<span><p class="boldTextSmall" id="resultPage">Current Page of 1 of </p></span>
 			<span><p class="boldTextSmall" >Enter page no: <input type="text" name="page" id="txtPage" value="1" style="width: 50px;"> <input type="button" name="go" value="Go" class="clear" onclick="selectOutbound();"></p></span>
 			</div>
 			<div style="clear: both;"></div>
 			</div>
 			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div  style="    margin-left: 11px;margin-right: 11px;">
			<table class="tbl" id="tblOutbound" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
			<thead class="listHeaders">
			<tr style="cursor:pointer;color: #464646;">
			<th style="border-right: 1px solid #fff;height: 20px">Bill Lading</th>
			<th style="border-right: 1px solid #fff;">Delivery Receipt</th>
			<th style="border-right: 1px solid #fff;">Invoice Number</th>
			<th style="border-right: 1px solid #fff;">Pallet Code</th>
			<th style="border-right: 1px solid #fff;">Quantity</th>
			<th style="border-right: 1px solid #fff;">Description</th>
			<th style="border-right: 1px solid #fff;">Location</th>
			<th style="border-right: 1px solid #fff;">Expiration Date</th>
			<th style="border-right: 1px solid #fff;">Pick Up Date</th>
			<th style="border-right: 1px solid #fff;">Type of Shipment</th>
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
		
</body>