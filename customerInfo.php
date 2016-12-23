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

	function clearCustomer(){
		 document.getElementById("1search").reset();
	}

</script>

</head>


<body onResize="updateToolbarPos();">


	<div class="scrollingContainer">
		<div class="subContainer " style="width: 950px;">
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
 		<div style="clear: left; width: 940px; height: 1000px; background-color: #fff; border: solid 1px #999;margin-top: 20px">
 			<div style="margin-left: 15px;margin-bottom: 40px;"><h1 style="color:#999999">Customer Information</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
 			<div>
 				<div align="center" style="margin-left: auto;margin-right: auto;clear: left; width: 910px; height: 120px; border: solid 1px #ddd; background-color: #eee; background-image: url('../images/background.gif');">
 					<!-- Header of Search FORM  -->
					<div class="boldTextSmall" style="clear: left; width: 910px; height: 20px; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;">
						<!-- Archive and Live Link at the Top of Search FORM -->
						<div style="clear: left; float: left; width: 5px;"><!-- --></div>
						<!-- Archive and Live Link at the Top of Search FORM -->
						<div style="clear: left; width: 830px; height: 20px; background-image: url('../images/header_bg.gif'); background-repeat: repeat-x;" class="boldTextSmall">
							<div style="clear: left; float: left; width: 5px;"><!-- --></div>
							<div style="float: left; width: 840px; height: 20px;" class="boldTextSmall" align="left">
								<div class="buff3"><!-- --></div>
								<div id="titleBarDescription" onmouseover="document.body.style.cursor='pointer';" onmouseout="document.body.style.cursor='auto';" onclick="toggleSearchBox();"  style="float:right">Click here to minimize</div>
							</div>
						</div>
 					</div>
 					<div id="SearchBox">
						<form id="1search" action="/CBL/addcustomer.php" style="float:left;padding: 10px; background-color: #eee;">
							<table>
								<tbody>
									<tr>
										<td width="330px;" valign="top">
											<table>
												<tbody>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Customer Name</td>
														<td><input type="text" id="txtCustomername" name="" style="width: 160px;"></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Area</td>
														<td>
															<input type="text" id="txtCompanyanniv" name="" style="width: 160px;">
														</td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Region</td>
														<td>
															<input type="text" id"txtTelnumber" name="" style="width: 160px;">
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="330px;" valign="top" style="padding-left: 20px;">
											<table>
												<tbody>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Industry Type</td>
														<td><select id="txtIndustrytype" style="width: 140px;">
															<option selected disabled>--Select Industry Type--</option>
															<option>MANUFACTURING</option>
															<option>DISTRIBUTION</option>
														</select></td>
													</tr>
													<tr>
														<td class="boldTextSmall" style="width: 100px;">Customer Status</td>
														<td class="boldTextSmall">
															<form action="">
  																<input type="radio" name="customerStatus" value="0"> All
																<input type="radio" name="customerStatus" value="1"> Active
																<input type="radio" name="customerStatus" value="2"> Inactive
															</form>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="330px;" valign="center" style="padding-left: 20px; padding-right: 20px;" align="right">
											<table>
												<tbody>
													<tr align="center">
														<td>
															<button class="boldTextSmall" type="button" id="customerSearch">Search</button>
															<button class="boldTextSmall" type="button" id="customerClear" onclick="clearCustomer()">Clear</button>
														</td>
													</tr>
													<tr>
														<td>
															<button class="boldTextSmall" type="submit" id="customerAdd">Add New Customer</button>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<div class="buff10"><!-- --></div>
					<div style="">
 						<div style="float:left;margin-left: 11px;">
 							<span><p class="boldTextSmall">### Customers were found</p></span>
 							<span><p class="boldTextSmall">Displaying Customers 0 to 0</p></span>
 						</div>
						<div style="float:right;margin-right: 11px;">
							<span><p class="boldTextSmall" >Current Page of 1 of 1</p></span>
 							<span><p class="boldTextSmall" >Enter page no: <input type="text" name="page" id="txtPage" value="1" style="width: 50px;"> <input type="button" name="go" value="Go" class="clear"></p></span>
						</div>
						<div style="clear: both;"></div>
 					</div>
					<div>
						<table class="tbl" id="tblCustomers" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
							<thead class="listHeaders">
								<tr style="cursor:pointer;color: #464646;">
									<th style="border-right: 1px solid #fff;height: 20px">Customer Code</th>
									<th style="border-right: 1px solid #fff;">Customer Name</th>
									<th style="border-right: 1px solid #fff;">Industry Type</th>
									<th style="border-right: 1px solid #fff;">Area</th>
									<th style="border-right: 1px solid #fff;">Region</th>
									<th style="border-right: 1px solid #fff;">Payment Terms</th>
									<th style="border-right: 1px solid #fff;">Aging</th>
									<th style="border-right: 1px solid #fff;">Credit Limit</th>
									<th style="border-right: 1px solid #fff;">Outstanding Balance</th>
									<th style="border-right: 1px solid #fff;">Amount Due</th>
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
</body>