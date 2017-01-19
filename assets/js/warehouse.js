
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
			          saveStorage(this);
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


	function rearrangeshelves(){
		// alert(racks);

		var rdatas = JSON.parse(racksjsondata);  
		var bdatas = JSON.parse(baysjsondata); 
		$('.rackStorage').remove();
		$('.bayStorage').remove();


		var content = '';
		$.each(rdatas, function( index, value ) {

			// var style = value.style.replace(/(width:([0-9]+)px;)|(height:([0-9]+)px;)/g, "");
			content +='<div class="rackStorage" data-racklevel="" data-racklevelheight="" id="rack-'+value.id+'" style="height:'+value.rack_length.trim()+'px;width:'+value.rack_width+'px;'+value.style+'"></div>';
		});		

		$.each(bdatas, function( index, value ) {
			content +='<div class="bayStorage" id="bay-'+value.id+'" style="height:'+value.bay_length+'px;width:'+value.bay_width+'px;'+value.style+'"></div>';
		});

		$('.warehouse_container').append(content);
		$( ".rackStorage, .bayStorage" ).draggable({ containment: "parent" });
		$( ".rackStorage, .bayStorage" ).dblclick(function() {alert( this.id );});
	}

	function getcode(type){
		$.get("backstage/warehouse/getcode/"+type,function(data){
			$('#'+type+'code').val(data);
		});
	}

	function cleardata(){
		$('#add_storage input[type="number"]').val('');
		$('div').removeClass('has-error');
	}

	function checkifexist(type){
		var t = $('#'+type+'code').val();
		if(t==''){
			getcode(type);
		}
	}

	function saveStorage(dialog){
		var t = $('#stype').val();
		var array = createPostData(t);		
		var error = array['error'];		
		var jsondata = JSON.stringify(array['data']);
		if(error==''){
			$.post("backstage/warehouse/saveStorage/"+t, {d:jsondata},function(data){
				if(data.status==200){
					if(t=='rack'){
						racksjsondata = JSON.stringify(data.data);
					}else{
						baysjsondata = JSON.stringify(data.data);
					}
					rearrangeshelves();

					getcode(t);
					toastr["success"](t.toUpperCase()+' storage successfully created.');
					cleardata();
				}
				$( dialog ).dialog( "close" );
			}).fail(function(){
				toastr["error"]("Failed to load.");
			});
		}else{
				toastr["error"](error);
		}

	}


function saveOrder(){
		var array = new Object();	
		
		$('.rackStorage, .bayStorage').each(function( data ) {
			var style = $(this).attr('style');
			style = style.replace(' ', "");
			style = style.replace(/(height:([0-9]+)px;)/i, "");
			style = style.replace(/(width:([0-9]+)px;)/i, "");
			style = style.replace(/(height: ([0-9]+)px;)|(width: ([0-9]+)px;)/i, "");
			array[this.id] = style;
		});
		var data = JSON.stringify(array);
		$.post("backstage/warehouse/saveOrder/", {d:data},function(data){
			if(data.status==200){
				toastr["success"]("Successfully saved.");	
				racksjsondata = JSON.stringify(data.rack);
				baysjsondata = JSON.stringify(data.bay);
			}else{
				toastr["error"]("Failed to save.");	
			}
		}).fail(function(){
			toastr["error"]("Unable to reach the server.");
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

$('#saveOrder').click(function(){
	saveOrder();
});

$('#cancelOrderStorage').click(function(){
	rearrangeshelves();
});


$( "#add_storage" ).dialog({autoOpen: false});	
rearrangeshelves();