<?php

session_start();
$_SESSION['page']="UA";


require_once('header.php');

?>

<head>
	<style type="text/css">
		#SearchBox{
		display: block;
	    width: 950px;
	    height: 110px;
	    background-color: #cccccc;
	    background-image: url(/images/background.gif);
	    display: block;
	    margin-left: auto;
	    margin-right: auto;
	}
	.name_class{
		clear: left; float: left; width: 78px; padding-top: 2px;
	}
	.labels{
		float: left; width: 182px; padding-top: 3px; padding-left: 2px;
	}
	.labels2{
		float: left;width: 182px; padding-top: 4px; padding-left: 2px;
			}
	.usercheckacc_box{
		    font-size: small;
	}
	</style>

	<script type="text/javascript">

	$(document).ready(function(){
		getUserdatas();
		accessCheckbox();
	$('#selectUsertype').on('change',function(){
			accessCheckbox($(this).val());
		})

	

		
	})

	var accessCheckbox = function(type){

			$.post('getCheckboxes.php',{type:type},function(data){
					
					$('#editUserType').empty();

					$('#editUserType').append("<table><tbody><tr><td class='boldTextSmall' style=''>PORTAL APPLICATIONS </td></tr></tbody></table>");
					$.each(data,function(index,value){
						var arr = value.access;
						var split_this = arr.split(',');
						for (var i = 0; i < split_this.length; i++) {

							if (i==0) {
								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>USER ADMINISTRATION</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>USER ADMINISTRATION</td></tr>");
								}

							}else if(i==1){

								if (split_this[i]==1){
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>MAINTENANCE</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>MAINTENANCE</td></tr>");
								}

							}else if(i==2){

								if (split_this[i]==1){
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>CUSTOMER INFORMATION</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>CUSTOMER INFORMATION</td></tr>");
								}

							}else if(i==3){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>BOOKING</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>BOOKING</td></tr>");
								}

							}else if(i==4){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>WAREHOUSE</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>WAREHOUSE</td></tr>");
								}
								
							}else if(i==5){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>BILL OF LADING</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>BILL OF LADING</td></tr>");
								}
								
							}else if(i==6){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>BILLING</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>BILLING</td></tr>");
								}
								
							}else if(i==7){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>COLLECTION CALL-OUT</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>COLLECTION CALL-OUT</td></tr>");
								}
								
							}else if(i==8){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>PAYMENT</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>PAYMENT</td></tr>");
								}
								
							}else if(i==9){

								if (split_this[i]==1){

									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='1' checked><b>REPORTS</td></tr>");
								}else{
									$('#editUserType').append("<tr><td><input class='usercheck_box' type='checkbox' value='0'><b>REPORTS</td></tr>");
								}
								
							}
						}
					});
			},'json');
		}

		var showTypeaccess = function(){

			$.post('getUtypeaccess.php',function(data){
					$('#selectUsertype').empty();
					
					$.each(data,function(index,value){
						$('#selectUsertype').append("<option>"+value.type+"</option>");
					/*	*/
					});

			},'json');
			$('#EditUser_Type').dialog('open');
		}
		var showTypeUseraccess = function(id,type,logid){

			$('#role_Access1').html('Role access settings for: '+logid);
			$("#hidden_shit").val(id);
			
			$.post('getUserAccess.php',{id:id},function(data){
				var arr_access = new Array();
		
				$.each(data,function(index,value){
					
					var main 	= 	value.m.split(",");
					var s1 		= 	value.s1.split(",");
					var s2 		= 	value.s2.split(",");
					var s3 		= 	value.s3.split(",");
					var s4 		= 	value.s4.split(",");
					var s5 		= 	value.s5.split(",");
					var s6 		= 	value.s6.split(",");
					var s7 		= 	value.s7.split(",");
					var s8 		= 	value.s8.split(",");
					var s9 		= 	value.s9.split(",");
					var s10 	= 	value.s10.split(",");
					var count =1;
					var sc1=1;
					
					console.log(s1.length+ " " +s2.length+ " " +s3.length+ " " +s4.length+ " " +s5.length+ " " +s6.length+ " " +s7.length+ " " +s8.length+ " " +s9.length+ " " +s10.length);
					$.each(main,function(index,m_value){
						if (count==1) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s1,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==2) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s2,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==3) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s3,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==4) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s4,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==5) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s5,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==6) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s6,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==7) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s7,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==8) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s8,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==9) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s9,function(index,s_value){
									arr_access.push(s_value);
								})
						}else if (count==10) {
							if (m_value==1){
									arr_access.push(m_value);
								}else{
									arr_access.push(m_value);
								}
								$.each(s10,function(index,s_value){
									arr_access.push(s_value);
								})
						}
					count++;
					})
				})
				var a =0;
					$('input:checkbox[class=usercheckacc_box]').each(function(){
			    			if(arr_access[a]==1){
          						$(this).prop('checked',true);
    				
    						}else{
          						$(this).prop('checked',false);
          					}
          					
          				a++;
			    	});
						arr_access =[];
				},"JSON");
					

				
			$('#EditUser_TypeAccess').dialog('open');

		
		}
		var deactivateAccount = function(id){

			if (confirm("Are you sure you want to deactivate this user?")==true) {
				$.post('dactivate.php',{id:id},function(data){
					alert(data);
					getUserdatas();
				});
			}
		}

		var dash = function(txt){
				
				
		}
		var openAddUser = function(){
			$('#newUserdialog').dialog('open');
		}

		var clearDialog= function(){

			$('#newUserdialog').find('input:text').val('');
			$('#newUserdialog').find('input:password').val('');
		}

		var showDetails = function(item){
				
			if ($("#div_"+item).css("display")=="none") {

				$("#div_"+item).css("display","block");
				$("#item"+item).css('background-image','url(./img/icon_collapse.gif)');
			}else if($("#div_"+item).css("display")=="block"){

				$("#div_"+item).css("display","none");
				$("#item"+item).css('background-image','url(./img/icon_expand.gif)');
			}
		}

		var EditUser = function(id,logid,fname,mname,lname,email,utype,mobile,dept,pos){
			$('#UpuserDialog').empty();
			$('#UpuserDialog').append("<table><tbody><tr><input type='text' id='Upid' name='' style='width: 150px;font-size: small;display:none;'  value='"+id+"'><td class='boldTextSmall' style=''>Login ID </td><td><input class='usrnamevalidation' type='text' id='upLogid' name='' style='width: 150px;font-size: small;'  value='"+logid+"' onkeypress='dash(\"upLogid\");'></td></tr><tr><td class='boldTextSmall' style=''>First Name </td><td><input type='text' id='upFname' onkeypress='validateName(event,\""+'First Name'+"\",\""+'upFname'+"\");' style='width: 150px;font-size: small;'  value='"+fname+"'></td></tr><tr><td class='boldTextSmall' style=''>Middle Name </td><td><input type='text' id='upMname' onkeypress='validateName(event,\""+'Middle Name'+"\",\""+'upMname'+"\");'  name='' style='width: 150px;font-size: small;'  value='"+mname+"'></td></tr><tr><td class='boldTextSmall' style=''>Last Name </td><td><input type='text' id='upLname' onkeypress='validateName(event,\""+'Last Name'+"\",\""+'upLname'+"\");' name='' style='width: 150px;font-size: small;'  value='"+lname+"'></td></tr><tr><td class='boldTextSmall' style=''>Mobile No </td><td><input type='text' id='upMobile' name='' style='width: 150px;font-size: small;' onkeypress='validateNumber(event,\""+'Mobile No.'+"\",\""+'upMobile'+"\")' value='"+mobile+"' maxlength=''></td></tr><tr><td class='boldTextSmall' style=''>Email Address </td><td><input type='text' id='upEmail' name='' style='width: 150px;font-size: small;' onkeypress='validateEmail(event,\""+'Email Address'+"\",\""+'upEmail'+"\")'  value='"+email+"'></td></tr><tr><td class='boldTextSmall' style='width: 100px;'>User Type</td><td class='boldTextSmall'><select id='Uputype' style='width: 150px;' selected='"+utype+"'><option disabled>All</option><option>System Administrator</option><option>Manager</option><option>Supervisor</option><option>Regular User</option></select></td></tr><tr><td class='boldTextSmall' style=''>Department </td><td><input type='text' id='upDept'  onkeypress='validateName(event,\""+'Department'+"\",\""+'upDept'+"\");' name='' style='width: 150px;font-size: small;'  value='"+dept+"'></td></tr><tr><td class='boldTextSmall' style=''>Position </td><td><input type='text' id='upPos'  onkeypress='validateName(event,\""+'Position'+"\",\""+'upPos'+"\");'  name='' style='width: 150px;font-size: small;'  value='"+pos+"'></td></tr><tr style='height: 20px;'><td></td></tr><tr><td class='boldTextSmall' style=''>Password</td><td><input onkeypress='validatePassword(event,\""+'Password'+"\",\""+'Uppass'+"\")' type='password' id='Uppass' name='' style='width: 150px;font-size: small;'></td></tr><tr><td class='boldTextSmall' style=''>Confirm Password</td><td><input type='password' id='Upconpass'  onkeypress='validatePassword(event,\""+'Confirm Password'+"\",\""+'Upconpass'+"\")'  name='' style='width: 150px;font-size: small;'></td></tr></tbody></table>");

		

			$('#UpuserDialog').dialog('open');

		}

		var GODATA = function(){
			if ($('#txtPage').val() > $('#txtlastpage').val()) {
       			alert("Invalid page number");
       			$('#txtPage').val(1);
       			
       		}else if($('#txtPage').val()==""){
       			alert("Please indicate page number.");
       		}else{
       			getUserdatas();
       		}
		}

		var getUserdatas = function(){
			var a = $('#txtUsertype').val();
			var b = $('#txtLogid').val();
			var c = $('#txtUsername').val();
       		var d = $('#txtPage').val();

       		if (a=="All") {
       			a = '';
       		}

			$.post('getUser.php',{utype:a,logid:b,uname:c,page:$('#txtPage').val()},function(data){

					$('#tblUaccess').empty();
					var totalrows;
					var back = 0;
					var color ='#F2F2F2';
					$.each(data,function(index,value){

						if (back==0){
       						color ='#F2F2F2';
       						back=1;
						}else{

							back=0;
						}
						$('#tblUaccess').append("<div class='overviewList' style='background-color:"+color+"'><td><div id='item"+value.id+"' style='clear: left; float: left; width: 9px; height: 9px; margin-top: 2px; margin-left: 3px; background-image: url(&quot;./img/icon_expand.gif&quot;); margin-right: 10px;background-repeat: no-repeat;cursor:pointer' onclick='showDetails(\""+value.id+"\");'><!-- --></div><div class='labels2' >"+value.uname+"</div><div class='labels2' >"+value.logid+"</div><div class='labels2' >"+value.utype+"</div><div class='labels2' style='width: 230px;'>"+value.last_login+"</div><div id='div_"+value.id+"' style='clear: left; width: auto; height: auto; padding-top: 3px; padding-left: 2px; display: none;'><table><tbody><tr><td width='300px;' style='padding: 10px;'><table><tbody><tr><td class='boldTextSmall' style=''>First Name</td><td><input type='text' id='' value='"+value.fname+"' name='' style='width: 150px;font-size: small;'disabled></td></tr><tr><td class='boldTextSmall' style=''>Middle Name</td><td><input type='text' id='' value='"+value.mname+"' name='' style='width: 150px;font-size: small;'disabled></td></tr><tr><td class='boldTextSmall' style=''>First Name</td><td><input type='text' id='' value='"+value.lname+"' name='' style='width: 150px;font-size: small;'disabled></td></tr></tbody></table></td><td width='300px;' style='padding: 10px;' valign='top'><table><tbody><tr><td class='boldTextSmall' style=''>User Type</td><td><input type='text' id='' value='"+value.utype+"' name='' style='width: 150px;font-size: small;'disabled></td></tr><tr><td class='boldTextSmall' style=''>Email Address</td><td><input type='text' id='' value='"+value.email+"' name='' style='width: 150px;font-size: small;'disabled></td><tr><td class='boldTextSmall' style=''>Mobile Number</td><td><input type='text' id='' value='"+value.mobile+"' name='' style='width: 150px;font-size: small;'disabled></td></tr></tr></tbody></table></td><td width='300px;' style='padding: 10px;' valign='bottom'><table><tbody><tr><td><input type='button' name='' value='Access Settings' class='search' onclick='showTypeUseraccess(\""+value.id+"\",\""+value.utype+"\",\""+value.logid+"\");'><span> </span></td><td><input type='button' name='' value='Edit User' class='search' onclick='EditUser(\""+value.id+"\",\""+value.logid+"\",\""+value.fname+"\",\""+value.mname+"\",\""+value.lname+"\",\""+value.email+"\",\""+value.utype+"\",\""+value.mobile+"\",\""+value.dept+"\",\""+value.position+"\");'><span> </span></td><td><input type='button' name='' value='De-activate User' class='search' onclick='deactivateAccount(\""+value.id+"\")'><span> </span></td></tr></tbody></table></td></tr></tbody></table></div>");
						totalrows = value.totalrows;
						$('#txtlastpage').val(value.lastpage);
						$('#resultPage').html("Current Page "+$('#txtPage').val()+" of "+$('#txtlastpage').val()+"");

					})

				$('#resultFound').html(totalrows+' User were found');
       			$('#resultCount').html('Displaying User 1 to '+totalrows);
					if (data ==false) {
						alert("No records were found.");

						$('#resultFound').html('No User were found');
       					$('#resultCount').html('Displaying User 0 to '+totalrows);
					}
				

			},'json');
		}
		
		$(function(){
			$('#newUserdialog').dialog({
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
			    height: 400,
			    buttons: {
			    	"Save":function(){

			    		var a = $('#addLogid').val();
			    		var b = $('#addFirstname').val();
			    		var c = $('#addMidname').val();
			    		var d = $('#addLastname').val();
			    		var e = $('#addMobile').val();
			    		var f = $('#addEmail').val();
			    		var g = $('#addDept').val()
			    		var h = $('#addUsertype').val();
			    		var i = $('#addPosition').val();
			    		var j = $('#addPassword').val();
			    		var k = $('#addConpassword').val();

			    		if (a =='') {
			    			$('#required_dialog').dialog('open');
			    		}else if (b =='') {
			    			$('#required_dialog').dialog('open');
			    		}else if (c =='') {
			    			$('#required_dialog').dialog('open');
			    		}else if (d =='') {
			    			$('#required_dialog').dialog('open');
			    		}else if (g =='') {
			    			$('#required_dialog').dialog('open');
			    		}else if (i =='') {
			    			$('#required_dialog').dialog('open');
			    		}else if ( f=='') {
			    			$('#required_dialog').dialog('open');
			    		}else if (!ValidateEmail(f)) {
            						alert("Email Address must be in the format email@<domain name>.");
        				}else if (e =='') {
			    			alert("Mobile ID is a required field.");
			    		}else if(e.length < 13){
			    			alert("Mobile Number format +63xxxxxxxxxx (e.g +639999999999).");
			    		}else if(e.substring(0, 3)!="+63"){
			    			alert("Mobile Number format +63xxxxxxxxxx (e.g +639999999999).");
			    		}else if (j ==""){
			    			$('#required_dialog').dialog('open');
			    		}else if (k ==""){
			    			$('#required_dialog').dialog('open');
			    		}else if ((j.length <5 && j.length >=1) || (k.length < 5 && k.length >=1)) {
			    			alert("Min length is 5 characters.");
			    		}else if (j!= k) {
			    			alert("Password did not match");
			    		}else{


			    		$.post('addUaccess.php',{logid:a,fname:b,mname:c,lname:d,mobile:e,email:f,dept:g,utype:h,position:i,pass:j,cpass:k},function(data){

			    			alert(data);
							clearDialog();
			    		});
			    	}
			    		

			    	},
			    	"Cancel":function(){
			    		$(this).dialog("close");
			    		clearDialog();
			    	}
			    }
			})

			$('#EditUser_TypeAccess').dialog({
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
			    width: 600,
			    height: 550,
			    buttons: {
			    	"Save Settings":function(){

			    			var main = new Array();
			    			var id = $('#hidden_shit').val();
			    			var count = 0;
			    			$('input:checkbox[class=usercheckacc_box]').each(function(){
			    				if ($(this).prop('checked')) {
			    					
			    						main.push('1');
			    					
			    				}else{
			    						main.push('0');
			    				}
			    			})

			    			$.post('updateUserAccessType.php',{main:main,id:id,name:$('#role_Access1').val()},function(data){

			    				alert(data);
			    			})
			    			count="";
			  		 },
			  		 "Cancel":function(){
			  		 	$(this).dialog('close');
			  		 }
					}
			    });
			$('#EditUser_Type').dialog({
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
			    height: 370,
			    buttons: {
			    	"Save Settings":function(){
			    		var checkList = [];
			    		$('input:checkbox[class=usercheck_box]').each(function(){
			    			if($(this).prop('checked')){
          						checkList.push('1');
          						alert
    						}else{
          						checkList.push('0');
          					}
			    			

			    		});
			    		var type= $('#selectUsertype').val();
			    		
			    		console.log(checkList);
			    		 
			    	$.post('saveTypeaccess.php',{type:type,ua:checkList[0],mtc:checkList[1],ci:checkList[2],bk:checkList[3],wh:checkList[4],bol:checkList[5],blng:checkList[6],cco:checkList[7],pymt:checkList[8],rpts:checkList[9]},function(data){

			    				if (data==1) {
			    					alert('The settings for user type '+type+' were successfully saved.');
			    				}
			    		});
						checkList = [];
			    		accessCheckbox($('#selectUsertype').val());
			    		
			    	},
			    	"Reset Settings":function(){
			    		accessCheckbox($('#selectUsertype').val());
			    	},
			    	"Cancel":function(){
			    		$(this).dialog('close');
			    	}
			    }})
			$('#required_dialog').dialog({
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
			    width: 300,
			    height: 350,
			    open: function(event, ui){
     			setTimeout("$('#required_dialog').dialog('close')",3000);
    			},
			    buttons: {
			    		"Close":function(){$(this).dialog('close');
			    		}
			    }
			});
			$('#UpuserDialog').dialog({
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
			    height: 400,
			    buttons: {
			    		"Update Password":function(){

			    				var k = $('#Uppass').val();
			    				var l = $('#Upconpass').val();

			    				if(k==''){
			    					alert('Password is a required field.');
			    				}else if(l==''){
			    					alert('Confirm Password is a required field.');
			    				}else if(k.length < 5 && k.length >=1){
			    					alert('Min length is 5 characters.');
			    				}else if(l.length < 5 && l.length >=1){
			    					alert('Min length is 5 characters.');
			    				}else if(k!=l){
			    					alert('Password did not match');
			    				}else{

			    					$.post('updateAccess.php',{def:0,pass1:k,pass2:l},function(data){

			    						if (data=="Success") {

			    							alert("Password successfully updated.");
			    						getUserdatas();
			    						$('#UpuserDialog').dialog('close');
			    					}
			    					})

			    				}


			    		},"Update User":function(){
			    				var a = $('#Upid').val();
			    				var b = $('#upLogid').val();
			    				var c = $('#upFname').val();
			    				var d = $('#upMname').val();
			    				var e = $('#upLname').val();
			    				var f = $('#upMobile').val();
			    				var g = $('#upEmail').val();
			    				var h = $('#Uputype').val();
			    				var i = $('#upDept').val();
			    				var j = $('#upPos').val();

			    				if (b=='') {
			    					alert('Login ID is a required field.');
			    				}else if(f==''){
			    					alert('User Name is a required field.');
			    				}else if(f==''){
			    					alert('Mobile Number is a required field.');
			    				}else if(f.substring(0, 3)!="+63"){
			    					alert("Mobile Number format +63xxxxxxxxxx (e.g +639999999999).");
			    				}else if(f.length < 13){
			    					alert("Mobile Number format +63xxxxxxxxxx (e.g +639999999999).");
			    				}else if(g==''){
			    					alert('Email Address is a required field.');
			    				}else if (!ValidateEmail(g)) {
            						alert("Email Address must be in the format email@<domain name>.");
        							}else if(i==''){
			    					alert('Department is a required field.');
			    				}else if(j==''){
			    					alert('Position is a required field.');
			    				}else{

			    					$.post('updateAccess.php',{def:1,id:a,login:b,fname:c,mname:d,lname:e,mobile:f,email:g,type:h,dept:i,pos:j},function(data){

			    						if (data=="Success") {

			    							alert("User updated successfully.");
			    						getUserdatas();
			    						$('#UpuserDialog').dialog('close');
			    					}
			    					})
			    				}
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
				<option value=""></option>
				<option value=""></option>
				<option value=""></option>
			</select><span id=""> </span><a style="cursor: pointer;text-decoration: underline;" id="switchPort" onclick="switchPortal();">[switch]</a>
			</div>

 		</div>
 		<br>
 		<div style="clear: left; width: 970px;padding-bottom: 30px;
    margin-bottom: 100px; background-color: #fff; border: solid 1px #999;margin-top: 20px;position: absolute;">
 			<div style="margin-left: 50px;margin-bottom: 40px;"><h1 style="color:#999999">User Administration</h1><h3 style="color:#cc0000;margin-top: -20px;"><i>For test account</i></h3></div>
 			<div style="overflow: auto;height: 500px;">
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
												<td class="boldTextSmall" style="width: 100px;">User Type</td>
												<td class="boldTextSmall">
												<select id="txtUsertype" style="width: 150px;">
													<option selected >All</option>
													<option>System Administrator</option>
													<option>Manager</option>
													<option>Supervisor</option>
													<option>Regular User</option>
												</select>
												</td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">Login ID</td>
												<td><input class="regvalidation" type="text" id="txtLogid" name="" style="width: 150px;"></td>
											</tr>
											<tr>
												<td class="boldTextSmall" style="">User Name</td>
												<td><input class="usrnamevalidation" type="text" id="txtUsername" name="" style="width: 150px;"></td>
											</tr>
											<tr style="">
											<td>
												
											</td>
											<td style="float:right">
												<input type="button" name="" value="Search" class="search" onclick="getUserdatas();"><span> </span>
											</td>
											</tr>
										</tbody>
									</table>	
								</td>
								<td width="400px"></td>
								<td valign="top">
								<table>
									<tbody>
									<tr style="">
											<td>
												<input type="button" name="" value="Add New User" class="search" onclick="openAddUser();"><span> </span>
											</td>
											<td >
												<input type="button" name="" value="Manage New User Type" class="search" onclick="showTypeaccess();"><span> </span>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			<div style="">
 			<div style="float:left;margin-left: 11px;">
 			<span><p class="boldTextSmall" id="resultFound"></p></span>
 			<span><p class="boldTextSmall" id="resultCount"></p></span>
 			</div>
 			<div style="float:right;margin-right: 11px;">
 			<span><p class="boldTextSmall" id="resultPage">Current Page of 1 of </p><p id="txtlastpage"></p></span>
 			<span><p class="boldTextSmall" >Enter page no: <input type="text" name="page" id="txtPage" value="1" style="width: 50px;"> <input type="button" name="go" value="Go" class="clear" onclick="GODATA();"></p></span>
 			</div>
 			<div style="clear: both;"></div>
 			</div>

 				
 			</div>
 			<div  style="    margin-left: 11px;margin-right: 11px;">
 			
			<div class="overviewHeader">
						<div style="clear: left; float: left; width: 13px; height: 20px;"></div>
						<div style="float: left; width: 20px; height: 20px;"></div>
						<div class="labels">User Name</div>
						<div class="labels">Login ID</div>
						<div class="labels">User Type</div>
						<div class="labels">Last Login</div>
			</div>
			<div id="tblUaccess">
			</div>
			</div>
 			<!--FOR DIALOGS-->
 			<div id="newUserdialog" style="display: none;" title="Add New User">
 				<table>
					<tbody>
						<tr style="">
							<td class="boldTextSmall" style="">Login ID</td>
							<td><input class="regvalidation" type="text" id="addLogid" name="" style="width: 150px;font-size: small;" maxlength="25"></td>
							<tr id="rlogid" style="display: none;"><td></td><td class="boldTextSmall regvalidation" style="color:red;">Login ID is required field.</td></tr>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">First Name</td>
							<td><input type="text" id="addFirstname" onkeypress="validateName(event,'First Name','addFirstname');" name="" style="width: 150px;font-size: small;"></td>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Middle Name</td>
							<td><input type="text" id="addMidname" onkeypress="validateName(event,'Middle Name','addMidname');" name="" style="width: 150px;font-size: small;"></td>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Last Name</td>
							<td><input type="text" id="addLastname" onkeypress="validateName(event,'Last Name','addLastname');" name="" style="width: 150px;font-size: small;"></td>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Mobile No.</td>
							<td><input type="text" id="addMobile" onkeypress="validateNumber(event,'Mobile No.','addMobile');" name="" style="width: 150px;font-size: small;"></td>
							<tr id="rmobile" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Mobile no. is required field.</td></tr>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Email Address</td>
							<td><input type="text" id="addEmail" onkeypress="validateEmail(event,'Email Address','addEmail');"  name="" style="width: 150px;font-size: small;"></td>
							<tr id="remail" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Email address is required field.</td></tr>
						</tr>
						<tr>
							<td class="boldTextSmall" style="width: 100px;">User Type</td>
								<td class="boldTextSmall">
								<select id="addUsertype" style="width: 150px;font-size: small;">
									<option selected>System Administrator</option>
									<option>Manager</option>
									<option>Supervisor</option>
									<option>Regular User</option>
								</select>
							</td>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Department</td>
							<td><input type="text" id="addDept" onkeypress="validateName1(event,'Department','addDept');"  name="" style="width: 150px;font-size: small;"></td>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Position</td>
							<td><input type="text" id="addPosition" onkeypress="validateName1(event,'Position','addPosition');"   name="" style="width: 150px;font-size: small;"></td>
						</tr>

						<tr style="height: 20px;"><td></td></tr>

						<tr style="">
							<td class="boldTextSmall" style="">Password</td>
							<td><input type="password" id="addPassword" onkeypress="validatePassword(event,'Password','addPassword');"   name="" style="width: 150px;font-size: small;"></td>
							<tr id="rpass" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Password is required field.</td></tr>
						</tr>
						<tr style="">
							<td class="boldTextSmall" style="">Confirm Password</td>
							<td><input type="password" id="addConpassword" onkeypress="validatePassword(event,'Confirm Password','addConpassword');" name="" style="width: 150px;font-size: small;"></td>
							<tr id="rconpass" style="display: none;"><td></td><td class="boldTextSmall" style="color:red;">Confirm password is required field.</td></tr>
						</tr>
					</tbody>
				</table>
 			</div>

 			<div id="UpuserDialog" style="display: none;" title="Update User"></div>
 				<div id="updateUser" style="float:left;padding: 10px;">

 				</div>
 			</div>


 			<div id="EditUser_Type" style="display: none;" title="Manage User Type">
 					<table>
					<tbody>
						<tr><td class="boldTextSmall" style="">Role access settings for: </td>
							<td class="boldTextSmall">
								<select id="selectUsertype" style="width: 150px;font-size: small;" >

								</select>
							</td>
						</tr>
						</tbody>
					</table>
				<div id="editUserType" style="float:left;padding: 10px;">
					<table>
					<tbody>
						<tr>
							<td class="boldTextSmall" style="">PORTAL APPLICATIONS </td>
						</tr>
					</tbody>
					</table>
 				</div>


 			</div>

 			<div id="EditUser_TypeAccess" style="display: none;    background-color: #eee;" title="Manage User Type">
 			<input type='text' id='hidden_shit' value='' style="display: none">
 					<table>
					<tbody>
						<tr>
								<td id="role_Access1" class="boldTextSmall" style=""></td>
						</tr>
						</tbody>
					</table>
				<div id="editUserTypeAccess" style="float:left;padding: 10px;">
				<table>
					<tbody>
					<tr>
						<td style="font-weight: bold;"><input class='usercheckacc_box' type='checkbox' value='1'>USER ADMINISTRATION</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Create User Account and Assign corresponding User Type</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Search for User Account using User Type, Login or User Name</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View User Account Details</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View Own User Account Details via 'My Account' toolbar</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Updated User Account Details</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update modules that the selected user account can access</td>
					</tr>

					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update modules that selected user type can access</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Own User Account via 'My Account' toolbar</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Deactivate a selected User Account</td>
					</tr>
 					
 					
					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>MAINTENANCE</td>
					</tr>	
					<tr>
						<td>General Settings</td>
 					</tr>
 					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown and Checkbox Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Search specific Dropdown or Checkbox</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View Dropdown and Checkbox Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown and Checkbox Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Upload Price Matrix for Billing</td>
					</tr>
					<tr>
						<td>Driver Information</td>
 					</tr>
 					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Driver Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Checkbox Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Driver Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View Driver Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Driver Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Driver Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Checkbox Content</td>
					</tr>
					<tr>
						<td>Vehicle Information</td>
 					</tr>
 					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Vehicle Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Vehicle using Vehicle Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View Vehicle Details</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Vehicle Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Vehicle Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown Content</td>
					</tr>
					<tr>
						<td>Location Management</td>
 					</tr>
 					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Location</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Location</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View Location Details</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Location Details</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Remove Location</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown Content</td>
					</tr>
					
 					
 					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>CUSTOMER INFORMATION</td>
					
					
 					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Customer Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown Content</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Customer Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>View Customer Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Customer Information</td>
					</tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown Content</td>
					</tr>
					
					
 					</tr>
 					<tr><td><span><br></span></td></tr>
 					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>BOOKING</td>
						
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Book Shipments</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown Contents</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Booking Request Form</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Booking Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Names who Created, Monitored and Approved Specific Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Booking Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Booking Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown Contents</td>
								</tr>
						
					</tr>

 					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>WAREHOUSE</td>
					
								<tr>
								<td>Warehouse</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Racks, Shelves or Bay</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Warehouse Storage View or Shelves View</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Shipment Locationt</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Shipment Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Packing List for Pull Out</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Available Slots</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Move Rack or Bay</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Remove Rack, Shelves or Bay</td>
								</tr>
								<tr>
								<td>Location Management</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Location or Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Different Locations and Shipments per Location</td>
								</tr>
								<tr>
								<td>Inbound Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Place Shipment on Warehouse</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown Content</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Inbound Shipment
								</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Inbound Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Shipment Details </td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Pull Out Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown Content</td>
								</tr>
								<tr>
								<td>Outbound Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Outbound Shipment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Shipment Status</td>
								</tr>


					</tr>
					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>BILL OF LADING</td>
				
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Bill of Lading</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown and Checkbox Content</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Generate Billing Report</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Bill of Lading</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Bill of Lading</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Names who Created, Reviewed and Approved Specific Bill of Lading</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Bill of Lading Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown and Checkbox Content</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Download PDF Format</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>DownloadExcel File</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Print in PDF Format</td>
								</tr>
					
					</tr>
					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>BILLING</td>
				
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Billing Statement </td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Billing Statement</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Billing Statement</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Billing Statement Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Void Generated Billing Statement</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Download PDF Format</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>DownloadExcel File</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Print in PDF Format</td>
								</tr>
					</tr>
					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>COLLECTION CALL-OUT</td>
						<table>
							<tbody>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Collection Call Out</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Billing Statement</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Billing Statement and History Logs</td>
								</tr>
					</tr>
					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>PAYMENT</td>
				
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Payment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Add Dropdown Content</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Payment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Payment Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Update Payment Details</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Payment</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Delete Dropdown Content</td>
								</tr>
					</tr>
					<tr><td><span><br></span></td></tr>
					<tr>
						<td><input class='usercheckacc_box' type='checkbox' value='1'><b/>REPORTS</td>
					
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Generate Reports</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Search Reports</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>View Reports</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Download PDF Format</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Download Excel File</td>
								</tr>
								<tr>
								<td><input class='usercheckacc_box' type='checkbox' value='1'>Print Reports in PDF Format</td>
								</tr>
					</tbody>
				</table>
 				</div>

 				
 			</div>


 		</div>
 		</div>
 		</div>

 		<div id=required_dialog style="display: none;" title="Reqired Fields">
 			<table>
 				<tbody>
 					<tr><td>Login ID is a required field.</td></tr>
 					<tr><td>First Name is a required field.</td></tr>
 					<tr><td>Middle Name is a required field.</td></tr>
 					<tr><td>Last Name is a required field.</td></tr>
 					<tr><td>Mobile No. is a required field.</td></tr>
 					<tr><td>Email is a required field.</td></tr>
 					<tr><td>Department is a required field.</td></tr>
 					<tr><td>Position is a required field.</td></tr>
 					<tr><td>Password is a required field.</td></tr>
 					<tr><td>Confirm Password is a required field.</td></tr>
 				</tbody>
 			</table>
 		</div>
</body>