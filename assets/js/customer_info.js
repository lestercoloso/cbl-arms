


var search = {
	init: function(){
		//clear select button
		$('#clearsearch').click(function(){
			$('.searchdata input, .searchdata select').val('');
		});

	}


}

var customer = {

	init: function(){

		$('#create_company_anniversary_container .create-date').datetimepicker({
			format: 'MM/DD/YYYY',
			useCurrent: false
		});
		//add new bill of lading modal
		$('#add_customer_info').click(function(){
			customer.createcustomer();
		});		

		//clear new bill of lading 
		$('#clearecreate').click(function(){
			customer.clear();
		});		
		//save new bill of lading 
		$('#savecreate').click(function(){
			customer.save();
		});		

	},

	createcustomer: function(){
		$('#create_modal').modal();
		customer.clear();
	},

	save: function(){
		var arr = createPostData('create_customer');

		if(arr['error']){
    		toastr["error"](arr['error']);

    	}else{

			$.post("backstage/customer/save/", { d:arr['data'] },function(data){
				
			});

    	}

	},
	clear: function(){
		customer.form('create_shippment');
		customer.getcustomer();
		$('#create_customer_date').val(datetoday);

	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	},
	getcustomer: function(){
		$.post("backstage/customer/getcustomerno/", {},function(data){
			$('#create_customer_no').val(data);
		});
	}





}


search.init();
customer.init();



// [customer_code] => 
//    [customer_type] => 
//    [customer_name] => 
//    [company_anniversary] => 
//    [tel_no] => 
//    [fax_no] => 
//    [industry_type] => 
//    [address] => 
//    [tin_no] => 
//    [city] => 
//    [assistant_executive_1] => 
//    [assistant_executive_2] => 
//    [area_1] => 
//    [area_2] => 
//    [area_3] => 
//    [area_4] => 
//    [area_5] => 
//    [region] => 
//    [tax_type] => 
//    [payment_terms] => 
//    [preferred_supplier] => 
//    [pricelist_ds] => 
//    [pricelist_da] => 
//    [pricelist_dt] => 
//    [pricelist_is] => 
//    [pricelist_ia] => 
//    [pricelist_it] => 
//    [follow_up_day] => 
//    [collection_day] => 
//    [billing_cycle] => 
//    [credit_limit] => 
//    [billing_format] => 