            
$( "#tabs" ).tabs({ active: 1 });
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

function getInbound(){


$.post("backstage/inbound/getInbound/", {},function(data){
	var content = '';
	console.log(data);
	$.each(data.data, function( index, value ) {

		var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		action += ' <button type="button" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		
		content +='<tr>';
		content +='<td>'+value.bill_of_lading+'</td>';
		content +='<td>'+value.customer_name+'</td>';
		content +='<td>'+value.delivery_receipt+'</td>';
		content +='<td>'+value.pallet_code+'</td>';
		content +='<td>'+value.quantity+'</td>';
		content +='<td>'+value.storage_type+'</td>';
		content +='<td>'+value.inventory_type+'</td>';
		content +='<th>'+action+'</th>';
		content +='</tr>';
	});

	$('#inbound-list tbody').html(content);

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
		});
    },
    cleardata: function(){
    	$('.search-filter input, .search-filter select').val('');
		$('#s-type, #si-type').chosen('destroy');
		$('#s-type, #si-type').chosen({no_results_text: "Oops, nothing found!"});

    }


}

var createshipment = {
    init: function() {
		$('#addnewshipment').click( function(){
			createshipment.addShipment();
		});
		$('#addshipment_storage').change( function(){
			$('.addshipment_rack').hide();
			$('.addshipment_bay').hide();
			$('.addshipment_'+$(this).val()).show();
			createshipment.getstoragecode($(this).val());
		});

		$('.addshipment_bay').hide();



    },
    cleardata: function(){


    }, 
    getNewBillOfLading: function(){
		var bill_of_lading = "";
		$.post("backstage/inbound/billoflading/", {},function(data){
			$('#addnew_billoflading').val(data);
		});
	},
	addShipment: function(){
		$('#add_shipment').modal();
		
		if($('#addnew_billoflading').val()==''){
			createshipment.getNewBillOfLading();	
		}	
		createshipment.getstoragecode('rack');	
		
		$('#rack_code').change(function(){
			var rack_level = $('#'+this.id+' :selected').data('racklevel');
			var content = '';
			for (i = 1; i <= rack_level; i++) { content +='<option value="'+i+'">'+i+'</option>';}
			$('#rack_level').html(content);
		});

		createshipment.customer_name();

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
					d.chosen();
				}, 300);
			});
		}
	}
,
	customer_name: function(){
		var d = $('#shipment_customer_name');
		if(d.html().trim()==''){
			$.post("backstage/inbound/customer", {},function(data){
				var content = "<option></option>";
				$.each(data.data, function( index, value ) {
					content +='<option value="'+value.id+'">'+value.customer_name+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen();
				}, 300);
			});
		}
	}



}

createshipment.init();
search.init();