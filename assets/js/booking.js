
var searchdata = "";
var updateid = '';
var inventory = [];
var vehicle = [];
var lastitemid = 0;
var updateinventorykey = '';
var updatevehiclekey = '';


var search = {
	init: function(){
		$('#search_booking_date_from, #search_booking_date_to').datetimepicker({
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

		$("#search_booking_date_from").on("dp.change", function (e) {
			$('#search_booking_date_to').data("DateTimePicker").minDate(e.date);
		});
		$("#search_booking_date_to").on("dp.change", function (e) {
			$('#search_booking_date_from').data("DateTimePicker").maxDate(e.date);
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
		booking.getbookinglist(1);
    }


}

var booking = {

	init: function(){

		//add new bill of lading modal
		$('#book_shipment').click(function(){
			booking.createbooking();
		});				
		$('#add_new_inventory').click(function(){
			booking.createinventory();
		});				
		$('#add_multiple_vehicle').click(function(){
			booking.createvehicle();
		});				
		$('#savevehicle').click(function(){
			booking.savevehicle();
		});				
		$('#saveinventory').click(function(){
			booking.saveinventory();
		});					
		$('#updateinventory').click(function(){
			booking.updateinventory();
		});				
		$('#updatevehicle').click(function(){
			booking.updatevehicle();
		});				
		$('#clearadditional').click(function(){
			booking.clearadditional();
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
				booking.clear();				
			}

		});			

		$('#create_customer_name').change(function(){
			var clientid = $(this).find(':selected').data('client_id');
			$('#create_customer_id').val(clientid);
			booking.getcontacts(clientid);
		});		

		$('#create_contact_person').change(function(){
			var department = $(this).find(':selected').data('department');
			var contact_id = $(this).find(':selected').data('contact_id');
			$('#create_department').val(department);
			$('#create_contact_id').val(contact_id);

		});		

		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				booking.save();	
			}
		});
		$('#updatecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				booking.update();	
			}
		});	

		booking.getbookinglist();

		$('#additional-vehicle_type').change(function(){
			booking.selectvehicle();
		});

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

	createbooking: function(){
		$('#create_modal').modal();
		$('#savecreate').show();
		$('#clearecreate').show();
		$('#updatecreate').hide();
		booking.clear();
	},

	createinventory: function(){
		$('#create_additional').modal();
		$('#create_additional .modal-title').html('Add Inventory');
		$('#create_additional').addClass('inventory');
		$('#create_additional').removeClass('vehicle');
		$('.add_inventory').show();
		$('.add_vehicle').hide();
		booking.clearadditional();
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
		booking.clearadditional();
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
		booking.selectvehicle(vehicle[key].plate_no);
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
    		booking.constructinventory();
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
    		booking.constructinventory();
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
    		booking.constructvehicle();
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
    		booking.constructvehicle();
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
			booking.vehicleedit($(this).parent().parent().data('key'));
		});
		$('#vehicle_selected tbody tr .btn-danger').click(function(){
			if(confirm('Are you sure you want to remove this?')){
					vehicle.remove($(this).parent().parent().data('key'));
					toastr["success"]('Successfully removed.');
					booking.constructvehicle();					
				
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
			booking.inventoryedit($(this).parent().parent().data('key'));
		});		
		$('#inventory_selected tbody tr .btn-danger').click(function(){
			if(confirm('Are you sure you want to remove this?')){
					inventory.remove($(this).parent().parent().data('key'));
					toastr["success"]('Successfully removed.');
					booking.constructinventory();					
			}
		});
	},




	getnewinventorynumber: function(){
		var item_id = (lastitemid+1);
		$('#additional-item_id').val(pad(item_id, 10, '0'));
	},

	clearadditional: function(){
		$('#create_additional input, #create_additional select').val('');
		booking.getnewinventorynumber();
		booking.form('add_inventory');
		booking.form('add_vehicle');
		booking.getnewinventorynumber();
		$('#additional-plate_no').html('');

	},


	edit: function(id){
		booking.form('create_shippment');
		$('#create_modal').modal();
		$('#savecreate').hide();
		$('#clearecreate').hide();
		$('#updatecreate').show();
		$('#create_customer_name').chosen('destroy');
		$.post("backstage/booking/getbookingdetails/"+id, {},function(data){	
			$.each(data, function( index, value ) {
				$('.create_shippment input[col="'+index+'"], .create_shippment select[col="'+index+'"]').val(value);
			});
			updateid = data.id;
			$('#create_customer_name').html('<option value="'+data.customer_name+'" data-client_id="'+data.customer_id+'" "="">'+data.customer_name+'</option>');
			$('#create_booking_date').val(data.booking_date);
			booking.getcontacts(data.customer_id, data.area, data.contact_person);
			
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

			
			booking.constructvehicle();	
			booking.constructinventory();	
		});
	},


	update: function(){
		var arr = createPostData('create_shippment');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#updatecreate').addClass('disabled');
			$('#updatecreate i').removeClass('hide');
    		$.post("backstage/booking/update/"+updateid, {d:arr['data'], i:inventory, v:vehicle},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully updated.');
						$('#create_modal').modal('hide');
						$('#updatecreate').removeClass('disabled');
						$('#updatecreate i').addClass('hide');
						booking.getbookinglist();
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
    		$.post("backstage/booking/save/", {d:arr['data'], i:inventory, v:vehicle},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_modal').modal('hide');
						$('#savecreate').removeClass('disabled');
						$('#savecreate i').addClass('hide');
						booking.getbookinglist();
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
			$.post("backstage/booking/delete/"+id, {},function(data){
				toastr["success"]('Successfully deleted.');
				booking.getbookinglist();
			}).fail(function(){
				toastr["error"]('Network error!<br> Please try again.');				
			});			
		}

	},

	clear: function(){
		booking.form('create_shippment');
		booking.getbooking();
		$('#create_booking_date').val(datetoday);
		$('#create_contact_person').html('');
		$('#create_area').html('');
		booking.getcustomerlist();
		setTimeout(function(){ 
			resetchosen('create_customer_name');
		}, 500);
		$('#create_time_called').val(getClockTime());
		$('#craete_transaction_type').val('Delivery');
		inventory = [];
		vehicle = [];
		booking.constructvehicle();	
		booking.constructinventory();	

	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	},
	getbooking: function(){
		$.post("backstage/booking/getbookingno/", {},function(data){
			$('#create_booking_no').val(data);
		});
	},




	getcontacts: function(id, t1='', t2=''){
		var content1 = '<option value="">Select Area</option>';
		var content2 = '<option value="">Select Contact Person</option>';
		$.post("backstage/booking/getcontacts/"+id, {},function(data){
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
			$('#create_area').val(t1);
			$('#create_contact_person').val(t2);	
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

getbookinglist: function(page=1){
	
		$.post("backstage/booking/bookinglist/"+page, {searchdata: searchdata},function(data){
			var content = '';
			// console.log(data);
			$.each(data.data, function( index, value ) {

				var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				content +='<tr id="booking-'+value.id+'" data-id="'+value.id+'">';
				content +='<td class="centered">'+value.booking_no+'</td>';
				content +='<td class="centered">'+value.customer_name+'</td>';
				content +='<td>'+value.booking_date+'</td>';
				content +='<td>'+value.area+'</td>';
				content +='<td>'+value.mode_of_shipping+'</td>';
				content +='<td>'+value.contact_person+'</td>';
				content +='<td>'+value.booking_status+'</td>';
				content +='<th>'+action+'</th>';
				content +='</tr>';
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				booking.getbookinglist($(this).data('page'));
			});
			
			$('#search_result_list .btn-success').click(function(){
				booking.edit($(this).parent().parent().data('id'));
			});

			$('#search_result_list .btn-danger').click(function(){
				booking.delete($(this).parent().parent().data('id'));
			});

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});

	}



}


search.init();
booking.init();