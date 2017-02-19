


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
			billoflading.getbookingdata(booking_no, bookingid);
		});		

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

		if(form1['error'] || form2['error'] || form3['error'] || form4['error'] || form5['error'] || form6['error']){
			toastr["error"]('Complete the fields');
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
					content +='<option value="'+value.booking_no+'" data-bookingid="'+value.id+'"">'+value.booking_no+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 500);
			});
		}		
	},





}


search.init();
billoflading.init();