
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
			          $( this ).dialog( "close" );
			        },
			        Cancel: function() {
			          $( this ).dialog( "close" );
			        }
      	  }
	});	
}


$('#addStorage').click(function(){
	// var title = $(this).find('em').html();
	// $( "#add_storage" ).attr('title', title);
	addStorage();
});


$('#stype').change(function(){
	$('.rack').hide();
	$('.bay').hide();
	$('.'+$(this).val()).show();
});


$( "#add_storage" ).dialog({autoOpen: false});	