
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

function createPostData(classused){
		var array = new Object();	
		var array2 = new Object();	
			array['error'] = '';
			$('.'+classused+' div').removeClass('has-error');	
			$('.'+classused).removeClass('has-error');	
		
	$('.'+classused+' input, .'+classused+' select').each(function( data ) {
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