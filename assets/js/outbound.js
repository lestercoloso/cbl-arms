var searchdata = "";



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
		getOutbound();
    }
}

var shipment = {
    init: function() {

       $('#exdate_group, #endate_group, #pudate_group, .create-date').datetimepicker({
         format: 'MM/DD/YYYY',
         useCurrent: false
   		});

        $('#s-type, #si-type').chosen({
        	no_results_text: "Oops, nothing found!"
        });  
          	
    	shipment.getOutbound();
    },

    getOutbound: function(page=1){

			$.post("backstage/outbound/getOutbound/"+page, {searchdata: searchdata},function(data){
				var content = '';
				// console.log(data);
				$.each(data.data, function( index, value ) {

					var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
					// action += ' <button type="button" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
					// action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
					
					content +='<tr id="inbound-'+value.id+'" data-id="'+value.id+'" data-qty="'+value.quantity+'">';
					content +='<td class="centered">'+value.bill_of_lading+'</td>';
					content +='<td>'+value.customer_name+'</td>';
					content +='<td>'+value.delivery_receipt+'</td>';
					content +='<td>'+value.invoice_no+'</td>';
					content +='<td>'+value.pallet_code+'</td>';
					content +='<td>'+value.quantity+'</td>';
					content +='<td>'+value.location+'</td>';
					content +='<td>'+value.ex_date+'</td>';
					content +='<td>'+value.pu_date+'</td>';
					content +='<td>'+value.type_of_shipment+'</td>';
					content +='<th>'+action+'</th>';
					content +='</tr>';
				});

				$('#pagination-container').html(data.pagination);
				$('#inbound-list tbody').html(content);
				$('.pagenumber').click(function(){
					shipment.getOutbound($(this).data('page'));
				});
				
				$('#inbound-list .btn-success').click(function(){
					shipment.edit($(this).parent().parent().attr('id'));
				});

				$('#inbound-list .btn-danger').click(function(){
					shipment.delete($(this).parent().parent().attr('id'));
				});

				$('#inbound-list .btn-info').click(function(){
					var o = $(this).parent().parent()
					shipment.pullout(o.data('id'), o.data('qty'));
				});


			}).fail(function(){
				toastr["error"]("Failed to load the inbound list.");
			});

		}

}

shipment.init();
search.init();