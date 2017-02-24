	var adjust = 3;



//alil js
$(document).ready(function(){
	
		$('.ui-tab').click(function(e){

			$(this).attr('aria-controls','');
			window.location.href=$(this).find('.ui-tabs-anchor').attr('href');
		});

		$('.ui-tab').each(function(e){
			$(this).attr('aria-controls','');
		});
	});
//end of alil's js





function addStorage(){
	$( "#add_storage" ).modal();
	getcode('rack');
}


	function rearrangeshelves(){
		// alert(racks);

		var rdatas = JSON.parse(racksjsondata);  
		var bdatas = JSON.parse(baysjsondata); 
		$('.rackStorage').remove();
		$('.bayStorage').remove();

		var deletebutton = '<button type="button" class="btn btn-danger deletethis" title="remove this storage"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span></button>';
		var rotateright = '<button type="button" class="btn btn-primary rotateright"><i class="fa fa-rotate-right" aria-hidden="true"></i><span class="hidden-xs"> </span></button>';
		var rotateleft = '<button type="button" class="btn btn-primary rotateleft"><i class="fa fa-rotate-left" aria-hidden="true"></i><span class="hidden-xs"> </span></button>';
		var rotate = '<div class="rotate">'+rotateleft+rotateright+'</div>';
		// var rotate = '';

		var content = '';
		$.each(rdatas, function( index, value ) {
			if(value.style==null){
				value.style = 'position:absolute;';
			}
			content +='<div id="rack-'+value.id+'" class="rackStorage" data-type="rack" data-rackcode="'+value.code+'" data-rackwidth="'+value.rack_width+'" data-racklength="'+value.rack_length+'"  data-racklevel="'+value.no_rack_level+'" data-racklevelheight="'+value.rack_level_height+'" style="height:'+value.rack_width.trim()+'px;width:'+value.rack_length+'px;'+value.style+'">'+deletebutton+rotate+'</div>';
		});		

		$.each(bdatas, function( index, value ) {
			if(value.style==''){
				value.style = 'transform: rotate(0deg)';
			}
			content +='<div class="bayStorage" id="bay-'+value.id+'"  data-type="bay" data-baycode="'+value.code+'" data-baywidth="'+value.bay_width+'" data-baylength="'+value.bay_length+'"  style="height:'+value.bay_width+'px;width:'+value.bay_length+'px;'+value.style+'">'+deletebutton+rotate+'</div>';
		});

		$('.warehouse_container').append(content);
		$( ".rackStorage, .bayStorage" ).draggable({ containment: "parent" });
		addFunctionToStorage2();
		$('#left-container').hide();
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
				$( '#add_storage' ).modal('toggle');
			}).fail(function(){
				toastr["error"]("Failed to load.");
			});
		}else{
				toastr["error"](error);
		}

	}


function openShelves(id){
	$('#warehouse').hide();
	$('#shelves').show();
	var d = $('#'+id);
	var content = '';
	if(d.hasClass('rackStorage')){
		var nrl = d.data('racklevel'); 
		var rlh = d.data('racklevelheight'); 
		var rl = d.data('racklength'); 
		var rw = d.data('rackwidth'); 

		for (i = 1; i <= nrl; i++) { 
			content += '<div class="rack-level" data-racklevel="'+i+'" style="width:'+rl+'px;height:'+rlh+'px;"><div class="support-left" style="height:'+(rlh+15)+'px;"></div><div class="support-bottom"></div><div class="support-right" style="height:'+(rlh+15)+'px;"></div></div>';
		}
		$('#shelf_container').html(content);
		
		$('.rack-level').click(function(){
			viewShelve($(this).data('racklevel'));
		});

	}else{

	}
}

function viewShelve(level){
$('#storage_view').modal();
var selected = $('.selected_storage');
	if(selected.data('type')=='rack'){
		$('#storage_view .modal-title').html('Rack ('+pad(selected.data('rackcode'),10) +') - Level '+level);
	}else{

	}
	$('#storage_container').css('width', (selected.data('racklength')*2)+'px');

}



function cancelShelves(){
	$('#warehouse').show();
	$('#shelves').hide();
}

// openShelves();
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
				getStorage();
			}else{
				toastr["error"]("Failed to save.");	
			}
		}).fail(function(){
			toastr["error"]("Unable to reach the server.");
		});

}

function getStorage(){

	$.post("backstage/warehouse/getStorage", {},function(data){
		racksjsondata = JSON.stringify(data.rack);
		baysjsondata = JSON.stringify(data.bay);
		rearrangeshelves();
		$('#warehouse').show();
		$('#shelves').hide();
		$('#left-container').hide();
	}).fail(function(){
		toastr["error"]("Failed to load.");
	});
}

function deleteStorage(id){


	if(confirm('Are you sure you want to delete this storage?')){
		$.post("backstage/warehouse/deleteStorage/"+id, {},function(data){
			toastr["success"]("Successfully deleted.");	
			getStorage();	

		}).fail(function(){
			toastr["error"]("Failed to load.");
		});
	}
}

function getAngle(d){
	var tr = d.css('transform');
	var angle = 0;
	if(tr!='none'){
		var values = tr.split('(')[1],
	    values = values.split(')')[0],
	    values = values.split(',');
		var a = values[0]; // 0.866025
		var b = values[1]; // 0.5
		var c = values[2]; // -0.5
		var d = values[3]; // 0.866025
		angle = Math.round(Math.asin(b) * (180/Math.PI));
	}


	return angle;
}

function rotate(d,angl){
	console.log(d);
	var angle = getAngle(d)+parseInt(angl);
	d.css({ WebkitTransform: 'rotate('+angle+'deg)'});
}

function addFunctionToStorage(){
	//reveal functions
	$( ".rackStorage, .bayStorage" ).click(function() {
		$( ".rackStorage .btn, .bayStorage .btn" ).hide();
		$( this ).find( '.btn' ).show();
	});

	$( ".rackStorage, .bayStorage" ).dblclick(function() {
		openShelves( this.id );
	});

	$(".deletethis").click(function(){
		deleteStorage($(this).parent().attr('id'));
	});

	$(".rotate .rotateright").click(function(){
		rotate($(this).parent().parent(),'+'+adjust);
	});

	$(".rotate .rotateleft").click(function(){
		rotate($(this).parent().parent(),'-'+adjust);
	});
}

function selectStorage(){
	$('#left-container').show();
	var selected = $('.selected_storage');
	if(selected.hasClass('bayStorage')){
		$('.storage_type_container').html('<b>Bay Storage</b>');
		var container = '<span class="col-sm-6">Bay Code : </span> <span class="col-sm-6"> '+pad(selected.data('baycode'),10)+' </span>';
		 container += '<span class="col-sm-6">Bay Length : </span> <span class="col-sm-6"> '+selected.data('baylength')+' </span>';
		 container += '<span class="col-sm-6">Bay Width : </span> <span class="col-sm-6"> '+selected.data('baywidth')+' </span>';
		$('.storage_preview_container').html(container);
	}else{
		$('.storage_type_container').html('<b>Rack Storage</b>');
		var container = '<span class="col-sm-6">Rack Code : </span> <span class="col-sm-6"> '+pad(selected.data('rackcode'),10)+' </span>';
		 container += '<span class="col-sm-6">Rack Length : </span> <span class="col-sm-6"> '+selected.data('racklength')+' </span>';
		 container += '<span class="col-sm-6">Rack Width : </span> <span class="col-sm-6"> '+selected.data('rackwidth')+' </span>';
		 container += '<span class="col-sm-6">No. of Rack level : </span> <span class="col-sm-6"> '+selected.data('racklevel')+' </span>';
		 container += '<span class="col-sm-6">Rack level height : </span> <span class="col-sm-6"> '+selected.data('racklevelheight')+' </span>';
		$('.storage_preview_container').html(container);		
	}


}

function addFunctionToStorage2(){
	//reveal functions
	$( ".rackStorage, .bayStorage" ).click(function() {
		$( ".rackStorage, .bayStorage" ).removeClass('selected_storage');
		$( this ).addClass('selected_storage');

		selectStorage();
	});

}


$(".view_storage").click(function(){
	openShelves( $('.selected_storage').attr('id') );
});
$(".delete_storage").click(function(){
	deleteStorage($('.selected_storage').attr('id'));
});

$(".rotate_right").click(function(){
	rotate($('.selected_storage'),'+'+adjust);
});
$(".rotate_left").click(function(){
	rotate($('.selected_storage'),'-'+adjust);
});

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

$('#cancelShelves').click(function(){
	cancelShelves();
});
$('#saveOrder').click(function(){
	saveOrder();
});

$('#cancelOrderStorage').click(function(){
	rearrangeshelves();
});





// $( "#add_storage" ).dialog({autoOpen: false});	
getStorage();