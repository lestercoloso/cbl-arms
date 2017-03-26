
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
		driver.getlist(1);
    }


}

var driver = {

	init: function(){

		$('.create-date').datetimepicker({
			format: 'MM/DD/YYYY',
			useCurrent: false
		});		
		//add new bill of lading modal
		$('#addmodal').click(function(){
			driver.create();
		});
		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				driver.save();	
			}
		});	
		$('#updatecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				driver.update();	
			}
		});			
		$('#clearecreate').click(function(){
			driver.clear();
		});			

		driver.getlist();


	},

create: function(){
	$('#create_modal').modal();
	$('#updatecreate').hide();
	$('#savecreate').show();
	$('#clearecreate').show();
	$('#create_modal .modal-title').html('Add Driver Profile');
	driver.clear();
},

delete: function(id){
	if(confirm('Are you sure you want to delete this?')){
		$.post("backstage/maintenance/driverdelete/"+id, {},function(data){
			toastr["success"]('Successfully deleted.');
			driver.getlist();
		}).fail(function(){
			toastr["error"]('Network error!<br> Please try again.');	
		});		
	}

},

edit: function(id){
	$('#create_modal').modal();
	$('#create_modal .modal-title').html('Edit Driver Profile');
	$('#updatecreate').show();
	$('#savecreate').hide();
	$('#clearecreate').hide();
	$.post("backstage/maintenance/driverdetail/"+id, {},function(data){
		updateid = data.id;
		$.each(data, function( index, value ) {
			$('#create_modal [col="'+index+'"]').val(value);
		});
	});


},

clear: function(){
	$('#create_modal input, #create_modal select').val('');
	driver.getno();
},

getno: function(){
	$.post("backstage/maintenance/drivercode/", {},function(data){
		$('#create_driver_code').val(data);
	});
},

update: function(){
		var arr = createPostData('createform');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#updatecreate').addClass('disabled');
			$('#updatecreate i').removeClass('hide');
    		$.post("backstage/maintenance/updatedriver/"+updateid, {d:arr['data']},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#updatecreate').removeClass('disabled');
						$('#updatecreate i').addClass('hide');
						driver.getlist();
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
    		$.post("backstage/maintenance/savedriver/", {d:arr['data']},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#savecreate').removeClass('disabled');
						$('#savecreate i').addClass('hide');
						driver.getlist();
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
	
		$.post("backstage/maintenance/driverlist/"+page, {searchdata: searchdata},function(data){
			var content = '';
			// console.log(data);
			$.each(data.data, function( index, value ) {

				var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				content +='<tr id="list-'+value.id+'" data-id="'+value.id+'">';
				content +='<td class="centered">'+value.code+'</td>';
				content +='<td>'+value.name+'</td>';
				content +='<td>'+value.vehicle_type+'</td>';
				content +='<th>'+action+'</th>';
				content +='</tr>';
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				driver.getlist($(this).data('page'));
			});
			
			$('#search_result_list .btn-success').click(function(){
				driver.edit($(this).parent().parent().data('id'));
			});
			$('#search_result_list .btn-danger').click(function(){
				driver.delete($(this).parent().parent().data('id'));
			});

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});

	}



}


search.init();
driver.init();