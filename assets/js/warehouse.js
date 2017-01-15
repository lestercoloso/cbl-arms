
//alil js
$(document).ready(function(){
	$( "#tabs" ).tabs();
	$(function () {
		$("#storView").click(function(){
			var a = true;
			$.post("storeView.php",function(data){

				if(a===true){
				$("#tab1-div2").html(data);
				a=false;
			}else{
					alert("You are on storage View");

				}
			})
		});
		});

	});
//end of alil's js

function addStorage(){
	$( "#add_storage" ).dialog('destroy');
	$( "#add_storage" ).dialog({
	      autoOpen: true,
	      width: 400,
	      modal: true,
	 	  resizable: false,
	 	  movable: false,
	 	  draggable: false, 
	 	  buttons: {
			        Save: function() {
			          $( this ).dialog( "close" );
			        },			        
			        Clear: function() {
			          cleardata();
			        },
			        Cancel: function() {
			          $( this ).dialog( "close" );
			        }
      	  }
	});	
}


$('#addStorage').click(function(){
	addStorage();
	cleardata();
	checkifexist('rack');
});

$('#stype').change(function(){
	cleardata();
	checkifexist($('#stype').val());
});


$('#stype').change(function(){
	$('.rack').hide();
	$('.bay').hide();
	$('.'+$(this).val()).show();
});


$( "#add_storage" ).dialog({autoOpen: false});	

function getcode(type){
	$.get("backstage/warehouse/getcode/"+type,function(data){
		$('#'+type+'code').val(data);
	});
}

function cleardata(){
	$('#add_storage input[type="number"]').val('');
}

function checkifexist(type){
	var t = $('#'+type+'code').val();
	if(t==''){
		getcode(type);
	}
}