
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
		$('#add_new_inventory').click(function(){
			user.createinventory();
		});				
		$('#add_multiple_vehicle').click(function(){
			user.createvehicle();
		});				
		$('#savevehicle').click(function(){
			user.savevehicle();
		});				
		$('#saveinventory').click(function(){
			user.saveinventory();
		});					
		$('#updateinventory').click(function(){
			user.updateinventory();
		});				
		$('#updatevehicle').click(function(){
			user.updatevehicle();
		});				
		$('#clearadditional').click(function(){
			user.clearadditional();
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
			if(confirm("Are you sure you want to proceed?\nThis will also clear the inventory/vehicle list.")){
				user.clear();				
			}

		});			

		$('#create_customer_name').change(function(){
			var clientid = $(this).find(':selected').data('client_id');
			$('#create_customer_id').val(clientid);
			user.getcontacts(clientid);
		});		

		$('#create_contact_person').change(function(){
			user.select_contacts();
		});		

		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				user.save();	
			}
		});
		$('#updatecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				user.update();	
			}
		});	

		user.getuserlist();

		$('#additional-vehicle_type').change(function(){
			user.selectvehicle();
		});

	},

	select_contacts: function(){
			var department = $('#create_contact_person').find(':selected').data('department');
			var contact_id = $('#create_contact_person').find(':selected').data('contact_id');
			$('#create_department').val(department);
			$('#create_contact_id').val(contact_id);
	},
	selectvehicle: function(selected){
		var vehicle_type = $('#additional-vehicle_type').val();
		var content = '<option value="">Select Plate No.</option>';
		$.each(vehicle_data[vehicle_type], function( index, value ) {
			content += '<option value="'+value+'">'+value+'</option>';
		});
		$('#additional-plate_no').html(content);
		$('#additional-plate_no').val(selected);
	},

	createuser: function(){
		$('#create_modal').modal();
		$('#savecreate').show();
		$('#clearecreate').show();
		$('#updatecreate').hide();
		user.clear();
	},

	createinventory: function(){
		$('#create_additional').modal();
		$('#create_additional .modal-title').html('Add Inventory');
		$('#create_additional').addClass('inventory');
		$('#create_additional').removeClass('vehicle');
		$('.add_inventory').show();
		$('.add_vehicle').hide();
		user.clearadditional();
		$('#clearadditional').show();
		$('#saveinventory').show();
		$('#savevehicle').hide();
		$('#updateinventory').hide();
		$('#updatevehicle').hide();

	},
	
	createvehicle: function(){
		$('#create_additional').modal();
		$('#create_additional .modal-title').html('Add Vehicle');		
		$('#create_additional').removeClass('inventory');
		$('#create_additional').addClass('vehicle');
		$('.add_inventory').hide();
		$('.add_vehicle').show();
		user.clearadditional();
		$('#saveinventory').hide();
		$('#clearadditional').show();
		$('#savevehicle').show();
		$('#updateinventory').hide();
		$('#updatevehicle').hide();
	},

	vehicleedit: function(key){
		$('#saveinventory').hide();
		$('#savevehicle').hide();
		$('#clearadditional').hide();
		$('#updateinventory').hide();
		$('#updatevehicle').show();
		$('.add_inventory').hide();
		$('.add_vehicle').show();
		$('#create_additional').modal();
		$('#create_additional').removeClass('inventory');
		$('#create_additional').addClass('vehicle');
		$('#create_additional .modal-title').html('Edit Vehicle');
		$.each(vehicle[key], function( index, value ) {
			$('#additional-'+index).val(value);
		});
		updatevehiclekey = key;
		user.selectvehicle(vehicle[key].plate_no);
	},
	inventoryedit: function(key){
		$('#saveinventory').hide();
		$('#savevehicle').hide();
		$('#clearadditional').hide();
		$('#updateinventory').show();
		$('#updatevehicle').hide();
		$('#create_additional').modal();
		$('.add_inventory').show();
		$('.add_vehicle').hide();
		$('#create_additional').addClass('inventory');
		$('#create_additional').removeClass('vehicle');
		$('#create_additional .modal-title').html('Edit Inventory');
		$.each(inventory[key], function( index, value ) {
			$('#additional-'+index).val(value);
		});
		updateinventorykey = key;
	},

	saveinventory: function(){

		var arr = createPostData('add_inventory');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
    		inventory.push(arr['data']);
    		toastr["success"]('Successfully added.');
    		$('#create_additional').modal('hide');
    		user.constructinventory();
    	}
	},
	updateinventory: function(){

		var arr = createPostData('add_inventory');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
    		toastr["success"]('Successfully updated.');
    		$('#create_additional').modal('hide');
    		inventory[updateinventorykey] = arr['data'];
    		user.constructinventory();
    	}
	},
	savevehicle: function(){

		var arr = createPostData('add_vehicle');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
    		vehicle.push(arr['data']);
    		toastr["success"]('Successfully added.');
    		$('#create_additional').modal('hide');
    		user.constructvehicle();
    	}
	},	
	updatevehicle: function(){

		var arr = createPostData('add_vehicle');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
    		vehicle[updatevehiclekey] = arr['data'];
    		toastr["success"]('Successfully updated.');
    		$('#create_additional').modal('hide');
    		user.constructvehicle();
    	}
	},
	constructvehicle: function(){
		
		var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		content = '';
		$.each(vehicle, function( index, value ) {
			content +='<tr id="vehicle-'+index+'" data-key="'+index+'">';
			content +='<td class="centered">'+value.vehicle_type+'</td>';
			content +='<td class="centered">'+value.plate_no+'</td>';
			content +='<td class="centered">'+value.driver+'</td>';
			content +='<td class="centered">'+action+'</td></tr>';
		});

		$('#vehicle_selected tbody').html(content);
		$('#vehicle_selected tbody tr .btn-success').click(function(){
			user.vehicleedit($(this).parent().parent().data('key'));
		});
		$('#vehicle_selected tbody tr .btn-danger').click(function(){
			if(confirm('Are you sure you want to remove this?')){
					vehicle.remove($(this).parent().parent().data('key'));
					toastr["success"]('Successfully removed.');
					user.constructvehicle();					
				
			}
		});
	},
	constructinventory: function(){
		
		var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		content = '';
		$.each(inventory, function( index, value ) {
			content +='<tr id="inventory-'+index+'" data-key="'+index+'">';
			content +='<td class="centered">'+pad(value.item_id,10,'0')+'</td>';
			content +='<td class="centered">'+value.product_code+'</td>';
			content +='<td class="centered">'+value.item_type+'</td>';
			content +='<td class="centered">'+value.unit_of_measurement+'</td>';
			content +='<td class="centered">'+value.packaging+'</td>';
			content +='<td class="centered">'+value.length+'x'+value.width+'x'+value.height+'</td>';
			content +='<td class="centered">'+value.storage_type+'</td>';
			content +='<td class="centered">'+value.unit_cost+'</td>';
			content +='<td class="centered">'+value.unit_price+'</td>';
			content +='<td class="centered">'+action+'</td></tr>';	

			lastitemid = parseInt(value.item_id);
		});

		$('#inventory_selected tbody').html(content);
		$('#inventory_selected tbody tr .btn-success').click(function(){
			user.inventoryedit($(this).parent().parent().data('key'));
		});		
		$('#inventory_selected tbody tr .btn-danger').click(function(){
			if(confirm('Are you sure you want to remove this?')){
					inventory.remove($(this).parent().parent().data('key'));
					toastr["success"]('Successfully removed.');
					user.constructinventory();					
			}
		});
	},




	getnewinventorynumber: function(){
		var item_id = (lastitemid+1);
		$('#additional-item_id').val(pad(item_id, 10, '0'));
	},

	clearadditional: function(){
		$('#create_additional input, #create_additional select').val('');
		user.getnewinventorynumber();
		user.form('add_inventory');
		user.form('add_vehicle');
		user.getnewinventorynumber();
		$('#additional-plate_no').html('');

	},


	edit: function(id){
		user.form('create_shippment');
		$('#create_modal').modal();
		$('#savecreate').hide();
		$('#clearecreate').hide();
		$('#updatecreate').show();
		$('#create_customer_name').chosen('destroy');
		$.post("backstage/user/getuserdetails/"+id, {},function(data){	
			$.each(data, function( index, value ) {
				$('.create_shippment input[col="'+index+'"], .create_shippment select[col="'+index+'"]').val(value);
			});
			updateid = data.id;
			$('#create_customer_name').html('<option value="'+data.customer_name+'" data-client_id="'+data.customer_id+'" "="">'+data.customer_name+'</option>');
			$('#create_user_date').val(data.user_date);
			user.getcontacts(data.customer_id, data.area, data.contact_person);
			
			if(data.vehicle){
				vehicle = JSON.parse(data.vehicle);				
			}else{
				vehicle = [];
			}

			if(data.inventory){
				inventory = JSON.parse(data.inventory);
			}else{
				inventory = [];
			}

			
			user.constructvehicle();	
			user.constructinventory();	
		});
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
		var arr = createPostData('create_shippment');
		// if(inventory.length<=0){
		// 	arr['error'] = 'Complete the fields';
		// 	$('#inventory_select').addClass('has-error');
		// }else{
		// 	$('#inventory_select').removeClass('has-error');
		// }

		// if(vehicle.length<=0){
		// 	$('#vehicle_select').addClass('has-error');
		// 	arr['error'] = 'Complete the fields';
		// }else{
		// 	$('#vehicle_select').removeClass('has-error');			
		// }

		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#savecreate').addClass('disabled');
			$('#savecreate i').removeClass('hide');
    		$.post("backstage/user/save/", {d:arr['data'], i:inventory, v:vehicle},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#savecreate').removeClass('disabled');
						$('#savecreate i').addClass('hide');
						user.getuserlist();
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
		user.form('create_shippment');
		user.getuser();
		$('#create_user_date').val(datetoday);
		$('#create_contact_person').html('');
		$('#create_area').html('');
		user.getcustomerlist();
		setTimeout(function(){ 
			resetchosen('create_customer_name');
		}, 500);
		$('#create_time_called').val(getClockTime());
		$('#craete_transaction_type').val('Delivery');
		inventory = [];
		vehicle = [];
		user.constructvehicle();	
		user.constructinventory();	

		$('#create_address_container').hide();
		$('#create_area_container').hide();
		$('#create_contact_person_container').hide();
		$('#create_department_container').hide();

	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	},
	getuser: function(){
		$.post("backstage/user/getuserno/", {},function(data){
			$('#create_user_no').val(data);
		});
	},




	getcontacts: function(id, t1='', t2=''){
		var content1 = '<option value="">Select Area</option>';
		var content1 = '';
		var content2 = '<option value="">Select Contact Person</option>';
		var content2 = '';
		$.post("backstage/user/getcontacts/"+id, {},function(data){
			$.each(data.area, function( index, value ) {
				if(value.trim()!=''){
					content1 +='<option value="'+value+'">'+value+'</option>';
				}
			});		

			$.each(data.contact, function( index, value ) {
					content2 +='<option value="'+value.name+'" data-department="'+value.department+'" data-contact_id="'+value.id+'">'+value.name+'</option>';
			});
			$('#create_area').html(content1);
			$('#create_contact_person').html(content2);
			$('#create_address').val(data.address);
			if(t1!=''){
				$('#create_area').val(t1);			
			}

			if(t2!=''){
				$('#create_contact_person').val(t2);					
			}


			$('#create_address_container').show();
			$('#create_area_container').show();
			$('#create_contact_person_container').show();
			$('#create_department_container').show();
			user.select_contacts();

		});
	},

	getcustomerlist: function(){
		var d = $('#create_customer_name');
		// if(d.html().trim()==''){
			$.post("backstage/customer/getcustomername/", {},function(data){
				var content = "<option></option>";
				$.each(data.data, function( index, value ) {
					content +='<option value="'+value.customer_name+'" data-client_id="'+value.id+'"">'+value.customer_name+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 500);
			});
		// }		
	},

reveal: function(id){
	var detail = $('#detail-'+id);
	var revealbtn = $('#user-'+id+' .reveal i');
	console.log(revealbtn);
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
				content +="<tr id='detail-"+value.id+"' class='hide revealed-detail'><td colspan=6><table>";
				content +="<tr>";
				content +="<td>First Name</td><td><input type=\"text\" col=\"fname\" id=\"detailfname\" class=\"form-control\" value='"+value.fname+"'></td>";
				content +="<td class='second'>Email Address</td><td><input type=\"text\" col=\"email\" id=\"detailemail\" class=\"form-control\" value='"+value.email+"'></td>";
				content +="<td class='second'>User Type</td><td>"+CreateSelectOption(value.user_type, user_type, 'user_type')+"</td>";
				content +="</tr>";
				
				content +="<tr>";
				content +="<td>Middle Name</td><td><input type=\"text\" col=\"mname\" id=\"detailmname\" class=\"form-control\" value='"+value.mname+"'></td>";
				content +="<td class='second'>Mobile Number</td><td><input type=\"text\" col=\"mobile\" id=\"detailmobile\" class=\"form-control\" value='"+value.mobile+"'></td>";
				content +="</tr>";

				content +="<tr>";
				content +="<td>Last Name</td><td><input type=\"text\" col=\"lname\" id=\"detaillname\" class=\"form-control\" value='"+value.lname+"'></td>";
				content +="<td colspan=4 class='last'> <button class=\"custombutton\">Update User</button> <button class=\"custombutton\">Reset</button> <button class=\"custombutton\">De-activate User</button></td>";
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

		}).fail(function(){
			toastr["error"]("Failed to load the User list.");
		});

	}



}


search.init();
user.init();