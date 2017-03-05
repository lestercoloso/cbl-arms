
var searchdata = "";
var updateid = '';

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

		//clear new bill of lading 
		$('#clearecreate').click(function(){
			booking.clear();
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


	},

	createbooking: function(){
		$('#create_modal').modal();
		$('#savecreate').show();
		$('#clearecreate').show();
		$('#updatecreate').hide();
		booking.clear();
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
		});
	},


	update: function(){
		var arr = createPostData('create_shippment');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#updatecreate').addClass('disabled');
			$('#updatecreate i').removeClass('hide');
    		$.post("backstage/booking/update/"+updateid, {d:arr['data']},function(data){
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
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$('#savecreate').addClass('disabled');
			$('#savecreate i').removeClass('hide');
    		$.post("backstage/booking/save/", {d:arr['data']},function(data){
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

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});

	}



}


search.init();
booking.init();