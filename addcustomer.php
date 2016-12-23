<?php
	session_start();
	$_SESSION['page']="customerinfo";
	require_once('header.php');
	require_once('db_connect.php');


	class CustomerInfo extends Database
	{
		public $name;
	}	
?>

<head>

<style type="text/css">
	/* Style the list */
	ul.tabs {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	    overflow: hidden;
	    border: 1px solid #ccc;
	    background-color: #f1f1f1;
	}

	/* Float the list items side by side */
	ul.tabs li {float: left;}

	/* Style the links inside the list items */
	ul.tabs li a {
	    display: inline-block;
	    color: black;
	    text-align: center;
	    padding: 14px 16px;
	    text-decoration: none;
	    transition: 0.3s;
	    font-size: 17px;
	}

	/* Change background color of links on hover */
	ul.tabs li a:hover {background-color: #ddd;}

	/* Create an active/current tablink class */
	ul.tabs li a:focus, .active {background-color: #ccc;}

	/* Style the tab content */
	.tabcontent {
	    display: none;
	    padding: 6px 12px;
	    border: 1px solid #ccc;
	    border-top: none;
	}
	
	.modal {
	    display: none; /* Hidden by default */
	    position: fixed; /* Stay in place */
	    z-index: 1; /* Sit on top */
	    padding-top: 200px; /* Location of the box */
	    left: 0;
	    top: 0;
	    width: 100%; /* Full width */
	    height: 100%; /* Full height */
	    overflow: auto; /* Enable scroll if needed */
	    background-color: rgb(0,0,0); /* Fallback color */
	    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.addressModal-content {
	    background-color: #fefefe;
	    margin: none;
	    padding: none;
	    border: 1px solid #888;
	    width: 20%;
	    height: 30%;
	}

	/* Modal Content */
	.contactModal-content {
	    background-color: #fefefe;
	    margin: none;
	    padding: none;
	    border: 1px solid #888;
	    width: 29%;
	    height: 42%;
	}

	/* The Close Button */
	.close {
	    color: #aaaaaa;
	    float: right;
	    font-size: 28px;
	    font-weight: bold;
	}

	.close:hover,
	.close:focus {
	    color: #000;
	    text-decoration: none;
	    cursor: pointer;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){

		geTport();

	});


		var geTport = function(){

			$.post('cusinfo.php',function(data){

				$.each(data,function(index,value){
					$("#selPort").append("<option value="+value.Selpage+'.php'+">"+value.SelName+"</option>");
				});
			},'json');
		};

	$(document).ready(function(){

		//CREATE Company Anniversary
		createDatePickerRange('txtCompanyanniv');
		createDatePicker('addCompanyanniv');
		createDatePicker('eCompanyanniv');

		createDatePickerRange('txtBirthdate');
		createDatePicker('addBirthdate');
		createDatePicker('eBirthdate');

	});


	var createDatePicker = function(id_from){

		$( "#" + id_from ).datepicker({
			showOn: "button",
			changeMonth: true,
			buttonImage: "img/icon_calendar.png",
			dateFormat: "mm/dd/yy",
			buttonImageOnly: true
		});

	}


	var createDatePickerRange =	function(id_from)
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

	openInfo("Address");
	function openInfo(infoName) {
	    var i;
	    var x = document.getElementsByClassName("customer");
	    for (i = 0; i < x.length; i++) {
	       x[i].style.display = "none";
	    }
	    document.getElementById(infoName).style.display = "block";
	}


	openModal("addressButton");
	function openAddressModal(modalButton) {
		// Get the modal
		var modal = document.getElementById('addressModal');

		// When the user clicks the button, open the modal
		
		modal.style.display = "block";
		
	}
	
	cancelModal("addressCancel");
	function cancelAddressModal() {
		// Get the modal
		var modal = document.getElementById('addressModal');

		modal.style.display = "none";
	}

	openModal("contactButton");
	function openContactModal(modalButton) {
		// Get the modal
		var modal = document.getElementById('contactModal');

		// When the user clicks the button, open the modal
		
		modal.style.display = "block";
		
	}
	
	cancelModal("contactCancel");
	function cancelContactModal() {
		// Get the modal
		var modal = document.getElementById('contactModal');

		modal.style.display = "none";
	}


</script>

</head>


<body onResize="updateToolbarPos();" onload="openInfo('Address')">


	<div class="scrollingContainer">
		<div class="subContainer " style="width: 1270px;">
			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div style="clear: left; float: left;"><a href="homepage.php"><img src="" width=445 height=70 alt="" title="" border=0></a></div>
 			<div style="clear: left; padding-left: 5px; height: 30px;" class="normalTextSmall">

 				Welcome <b><?php echo $_SESSION['profilename'];?></b> <?php echo " (" .$_SESSION['profilestats'] . ")" ; ?>
				<br>
				<div style="clear: left; float: left; width: 250px;">
				Last Login: <span id="head_lastlogin"></span><a href="">[view log]</a>
			</div>
 			<div style="clear: left; float: left; width: 250px;">
				System Date/Time: <span id="systemTimeContent"><?php echo $system_time ;?></span>
			</div>
			<div style="float: left;">
				Your session will expire in <span id="timerContent"><?php echo "NEED HEADER HERE"; ?>:00</span>
			</div>
			<div style="clear: left; float: left; width: 250px;">
				<select id="selPort"></select><span id=""> </span><a href="" id="switchPort">[switch]</a>
			</div>
 		</div>
 		<br>
 		<div style="clear: left; width: 1270px; height: 1000px; background-color: #fff; border: solid 1px #999;margin-top: 20px">
 			<div style="margin-left: 30px;margin-bottom: 40px;"><h1 style="color:#999999">Customer Information</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
 			<div>
 				<div align="center" style="margin-left: auto;margin-right: auto;clear: left; width: 1190px; height: auto; border: solid 1px #ddd; background-color: #eee; background-image: url('../images/background.gif');">
 					<!-- Header of Search FORM  -->
					<div class="boldTextSmall" style="clear: left; width: 1190px; height: 20px; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;">
						<!-- Archive and Live Link at the Top of Search FORM -->
						<div style="clear: left; float: left; width: 5px;"><!-- --></div>
						<!-- Archive and Live Link at the Top of Search FORM -->
							<div style="clear: left; width: 1190px; height: 20px; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;" class="boldTextSmall">
								<div style="clear: left; float: left; width: 5px;"><!-- --></div>
								<div style="float: left; width: 7px; height: 20px; background-image: url('../images/left_handle.gif');"><!-- --></div>
								<div style="float: left; width: 1170px; height: 20px;" class="boldTextSmall" align="left">
									<div class="buff3"><!-- --></div>
									<div id="titleBarDescription" onmouseover="document.body.style.cursor='pointer';" onmouseout="document.body.style.cursor='auto';" onclick="toggleSearchBox();"  style="float:right">This page is set as my homepage  [<a href="hset.php"><strong>cancel</strong></a>]</div>
								</div>
							</div>
 					</div>
 					<div id="SearchBox">
						<div id="1search" style="float:left;padding: 10px; background-color: #fff; border: solid 1px #999; border-color: #bbb;">
							<table>
								<tbody>
									<tr>
										<td width="490px;" valign="top">
											<table>
												<tbody>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Customer Code</td>
														<td>
															<input type="text" id"txtCustomercode" name="" style="width: 130px;" hidden>
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Customer Type</td>
														<td><select id="txtCustomertype" style="width: 150px;">
															<option selected disabled>--Select Customer Type--</option>
															<option>PERSONAL</option>
															<option>PRIVATE</option>
															<option>GOVERNMENT</option>
															<option>NON-VAT</option>
															<option>EXEMPT</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Customer Name</td>
														<td><input type="text" id="txtCustomername" name="" style="width: 130px;"></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Company Anniversary</td>
														<td>
															<input type="text" id="txtCompanyanniv" name="" style="width: 130px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Telephone No.</td>
														<td>
															<input type="text" id"txtTelnumber" name="" style="width: 130px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Fax No.</td>
														<td>
															<input type="text" id"txtFaxnumber" name="" style="width: 130px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Industry Type</td>
														<td><select id="txtIndustrytype" style="width: 150px;">
															<option selected disabled>--Select Industry Type--</option>
															<option>MANUFACTURING</option>
															<option>DISTRIBUTION</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Address</td>
														<td>
															<input type="text" id"txtAddress" name="" style="width: 130px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Tin No.</td>
														<td>
															<input type="text" id"txtTinnumber" name="" style="width: 130px;">
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td  width="400px;" valign="top">
											<table>
												<tbody>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">City</td>
														<td>
															<input type="text" id"txtCity" name="" style="width: 130px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Assistant Executive 1</td>
														<td><select id="txtAsstExec1" style="width: 190px;">
															<option selected disabled>-- Select Assistant Executive 1 --</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Assistant Executive 2</td>
														<td><select id="txtAsstExec2" style="width: 190px;">
															<option selected disabled>-- Select Assistant Executive 2 --</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Area 1</td>
														<td>
															<input type="text" id"txtArea" name="" style="width: 160px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Area 2</td>
														<td><select id="txtArea2" style="width: 160px;">
															<option selected disabled>--optional--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Area 3</td>
														<td><select id="txtArea3" style="width: 160px;">
															<option selected disabled>--optional--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Area 4</td>
														<td><select id="txtArea4" style="width: 160px;">
															<option selected disabled>--optional--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Area 4</td>
														<td><select id="txtArea5" style="width: 160px;">
															<option selected disabled>--optional--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Area 5</td>
														<td><select id="txtArea5" style="width: 160px;">
															<option selected disabled>--optional--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 80px;">Region</td>
														<td>
															<input type="text" id"txtRegion" name="" style="width: 160px;">
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td  width="600px;" valign="top">
											<table>
												<tbody>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Tax Type</td>
														<td><select id="txtAsstExec1" style="width: 130px;">
															<option selected disabled>-- Select Tax Type --</option>
															<option>EWT</option>
															<option>VAT</option>
															<option>NON-VAT</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Payment Terms</td>
														<td>
															<input type="text" id"txtPayterm" name="" style="width: 150px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Preferred Supplier</td>
														<td><select id="txtAsstExec1" style="width: 160px;">
															<option selected disabled>--Select Preferred Supplier--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Price List(Domestic Sea)</td>
														<td><select id="txtAsstExec1" style="width: 150px;">
															<option selected disabled>--Select Price List (DS)--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Price List(Domestic Air)</td>
														<td><select id="txtAsstExec1" style="width: 1250px0px;">
															<option selected disabled>--Select Price List (DA)--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 180px;">Price List(Domestic Trucking)</td>
														<td><select id="txtAsstExec1" style="width: 140px;">
															<option selected disabled>--Select Price List (DT)--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Price List (International Sea)</td>
														<td><select id="txtAsstExec1" style="width: 140px;">
															<option selected disabled>--Select Price List (IS)--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Price List(International Air)</td>
														<td><select id="txtAsstExec1" style="width: 140px;">
															<option selected disabled>--Select Price List (IA)--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Price List(International)</td>
														<td><select id="txtAsstExec1" style="width: 130px;">
															<option selected disabled>--Select Price List (I)--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
												</tbody>
											</table>
										</td>
										<td  width="350px;" valign="top">
											<table>
												<tbody>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Follow Up Day</td>
														<td>
															<input type="text" style="width: 120px;" id="txtFollowup" name="">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Collection Day</td>
														<td>
															<input type="text" style="width: 120px;" id="txtCollection" name="">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Billing Cycle</td>
														<td>
															<input type="text" style="width: 120px;" id="txtBilling" name="">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Credit Limit</td>
														<td>
															<input type="text" style="width: 120px;" id="txtCredit" name="">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Billing Format</td>
														<td><select id="txtAsstExec1" style="width: 130px;">
															<option selected disabled>--Select Billing Format--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Status</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 200px;">Outstanding Balance</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 130px;">Amount Due</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							<div style="background-color: #fff; border: solid 1px #999; border-color: #bbb; width: 1120px;">
								<div class="infoTabs" style="cursor: pointer" id="infoTabs">
									<ul class="tabs">
										<li style="width: 33.33%;"><a style="width: 100%;" id="defaultTab" href="javascript:void(0)" onclick="openInfo('Address')">Address</a></li>
  										<li style="width: 33.33%;"><a style="width: 100%;" href="javascript:void(0)" onclick="openInfo('Contact')">Contact Person</a></li>
  										<li style="width: 33.33%;"><a style="width: 100%;" href="javascript:void(0)" onclick="openInfo('Billing')">Billing</a></li>
									</ul>
									</br>
									<div id="Address" class="customer">
										<button type="button" id="addAddress" style="float: right; margin-right: 20px;" onclick="openAddressModal('addressButton')">Add Address</button>
										<div id="addressModal" class="modal">
											<div class="addressModal-content">
												<div style="clear: left; width: 100%; height: 10%; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;" class="boldTextSmall">
													<div class="buff3"><!-- --></div>
													<div id="addressModaltitle" style="float:left; margin-left: 5px;">Add Address</div>
												</div>
												<table style="padding: 10px;float: left;">
													<tbody>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Address Type</td>
															<td><select id="txtAddresstype" style="width: 140px;">
															<option selected disabled>--Select Address Type--</option>
															<option>Storage A</option>
															<option>Storage B</option>
															<option>Storage C</option>
														</select></td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Address</td>
															<td>
																<input type="text" style="width: 140px;" id="txtAddress" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">City</td>
															<td>
																<input type="text" style="width: 140px;" id="txtCity" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Region</td>
															<td>
																<input type="text" style="width: 140px;" id="txtRegion" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Area</td>
															<td>
																<input type="text" style="width: 140px;" id="txtArea" name="">
															</td>
														</tr>
													</tbody>
												</table>
												<div class="buff3"><!-- --></div>
												<div class="buff3"><!-- --></div>
												<div class="addressModalbuttons">
													<button class="boldTextSmall" type="button" id="saveAddress">Save</button>
													<button class="boldTextSmall" type="button" id="clearAddress">Clear</button>
													<button class="boldTextSmall" type="button" id="cancelAddress" onclick="cancelAddressModal('addressCancel')">Cancel</button>
												</div>
											</div>
										</div>
										<div style="border: solid 1px #999; border-color: #ddd; width: 75%;">
											<table class="tbl" id="tblAddress" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
												<thead class="listHeaders">
													<tr style="cursor:pointer;color: #464646;">
														<th style="border-right: 1px solid #ddd;height: 20px; width: 16%;">Address Type</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Address</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">City</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Region</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Area</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></br></td>
													</tr>
													<tr>
														<td></br></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div id="Contact" class="customer">
										<button type="button" id="addContact" style="float: right; margin-right: 10px;" onclick="openContactModal('contactButton')">Add Contact Person</button>
										<div id="contactModal" class="modal">
											<div class="contactModal-content">
												<div style="clear: left; width: 100%; height: 10%; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;" class="boldTextSmall">
													<div class="buff3"><!-- --></div>
													<div id="contactModaltitle" style="float:left; margin-left: 5px;">Add Contact Person</div>
												</div>
												<table style="padding: 5px;float: left;">
													<tbody>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">First Name</td>
															<td>
																<input type="text" style="width: 230px;" id="txtfName" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Last Name</td>
															<td>
																<input type="text" style="width: 230px;" id="txtlName" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Middle Initial</td>
															<td>
																<input type="text" style="width: 70px;" id="txtMiddle" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Birth Date</td>
															<td>
																<input type="text" style="width: 140px;" id="txtBirthdate" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 120px;">Contact Number</td>
															<td>
																<input type="text" style="width: 230px;" id="txtContactnum" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Mobile Number</td>
															<td>
																<input type="text" style="width: 230px;" id="txtMobilenum" name="">
															</td>
														</tr>	
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Email Address</td>
															<td>
																<input type="text" style="width: 230px;" id="txtEmail" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Department</td>
															<td>
																<input type="text" style="width: 230px;" id="txtDepartment" name="">
															</td>
														</tr>
														<tr>
															<td class="boldTextSmall" style="width: 80px;">Designation</td>
															<td>
																<input type="text" style="width: 230px;" id="txtDesignation" name="">
															</td>
														</tr>				
													</tbody>
												</table>
												<div class="buff3"><!-- --></div>
												<div class="contactModalbuttons" style="padding: 10px;">
													<button class="boldTextSmall" type="button" id="saveContact">Save</button>
													<button class="boldTextSmall" type="button" id="clearContact">Clear</button>
													<button class="boldTextSmall" type="button" id="cancelContact" onclick="cancelContactModal('contactCancel')">Cancel</button>
												</div>
											</div>
										</div>
										<div style="border: solid 1px #999; border-color: #ddd; width: 83%; float: left; margin-left: 20px;">
											<table class="tbl" id="tblContact" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
												<thead class="listHeaders">
													<tr style="cursor:pointer;color: #464646;">
														<th style="border-right: 1px solid #ddd;height: 20px; width: 9.22%;">First Name</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Last Name</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Middle Initial</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Birth Date</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Contact No.</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Mobile No.</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Email Address</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Department</th>
														<th style="border-right: 1px solid #ddd; width: 9.22%;">Designation</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></br></td>
													</tr>
													<tr>
														<td></br></td>
													</tr>
												</tbody>
											</table>
										</div>
										</br>
										</br>
										</br>
									</div>
									<div id="Billing" class="customer">
										<div style="border: solid 1px #999; border-color: #ddd; width: 80%">
											<table class="tbl" id="tblBilling" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
												<thead class="listHeaders">
													<tr style="cursor:pointer;color: #464646;">
														<th style="border-right: 1px solid #ddd;height: 20px; width: 16%;">Billing Statement No.</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Date Recieved</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Amount</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Aging</th>
														<th style="border-right: 1px solid #ddd; width: 16%;">Remarks</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></br></td>
													</tr>
													<tr>
														<td></br></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								</br>
								</br>
							</div>
							</br>
							</br>
							<div class="formButtons">
								<button type="button">Save</button>
								<button type="button">Clear</button>
								<button type="button">Cancel</button>
							</div>
						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</body>