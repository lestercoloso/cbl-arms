            
$( "#tabs" ).tabs({ active: 1 });
            $(function () {
               $('#exdate_group, #endate_group, #pudate_group, .create-date').datetimepicker({
                 format: 'MM/DD/YYYY'
           		});

                $('#s-type, #si-type').chosen({
                	no_results_text: "Oops, nothing found!"
                });
            });



function addShipment(){
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


$.post("backstage/warehouse/getInbound/", {},function(data){
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


$('#addnewshipment').click( function(){
	addShipment();
});


// $( "#add_shipment" ).dialog({autoOpen: false});	
getInbound();