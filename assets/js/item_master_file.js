
var searchdata = "";
var updateid = '';

var search = {
	init: function(){

		//clear select button
		$('#clearsearch').click(function(){
			$('.searchdata input, .searchdata select').val('');
		});

		$('#search').click(function(){
			search.execute();
		});

	},

	execute: function(){
		var arr = createPostData('searchdata');
		searchdata = JSON.stringify(arr['data']);
		item.getlist(1);
    }


}

var item = {

	init: function(){



		//add new bill of lading modal
		$('#addmodal').click(function(){
			item.create();
		});

		$('#uomsettings').click(function(){
			item.uomsettings();
		});	
		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				item.save();	
			}
		});	
		$('#updatecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				item.update();	
			}
		});		

		$('#clearecreate').click(function(){
			item.clear();
		});	

		$('.uom-select').change(function(){
			var un = $(this).attr('name');
			if($(this).val()==''){
				$('.'+un).val('');
			}else{
				$('.'+un).val(1);	
			}
			
		});			


		$("#add-non_sku").change(function() {
		        item.checknonsku();	    
		});

		$("#additional-length, #additional-width, #additional-height").bind('keyup',function() {
		        item.cbmcomputation();	    
		});


		item.getlist();


	},

cbmcomputation: function(){
	var l = $('#additional-length').val();
	var w = $('#additional-width').val();
	var h = $('#additional-height').val();
	var cbm = (l*w*h)/1000000;
	$('#additional-cbm').val(cbm);
},

checknonsku: function(){
	var nonsku = $('#additional-item_id').val();
	var key = $('#add-non_sku').is(':checked');
	if(key) {
		$('#additional-stock_no').val(nonsku);
		$('#additional-bar_code').val(nonsku);
		$('#additional-casebar_code').val(nonsku);
		$('#additional-bar_code').attr('disabled', 'disabled');
		$('#additional-casebar_code').attr('disabled', 'disabled');
		$('#additional-stock_no').attr('disabled', 'disabled');
	}else{
		$('#additional-bar_code').attr('disabled', false);
		$('#additional-casebar_code').attr('disabled', false);
		$('#additional-stock_no').attr('disabled', false);
	}

	

},

uomsettings: function(){
	$('#create_additional').modal();
},

create: function(){
	$('#create_modal').modal();
	$('#updatecreate').hide();
	$('#savecreate').show();
	$('#clearecreate').show();
	$('#create_modal .modal-title').html('Add Item');
	item.clear();
},

delete: function(id){
	if(confirm('Are you sure you want to delete this?')){
		$.post("backstage/itemmasterfile/delete/"+id, {},function(data){
			toastr["success"]('Successfully deleted.');
			item.getlist();
		}).fail(function(){
			toastr["error"]('Network error!<br> Please try again.');	
		});		
	}

},

edit: function(id){
	$('#create_modal').modal();
	$('#create_modal .modal-title').html('Edit Item');
	$('#updatecreate').show();
	$('#savecreate').hide();
	$('#clearecreate').hide();
	$('#add-non_sku').prop('checked', false);
	$.post("backstage/itemmasterfile/itemdetails/"+id, {},function(data){
		updateid = data.id;
		$.each(data, function( index, value ) {
			$('#create_modal [col="'+index+'"]').val(value);
		});
		if(data.non_sku){
			$('#add-non_sku').prop('checked', true);
		}
		 item.checknonsku();
	});


},

clear: function(){
	$('#create_modal input[type="text"], #create_modal input[type="number"], #create_modal select').val('');
	$('#add-non_sku').prop('checked', false);
	remove_error_tag('createform');
	item.checknonsku();
	item.itemno();
},

itemno: function(){
	$.post("backstage/itemmasterfile/itemno/", {},function(data){
		$('#additional-item_id').val(data);
	});
},

update: function(){
		var arr = createPostData('createform');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#updatecreate').addClass('disabled');
			$('#updatecreate i').removeClass('hide');
    		$.post("backstage/itemmasterfile/update/"+updateid, {d:arr['data']},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#updatecreate').removeClass('disabled');
						$('#updatecreate i').addClass('hide');
						item.getlist();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#updatecreate').removeClass('disabled');
				$('#updatecreate i').addClass('hide');
			});
    	}
},

save: function(){
		var arr = createPostData('createform');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#savecreate').addClass('disabled');
			$('#savecreate i').removeClass('hide');
    		$.post("backstage/itemmasterfile/save/", {d:arr['data']},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#savecreate').removeClass('disabled');
						$('#savecreate i').addClass('hide');
						item.getlist();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#savecreate').removeClass('disabled');
				$('#savecreate i').addClass('hide');
			});
    	}
},

getlist: function(page=1){
	
		$.post("backstage/itemmasterfile/itemlist/"+page, {searchdata: searchdata},function(data){
			var content = '';
			// console.log(data);
			$.each(data.data, function( index, value ) {

				var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				content +='<tr id="list-'+value.id+'" data-id="'+value.id+'">';
				content +='<td class="centered">'+value.item_id+'</td>';
				content +='<td>'+value.stock_no+'</td>';
				content +='<td>'+value.bar_code+'</td>';
				content +='<td>'+value.storage_type+'</td>';
				content +='<td>'+value.item_type+'</td>';
				content +='<td>'+value.item_description+'</td>';
				content +='<td>'+value.uom+'</td>';
				content +='<td>'+value.unit_cost+'</td>';
				content +='<td>'+value.unit_price+'</td>';
				content +='<th>'+action+'</th>';
				content +='</tr>';		
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				item.getlist($(this).data('page'));
			});
			
			$('#search_result_list .btn-success').click(function(){
				item.edit($(this).parent().parent().data('id'));
			});
			$('#search_result_list .btn-danger').click(function(){
				item.delete($(this).parent().parent().data('id'));
			});

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});

	}



}


search.init();
item.init();