	var adjust = 3;
	var adjust2 = 3;

var rack_type 				= 'drive-in';
var pallet_position 		= [];
var pallet_position_type 	= [];
var storage = [];
var pallets = [];


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
		$('.area .container').html('');
		var content = '';
		$.each(rdatas, function( index, value ) {
			if(value.style==null){
				value.style = 'position:absolute;';
			}
			var width 	= (parseInt(value.rack_width)*0.01)*warehouse_scale;
			var length 	= (parseInt(value.rack_length)*0.01)*warehouse_scale;
			var content ='<div id="rack-'+value.id+'" class="rackStorage" data-storage_type="'+value.storage_type+'" data-no_pallet_position="'+value.no_pallet_position+'" data-type="rack" data-no_section="'+value.no_rack_section+'" data-rackcode="'+value.code+'" data-rackwidth="'+value.rack_width+'" data-racklength="'+value.rack_length+'"  data-racklevel="'+value.no_rack_level+'" data-racklevelheight="'+value.rack_level_height+'" style="height:'+width+'px;width:'+length+'px;'+value.style+'">';
				content +='<table>';
				for (i = 0; i < value.no_pallet_position; i++) { 
					content += "<tr>";

					for (ir = 0; ir < value.no_rack_section; ir++) { 
						content += "<td></td>";
					}

					content += "</tr>";
				}
				content +='</table>';

				content +='</div>';
			$('.block_'+value.block+' .container').append(content);
		});		

		$.each(bdatas, function( index, value ) {
			if(value.style==''){
				value.style = 'transform: rotate(0deg)';
			}
			var width 	= (parseInt(value.bay_width)*0.01)*warehouse_scale;
			var length 	= (parseInt(value.bay_length)*0.01)*warehouse_scale;

			var content ='<div class="bayStorage" id="bay-'+value.id+'"  data-type="bay" data-baycode="'+value.code+'" data-baywidth="'+value.bay_width+'" data-baylength="'+value.bay_length+'"  style="height:'+width+'px;width:'+length+'px;'+value.style+'">'+deletebutton+rotate+'</div>';
			$('.block_'+value.block+' .container').append(content);
		});

		// $('.warehouse_container').append(content);
		$( ".rackStorage, .bayStorage" ).draggable({ containment: "parent" });
		addFunctionToStorage2();
		$('#left-container').hide();
	}

	function getcode(type){
		$.get("backstage/warehouse/getcode/"+type,function(data){
			$('#create-code').val(data);
		});
	}

	function cleardata(){
		pallet_position = [];
		$('#add_storage input[type="number"]').val('');
		$('#add_storage input[type="checkbox"]').prop('checked', false); 
		$('#add_storage .bay select, #add_storage .rack select').val('');
		$('div').removeClass('has-error');
		racktype();
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


//not needed anymore	
/**
	$('#warehouse').hide();
	$('#shelves').show();
	var d = $('#'+id);
	var content = '';
	if(d.hasClass('rackStorage')){
		var nrl = d.data('racklevel'); 
		var rlh = d.data('racklevelheight'); 
		var rl = d.data('racklength'); 
		var rw = d.data('rackwidth'); 
		zindex = 100;

		var box = '<div class="box"  draggable="true"><div class="frnt"></div><div class="bck"></div><div class="tp"></div><div class="bot"></div><div class="lft"></div><div class="rght"></div> </div>';
		for (i = 1; i <= nrl; i++) { 
			zindex--;
			// content += '<div class="rack-level" data-racklevel="'+i+'" style="width:'+rl+'px;height:'+rlh+'px;"><div class="support-left" style="height:'+(rlh+15)+'px;"></div><div class="support-bottom"></div><div class="support-right" style="height:'+(rlh+15)+'px;"></div></div>';
			content += '	<div class="shelves_container rack-level" data-level="'+i+'" data-racklevel="'+i+'"  style="z-index: '+zindex+';transform: rotateX(-15deg) rotateY(30deg);"> <div class="boxes"></div><div class="back"></div><div class="bottom"></div> <div class="left storage_height"></div><div class="right storage_height"></div></div>';
		}
		$('#shelf_container').html(content);
		
		$('.rack-level').click(function(){
			// viewShelve($(this).data('racklevel'), 3);
		});

		viewShelve();

	}else{

	}
	**/
}

function viewShelve(level='', scale=5){

	if(level!=''){
		$('#storage_view').modal();	
		var add = '#storage_view ';
	}else{
		var add = '#shelf_container ';
	}
	
	var selected = $('.selected_storage');
		if(selected.data('type')=='rack'){
			$('#storage_view .modal-title').html('Rack ('+pad(selected.data('rackcode'),10) +') - Level '+level);
		}else{

		}

		getBoxes(selected.data('rackcode'), selected.data('type'), scale);
// warehouse_scale
		var Length = (((selected.data('racklength')*0.01)*warehouse_scale)*scale);
		var Width  = (((selected.data('rackwidth')*0.01)*warehouse_scale)*scale);
		var Height = (((selected.data('racklevelheight')*0.01)*warehouse_scale)*scale);
		$(add+'.shelves_container').css('width', Length+'px');
		$(add+'.shelves_container').css('height', Height+'px');
		$(add+'.shelves_container .storage_height').css('width', Width+'px');
		$(add+'.shelves_container .bottom').css('height', Width+'px');
		$(add+'.shelves_container .bottom').css('transform', 'rotateX(270deg) translateY(100px) translateZ('+(Height-Width)+'px)');
		$(add+'.shelves_container .back').css('height', Height+'px');
		$(add+'.shelves_container .storage_height.right').css('transform', 'rotateY(-270deg) translate(100px, 2px) translateZ('+(Length-Width)+'px)');
}

function rotateShelf(id, t='up'){
	var obj = $('#'+id+ ' .shelves_container');
	var getcss = obj.attr('style');
	var getX = /rotateX\(\s*([^ ,]+)deg\s*\)/;
	var getY = /rotateY\(\s*([^ ,]+)deg\s*\)/;
	var Y = getcss.split(getY)[1];
	var X = getcss.split(getX)[1];
	
	if(t=='up' && X<=6){ X = parseInt(X)+parseInt(adjust) }
	if(t=='down' && X>=-18){ X = parseInt(X)-parseInt(adjust) }
	if(t=='left'){ Y = parseInt(Y)-parseInt(adjust) }
	if(t=='right'){ Y = parseInt(Y)+parseInt(adjust) }
	obj.css({ WebkitTransform: 'rotateX('+X+'deg) rotateY('+Y+'deg)'});
}

function getBoxes(code=0, type='', scale){
	$.post("backstage/warehouse/getBoxes/"+code+"/"+type+"/"+warehouse_scale+"/"+scale, {},function(data){
		$.each(data.level, function( i, v ) {
				relocateboxes(i,v,scale);
		});		
	});
}



function relocateboxes(level, d, s){
	var obj = $('.shelves_container[data-level="'+level+'"] .boxes');
	// var box = '<div class="box"  draggable="true"><div class="frnt"></div><div class="bck"></div><div class="tp"></div><div class="bot"></div><div class="lft"></div><div class="rght"></div> </div>';
	var content = '';
	var selected = $('.selected_storage');	
	var container = $('.shelves_container[data-level="'+level+'"]');
	// (((selected.data('racklength')*0.01)*warehouse_scale)*scale);
	var container_height = parseInt(((selected.data('racklevelheight')*0.01)*warehouse_scale)*s);
	var container_width = parseInt(((selected.data('rackwidth')*0.01)*warehouse_scale)*s);
	var container_length = parseInt(((selected.data('racklength')*0.01)*warehouse_scale)*s);;
	var ch = container_height;
	var cw = 0;
	var cl = 0;
		$.each(d, function( i, v ) {

			var w = parseInt(v.width);
			var l = parseInt(v.length);
			var h = parseInt(v.height);
			var locationY = (ch-h);
			var locationZ = 0;

			if(locationY<0){
				ch = container_height;
				locationY = container_height-h;
				cw += w;
				if((cw+w)>container_width){
					cw = 0;	
					cl += l;			
				}

			} 

			content += '<div class="box" style="height:'+w+'px;width:'+l+';transform: translateY('+locationY+'px) translateZ('+cw+'px) translateX('+cl+'px);">';
			content += '<div class="frnt" style="transform: translateZ('+(w-100)+'px);height:'+h+'px;"></div>';
			content += '<div class="bck"></div>';
			content += '<div class="tp"></div>';
			content += '<div class="bot" style="transform: rotateX(270deg) translateY(100px) translateZ('+(h-w)+'px)"></div>';
			content += '<div class="lft" style="width:'+w+'px;height:'+h+'px;"></div>';
			content += '<div class="rght" style="width:'+w+'px;height:'+h+'px;transform: rotateY(-270deg) translate(100px) translateZ('+(l-w)+'px)"></div> </div>';	
			ch = ch-h;
		});		

		obj.html(content);
}



function cancelShelves(){
	$('#warehouse').show();
	$('#shelves').hide();
}

// openShelves();
function saveOrder(){
		var array = new Object();	
		
		// $('.rackStorage, .bayStorage').each(function( data ) {
		// 	var style = $(this).attr('style');
		// 	style = style.replace(' ', "");
		// 	style = style.replace(/(height:([0-9]+)px;)/i, "");
		// 	style = style.replace(/(width:([0-9]+)px;)/i, "");
		// 	style = style.replace(/(height: ([0-9]+)px;)|(width: ([0-9]+)px;)/i, "");
		// 	array[this.id] = style;
		// });

		var d = [];

		$('.wh_free_roam table').each(function( index ) {
		  d.push({ id: this.id, style: $(this).attr('style')});
		});

		// console.log(d);
		
		// var data = JSON.stringify(array);
		$.post("backstage/warehouse/saveOrder/", {d:d},function(data){
			if(data.status==200){
				toastr["success"]("Successfully saved.");	
				selectstorage();
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
		var container = '<span class="col-sm-7">Rack Code : </span> <span class="col-sm-5"> '+pad(selected.data('rackcode'),10)+' </span>';
		 container += '<span class="col-sm-7">Storage Type : </span> <span class="col-sm-5"> '+selected.data('storage_type')+' </span>';
		 container += '<span class="col-sm-7">Rack Length : </span> <span class="col-sm-5"> '+selected.data('racklength')+' </span>';
		 container += '<span class="col-sm-7">Rack Width : </span> <span class="col-sm-5"> '+selected.data('rackwidth')+' </span>';
		 container += '<span class="col-sm-7">No. of Rack level : </span> <span class="col-sm-5"> '+selected.data('racklevel')+' </span>';
		 container += '<span class="col-sm-7">Rack height level : </span> <span class="col-sm-5"> '+selected.data('racklevelheight')+' </span>';
		 container += '<span class="col-sm-7">No. of Rack Section : </span> <span class="col-sm-5"> '+selected.data('no_section')+' </span>';
		 container += '<span class="col-sm-7">No. of Pallet Postiion : </span> <span class="col-sm-5"> '+selected.data('no_pallet_position')+' </span>';
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


function openpalletposition(t){

	clearadditional();
	constructpalletposition();


	var data = createPostData('rack');
	var noracksection = data['data']['sections'];
	var option_content = "<option value=''>Select Rack Section</option>";
	for (i = 1; i <= noracksection; i++) { 
	    option_content += "<option value='"+i+"'>"+i+"</option>";
	}
	$('#additional_modal [col="rack_section"]').html(option_content);

	var noofracklevel = data['data']['levels'];
	var option_content2 = "<option value=''>Select Rack Level</option>";
	for (i = 1; i <= noofracklevel; i++) { 
	    option_content2 += "<option value='"+i+"'>"+i+"</option>";
	}
	$('#additional_modal [col="rack_level"]').html(option_content2);


	// if($('#create-wing [col="wing"]').is(':checked')){
	// 	$('#additional_modal [col="wing"]').parent().parent().show();
	// 	$('.lrw').removeClass('hide');
	// 	$('#additional_modal [col="wing"]').removeClass('not_mandatory');
	// }else{
	// 	$('#additional_modal [col="wing"]').parent().parent().hide();
	// 	$('.lrw').addClass('hide');
	// 	$('#additional_modal [col="wing"]').addClass('not_mandatory');
	// }


	if(data['error']){
		toastr["error"](data['error']+"<br>Before proceeding to next step.");
	}else{
		$('#additional_modal').modal();
		if(t=='assign'){
			$('.app').show();
			$('.appt').hide();
			$('#additional_modal .modal-title').html('Assign Pallet Position');
		}else{
			$('.appt').show();
			$('.app').hide();
			$('#additional_modal .modal-title').html('Assign Pallet Position Type');
			generatelocationcode();
		}

	}

}

function generatelocationcode(){
	var first 	= 'B'+$('#create-block').val();
	var second 	= $('.appt [col="rack_location"]').val().toUpperCase();
	var third 	= pad($('.appt [col="rack_section"]').val(), 2, '0');
	var fourth 	= pad($('.appt [col="rack_level"]').val(), 2, '0');
	$('#appt-bin_location').val(first+second+third+fourth);
}

function racktype(){
	var selected_rack_type = $('#rack-rack_type').val();
 	 if(rack_type==selected_rack_type.toLowerCase()){
 	 	$('#apptbtn').removeClass('no_access');
 	 }else{
 	 	$('#apptbtn').addClass('no_access');
 	 }
}


function clearadditional(){
	$('#additional_modal input, #additional_modal select').val('');
}

function constructpalletposition(){
	var content = '';
	var num = 0;
	for (v in pallet_position) {
		if(pallet_position[v].rack_section){
			num +=1;
			content += '<tr data-key="'+v+'">';
			content += '<td>'+pallet_position[v].bin_location+'</td>';
			content += '<td>'+pallet_position[v].rack_location+'</td>';
			content += '<td>'+pallet_position[v].rack_section+'</td>';
			content += '<td>'+pallet_position[v].rack_level+'</td>';
			content += '<td>'+pallet_position[v].type+'</td>';
			content += '<td><i class="fa fa-times-circle"></i></td></tr>';	
		}
	};

	// if(num==0){
	// 	$('#apptbtn').addClass('no_access');
	// }

	$('#pallet_position_table tbody').html(content);
	$('#pallet_position_table i').click(function(){
		removepalletposition($(this).parent().parent().data('key'));
	});
}

function saveadditional(){
	// $('#additional_modal').modal('close');

	// if($('.appt').is(':visible')){
		var err = createPostData('appt');	
		if(!err['error']){
			var data = err['data'];
			var tosave = data['rack_level']+'-'+data['rack_section']+'-'+data['rack_location'];

			if(pallet_position[tosave]){
				if(confirm("Already exist.\nDo you want to overwrite it?")){
					pallet_position[tosave] = data;
					// $('#additional_modal').modal('hide');
					toastr["success"]('Successfully Overwrited.');
					clearadditional();
					constructpalletposition();
					// $('#apptbtn').removeClass('no_access');

				}
			}else{
					pallet_position[tosave] = data;
					// $('#additional_modal').modal('hide');
					toastr["success"]('Successfully Added.');
					clearadditional();
					constructpalletposition();					
					// $('#apptbtn').removeClass('no_access');
			}


		}else{
			toastr["error"](err['error']);
		}
	// }else{
	// 	var err = createPostData('appt');	
	// 	if(!err['error']){
	// 		var data = err['data'];
	// 		var tosave = data['rack_level']+'-'+data['rack_section']+'-'+data['wing']+'-'+data['pallet_position'];

	// 		if(pallet_position_type[tosave]){
	// 			if(confirm("Already exist.\nDo you want to overwrite it?")){
	// 				pallet_position_type[tosave] = data;
	// 				$('#additional_modal').modal('hide');
	// 				toastr["success"]('Successfully Added.');

	// 			}
	// 		}else{
	// 				pallet_position_type[tosave] = data;
	// 				$('#additional_modal').modal('hide');
	// 				toastr["success"]('Successfully Added.');
	// 		}

	// 	}else{
	// 		toastr["error"](err['error']);
	// 	}
	// }
}


function removepalletposition(key){
	if(confirm('Are you sure you want to remove this?')){
		delete pallet_position[key];
		constructpalletposition();	
	}
}


function save(){
		var t = $('#stype').val();
		var psave = [];
		var ptsave = [];
		for (v in pallet_position) {if(pallet_position[v].rack_section){ psave.push(pallet_position[v]); }};
		for (v in pallet_position_type) {if(pallet_position_type[v].rack_section){ ptsave.push(pallet_position_type[v]); }};
		var arr = createPostData(t);
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#savestorage').addClass('disabled');
			$('#savestorage i').removeClass('hide');
    		$.post("backstage/warehouse/save/", {d:arr['data'], t:t, p:psave, pt: ptsave},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#add_storage').modal('hide');
						$('#savestorage').removeClass('disabled');
						$('#savestorage i').addClass('hide');
						selectstorage();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#savestorage').removeClass('disabled');
				$('#savestorage i').addClass('hide');
			});
    	}
}



function generatepositiontype(){

var l = $('.appt [col="rack_level"]').val();
var s = $('.appt [col="rack_section"]').val();
var w = $('.appt [col="wing"]').val();



	if(pallet_position[l+'-'+s+'-'+w]){
		var no_position = pallet_position[l+'-'+s+'-'+w].pallet_position;
		var content = '<option value="">Select Pallet Position</option>';
		
		if(no_position>=1){
			content +='<option value="a">a</option>';
		}
		if(no_position>=2){
			content +='<option value="b">b</option>';
		}
		if(no_position>=3){
			content +='<option value="c">c</option>';
		}		
	}else{
		content = '';
	}
	$('#appt-pallet_position').html(content);
}


function selectstorage(){
	var s = $('#selectstorage').val();
	var st = $('#selectstoragetype').val();
	if(s!=''){
		$.post("backstage/warehouse/selectstorage/"+s+"/"+st, {},function(data){
			storage = data.data;
			pallets = data.pallets;
			constructnewstorage();
		});		
	}else{
		toastr["error"]('Please Select Warehouse Location.');
	}

}


function constructnewstorage(){

	var content = '';
	var l = 0;
	$.each(storage, function( index, v ) {
		
	if(v.style!=null){
		var style = JSON.parse(v.style);			
	}else{
		var style = [];
	}
		
		for (h = 1; h <= v.locations; h++) {
			l++;
			if(style[h]){
				var styling = style[h].style;	
			}else{
				var styling = '';	
			}
			content +='<table border="1" id="'+v.location+'-'+v.id+'-'+h+'" style="'+styling+'">';
			
			  for (i = v.levels; i >= 1; i--) {
				  content += '<tr>';
					for (j = 1; j <= v.sections; j++) {
				  		content += '<td class="'+pallets[abc[l-1]+pad(j, 2, '0')+pad(i, 2, '0')]+'">'+abc[l-1]+pad(j, 2, '0')+pad(i, 2, '0')+'</td>'; 	
				  	}
				  content += '</tr>';
				}
		  	content +='</table>';
		}

	});		

	$('.wh_free_roam').html(content);
	$( ".wh_free_roam table" ).draggable({ containment: "parent" });
}


$('#selectstorage, #selectstoragetype').change(function(){
	selectstorage();
});


$('.appt [col="rack_level"], .appt [col="rack_section"], .appt [col="wing"]').change(function(){
	generatepositiontype();
});


$("#savestorage").click(function(){
	// if(!$(this).hasClass('disabled')){
	// 	save();	
	// }
	save();
});


$("#cleardata").click(function(){
	if(confirm('Are you sure you want to clear this data?')){
		cleardata();		
	}

});

$("#saveadditional").click(function(){
	saveadditional();
});

$("#clearadditional").click(function(){
	clearadditional();
})

$('#rack-rack_type').change(function(){
	racktype();
});

$('.appt select').change(function(){
	generatelocationcode();
});

$('.appt input').bind('keyup keydown',function(){
	generatelocationcode();
});



$(".view_storage").click(function(){
	var obj = $('.selected_storage');
	openShelves( obj.attr('id') );
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
	constructnewstorage();
});


//rotate function of shelf
$('#rotate_shelves .ru').mousedown(function(){
	rotateShelf('shelf_container', 'up');
});
$('#rotate_shelves .rd').mousedown(function(){
	rotateShelf('shelf_container', 'down');
});
$('#rotate_shelves .rl').mousedown(function(){
	rotateShelf('shelf_container', 'left');
});
$('#rotate_shelves .rr').mousedown(function(){
	rotateShelf('shelf_container', 'right');
});


$('#shelf_container').keydown(function(e){
	alert(e);
});





$('#appbtn').click(function(e){
	if(!$(this).hasClass('no_access')){
		openpalletposition('assign');
	}
	
});


$('#apptbtn').click(function(e){
	if(!$(this).hasClass('no_access')){
		openpalletposition('type', this);
	}
});




// $( "#add_storage" ).dialog({autoOpen: false});	
getStorage();