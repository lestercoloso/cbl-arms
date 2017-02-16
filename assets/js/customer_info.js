

var searchdata = "";

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
		
		$('#add_customer_info').click(function(){
			customer.createcustomer();
		});		

		$('#clearecreate').click(function(){
			customer.clear();
		});		
		
		$('#savecreate').click(function(){
			if(!$(this).hasClass('disabled')){
				customer.save();	
			}
		});		
		
		$('.selector').click(function(){
			customer.selector(this);
		});		

		customer.getcustomerlist();

	},
	selector: function(d){
		$('.selector').attr('class','selector select_inactive');
		$(d).attr('class','selector select_active');
		$('#additional_table table').hide();
		$('#'+d.id+'ed').show();
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
			$('#savecreate').addClass('disabled');
			$('#savecreate i').removeClass('hide');
			$.post("backstage/customer/save/", { d:arr['data'] },function(data){
				if(data.status==200){
					toastr["success"]('Successfully added.');
					$('#create_modal').modal('hide');
					$('#savecreate').removeClass('disabled');
					$('#savecreate i').addClass('hide');
					customer.getcustomerlist();
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
		customer.form('create_shippment');
		customer.getcustomer();
		$('#create_customer_date').val(datetoday);
		$('#savecreate').removeClass('disabled');
		$('#savecreate i').addClass('hide');


	},
	form: function(classused){
		$('.'+classused+' div').removeClass('has-error');	
		$('.'+classused).removeClass('has-error');	
		$('.'+classused+' input, .'+classused+' select').val('');
	},
	getcustomer: function(){
		$.post("backstage/customer/getcustomercode/", {},function(data){
			$('#create_customer_code').val(data);
		});
	},
	getcustomerlist: function(page=1){
	
		$.post("backstage/customer/customerlist/"+page, {searchdata: searchdata},function(data){
			var content = '';
			// console.log(data);
			$.each(data.data, function( index, value ) {

				var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
				
				content +='<tr id="customer-'+value.id+'">';
				content +='<td class="centered">'+value.customer_code+'</td>';
				content +='<td class="centered">'+value.customer_name+'</td>';
				content +='<td>'+value.industry_type+'</td>';
				content +='<td>'+value.area_1+'</td>';
				content +='<td>'+value.region+'</td>';
				content +='<td>'+value.payment_terms+'</td>';
				content +='<td>'+value.aging+'</td>';
				content +='<td>'+value.credit_limit+'</td>';
				content +='<td>'+value.outstanding_balance+'</td>';
				content +='<td>'+value.amount_due+'</td>';
				content +='<th>'+action+'</th>';
				content +='</tr>';
			});

			$('#pagination-container').html(data.pagination);
			$('#search_result_list tbody').html(content);
			$('.pagenumber').click(function(){
				customer.getcustomerlist($(this).data('page'));
			});
			
			// $('#inbound-list .btn-success').click(function(){
			// 	shipment.edit($(this).parent().parent().attr('id'));
			// });

			// $('#inbound-list .btn-danger').click(function(){
			// 	shipment.delete($(this).parent().parent().attr('id'));
			// });


		}).fail(function(){
			toastr["error"]("Failed to load the inbound list.");
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