
var searchdata = "";
var updateid = '';
var inventory = [];
var vehicle = [];
var lastitemid = 0;
var updateinventorykey = '';
var updatevehiclekey = '';


var search = {
	init: function(){
		$('#search_date_from, #search_date_to').datetimepicker({
			format: 'MM/DD/YYYY',
			useCurrent: false
		});

		$('#search_date_created_from, #search_date_created_to').datetimepicker({
			format: 'MM/DD/YYYY',
			useCurrent: false
		});

		$('#create_datetime_ready_container .create-date').datetimepicker({
			format: 'MM/DD/YYYY LT',
			useCurrent: false
        });

		$('#create_time_called_container .create-date').datetimepicker({
			format: 'LT',
			// useCurrent: false
        });

		$("#search_user_date_from").on("dp.change", function (e) {
			$('#search_user_date_to').data("DateTimePicker").minDate(e.date);
		});
		$("#search_user_date_to").on("dp.change", function (e) {
			$('#search_user_date_from').data("DateTimePicker").maxDate(e.date);
		});

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
		user.getuserlist(1);
    }


}

var user = {

	init: function(){

		//add new bill of lading modal
		$('#new_user').click(function(){
			user.createuser();
		});				

		$('.selector').click(function(){
			$('.selector').removeClass('select_active');
			$('.selector').addClass('select_inactive');
			$(this).addClass('select_active');
			$(this).removeClass('select_inactive');
			$('#additional_table table').hide();
			$('#additional_table #'+this.id+'ed').show();
		});		

		//clear new bill of lading 
		$('#clearecreate').click(function(){
			if(confirm("Are you sure you want to proceed?.")){
				user.clear();				
			}

		});			


		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				user.save();	
			}
		});
		user.getuserlist();


	},

	createuser: function(){
		$('#create_modal').modal();
		$('#savecreate').show();
		$('#clearecreate').show();
		$('#updatecreate').hide();
		user.clear();
	},


	update: function(){
		var arr = createPostData('create_shippment');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#updatecreate').addClass('disabled');
			$('#updatecreate i').removeClass('hide');
    		$.post("backstage/user/update/"+updateid, {d:arr['data'], i:inventory, v:vehicle},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully updated.');
						$('#create_modal').modal('hide');
						$('#updatecreate').removeClass('disabled');
						$('#updatecreate i').addClass('hide');
						user.getuserlist();
				}else{
					toastr["error"](data.message);
					$('#'+data.error_col).addClass('has-error');

				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#updatecreate').removeClass('disabled');
				$('#updatecreate i').addClass('hide');
			});
    	}

	},

	delete: function(id){
		if(confirm("Are you sure you want to delete this?")){
			$.post("backstage/user/delete/"+id, {},function(data){
				toastr["success"]('Successfully deleted.');
				user.getuserlist();
			}).fail(function(){
				toastr["error"]('Network error!<br> Please try again.');				
			});			
		}

	},

	clear: function(){
		user.form('user_form');	
	},

form: function(classused){
	$('.'+classused+' div').removeClass('has-error');	
	$('.'+classused).removeClass('has-error');	
	$('.'+classused+' input, .'+classused+' select').val('');
},


reveal: function(id){
	var detail = $('#detail-'+id);
	var revealbtn = $('#user-'+id+' .reveal i');
	if(detail.hasClass('hide')){
		detail.removeClass('hide');
		revealbtn.removeClass('fa-plus');
		revealbtn.addClass('fa-minus');
	}else{
		detail.addClass('hide');
		revealbtn.removeClass('fa-minus');
		revealbtn.addClass('fa-plus');
	}

},

activate: function(id, action=0){
	
		$('#detail-'+id+' .action-btn').addClass('disabled');
		$('#detail-'+id+' .action-btn i').removeClass('hide');
		$.post("backstage/user/activate/"+id+"/"+action, {},function(data){
			if(data.status==200){
					toastr["success"]('Successfully updated.');
					$('#detail-'+id+' .action-btn').removeClass('disabled');
					$('#detail-'+id+' .action-btn i').addClass('hide');
					user.getuserlist();
			}else{
				toastr["error"]('Error');
			}
		}).fail(function(){
			toastr["error"]('Error.');
			$('#detail-'+id+' .action-btn').removeClass('disabled');
			$('#detail-'+id+' .action-btn i').addClass('hide');
		});
	

},
update: function(id){
	var arr = createPostData('user-detail-'+id);
	if(arr['error']){
		toastr["error"](arr['error']);
	}else{
		$('#detail-'+id+' .update_user_detail').addClass('disabled');
		$('#detail-'+id+' .update_user_detail i').removeClass('hide');
		$.post("backstage/user/update/"+id, {d:arr['data']},function(data){
			if(data.status==200){
					toastr["success"]('Successfully updated.');
					$('#detail-'+id+' .update_user_detail').removeClass('disabled');
					$('#detail-'+id+' .update_user_detail i').addClass('hide');
					user.getuserlist();
			}else{
				toastr["error"](data.message);
				$('#'+data.error_col).addClass('has-error');
			}
		}).fail(function(){
			toastr["error"]('Error.');
			$('#detail-'+id+' .update_user_detail').removeClass('disabled');
			$('#detail-'+id+' .update_user_detail i').addClass('hide');
		});
	}

},

save: function(){
	var arr2 = createPostData('user_profiles');
	var arr1 = createPostData('user_account');

	if(arr1['error'] || arr2['error']){
		toastr["error"]('Complete the fields');
	}else{
		$('#savecreate').addClass('disabled');
		$('#savecreate i').removeClass('hide');
		$.post("backstage/user/save/", {user_profiles:arr2['data'], user_account:arr1['data'] },function(data){
			if(data.status==200){
					toastr["success"]('Successfully added.');
					$('#create_modal').modal('hide');
					$('#savecreate').removeClass('disabled');
					$('#savecreate i').addClass('hide');
					user.getuserlist();
			}else{
					toastr["error"](data.message);
					$('#'+data.error_col).addClass('has-error');
					$('#savecreate').removeClass('disabled');
					$('#savecreate i').addClass('hide');
			}
		}).fail(function(){
			toastr["error"]('Error.');
			$('#savecreate').removeClass('disabled');
			$('#savecreate i').addClass('hide');
		});
	}

},

getuserlist: function(page=1){
	
		$.post("backstage/user/getUserList/"+page, {searchdata: searchdata},function(data){
			var content = '';
			// console.log(data);
			$.each(data.data, function( index, value ) {

				var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				content +='<tr id="user-'+value.id+'" data-id="'+value.id+'">';
				content +='<td class="centered reveal"> <i class="fa fa-plus" aria-hidden="true"></i> </td>';
				content +='<td>'+value.lname+', '+value.fname+' '+ value.mname +'</td>';
				content +='<td>'+value.username+'</td>';
				content +='<td>'+SelectOption(value.user_type, user_type)+'</td>';

				if(value.last_login==null){
					content +='<td> </td>';
				}else{
					content +='<td>'+value.last_login+'</td>';	
				}
				
				if(value.status==1){
					content +='<td>Active</td>';	
				}else{
					content +='<td>Inactive</td>';	
				}
				
				content +='</tr>';
				content +="<tr id='detail-"+value.id+"' class='hide revealed-detail user-detail-"+value.id+"' data-id=\""+value.id+"\"><td colspan=6><table>";
				content +="<tr>";
				content +="<td>First Name</td><td><input type=\"text\" col=\"fname\" class=\"detailfname form-control\" value='"+value.fname+"'></td>";
				content +="<td class='second'>Email Address</td><td><input type=\"text\" col=\"email\" class=\"detailemail form-control\" value='"+value.email+"'></td>";
				content +="<td class='second'>Postion</td><td><input type=\"text\" col=\"position\" class=\"detailposition form-control\" value='"+value.position+"'></td>";
				content +="</tr>";
				
				content +="<tr>";
				content +="<td>Middle Name</td><td><input type=\"text\" col=\"mname\" class=\"detailmname form-control not_mandatory\" value='"+value.mname+"'></td>";
				content +="<td class='second'>Mobile Number</td><td><input type=\"text\" col=\"mobile\" class=\"detailmobile form-control\" value='"+value.mobile+"'></td>";
				content +="<td class='second'>User Type</td><td>"+CreateSelectOption(value.user_type, user_type, 'user_type')+"</td>";
				content +="</tr>";

				content +="<tr>";
				content +="<td>Last Name</td><td><input type=\"text\" col=\"lname\" class=\"detaillname form-control\" value='"+value.lname+"'></td>";
				content +="<td class='second'>Department</td><td><input type=\"text\" col=\"dept\" class=\"detaildept form-control\" value='"+value.dept+"'></td>";
				content +="<td colspan=2 class='last'> <button class=\"custombutton update_user_detail\"> <i class=\"fa fa-circle-o-notch fa-spin hide\"></i> Update User</button> <button class=\"custombutton\">Reset</button> ";
				
				if(value.status==1){
					content +="<button class=\"custombutton deactivate action-btn\"><i class=\"fa fa-circle-o-notch fa-spin hide\"></i>De-activate User</button></td>";
				}else{
					content +="<button class=\"custombutton activate action-btn\"><i class=\"fa fa-circle-o-notch fa-spin hide\"></i>Activate User</button></td>";
				}
				
				
				content +="</tr>";
				content +="</table></td></tr>";
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				user.getuserlist($(this).data('page'));
			});
			

			$('#search_result_list .reveal').click(function(){
				user.reveal($(this).parent().data('id'));
			});

			$('.deactivate').click(function(){
				if(!$(this).hasClass('disabled')){
					var id = $(this).parent().parent().parent().parent().parent().parent().data('id'); 
					user.activate(id, '0');
				}
			});

			$('.activate').click(function(){
				if(!$(this).hasClass('disabled')){
					var id = $(this).parent().parent().parent().parent().parent().parent().data('id'); 
					user.activate(id, '1');
				}
			});

			$('.update_user_detail').click(function(){
				if(!$(this).hasClass('disabled')){
					var id = $(this).parent().parent().parent().parent().parent().parent().data('id'); 
					user.update(id);
				}
			});

		}).fail(function(){
			toastr["error"]("Failed to load the User list.");
		});

	}



}


search.init();
user.init();