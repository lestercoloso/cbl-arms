var searchdata = "";
var inventory = [];       
var updateid = '';
var pageno = 1;


//search function 
var search = {
    init: function() {
		$('#clearInbound').click( function(){
			search.cleardata();
			// search.execute();
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
		shipment.getOutbound();
    }
}

var shipment = {
    init: function() {

       $('#exdate_group, #endate_group, #pudate_group, .create-date').datetimepicker({
         format: 'MM/DD/YYYY',
         useCurrent: false
   		});

       $('#inventory_modal input[col="exp_date"]').datetimepicker({
         format: 'MM/DD/YYYY',
         useCurrent: false
   		});

		$('#inventory_estimated_arrival').datetimepicker({
			format: 'MM/DD/YYYY LT',
			useCurrent: false
        });

        $('#s-type, #si-type').chosen({
        	no_results_text: "Oops, nothing found!"
        });

		$('#addnewshipment').click( function(){
			shipment.addInventory();
		});

		$('#updateinventory').click( function(){
			shipment.update();
		});		

		$('#saveinventory').click( function(){
			shipment.saveInventory();
		});
		$('#postinventory').click( function(){
			shipment.saveInventory(2);
		});

		$('#checkall').change(function () {
		    var checked = (this.checked) ? true : false;
		    $('#outbound-list tbody input[type="checkbox"]').prop('checked', checked);
		});

		//inventory
		$('#inventory_modal tfoot .btn-success').click(function(){
			shipment.inventoryAdd();
		});		
		$('#inventory_modal tfoot .btn-danger').click(function(){
			$(this).parent().parent().find('input').val('');
			$(this).parent().parent().find('select').val('');
			$('[col="stock_no"]').trigger("chosen:updated");			
		});

		$('#masspost').click(function(){
			shipment.masschangestatus(2);
		});		
          	
    	shipment.getOutbound();
    },

     masschangestatus: function(status){
    	var checked = 0;
    	var ids = [];
		$('#outbound-list tbody input[type="checkbox"]').each(function(){
			if($(this).is(':checked')){
		    	ids.push($(this).val());
		    	checked = 1;
			}
		});
		if(checked==0){
			toastr["error"]('Please select at least One.');
		}else{
			$.post("backstage/outbound/masschangestatus/"+status, {ids:ids},function(data){
				shipment.getOutbound(pageno);
			}).fail(function(){
				toastr["error"]('Network error!<br> Please try again.');
			}); 	
		}
    },   

	saveInventory: function(posted=1){

		var inv = createPostData('inv_form');

		if(inventory.length==0){
			toastr["error"]('Complete the fields');
			$('.inventory_table_container').addClass('has-error-container');
		}else if(inv['error']!=""){
			$('.inventory_table_container').removeClass('has-error-container');
			toastr["error"](inv['error']);
		}else{

			$('#saveinventory').addClass('disabled');
			$('#saveinventory i').removeClass('hide');
    		$.post("backstage/outbound/save/"+posted, {d:inv['data'], inventory:inventory},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#inventory_modal').modal('hide');
						$('#saveinventory').removeClass('disabled');
						$('#saveinventory i').addClass('hide');
						shipment.getOutbound();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#saveinventory').removeClass('disabled');
				$('#saveinventory i').addClass('hide');
			});
    	}

	},
	addInventory: function(){
		shipment.clearInventory();
		// shipment.getitemmasterfile();
		$('#inventory_modal').modal();
		$('#updateinventory').hide();
		$('#backinventory').hide();
		$('#clearinventory').show();
		$('#saveinventory').show();
	}, 

  update: function(){
		
		var inv = createPostData('inv_form');

		if(inventory.length==0){
			toastr["error"]('Complete the fields');
			$('.inventory_table_container').addClass('has-error-container');
		}else if(inv['error']!=""){
			$('.inventory_table_container').removeClass('has-error-container');
			toastr["error"](inv['error']);
		}else{

			$('#updateinventory').addClass('disabled');
			$('#updateinventory i').removeClass('hide');
    		$.post("backstage/outbound/update/"+updateid, {d:inv['data'], inventory:inventory},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully Updated.');
						$('#inventory_modal').modal('hide');
						$('#updateinventory').removeClass('disabled');
						$('#updateinventory i').addClass('hide');
						getInbound();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#updateinventory').removeClass('disabled');
				$('#updateinventory i').addClass('hide');
			});
    	}
    },	  

	clearInventory: function(){
			$('.inv_form input[type="text"], .inv_form input[type="number"]').val('');
			// $('.inv_form input[type="checkbox"]').prop('checked', false);
			$('.inv_form .has-error').removeClass('has-error');
			$('.inventory_table_container').removeClass('has-error-container');
			$('#inventory-list input').val('');			
			inventory = [];
			shipment.constructInventory();
			shipment.getrefno();
			shipment.getitemmasterfile();
			$('#inventory_request_date').val(datetoday);
			$('#inventory_booked_by').val(userfullname);
			$('[col="stock_no"]').val('');
			$('[col="stock_no"]').trigger("chosen:updated");

	},

	getrefno: function(t){
			$.post("backstage/outbound/getrefno/", {},function(data){
					$('#inventory_outbound_no').val('OB'+data);
			});
	},	
	getitemmasterfile: function(t){
			$.post("backstage/inbound/getitemmasterfile/", {},function(data){
				var content = "<option></option>";
				$.each(data.data, function( index, value ) {
					content += "<option value='"+value.item_id+"' item_description=\""+value.item_description+"\" cbm=\""+value.cbm+"\" uom=\""+value.uom+"\" pieces=\""+value.pieces+"\" carton=\""+value.carton+"\" box=\""+value.box+"\">"+value.stock_no+"</option>";
				});
				$('select[col="stock_no"]').html(content);
				$('select[col="stock_no"]').change(function(){
					var cbm = $(this).find(':selected').attr('cbm'); 
					var uom = $(this).find(':selected').attr('uom'); 
					var box = $(this).find(':selected').attr('box'); 
					var carton = $(this).find(':selected').attr('carton'); 
					var pieces = $(this).find(':selected').attr('pieces'); 
					var item_description = $(this).find(':selected').attr('item_description'); 
					$('input[col="uom"]').val(uom);
					$('input[col="pieces"]').val(pieces);
					$('input[col="description"]').val(item_description);
					$('input[col="box"]').val(box);
					$('input[col="carton"]').val(carton);
					$('input[col="total_cbm"]').val(cbm*pieces);
					$('input[col="cbm"]').val(cbm+'m³');
				});

				$('select[col="stock_no"]').chosen({search_contains: true});
				
			});
	},	
constructInventory: function(){
		var content = '';

		// var action 	= '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button> ';
      	var action = '<button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
   		
   		// var irr = $('#inventory_irr_number').val();
   		// if(irr.trim()!=""){
   		// 	irr +="-";
   		// }

		$.each(inventory, function( index, value ) {
			content +='<tr data-key="'+index+'">';
				content +='<td>'+value.stock_no+'</td>';
				content +='<td>'+value.description+'</td>';
				content +='<td class="numeric">'+value.pieces+'</td>';
				content +='<td class="numeric">'+value.box+'</td>';
				content +='<td class="numeric">'+value.carton+'</td>';
				content +='<td class="numeric">'+value.cbm+'</td>';
				content +='<td class="numeric">'+value.total_cbm+'</td>';
				content +='<td>'+value.batch_code+'</td>';
				content +='<td>'+value.exp_date+'</td>';
				content +='<td>'+action+'</td>';
			content +='</tr>';
		});

		$('#inventory-list tbody').html(content);
		$('#inventory-list tbody tr td .btn-danger').click(function(){
			if(confirm("Are you sure you want to remove this?")){
				inventory.remove($(this).parent().parent().data('key'));
				shipment.constructInventory();
			}
		});
	},	

	inventoryAdd: function(){
		var inv = createPostData('add_inventory');
		inventory.push(inv['data']);
		$('#inventory_modal tfoot input, #inventory_modal tfoot select').val('');
		shipment.constructInventory();
		$("#inventory_modal input[col='exp_date']").datetimepicker('destroy');
       	$('#inventory_modal input[col="exp_date"]').datetimepicker({
         format: 'MM/DD/YYYY',
         useCurrent: false
   		});
		$('[col="stock_no"]').val('');
		$('[col="stock_no"]').trigger("chosen:updated");
		$('input[col="stock_no"]').focus();
	},

	  edit: function(id){

		$.post("backstage/outbound/edit/"+id, {},function(data){
			$.each(data, function( index, value ) {
				$('#inventory_modal [col="'+index+'"]').val(value);
			});
			
			updateid = data.id;
			inventory = data.inventory;
			$('#inventory_modal').modal();
			shipment.constructInventory();

			$('#clearinventory').hide();
			$('#saveinventory').hide();
			$('#updateinventory').show();

		}).fail(function(){
		    toastr["error"]('Error occured!<br>Please try again.');		
		});

	    },	


    delete: function(id){

		if(confirm("Are you sure you want to delete this shipment?")){

			$.post("backstage/outbound/delete/"+id, {},function(data){
				if(data.status==200){
				toastr["success"]('Successfully deleted.');
				shipment.getOutbound();
				}else{
			    toastr["error"]('Unable to delete!<br>Please try again.');						
				}
			}).fail(function(){
			    toastr["error"]('Error occured!<br>Please try again.');		
			});

		}
    },	

     changestatus: function(id, status=''){
	
		$.post("backstage/outbound/changestatus/"+id+"/"+status, {},function(data){
			shipment.getOutbound();
		}).fail(function(){
			toastr["error"]('Network error!<br> Please try again.');
		}); 

    },       

    getOutbound: function(page=1){
    	pageno = page;
			$.post("backstage/outbound/getoutboundlist/"+page, {searchdata: searchdata},function(data){
				var content = '';
				// console.log(data);
				$.each(data.data, function( index, value ) {

					var action = '';
					//cbl view
					if(user_type==10){
						action += '<button type="button" class="btn btn-success"><i class="fa fa-pencil"></i><span class="hidden-xs"> </span> </button>';
						
						if(value.status==1){
							action += ' <button type="button" class="btn btn-info"><i class="fa fa-envelope-o"></i><span class="hidden-xs"> </span> </button>';				
						}
						
						action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i><span class="hidden-xs"> </span> </button>';
					}else{
						action += '<button type="button" class="btn btn-success"><i class="fa fa-list-alt"></i><span class="hidden-xs"> </span> </button>';
						action += ' <button type="button" class="btn btn-info"><i class="fa fa-upload"></i><span class="hidden-xs"> </span> </button>';			
					}
						
					// var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
					// action += ' <button type="button" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
					// action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
					
					content +='<tr id="outbound-'+value.id+'" data-id="'+value.id+'" data-qty="'+value.quantity+'">';
					
					if(user_type==10){
						content +='<td class="centered"><input type="checkbox" value="'+value.id+'"></td>';	
					}
					
					content +='<td class="centered">'+value.inbound_no+'</td>';
					content +='<td>'+value.booked_by+'</td>';
					content +='<td>'+value.eta+'</td>';
					content +='<td>'+value.request_date+'</td>';
					content +='<td>'+SelectOption(value.status,inbound_status)+'</td>';
					content +='<th>'+action+'</th>';
					content +='</tr>';
				});

				$('#pagination-container').html(data.pagination);
				$('#outbound-list tbody').html(content);
				$('.pagenumber').click(function(){
					shipment.getOutbound($(this).data('page'));
				});
				
				$('#outbound-list .btn-success .fa-pencil').parent().click(function(){
					shipment.edit($(this).parent().parent().attr('id'));
				});

				$('#outbound-list .fa-envelope-o').parent().click(function(){
					shipment.changestatus($(this).parent().parent().data('id'), '2');
				});

				$('#outbound-list .btn-danger').click(function(){
					shipment.delete($(this).parent().parent().data('id'));
				});

				// $('#inbound-list .btn-info').click(function(){
				// 	var o = $(this).parent().parent()
				// 	shipment.pullout(o.data('id'), o.data('qty'));
				// });


			}).fail(function(){
				toastr["error"]("Failed to load the inbound list.");
			});



		}

}

shipment.init();
search.init();
shipment.getitemmasterfile();