
var searchdata = "";
var updateid = "";
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

		$('#updatebilling').click(function(){
			billoflading.update();
		});	

		$('#booking_no').change(function(){
			var booking_no = $(this).val();
			var bookingid = $(this).find(':selected').data('bookingid');
			var customer_id = $(this).find(':selected').data('clientid');
			$('#bill_client_id').val(customer_id);
			billoflading.getbookingdata(booking_no, bookingid);
		});		

		$('#create_bill_of_lading input[type="number"]').bind('keyup keydown change',function(){
			billoflading.compute_billing();
		});		

		billoflading.getbilllist();

		$('#create_vat').attr('disabled','disabled');
		$('#create_declared_value').attr('disabled','disabled');
		$('#create_total').attr('disabled','disabled');
		$('#create_total_amount_due').attr('disabled','disabled');
		$('#create_final_contract_price').attr('disabled','disabled');

	},
	compute_billing: function(){
		var tdv 			= $('#create_total_declared_value').val();
		var tdvapplied 		= $('#create_tdv_applied').val()*0.01;
		var declared_value 	= parseInt(tdv)+(tdv*tdvapplied);
		$('#create_declared_value').val(declared_value);


		var fumigation 	= $('#create_fumigation').val()*1;
		var exp_fee 	= $('#create_export_declaration_fee').val()*1;
		var acc 	 	= $('#create_address_correction_charge').val()*1;
		var rd  	 	= $('#create_residential_delivery').val()*1;
		var nsc  	 	= $('#create_non_stackable_charge').val()*1;
		var crating  	= $('#create_crating').val()*1;
		var labelcost  	= $('#create_label_cost').val()*1;
		var dgcharge  	= $('#create_dg_charge').val()*1;
		var backload  	= $('#create_back_load').val()*1;
		var demurage  	= $('#create_demmurage_fee').val()*1;
		var total   	= parseFloat(declared_value)+parseFloat(fumigation)+parseFloat(exp_fee)+parseFloat(acc)+parseFloat(rd)+parseFloat(nsc)+parseFloat(crating)+parseFloat(labelcost)+parseFloat(dgcharge)+parseFloat(backload)+parseFloat(demurage);	
		$('#create_total').val(total.toFixed(2));
		var vat 	    = (total*0.12);
		var plusvat 	= parseFloat(total)+(total*0.12);
		$('#create_vat').val(vat.toFixed(2));
		$('#create_total_amount_due').val(plusvat.toFixed(2));

		var discount  	= $('#create_discount_percent').val()*0.01;
		var contract 	= parseFloat(plusvat)-(plusvat*discount);
		$('#create_final_contract_price').val(contract.toFixed(2));



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
			$('#create_dimension').val(data.dimension);
			$('#create_actual_weight').val(data.weight);
			$('#create_tin_no').val(data.tin_no);
		});
	},
	createBillOfLading: function(){
		$('#create_bill_of_lading').modal();
		$('#create_bill_of_lading .modal-title').html('Add Bill of Lading');
		billoflading.clear();
		billoflading.getbookingno();
		$('#updatebilling').hide();
		$('#savenewbilling').show();
		$('#clearnewbilling').show();		
		$('#create_bill_of_lading input[type="number"]').val(0);
	},

	edit: function(id){
		updateid = id;
		$('#booking_no').chosen('destroy');
		$('#create_bill_of_lading').modal();
		$('#create_bill_of_lading .modal-title').html('Edit Bill of Lading');		
		$('#updatebilling').show();
		$('#savenewbilling').hide();
		$('#clearnewbilling').hide();

		$.post("backstage/billoflading/boldetails/"+id, {},function(data){
			$('#booking_no').html("<option value='"+data.book_id+"'>"+pad(data.book_id,10,'0')+"</option>");
			$('#bill_no').val(pad(data.bill_no,10,'0'));
			$('#bill_client_id').val(data.client_id);

			$.each(JSON.parse(data.shipper_information), function( index, value ) {
				$('.form_1 input[col="'+index+'"], .form_1 select[col="'+index+'"]').val(value);
			});	

			$.each(JSON.parse(data.recipient_information), function( index, value ) {
				$('.form_2 input[col="'+index+'"], .form_2 select[col="'+index+'"]').val(value);
			});

			var pack_cont = JSON.parse(data.package_content);
			$.each(pack_cont, function( index, value ) {
				$('.form_3 input[type="number"][col="'+index+'"], .form_3 input[type="text"][col="'+index+'"], .form_3 select[col="'+index+'"]').val(value);
			});

			$('.form_3 input[type="radio"][value="'+pack_cont.packing_type_document+'"]').prop("checked", true);
			$('.form_3 input[type="radio"][value="'+pack_cont.packing_type_parcel+'"]').prop("checked", true);
			$('.form_3 input[type="radio"][value="'+pack_cont.packing_type_crating+'"]').prop("checked", true);

			$.each(JSON.parse(data.others), function( index, value ) {
				$('.form_4 input[col="'+index+'"], .form_4 select[col="'+index+'"]').val(value);
			});

			$.each(JSON.parse(data.charges), function( index, value ) {
				$('.form_5 input[col="'+index+'"], .form_5 select[col="'+index+'"]').val(value);
			})

			$.each(JSON.parse(data.additional_charges), function( index, value ) {
				$('.form_6 input[col="'+index+'"], .form_6 select[col="'+index+'"]').val(value);
			});
		});

	},

	update: function(){

		var form1 = createPostData('form_1');
		var form2 = createPostData('form_2');
		var form3 = createPostData('form_3');
		var form4 = createPostData('form_4');
		var form5 = createPostData('form_5');
		var form6 = createPostData('form_6');

		if(form1['error'] || form2['error'] || form3['error'] || form4['error'] || form5['error'] || form6['error']){
			toastr["error"]('Complete the fields');
		}else{
			$('#updatebilling').addClass('disabled');
			$('#updatebilling i').removeClass('hide');

			$.post("backstage/billoflading/update/"+updateid, {
				shipper_information:JSON.stringify(form1['data']), 
				recipient_information: JSON.stringify(form2['data']), 
				package_content: JSON.stringify(form3['data']), 
				others: JSON.stringify(form4['data']),
				charges: JSON.stringify(form5['data']), 
				additional_charges: JSON.stringify(form6['data']) 
			},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully updated.');
						$('#create_bill_of_lading').modal('hide');
						$('#updatebilling').removeClass('disabled');
						$('#updatebilling i').addClass('hide');
						billoflading.getbilllist();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#updatebilling').removeClass('disabled');
				$('#updatebilling i').addClass('hide');
			});


		}

	},	save: function(){

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

			$.post("backstage/billoflading/save/", {
				d:d['data'], 
				shipper_information:JSON.stringify(form1['data']), 
				recipient_information: JSON.stringify(form2['data']), 
				package_content: JSON.stringify(form3['data']), 
				others: JSON.stringify(form4['data']),
				charges: JSON.stringify(form5['data']), 
				additional_charges: JSON.stringify(form6['data']) 
			},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#create_bill_of_lading').modal('hide');
						$('#savenewbilling').removeClass('disabled');
						$('#savenewbilling i').addClass('hide');
						billoflading.getbilllist();
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
		$('.'+classused+' input[type="text"], .'+classused+' input[type="number"], .'+classused+' select').val('');
		$('.'+classused+' .first').attr('checked', 'checked');
	},
	delete: function(id){
		if(confirm('Are you sure you want to delete this?')){
			$.post("backstage/billoflading/delete/"+id, {},function(data){
				toastr["success"]('Successfully removed.');
				billoflading.getbilllist();
			}).fail(function(){
				toastr["error"]("Failed to load the inbound list.");
			});					
		}
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
				
				content +='<tr id="booking-'+value.id+'" data-id="'+value.id+'">';
				content +='<td class="centered"><input type="checkbox" value="" id="check-'+value.id+'"></td>';
				content +='<td class="centered">'+value.bill_no+'</td>';
				content +='<td>'+value.recipient+'</td>';
				content +='<td>'+value.shipper+'</td>';
				content +='<td>'+value.bill_date+'</td>';
				content +='<td class="numeric">'+value.amount+'</td>';
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
				billoflading.edit($(this).parent().parent().data('id'));
			});
			$('#search_result_list .btn-danger').click(function(){
				billoflading.delete($(this).parent().parent().data('id'));
			});

		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
		});


	}





}


search.init();
billoflading.init();