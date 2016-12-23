<?php

session_start();
$_SESSION['page']="inbound";
require_once('header.php');
require_once('db_connect.php');


class Inbound extends Database{

	public $name;

	public function __construct(){

			parent::__construct();
			
	}



}


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

		$('#shipDialog span:contains("required")').css("display","none");
		$('#shipDialog span:contains("required")').css("margin-top","10px");
		$('#eshipDialog span:contains("required")').css("display","none");
		$('#eshipDialog span:contains("required")').css("margin-top","10px");

		$('#shipDialog :input').bind({
			focusout:function(){
				if($(this).val() != ''){
				$(this).css('border','solid 1px rgba(90, 87, 87, 0.51)');
       			$('#shipDialog span:contains("required")').css("display","none");
				}
			}
		})



		$('#rshipment').bind({

			click:function(){

				$('#rshipmentDialog').dialog("open");
				//$('#pullDialog').dialog("close");

			},mouseenter:function(){
				$(this).css({"cursor":"pointer"});
			}
		})

		$('#tshipment').bind({

			click:function(){
				$("#tshipmentDialog").dialog('open');
				//$('#pullDialog').dialog("close");

			},mouseenter:function(){
				$(this).css({"cursor":"pointer"});
			}
		})


		//CREATE DATEPICKERS!!
		//EXPIRATION DATE
		createDatePickerRange('txtExdateFrom','txtExdateTo','from');
		createDatePickerRange('txtExdateFrom','txtExdateTo','to');
		createDatePicker('addExdate');
		//ENTRY DATE
		createDatePickerRange('txtEndateFrom','txtEndateTo','from');
		createDatePickerRange('txtEndateFrom','txtEndateTo','to');
		createDatePicker('addEndate');
		//PICK UP DATE
		createDatePickerRange('txtPickdateFrom','txtPickdateTo','from');
		createDatePickerRange('txtPickdateFrom','txtPickdateTo','to');
		createDatePicker('addPickdate');

		createDatePicker('ePickdate');
		createDatePicker('eEndate');
		createDatePicker('eExdate');


		selectInbound();
	

	});


		var switchPortal = function(){
			var port = $('#selPort').val();

			$('#switchPort').on('click',function(){

				window.location.assign(port);
			})
		}
		var clearInbound = function(){
			$('#SearchBox').find('input:text').val('');
		}


		var selectInbound = function(){

			var a = $('#txtClient').val();
       		var b = $('#txtBlading').val();
       		var c = $('#txtReceipt').val();
       		var d = $('#txtPallet').val();
       		var e = $('#txtQuantity').val();
       		var f = $('#txtDescription').val();
       		var g = $('#txtStorage').val();
       		var h = $('#txtInventory').val();
       		var i = $('#txtExdateFrom').val();
       		var j = $('#txtExdateTo').val();
       		var k = $('#txtEndateFrom').val();
       		var l = $('#txtEndateTo').val();
       		var m = $('#txtPickdateFrom').val();
       		var n = $('#txtPickdateTo').val();
       		var o = $('#max_count').val();
       		var p = $('#txtPage').val();



       		$.post('selectInbound.php',{customer:a,blading:b,receipt:c,pallet:d,quantity:e,desc:f,storage:g,inventory:h,exdatefrom:i,exdateto:j,endatefrom:k,endateto:l,pickdatefrom:m,pickdateto:n,max:o,page:p,status:"inbound"},function(data){
       			var total_rows = parseInt(data.totalrows);
       			$('#tblInbound tbody').empty();
       			$('#resultFound').html(data.totalrows+' Inbound Shipment were found');
       			$('#resultCount').html('Displaying Inbound Shipment 1 to '+data.totalrows);
				var back = 0;
				var color ='#F2F2F2';
       			$.each(data,function(index,value){

       				
       				if (index >2) {


       					
       				if (back==0){
       					color ='#F2F2F2';
       					back=1;
					}else{
						color= "#FFF9F9";	
						back=0;
					}
       				$('#tblInbound tbody').append("<tr style='background-color:"+color+"'><td class='normalTextSmall center'>"+value.blading+"</td><td class='normalTextSmall center'>"+value.receipt+"</td><td class='normalTextSmall center'>"+value.pallet+"</td><td class='normalTextSmall center'>"+value.quantity+"</td><td class='normalTextSmall center'>"+value.desc+"</td><td class='normalTextSmall center'>"+value.storage+"</td><td class='normalTextSmall center'>"+value.expiration+"</td><td class='normalTextSmall center'>"+value.pick+"</td><td class='center'><input type='button' name='edit' value='Edit' class='' onclick='openeShipment(\""+value.id+"\",\""+value.client+"\",\""+value.blading+"\",\""+value.receipt+"\",\""+value.pallet+"\",\""+value.quantity+"\",\""+value.desc+"\",\""+value.storage+"\",\""+value.inventory+"\",\""+value.expiration+"\",\""+value.entry+"\",\""+value.pick+"\")'><span>    </span><input type='button' name='pull' value='Pull-Out' class='' onclick='openPullout("+value.id+")'></td></tr>");

       			}
       			
       			})
       			

       		},'json')
		}

	
	var openShipment = function(){
			$('#shipDialog').dialog("open");
	}

	var openeShipment = function(id,custom,blading,receipt,pallet,quantity,desc,storage,inventory,ex,en,pick){

			$("#eid").val(id);
			$('#eCustomer').val(custom);
       		$('#eBlading').val(blading);
       		$('#eReceipt').val(receipt);
       		$('#ePallet').val(pallet);
       		$('#eQuantity').val(quantity);
       		$('#eDescription').val(desc);
       		$('#eStorage').val(storage);
       		$('#eInventory').val(inventory);
       		$('#eExdate').val(ex);
       		$('#eEndate').val(en);
       		$('#ePickdate').val(pick);
			$('#eshipDialog').dialog("open");
	}

	var openPullout = function(value){
			$('#pullDialog').dialog("open");
	}


	var createDatePicker = function(id_from){

			$( "#" + id_from ).datepicker({
				showOn: "button",
				changeMonth: true,
				buttonImage: "img/icon_calendar.png",
				dateFormat: "mm/dd/yy",
				buttonImageOnly: true
			});

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

		var toggleSearchBox = function(){

			if ($('#SearchBox').css("display")=="none") {

				$('#SearchBox').css({"display":"block"});
				$('#titleBarStatus').html('-');
			}else{
				$('#SearchBox').css({"display":"none"});
				$('#titleBarStatus').html('+');
			}
		}



$(function(){

	$("#shipDialog").dialog({
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
    height: 520,
    buttons: {

       	"Save": function(){

       		//GET ALL INPUT ON ADD SHIPMENT DIALOG

       		var a = $('#addCustomer').val();
       		var b = $('#addBlading').val();
       		var c = $('#addReceipt').val();
       		var d = $('#addPallet').val();
       		var e = $('#addQuantity').val();
       		var f = $('#addDescription').val();
       		var g = $('#addStorage').val();
       		var h = $('#addInventory').val();
       		var i = $('#addExdate').val();
       		var j = $('#addEndate').val();
       		var k = $('#addPickdate').val();

       		if (a=='') {
       			$('#addCustomer').css('border-color','red');
       			$('#req1').css("display","block");
       		}else if(b==''){
       			$('#addBlading').css('border-color','red');
       			$('#req2').css("display","block");


       		}else if(c==''){
       			$('#addReceipt').css('border-color','red');
       			$('#req3').css("display","block");


       		}else if(d==''){
       			$('#addPallet').css('border-color','red');
       			$('#req4').css("display","block");


       		}else if(e==''){
       			$('#addQuantity').css('border-color','red');
       			$('#req5').css("display","block");


       		}else if(f==''){
       			$('#addDescription').css('border-color','red');
       			$('#req6').css("display","block");


       		}else if(g==''){
       			$('#addStorage').css('border-color','red');
       			$('#req7').css("display","block");


       		}else if(h==''){
       			$('#addInventory').css('border-color','red');
       			$('#req8').css("display","block");


       		}else if(j==''){
       			$('#addEndate').css('border-color','red');
       			$('#req9').css("display","block");


       		}else{

       		//INSERT DATA on inbound
       		$.post("createInbound.php",{customer:a,blading:b,receipt:c,pallet:d,quantity:e,desc:f,storage:g,inventory:h,exdate:i,endate:j,pickdate:k},function(data){

       						alert(data);
       					

       			});
			clearDialog();
       		}



       	},
       	"Clear": function(){

 		 clearDialog();


       	},
        "Close": function() {
            $(this).dialog("close");
        }


    }
});

	$("#eshipDialog").dialog({
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
    height: 520,
    buttons: {

       	"Save": function(){

       		//GET ALL INPUT ON ADD SHIPMENT DIALOG
       		var id = $('#eid').val();
       		var a = $('#eCustomer').val();
       		var b = $('#eBlading').val();
       		var c = $('#eReceipt').val();
       		var d = $('#ePallet').val();
       		var e = $('#eQuantity').val();
       		var f = $('#eDescription').val();
       		var g = $('#eStorage').val();
       		var h = $('#eInventory').val();
       		var i = $('#eExdate').val();
       		var j = $('#eEndate').val();
       		var k = $('#ePickdate').val();

       		if (a=='') {
       			$('#eCustomer').css('border-color','red');
       			$('#ereq1').css("display","block");
       		}else if(b==''){
       			$('#eBlading').css('border-color','red');
       			$('#ereq2').css("display","block");


       		}else if(c==''){
       			$('#eReceipt').css('border-color','red');
       			$('#ereq3').css("display","block");


       		}else if(d==''){
       			$('#ePallet').css('border-color','red');
       			$('#ereq4').css("display","block");


       		}else if(e==''){
       			$('#eQuantity').css('border-color','red');
       			$('#ereq5').css("display","block");


       		}else if(f==''){
       			$('#eDescription').css('border-color','red');
       			$('#ereq6').css("display","block");


       		}else if(g==''){
       			$('#eStorage').css('border-color','red');
       			$('#ereq7').css("display","block");


       		}else if(h==''){
       			$('#eInventory').css('border-color','red');
       			$('#ereq8').css("display","block");


       		}else if(j==''){
       			$('#eEndate').css('border-color','red');
       			$('#req9').css("display","block");


       		}else{

       		//INSERT DATA on inbound
       		$.post("editInbound.php",{id:id,customer:a,blading:b,receipt:c,pallet:d,quantity:e,desc:f,storage:g,inventory:h,exdate:i,endate:j,pickdate:k},function(data){

       						alert(data);
       				selectInbound();	

       			});
			//clearDialog();
			
       		}



       	},
       	"Clear": function(){

 		 clearDialog();


       	},
        "Close": function() {
            $(this).dialog("close");
        }


    }
});


	$("#pullDialog").dialog({
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
    height: 270,
    buttons: {
    	"Close":function(){
    		$(this).dialog("close");
    	}
    }
})

	$("#rshipmentDialog").dialog({
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
    height: 275,
    buttons: {
    	"Release":function(){

    	},
    	"Clear":function(){
    		$(this).find('input:text,textarea').val('');
    	},
    	"Cancel":function(){
    		$(this).find('input:text,textarea').val('');
    		$(this).dialog('close');
    	}
    }
})
	$("#tshipmentDialog").dialog({
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
    height: 230,
    buttons: {
    	"Transfer":function(){

    	},
    	"Clear":function(){
    		$(this).find('input:text,textarea').val('');
    	},
    	"Cancel":function(){
    		$(this).find('input:text,textarea').val('');
    		$(this).dialog('close');
    	}
    }
})



		var clearDialog = function(){
			 $('#shipDialog eshipDialog').find('input:text').val('');

		}
		

		

});


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
				<option value="inbound.php">Inbound</option>
				<option value="warehouse.php">Warehouse</option>
			</select><span id=""> </span><a style="cursor: pointer;text-decoration: underline;" id="switchPort" onclick="switchPortal();">[switch]</a>
			</div>

 		</div>
 		<br>
 		<div style="clear: left; width: 970px;padding-bottom: 30px;
    margin-bottom: 100px; background-color: #fff; border: solid 1px #999;margin-top: 20px;">
 			<div style="margin-left: 50px;margin-bottom: 40px;"><h1 style="color:#999999">Inbound Shipment</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
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
												<td class="boldTextSmall" style="width: 100px;">Customer Name</td>
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
												<td class="boldTextSmall" style="">Lot no</td>
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
												<td class="boldTextSmall" style="width: 100px;">Storage Type</td>
												<td><select id="txtStorage" style="width: 180px;">
													<option selected disabled>-- Select Storage Type--</option>
													<option>Storage A</option>
													<option>Storage B</option>
													<option>Storage C</option>
												</select>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Sub Inv. Type</td>
												<td><select id="txtInventory" style="width: 180px;">
													<option selected disabled>-- Select Sub Inventory Type--</option>
													<option>Inventor A</option>
													<option>Inventor B</option>
													<option>Inventor C</option>
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
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Entry Date</td>
												<td>
													<input type="text" id="txtEndateFrom" name="" style="width: 100px;">
													<input type="text" id="txtEndateTo" name="" style="width: 100px;">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Pick Up Date</td>
												<td>
													<input type="text" id="txtPickdateFrom" name="" style="width: 100px;">
													<input type="text" id="txtPickdateTo" name="" style="width: 100px;">
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td valign="top">
									<table>
										<tbody>
											<tr style="height: 30px;">
												<td>
												<input type="button" name="no_submit" value="Search" class="search" onclick="selectInbound();"><span> </span>
												<input type="button" name="clear" value="Clear" class="clear" onclick="clearInbound();">
												</td>
											</tr>
											<tr>
												
												<td><input type="button" name="no_submit" value="Add Shipment" class="search"  onclick="openShipment();"></td>
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
 			<span><p class="boldTextSmall" >Enter page no: <input type="text" name="page" id="txtPage" value="1" style="width: 50px;"> <input type="button" name="go" value="Go" class="clear" onclick="selectInbound();"></p></span>
 			</div>
 			<div style="clear: both;"></div>
 			</div>
 			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div  style="    margin-left: 11px;margin-right: 11px;">
			<table class="tbl" id="tblInbound" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
			<thead class="listHeaders">
			<tr style="cursor:pointer;color: #464646;">
			<th style="border-right: 1px solid #fff;height: 20px">Bill Lading</th>
			<th style="border-right: 1px solid #fff;">Delivery Receipt</th>
			<th style="border-right: 1px solid #fff;">Pallet Code</th>
			<th style="border-right: 1px solid #fff;">Quantity</th>
			<th style="border-right: 1px solid #fff;">Description</th>
			<th style="border-right: 1px solid #fff;">Storage Type</th>
			<th style="border-right: 1px solid #fff;">Expiration Date</th>
			<th style="border-right: 1px solid #fff;">Pick Up Date</th>
			<th style="border-right: 1px solid #fff;">Action</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
			</div>

		<!--SHIPMENT DIALOG-->
		<div id="shipDialog" style="display: none;" title="Add Shipment"> 
		<div style="margin: 10px;">
			<span><b/><span style="color:red">*</span> Customer Name:
			<select id="addCustomer" style="margin-left: 16px;width: 172px;">
				<option disabled selected>-- Select Customer --</option>
				<option  >Customer A</option>
			</select>    <input type="button" name="createuser" value="+" class="clear" onclick=""></span><br/><span id="req1" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Bill of Lading No: <input style="margin-left: 10px;width: 200px;" type="text" id="addBlading" required></span><br/><span id="req2" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Delivery Receipt: <input style="margin-left: 15px;width: 198px;" type="text" id="addReceipt"></span><br/><span id="req3" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Pallet Code: <input  style="margin-left: 41px;width: 198px;" type="text" id="addPallet"></span><br/><span id="req4" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Quantity: <input style="margin-left: 60px;width: 198px;" type="text" id="addQuantity"></span><br/><span id="req5" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Description: <input style="margin-left: 44px;width: 198px;" type="text" id="addDescription"></span><br/><span id="req6" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Storage Type:
			<select id="addStorage" style="margin-left: 39px;width: 198px;">
				<option disabled selected>-- Select Storage Type --</option>
				<option  >Storage A</option>
			</select></span><br/><span id="req7" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Sub inventory Type:
			<select id="addInventory" style="width: 198px;">
				<option disabled selected>-- Select Sub Inventory Type --</option>
				<option  >Inventory A</option>
			</select></span><br/><span id="req8" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/>Expiration Date: <input style="margin-left: 24px;width: 160px;" type="text" id="addExdate"></span><br/><br/>
			<span><b/><span style="color:red">*</span> Entry Date: <input style="margin-left: 46px;width: 160px;" type="text" id="addEndate"></span><br/><span id="req9" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/>Pick Up Date: <input style="margin-left: 42px;width: 160px;" type="text" id="addPickdate"></span><br/><br/>
		</div>
		</div>

		<!-- EDIT SHIP DIALOG-->
		<div id="eshipDialog" style="display: none;" title="Edit Shipment"> 
		<div style="margin: 10px;">
		<input type="text" id="eid"  name="" hidden>
			<span><b/><span style="color:red">*</span> Customer Name:
			<select id="eCustomer" style="margin-left: 16px;width: 172px;">
				<option disabled selected>-- Select Customer --</option>
				<option  >Customer A</option>
			</select>    <input type="button" name="createuser" value="+" class="clear" onclick=""></span><br/><span id="ereq1" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Bill of Lading No: <input style="margin-left: 10px;width: 200px;" type="text" id="eBlading" required></span><br/><span id="ereq2" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Delivery Receipt: <input style="margin-left: 15px;width: 198px;" type="text" id="eReceipt"></span><br/><span id="ereq3" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Pallet Code: <input  style="margin-left: 41px;width: 198px;" type="text" id="ePallet"></span><br/><span id="ereq4" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Quantity: <input style="margin-left: 60px;width: 198px;" type="text" id="eQuantity"></span><br/><span id="ereq5" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Description: <input style="margin-left: 44px;width: 198px;" type="text" id="eDescription"></span><br/><span id="ereq6" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Storage Type:
			<select id="eStorage" style="margin-left: 39px;width: 198px;">
				<option disabled selected>-- Select Storage Type --</option>
				<option  >Storage A</option>
			</select></span><br/><span id="ereq7" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/><span style="color:red">*</span> Sub inventory Type:
			<select id="eInventory" style="width: 198px;">
				<option disabled selected>-- Select Sub Inventory Type --</option>
				<option  >Inventory A</option>
			</select></span><br/><span id="ereq8" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/>Expiration Date: <input style="margin-left: 24px;width: 160px;" type="text" id="eExdate"></span><br/><br/>
			<span><b/><span style="color:red">*</span> Entry Date: <input style="margin-left: 46px;width: 160px;" type="text" id="eEndate"></span><br/><span id="ereq9" style="color:red;margin-left: 133px;">This Field is required.</span><br/>
			<span><b/>Pick Up Date: <input style="margin-left: 42px;width: 160px;" type="text" id="ePickdate"></span><br/><br/>
		</div>
		</div>

		<!--PULL-OUT DIALOG-->
		<div id="pullDialog" style="display: none;" title="Pull-Out Shipment">
		<div id="rshipment" style="float:left;width: 170px;height: 150px;margin-top:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    text-align: -webkit-center;">
		<h3 style="padding-top: 100;">Release Shipment</h3>
		</div>
		<div id="tshipment" style="float:right;width: 170px;height: 150px;margin-top:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    text-align: -webkit-center;">
		<h3 style="padding-top: 100;">Transfer Shipment</h3>
		</div>
		<div style="clear: both;"></div>
		
		<!--Release Shipment DIALOG-->
		<div id="rshipmentDialog" style="display: none;" title="Release Shipment">
		<div style="margin: 10px;">
			<span><b/>Quantity: <input style="margin-left: 60px;width: 198px;" type="text" id="rsQuantity"></span><br/><br/>
			<span><b/>Remarks: <textarea style="margin-left: 60px;width: 198px;resize: none;height: 60px;" type="text" id="reRemarks"></textarea></span><br/><br/>
			<span><b/>Type of Shipment:
			<select id="rshipType" style="width: 198px;margin-left: 5px;">
				<option disabled selected>-- Select Type of Shipment --</option>
				<option  >Shipment A</option>
			</select></span><br/><br/>
		</div>
		</div>
		<!--Transfer Shipment DIALOG-->
		<div id="tshipmentDialog" style="display: none;b" title="Transfer Shipment">
		<div style="margin: 10px;">
			<span><b/>Quantity: <input style="margin-left: 60px;width: 198px;" type="text" id="rsQuantity"></span><br/><br/>
			<span><b/>Localtion:
			<select id="tslocation" style="width: 198px;margin-left: 56px;">
				<option disabled selected>-- Select Location --</option>
				<option  >Shipment A</option>
			</select></span><br/><br/>
			<span><b/>Type of Shipment:
			<select id="tshipType" style="width: 198px;margin-left: 5px;">
				<option disabled selected>-- Select Location --</option>
				<option  >Shipment A</option>
			</select></span><br/><br/>
		</div>
		</div>
		</div>


 		</div>
 		</div>
 		</div>
 		</body>