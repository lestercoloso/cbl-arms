


var search = {
	init: function(){
		$('#search_booking_date_from, #search_booking_date_to').datetimepicker({
			format: 'MM/DD/YYYY',
			useCurrent: false
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
		$('#clearnewbilling').click(function(){
			booking.clear();
		});		
		//save new bill of lading 
		$('#savenewbilling').click(function(){
			booking.save();
		});		

	},

	createbooking: function(){
		$('#create_modal').modal();
		booking.clear();
	},

	save: function(){
		createPostData('form_1');
		createPostData('form_2');
		createPostData('form_3');
		createPostData('form_4');
		createPostData('form_5');
		createPostData('form_6');
	},
	clear: function(){
		booking.form('form_1');
		booking.form('form_2');
		booking.form('form_3');
		booking.form('form_4');
		booking.form('form_5');
		booking.form('form_6');
		$(".first").prop("checked", true)

	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	}





}


search.init();
booking.init();