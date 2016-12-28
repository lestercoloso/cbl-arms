
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

function editBlock(){
	$( "#zoom_block" ).dialog('destroy');
	$( "#zoom_block" ).dialog({
	      autoOpen: true,
	      width: 850,
	      modal: true,
	 	  resizable: false,
	 	  movable: false,
	 	  draggable: false
	});	
}


$('.area').click(function(){
	var title = $(this).find('em').html();
	$( "#zoom_block" ).attr('title', title);
	editBlock();
});

$( "#zoom_block" ).dialog({autoOpen: false});	