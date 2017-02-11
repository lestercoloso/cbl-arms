


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

	},

	createBillOfLading: function(){
		$('#create_bill_of_lading').modal();
		billoflading.clear();
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
		billoflading.form('form_1');
		billoflading.form('form_2');
		billoflading.form('form_3');
		billoflading.form('form_4');
		billoflading.form('form_5');
		billoflading.form('form_6');
		$(".first").prop("checked", true)

	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	}





}


search.init();
billoflading.init();