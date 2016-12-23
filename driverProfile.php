<?php

session_start();
$_SESSION['page']="driverProfile";


require_once('header.php');

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
		createDatePicker('addBirthdate');
		createDatePicker('editBirthdate');
		getDriver();
	})


	var openEdialog = function(id,code,name,birth,age,address,type){

		$('#editID').val(id);
		$('#editDrivercode').val(code);
		$('#editDrivername').val(name);
		$('#editBirthdate').val(birth);
		$('#editAge').val(age);
		$('#editAddress').val(address);
		$('#editVectype').val(type);

		$('#editDriverdialog').dialog('open');
	}

	var getDriver = function(){
		var code = $('#txtDrivercode').val();
		var name = $('#txtDrivername').val();
		var type = $('#txtVectype').val();

		$('#tblDriver tbody').empty();
		$.post('getDriver.php',{code:code,name:name,type:type},function(data){
			var back = 0;
			var color ='#F2F2F2';
			
			$.each(data,function(index,value){

				if (back==0){
       					color ='#F2F2F2';
       					back=1;
				}else{
						color= "#FFF9F9";	
						back=0;
				}

				$('#tblDriver tbody').append("<tr style='background-color:"+color+"'><td style='text-align:center;'>"+value.code+"</td><td style='text-align:center;'>"+value.name+"</td><td style='text-align:center;'>"+value.type+"</td><td style='text-align:center;'><input type='button' name='' value='Edit' class='search' onclick='openEdialog(\""+value.id+"\",\""+value.code+"\",\""+value.name+"\",\""+value.birth+"\",\""+value.age+"\",\""+value.address+"\",\""+value.type+"\")'></td></tr>");

			})

		},'json');
	};

	var addDriver = function(){

		$('#addDriverdialog').dialog('open');
	}

	var clearAdd = function(){
		$('#addDriverdialog').find('input:text').val('');
		$('#addVectype').val('');
		$('#addAddress').val('');
	}
		var createDatePicker = function(id_from){

			$( "#" + id_from ).datepicker({

					//GET Age on Select
					onSelect: function(value) {
		        	var today = new Date(), 
		            dob = new Date(value), 
		            age = new Date(today - dob).getFullYear() - 1970;
        
       				 $('#addAge').val(age);
       				 $('#editAge').val(age);
   				 },
				showOn: "button",
				changeMonth: true,
				changeYear: true,
				buttonImage: "img/icon_calendar.png",
				dateFormat: "mm/dd/yy",
				buttonImageOnly: true,
				 maxDate: "0D" 
			});

	}

	$(function(){
		$('#addDriverdialog').dialog({
		
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
			    		var a = $('#addDrivercode').val();
			    		var b = $('#addDrivername').val();
			    		var c = $('#addBirthdate').val();
			    		var d = $('#addAge').val();
			    		var e = $('#addAddress').val();
			    		var f = $('#addVectype').val();

			    		$.post('addDriver.php',{code:a,name:b,birth:c,age:d,address:e,type:f},function(data){

			    			alert(data);
			    			clearAdd();

			    		})

			    	},
			    	"Cancel":function(){
			    		$(this).dialog('close');
			    	}
			    }
	})

		$('#editDriverdialog').dialog({
		
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
			    		var id = $('#editID').val();
			    		var a = $('#editDrivercode').val();
			    		var b = $('#editDrivername').val();
			    		var c = $('#editBirthdate').val();
			    		var d = $('#editAge').val();
			    		var e = $('#editAddress').val();
			    		var f = $('#editVectype').val();

			    		$.post('editDriver.php',{id:id,code:a,name:b,birth:c,age:d,address:e,type:f},function(data){

			    			alert(data);
			    			//clearAdd();

			    		})

			    	},
			    	"Cancel":function(){
			    		$(this).dialog('close');
			    	}
			    }
	})
	})

	

</script>

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
 			<div style="margin-left: 50px;margin-bottom: 40px;"><h1 style="color:#999999">Driver Profile</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
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
												<td class="boldTextSmall" style="width: 100px;">Driver Code</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="txtDrivercode" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Driver Name</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="txtDrivername" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;">Vehicle Type</td>
												<td class="boldTextSmall">
												<select id="txtVectype" name="">
													<option selected disabled>-- Select Vehicle Type --</option>
												</select> 
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td width="200px"></td>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
											<td>
												<input type="button" name="" value="Search" class="search" onclick="getDriver();"><span> </span><span> </span>	<input type="button" name="" value="Cancel" class="search" onclick="">
											</td>
											<td>
											<input type="button" name="" value="Add Driver" class="search" onclick="addDriver();">
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
			</div>

 			<div class="buff10"><!-- --></div>
			<div class="buff10"><!-- --></div>
			<div  style="    margin-left: 11px;margin-right: 11px;">
			<table class="tbl" id="tblDriver" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
			<thead class="listHeaders">
			<tr style="cursor:pointer;color: #464646;">
			<th style="border-right: 1px solid #fff;height: 20px">Driver Code</th>
			<th style="border-right: 1px solid #fff;">Driver Name</th>
			<th style="border-right: 1px solid #fff;">Vehicle Type</th>
			<th style="border-right: 1px solid #fff;">Action</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
			</div>
			<!-- DIALOG-->

			<div style="display: none;" id="addDriverdialog" title="Add New Driver">
				<table>
						<tbody>
							<tr>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Driver Code</td>
												<td class="boldTextSmall"><input class="boldTextSmall" type="text" id="editID" name="" style="display: none">
												<input class="boldTextSmall" type="text" id="addDrivercode" name="" >
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;"><span style="color: red">*</span> Driver Name</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="addDrivername" name="">
												</td>
												<tr id="rDrivername" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Driver Name is required field.</td></tr>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Birthday</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="addBirthdate" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Age</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="addAge" name="" disabled>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;"><span style="color: red">*</span> Address</td>
												<td class="boldTextSmall">
												<textarea  class="boldTextSmall" type="text" id="addAddress" name="" style="resize: none;"></textarea>
												</td>
												<tr id="rAddress" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Driver Address is required field.</td></tr>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;"><span style="color: red">*</span> Vehicle Type</td>
												<td class="boldTextSmall">
												<select id="addVectype" style="width: 150px;">
													<option selected disabled>-- Select Vehicle --</option>
													<option>Vehicle A</option>
													<option>Vehicle B</option>
													<option>Vehicle C</option>
												</select>
												</td>
												<tr id="rVectype" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Driver Vehicle Type is required field.</td></tr>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>	
			</div>

			<div style="display: none;" id="editDriverdialog" title="Edit New Driver">
				<table>
						<tbody>
							<tr>
								<td width="300px;">
									<table>
										<tbody>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Driver Code</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="editDrivercode" name="" >
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;"><span style="color: red">*</span> Driver Name</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="editDrivername" name="">
												</td>
												
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Birthday</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="editBirthdate" name="">
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;padding-left: 9px;">Age</td>
												<td class="boldTextSmall">
												<input class="boldTextSmall" type="text" id="editAge" name="" disabled>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;"><span style="color: red">*</span> Address</td>
												<td class="boldTextSmall">
												<textarea  class="boldTextSmall" type="text" id="editAddress" name="" style="resize: none;"></textarea>
												</td>
												
											</tr>
											<tr>
												<td class="boldTextSmall" style="width: 100px;"><span style="color: red">*</span> Vehicle Type</td>
												<td class="boldTextSmall">
												<select id="editVectype" style="width: 150px;">
													<option selected disabled>-- Select Vehicle --</option>
													<option>Vehicle A</option>
													<option>Vehicle B</option>
													<option>Vehicle C</option>
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
		</div>
		</div>
	</div>
	</div>
</body>