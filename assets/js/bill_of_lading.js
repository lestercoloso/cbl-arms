


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

	},

	createBillOfLading: function(){
		$('#create_bill_of_lading').modal();
	}




}


search.init();
billoflading.init();