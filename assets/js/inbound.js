            
            $(function () {
               $('#exdate_group, #endate_group, #pudate_group, .create-date').datetimepicker({
                 format: 'MM/DD/YYYY',
                 useCurrent: false
           		});

                $('#s-type, #si-type').chosen({
                	no_results_text: "Oops, nothing found!"
                });
            });



function addShipment(){
	$('#add_shipment').modal();
	// $( "#add_shipment" ).dialog('destroy');
	// $( "#add_shipment" ).dialog({
	//       autoOpen: true,
	//       width: 1100,
	//       modal: true,
	//  	  resizable: false,
	//  	  movable: false,
	//  	  draggable: false, 
	//  	  buttons: {
	// 		        Save: function() {
	// 		          saveStorage(this);
	// 		        },			        
	// 		        Clear: function() {
	// 		          cleardata();
	// 		        },
	// 		        Cancel: function() {
	// 		          $( this ).dialog( "close" );
	// 		        }
 //      	  }
	// });	
}

var searchdata = "";

function getInbound(page=1){


$.post("backstage/inbound/getInbound/"+page, {searchdata: searchdata},function(data){
	var content = '';
	// console.log(data);
	$.each(data.data, function( index, value ) {

		var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		action += ' <button type="button" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		
		content +='<tr id="inbound-'+value.id+'">';
		content +='<td class="centered">'+value.bill_of_lading+'</td>';
		content +='<td>'+value.customer_name+'</td>';
		content +='<td>'+value.delivery_receipt+'</td>';
		content +='<td>'+value.pallet_code+'</td>';
		content +='<td>'+value.quantity+'</td>';
		content +='<td>'+value.storage_type+'</td>';
		content +='<td>'+value.inventory_type+'</td>';
		content +='<th>'+action+'</th>';
		content +='</tr>';
	});

	$('#pagination-container').html(data.pagination);
	$('#inbound-list tbody').html(content);
	$('.pagenumber').click(function(){
		getInbound($(this).data('page'));
	});
	
	$('#inbound-list .btn-success').click(function(){
		shipment.edit($(this).parent().parent().attr('id'));
	});

	$('#inbound-list .btn-danger').click(function(){
		shipment.delete($(this).parent().parent().attr('id'));
	});


}).fail(function(){
	toastr["error"]("Failed to load the inbound list.");
});

}



function getCustomers(){
	var bill_of_lading = "";
	$.post("backstage/inbound/billoflading/", {},function(data){
		$('#addnew_billoflading').val(data);
	});
}





// $( "#add_shipment" ).dialog({autoOpen: false});	
getInbound();


//search function 
var search = {
    init: function() {
		$('#clearInbound').click( function(){
			search.cleardata();
			search.execute();
		});

		$('#searchInbound').click( function(){
			search.execute();
		});
    },
    cleardata: function(){
    	$('.search-filter input, .search-filter select').val('');
		$('#s-type, #si-type').chosen('destroy');
		$('#s-type, #si-type').chosen({no_results_text: "Oops, nothing found!"});
    },
    execute: function(){
		var arr = createPostData('searchdata');
		searchdata = JSON.stringify(arr['data']);
		console.log(searchdata);
		getInbound();
    }
}

var shipment = {
    init: function() {
		$('#addnewshipment').click( function(){
			shipment.addShipment();
			shipment.cleardata();
		});

		$('#savenewshipment').click( function(){
			if(!$(this).hasClass('disabled')){
				shipment.create();	
			}
		});

		$('#clearnewshipment').click( function(){
			shipment.cleardata();
		});

		$('#addshipment_storage').change( function(){
			shipment.changestorage();
		});

		$('#addnew_billoflading').change( function(){
			shipment.customer_name();
		});

		$('.addshipment_bay').hide();

    },
    edit: function(id){

	$.post("backstage/inbound/edit/"+id, {},function(data){
		// $('#addnew_billoflading').val(data);
		// console.log(data);
		$('#savenewshipment').hide();
		$('#updateshipment').show();
		$('#add_shipment').modal();
		$('#add_shipment .modal-title').html('Edit Shipment');

	}).fail(function(){
	    toastr["error"]('Error occured!<br>Please try again.');		
	});

    },

    delete: function(id){

		if(confirm("Are you sure you want to delete this shipment?")){

			$.post("backstage/inbound/delete/"+id, {},function(data){
				if(data.status==200){
				toastr["success"]('Successfully deleted.');
				getInbound();
				}else{
			    toastr["error"]('Unable to delete!<br>Please try again.');						
				}
			}).fail(function(){
			    toastr["error"]('Error occured!<br>Please try again.');		
			});

		}
    },

    update: function(){

    },

    create: function(){

    	var arr = createPostData('addship');

    	if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
    		var arr = JSON.stringify(arr['data']);
    		$('#savenewshipment').addClass('disabled');
    		$('#savenewshipment i').removeClass('hide');
			$.post("backstage/inbound/save/", {d:arr},function(data){
				if(data.status==200){
					toastr["success"]('Successfully added.');
					$('#add_shipment').modal('hide');
					$('#savenewshipment').removeClass('disabled');
					$('#savenewshipment i').addClass('hide');
					getInbound();
				}
			}).fail(function(){
				toastr["error"]('Network error!<br> Please try again.');
				$('#savenewshipment').removeClass('disabled');
				$('#savenewshipment i').addClass('hide');
			});
    	}

    },
    cleardata: function(){
    	$('#add_shipment select').val('');
    	$('#add_shipment input').val('');
    	$('#addshipment_storage').val('rack');
    	shipment.changestorage();
    	$('#addnew_billoflading').chosen('destroy');
		$('#addnew_billoflading').html('');
		shipment.getNewBillOfLading();
    	$('#rack_code').chosen('destroy');
		$('#rack_code').html('');
		shipment.getstoragecode('rack');
		$('#bay_code').chosen('destroy');
		$('#bay_code').html('');
		$('#rack_level').html('');
		$('#pallet_code_shipment').val('This is autogenerated');
		$('#add_shipment div').removeClass('has-error');	

    }, 
	changestorage(){
		var d = $('#addshipment_storage').val();
		$('.addshipment_rack').hide();
		$('.addshipment_bay').hide();
		$('.addshipment_rack').removeClass('addship');
		$('.addshipment_bay').removeClass('addship');
		$('.addshipment_'+d).show();
		$('.addshipment_'+d).addClass('addship');
		shipment.getstoragecode(d);
		shipment.getNewBillOfLading();
		$('#savenewshipment').removeClass('disabled');
		$('#savenewshipment i').addClass('hide');
	},

    getNewBillOfLading: function(){
		var d = $('#addnew_billoflading');
		if(d.html().trim()==''){
			$.post("backstage/inbound/billoflading", {},function(data){
				var content = "<option></option>";
				$.each(data.data, function( index, value ) {
					content +='<option value="'+value.lading_number+'" data-customer_name="'+value.customer_name+'"">'+value.lading_number+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 300);
			});
		}

	},
	addShipment: function(){
		
		$('#add_shipment').modal();
		$('#add_shipment .modal-title').html('Add Shipment');

		$('#savenewshipment').show();
		$('#updateshipment').hide();
		
		if($('#addnew_billoflading').val()==''){
			shipment.getNewBillOfLading();	
		}	
		shipment.getstoragecode('rack');	
		
		$('#rack_code').change(function(){
			var rack_level = $('#'+this.id+' :selected').data('racklevel');
			var content = '<option>Please Select</option>';
			for (i = 1; i <= rack_level; i++) { content +='<option value="'+i+'">'+i+'</option>';}
			$('#rack_level').html(content);
		});

	},
	getstoragecode: function(t){
		var d = $('#'+t+'_code');
		if(d.html().trim()==''){
			$.post("backstage/inbound/getcode/"+t, {},function(data){
				var content = "<option></option>";
				$.each(data.data, function( index, value ) {
					if(t=='rack'){
						var add = 'data-racklevel="'+value.no_rack_level+'"';	
					}
					content +='<option value="'+value.code+'" '+add+'>'+value.code+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 300);
			});
		}
	}
,
	customer_name: function(){
		// var d = $('#shipment_customer_name');
		// if(d.html().trim()==''){
		// 	$.post("backstage/inbound/customer", {},function(data){
		// 		var content = "<option></option>";
		// 		$.each(data.data, function( index, value ) {
		// 			content +='<option value="'+value.id+'">'+value.customer_name+'</option>';
		// 		});

		// 		d.html(content);
		// 		d.chosen('destroy');
		// 		setTimeout(function(){ 
		// 			d.chosen({search_contains: true});
		// 		}, 300);
		// 	});
		// }
		var customer = $('#addnew_billoflading :selected').data('customer_name');
		$('#shipment_customer_name').val(customer);
	}



}

shipment.init();
search.init();