
var searchdata = "";

var search = {
	init: function(){
		$('#bill_of_lading_to_container, #bill_of_lading_from_container').datetimepicker({
			format: 'MM/DD/YYYY',
			useCurrent: false
		});

		$("#bill_of_lading_from_container").on("dp.change", function (e) {
			$('#bill_of_lading_to_container').data("DateTimePicker").minDate(e.date);
		});
		$("#bill_of_lading_to_container").on("dp.change", function (e) {
			$('#bill_of_lading_from_container').data("DateTimePicker").maxDate(e.date);
		});

		//clear select button
		$('#clearsearchbill').click(function(){
			$('.searchdata input, .searchdata select').val('');
		});

	}


}

var billoflading = {

	init: function(){

		//add new bill of lading modal
		$('#add_bill_of_lading').click(function(){
			billoflading.createBillOfLading();
		});		

		//clear new bill of lading 
		$('#clearnewbilling').click(function(){
			billoflading.clear();
		});		
		//save new bill of lading 
		$('#savenewbilling').click(function(){
			billoflading.save();
		});	

		$('#booking_no').change(function(){
			var booking_no = $(this).val();
			var bookingid = $(this).find(':selected').data('bookingid');
			var customer_id = $(this).find(':selected').data('clientid');
			$('#bill_client_id').val(customer_id);
			billoflading.getbookingdata(booking_no, bookingid);
		});		

		billoflading.getbilllist();

	},
	getbookingdata: function(bookingno, bookingid){
		$('#bill_no').val(bookingno);
		$.post("backstage/billoflading/getbookingdetails/"+bookingid, {},function(data){
			$('#create_shipper_name').val(data.contact_person);
			$('#create_company').val(data.customer_name);
			$('#create_contact_no').val(data.contact.contact_no);
			$('#create_email').val(data.contact.email);
			$('#create_department').val(data.contact.department);
			$('#create_department').val(data.contact.department);
			$('#create_area').val(data.area);
			$('#create_address').val(data.address);
		});
	},
	createBillOfLading: function(){
		$('#create_bill_of_lading').modal();
		billoflading.clear();
		billoflading.getbookingno();
	},

	save: function(){

		var form1 = createPostData('form_1');
		var form2 = createPostData('form_2');
		var form3 = createPostData('form_3');
		var form4 = createPostData('form_4');
		var form5 = createPostData('form_5');
		var form6 = createPostData('form_6');
		var d = createPostData('display');

		if(form1['error'] || form2['error'] || form3['error'] || form4['error'] || form5['error'] || form6['error'] || d['error']){
			toastr["error"]('Complete the fields');
		}else{
			$('#savenewbilling').addClass('disabled');
			$('#savenewbilling i').removeClass('hide');

			$.post("backstage/billoflading/save/", {d:d['data'], shipper_information:JSON.stringify(form1['data']), package_content: JSON.stringify(form2['data']), charges: JSON.stringify(form3['data']), additional_charges: JSON.stringify(form4['data']), recipient_information: JSON.stringify(form5['data']), others: JSON.stringify(form6['data']) },function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_bill_of_lading').modal('hide');
						$('#savenewbilling').removeClass('disabled');
						$('#savenewbilling i').addClass('hide');
						// booking.getbookinglist();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#savenewbilling').removeClass('disabled');
				$('#savenewbilling i').addClass('hide');
			});


		}


	},
	clear: function(){
		billoflading.form('form_1');
		billoflading.form('form_2');
		billoflading.form('form_3');
		billoflading.form('form_4');
		billoflading.form('form_5');
		billoflading.form('form_6');
		$(".first").prop("checked", true);
		$('#booking_no').html('');
		$('#bill_no').val('');
		billoflading.getbookingno();

	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	},
	getbookingno: function(){
		var d = $('#booking_no');
		if(d.html().trim()==''){
			$.post("backstage/billoflading/getbookingno/", {},function(data){
				var content = "<option></option>";
				console.log(data);
				$.each(data.data, function( index, value ) {
					content +='<option value="'+value.booking_no+'" data-bookingid="'+value.id+'"" data-clientid="'+value.customer_id+'"">'+value.booking_no+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 500);
			});
		}		
	},
	getbilllist: function(page=1){

		$.post("backstage/billoflading/listall/"+page, {searchdata: searchdata},function(data){
			var content = '';
			$.each(data.data, function( index, value ) {

				var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				content +='<tr id="booking-'+value.id+'">';
				content +='<td class="centered"><input type="checkbox" value="" id="check-'+value.id+'"></td>';
				content +='<td class="centered">'+value.bill_no+'</td>';
				content +='<td>'+value.recipient+'</td>';
				content +='<td>'+value.shipper+'</td>';
				content +='<td>'+value.bill_date+'</td>';
				content +='<td>'+value.amount+'</td>';
				content +='<td>'+value.bill_status+'</td>';
				content +='<th>'+action+'</th>';
				content +='</tr>';
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				billoflading.getbilllist($(this).data('page'));
			});
			
			$('#search_result_list .btn-success').click(function(){
				billoflading.edit($(this).parent().parent().attr('id'));
			});

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});


	}





}


search.init();
billoflading.init();