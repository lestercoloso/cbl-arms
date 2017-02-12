


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
		//save new bill of lading 
		$('#savecreate').click(function(){
			booking.save();
		});		

	},

	createbooking: function(){
		$('#create_modal').modal();
		booking.clear();
	},

	save: function(){
		var arr = createPostData('create_shippment');

		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{

    	}

	},
	clear: function(){
		booking.form('create_shippment');
		booking.getbooking();
		$('#create_booking_date').val(datetoday);

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
	}





}


search.init();
booking.init();