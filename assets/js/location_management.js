
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
		location_management.getlist(1);
    }


}

var location_management = {

	init: function(){



		//add new bill of lading modal
		$('#addmodal').click(function(){
			location_management.create();
		});	
		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				location_management.save();	
			}
		});	
		$('#updatecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				location_management.update();	
			}
		});		

		$('#clearecreate').click(function(){
			location_management.clear();
		});					

		location_management.getlist();


	},

create: function(){
	$('#create_modal').modal();
	$('#updatecreate').hide();
	$('#savecreate').show();
	$('#clearecreate').show();
	$('#create_modal .modal-title').html('Add Warehouse Location');
	location_management.clear();
},

delete: function(id){
	if(confirm('Are you sure you want to delete this?')){
		$.post("backstage/location_management/delete/"+id, {},function(data){
			toastr["success"]('Successfully deleted.');
			location_management.getlist();
		}).fail(function(){
			toastr["error"]('Network error!<br> Please try again.');	
		});		
	}

},

changestatus: function(id, status=1){

		$.post("backstage/location_management/changestatus/"+id+"/"+status, {},function(data){
			toastr["success"]('Successfully changed.');
			location_management.getlist();
		}).fail(function(){
			toastr["error"]('Network error!<br> Please try again.');	
		});		
	

},

edit: function(id){
	$('#create_modal input[type="text"], #create_modal select').val('');
	$('#create_modal input[type="checkbox"]').prop('checked', false); 
	$('#create_modal').modal();
	$('#create_modal .modal-title').html('Edit Location Management');
	$('#updatecreate').show();
	$('#savecreate').hide();
	$('#clearecreate').hide();
	$.post("backstage/location_management/detail/"+id, {},function(data){
		updateid = data.id;
		$.each(data, function( index, value ) {
			$('#create_modal input[type="text"][col="'+index+'"]').val(value);
		});
		$.each(data.storage_type, function( index, value ) {
			$('#create_modal [col="storage_type"][value="'+value+'"]').prop('checked', true); 
		});
	});


},



clear: function(){
	$('#create_modal input[type="text"], #create_modal select').val('');
	$('#create_modal input[type="checkbox"]').prop('checked', false); 
	$('#create_modal div').removeClass('has-error');	
	location_management.getno();
},

getno: function(){
	$.post("backstage/location_management/getno/", {},function(data){
		$('#create-wh_location_code').val(data);
	});
},

update: function(){
		var arr = createPostData('createform');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#updatecreate').addClass('disabled');
			$('#updatecreate i').removeClass('hide');
    		$.post("backstage/location_management/update/"+updateid, {d:arr['data']},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#updatecreate').removeClass('disabled');
						$('#updatecreate i').addClass('hide');
						location_management.getlist();
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
    		$.post("backstage/location_management/save/", {d:arr['data']},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#savecreate').removeClass('disabled');
						$('#savecreate i').addClass('hide');
						location_management.getlist();
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

expand: function(id, obj){
	if(obj.hasClass('fa-plus')){
		obj.removeClass('fa-plus');
		obj.addClass('fa-minus');

		$('#expand-'+id).show();

	}else{
		obj.removeClass('fa-minus');
		obj.addClass('fa-plus');
		$('#expand-'+id).hide();
	}

},

getlist: function(page=1){
	
		$.post("backstage/location_management/getlist/"+page, {searchdata: searchdata},function(data){
			var content = '';
			// console.log(data);
			$.each(data.data, function( index, value ) {

				
				var action = '';

				action += ' <button type="button" class="btn btn-success edit"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger delete"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				if(value.status==1){
					action += ' <button type="button" class="btn btn-danger status"> <span> Activate </span></button>';	
				}else{
					action += ' <button type="button" class="btn btn-success status"> <span> Deactivate </span> </button>';					
				}

				content +='<tr id="list-'+value.id+'" data-id="'+value.id+'">';
				content +='<td class="expand"> <i class="fa fa-plus"></i> </td>';
				content +='<td>'+value.code+'</td>';
				content +='<td>'+value.location+'</td>';
				content +='<td>'+value.address+'</td>';
				content +='<td>'+value.storage_type+'</td>';
				content +='<td>'+SelectOption(value.status, lcoation_status)+'</td>';
				content +='<th>'+action+'</th>';
				content +='</tr>';

				content +='<tr id="expand-'+value.id+'" class="expandable"> <td colspan="7"> <table  class="table table-bordered table-striped table-list storage-list"> <thead><tr><th>Block Code</th><th>Storage</th><th>Storage Code</th><th>Section</th><th>Level</th><th>Action</th></tr></thead></table></td></tr>'
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				location_management.getlist($(this).data('page'));
			});
			

			$('#search_result_list .expand').click(function(){
				location_management.expand($(this).parent().data('id'), $(this).find('i'));
			});
			

			$('#search_result_list .btn-success.edit').click(function(){
				location_management.edit($(this).parent().parent().data('id'));
			});

			$('#search_result_list .btn-danger.delete').click(function(){
				location_management.delete($(this).parent().parent().data('id'));
			});

			$('#search_result_list .btn-success.status').click(function(){
				location_management.changestatus($(this).parent().parent().data('id'), '1');
			});

			$('#search_result_list .btn-danger.status').click(function(){
				location_management.changestatus($(this).parent().parent().data('id'), '0');
			});

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});

	}



}


search.init();
location_management.init();