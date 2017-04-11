//set active link
function setactivelink(){
	var pathname = window.location.pathname;
	pathname = pathname.replace('/','');
	$('li a[href="'+pathname+'"]').parent().addClass('active');

}
setactivelink();


toastr.options = {
  "preventDuplicates": true,
  "positionClass": "toast-top-center"
}


function new_alert(msg,type=1){
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-center",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}	
	
}

function SelectOption(select, option){
	return option[select];
}
function CreateSelectOption(select, option, col){
	content = "<select col='"+col+"'>";
	$.each(option, function( index, value ) {
		if(select==index){
			var selected = 'selected';
		}else{
			var selected = '';
		}
		content +="<option value='"+index+"' "+selected+">"+value+"</option>";
	});
	content +="</select>";
	return content;
}

function createPostData(classused){
		var array = new Object();	
		var array2 = new Object();	
			array['error'] = '';
			$('.'+classused+' div').removeClass('has-error');	
			$('.'+classused).removeClass('has-error');	
		
	$('.'+classused+' input[type="text"], .'+classused+' input[type="number"], .'+classused+' select, .'+classused+' input[type="hidden"], .'+classused+' input[type="date"], .'+classused+' input[type="password"]').each(function( data ) {
			var c = $(this).attr('col');
			var v = $(this).val();
			if(c!=undefined && c!=''){
				array2[c] = v;

				if($(this).hasClass('not_mandatory')){

				}else if((!v || v=='')){
					$('#'+this.id+'_container').addClass('has-error');
					array['error'] = 'Complete the fields';
				}
			}
	});	

	$('.'+classused+' input[type="radio"]').each(function( data ) {
			var c = $(this).attr('col');
			var v = $(this).val();
			if(c!=undefined){
				if($(this).is(':checked')){
					array2[c] = v;					
				}
			}
	});

	$('.'+classused+' input[type="checkbox"]').each(function( data ) {
			var c = $(this).attr('col');
			var v = $(this).val();
			if(c!=undefined){
				array2[c] = $(this).is(':checked');					
			}
	});
	array['data'] = array2;
	return array;
// 
}


function resetchosen(id){	
	$('#'+id).chosen('destroy');
	$('#'+id).val('');
	$('#'+id).chosen();
}

function dateformat(object){

    $(object).keyup(function(e){
        if (e.keyCode != 8){    
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            }else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        }
    }); 

}

function getClockTime(){
   var now    = new Date();
   var hour   = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   var ap = "AM";
   if (hour   > 11) { ap = "PM";             }
   if (hour   > 12) { hour = hour - 12;      }
   if (hour   == 0) { hour = 12;             }
   if (hour   < 10) { hour   = "0" + hour;   }
   if (minute < 10) { minute = "0" + minute; }
   if (second < 10) { second = "0" + second; }
   var timeString = hour + ':' + minute + ' ' + ap;
   return timeString;
}

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

Array.prototype.remove = function(from, to){
  this.splice(from, (to=[0,from||1,++to-from][arguments.length])<0?this.length+to:to);
  return this.length;
};


function dpremove(){
	alert('Not Available');
	$('.dropdown').removeClass('open');
}

$('.dropdown [dp]').click(function(){
	$('.dropdown-menu .dropdown').removeClass('open');
	if($(this).parent().hasClass('open')){
		$(this).parent().removeClass('open');
	}else{
		$(this).parent().addClass('open');	
	}
});
$('.dropdown-open-backdrop').click(function(){
	$(this).parent().removeClass('open');
});


//my account functions
var myaccount = {

	init: function(){

		$('#myaccount').click(function(){
			$('#myaccountmodal').modal();
			myaccount.reset();
		});

		$('#changepwmyaccount').click(function(){
			$('#mypasswordmodal').modal();
		});

		$('#updatemypassword').click(function(){
			myaccount.changepassword();

		});

		$('#resetmyaccount').click(function(){
			if(confirm("Are you sure you want to reset? \nThis will revert back all the changes.")){
				myaccount.reset();				
			}
		});

		$('#updatemyaccount').click(function(){
			myaccount.update();
		});

	},

	reset: function(){
		$('#myaccount_first_name').val(myaccount_fname);
		$('#myaccount_middle_name').val(myaccount_mname);
		$('#myaccount_last_name').val(myaccount_lname);
		$('#myaccount_mobile_no').val(myaccount_mobile);
		$('#myaccount_email').val(myaccount_email);
	},

	changepassword: function(){
		var arr = createPostData('myaccount_password');
		if(arr['error']){
	    	toastr["error"](arr['error']);
	    }else if(arr['data']['npassword']!=arr['data']['cnpassword']){
			toastr["error"]("The new password and confirmation password did not match.");
	    }else{
			$('#updatemypassword').addClass('disabled');
			$('#updatemypassword i').removeClass('hide');
	    	$.post("backstage/user/myaccount_changepassword/", {d:arr['data']},function(data){
	    		if(data.status==200){
	    			toastr["success"]('Successfully Changed.<br>Logging Out.');
					$('#mypasswordmodal').modal('hide');
					setTimeout(function(){ 
						window.location.href="logout.php";
					}, 3000);
	    		}else{
	    			toastr["error"](data.message);
	    		}
					$('#updatemypassword').removeClass('disabled');
					$('#updatemypassword i').addClass('hide');
	    	}).fail(function(){
					toastr["error"]('Error.');
			$('#updatemypassword').removeClass('disabled');
			$('#updatemypassword i').addClass('hide');
			});

	    }

	},

	update: function(){
		var arr = createPostData('myaccountupdate');
			if(arr['error']){
	    		toastr["error"](arr['error']);
	    	}else{
				$('#updatemyaccount').addClass('disabled');
				$('#updatemyaccount i').removeClass('hide');
	    		$.post("backstage/user/myaccount_update/", {d:arr['data']},function(data){
	    			if(data.status==200){
							toastr["success"]('Successfully updated.');

							myaccount_fname = arr['data']['fname'];
							myaccount_mname = arr['data']['mname'];
							myaccount_lname = arr['data']['lname'];
							myaccount_mobile = arr['data']['mobile'];
							myaccount_email = arr['data']['email'];

							$('#myaccountmodal').modal('hide');
							$('#updatemyaccount').removeClass('disabled');
							$('#updatemyaccount i').addClass('hide');
					}else{
						toastr["error"]('Network error!<br> Please try again.');	
					}
	    		}).fail(function(){
					toastr["error"]('Error.');
					$('#updatemyaccount').removeClass('disabled');
					$('#updatemyaccount i').addClass('hide');
				});
	    	}	
	}

}

myaccount.init();














