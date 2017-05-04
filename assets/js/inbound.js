var inventory = [];    
var pageno = 1;  
var updateit = '';
            $(function () {
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
            });


if(user_type!=10){
	$('.add_inventory').hide();
}


function addShipment(){
	$('#add_shipment').modal();
	shipment.cleardata();
}

var searchdata = "";

function getInbound(page=1){

pageno = page;
$.post("backstage/inbound/getinboundlist/"+page, {searchdata: searchdata},function(data){
	var content = '';
	// console.log(data);
	$.each(data.data, function( index, value ) {

		var action = '';
		//cbl view
		if(user_type==10){
		

			if(value.status!=5){
				action += '<button type="button" class="btn btn-success"><i class="fa fa-pencil"></i><span class="hidden-xs"> </span> </button>';
			}

			if(value.status==1){
				action += ' <button type="button" class="btn btn-info"><i class="fa fa-envelope-o"></i><span class="hidden-xs"> </span> </button>';				
			}
			
			action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i><span class="hidden-xs"> </span> </button>';
		}else{
			// action += '<button type="button" class="btn btn-success"><i class="fa fa-list-alt"></i><span class="hidden-xs"> </span> </button>';
		
			if(value.status==2){
				action += ' <button type="button" class="btn btn-info acknowledge btn-txt"> <span class="hidden-xs"> Acknowledge </span> </button>';				
			}

			if(value.status==3){
				action += ' <button type="button" class="btn btn-info receive btn-txt"> <span class="hidden-xs"> Receive </span> </button>';				
			}

			// action += ' <button type="button" class="btn btn-info"><i class="fa fa-upload"></i><span class="hidden-xs"> </span> </button>';			
		}
		if(value.status!=5){
			action += ' <button type="button" class="btn btn-danger btn-txt cancel"><span class="hidden-xs"> Cancel </span> </button>';			
		}
		// var action = '<button type="button" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		// action += ' <button type="button" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		// action += ' <button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>';
		
		content +='<tr id="inbound-'+value.id+'" data-id="'+value.id+'" data-qty="'+value.quantity+'">';
		
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
	$('#inbound-list tbody').html(content);
	$('.pagenumber').click(function(){
		getInbound($(this).data('page'));
	});
	
	$('#inbound-list .btn-success .fa-pencil').parent().click(function(){
		shipment.edit($(this).parent().parent().attr('id'));
	});

	$('#inbound-list .fa-envelope-o').parent().click(function(){
		shipment.changestatus($(this).parent().parent().data('id'), '2');
	});

	$('#inbound-list .acknowledge').click(function(){
		shipment.changestatus($(this).parent().parent().data('id'), '3');
	});

	$('#inbound-list .receive').click(function(){
		// shipment.changestatus($(this).parent().parent().data('id'), '4');
		shipment.edit($(this).parent().parent().attr('id'), 'receive');
	});

	$('#inbound-list .cancel').click(function(){
		shipment.changestatus($(this).parent().parent().data('id'), '5');
	});

	$('#inbound-list .btn-danger .fa-times-circle').parent().click(function(){
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
		getInbound();
    }
}

var shipment = {
    init: function() {
		$('#addnewshipment').click( function(){
			shipment.addInventory();
		});


		$('#savenewshipment').click( function(){
			if(!$(this).hasClass('disabled')){
				shipment.create();	
			}
		});

		$('#updateshipment').click( function(){
			if(!$(this).hasClass('disabled')){
				shipment.update();	
			}
		});

		$('#clearnewshipment').click( function(){
			shipment.cleardata();
		});

		$('#pulloutbutton').click( function(){
			if(!$(this).hasClass('disabled')){
				shipment.pullout_submit($(this).attr('pulloutid'));
			}
		});

		$('#addshipment_storage').change( function(){
			shipment.changestorage();
		});

		$('#addnew_billoflading').change( function(){
			shipment.customer_name();
		});

		$('#pullout_select').change( function(){
			var v = $(this).val();
			if(v!=''){
				$('#pulloutbutton').show();	
				$('#pulloutbutton span').html(v);	
			}else{
				$('#pulloutbutton').hide();	
			}
			
		});

		$('.addshipment_bay').hide();

		//inventory
		$('#inventory_modal tfoot .btn-success').click(function(){
			shipment.inventoryAdd();
		});		
		$('#inventory_modal tfoot .btn-danger').click(function(){
			$(this).parent().parent().find('input').val('');
			$(this).parent().parent().find('select').val('');
			$('[col="stock_no"]').trigger("chosen:updated");
		});

		$('#receiveinventory').click( function(){
			shipment.receive();
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
		$('#viewinventory').click( function(){
			shipment.viewInventory();
		});
		$('#backinventory').click( function(){
			shipment.backInventory();
		});
		$('#clearinventory').click( function(){
			if(confirm('Are you sure you want to proceed? \nThis will clear all the data.')){
				shipment.clearInventory();
			}
		});


		$('input[col="qty"]').bind('keyup keydown', function(){
			var cbm = $('select[col="material_desc"] :selected').attr('cbm');
			$('input[col="cbm"]').val(($(this).val()*cbm)+'m³');
		});		

		$('#checkall').change(function () {
		    var checked = (this.checked) ? true : false;
		    $('#inbound-list tbody input[type="checkbox"]').prop('checked', checked);
		});

		$('#masspost').click(function(){
			shipment.masschangestatus(2);
		});

    },
    masschangestatus: function(status){
    	var checked = 0;
    	var ids = [];
		$('#inbound-list tbody input[type="checkbox"]').each(function(){
			if($(this).is(':checked')){
		    	ids.push($(this).val());
		    	checked = 1;
			}
		});
		if(checked==0){
			toastr["error"]('Please select at least One.');
		}else{
			$.post("backstage/inbound/masschangestatus/"+status, {ids:ids},function(data){
				getInbound(pageno);
			}).fail(function(){
				toastr["error"]('Network error!<br> Please try again.');
			}); 	
		}
    },
    changestatus: function(id, status=''){
	
		$.post("backstage/inbound/changestatus/"+id+"/"+status, {},function(data){
			getInbound(pageno);
		}).fail(function(){
			toastr["error"]('Network error!<br> Please try again.');
		}); 

    },
    pullout: function(id, qty){
    	$('#pullout_shipment').modal();
    	$('#pulloutbutton').hide();
    	$('#pulloutbutton').attr('pulloutid', id);
    	$('#pullout_shipment input, #pullout_shipment select').val('');    
    	$('#pullout_quantity').attr('maxlength',qty);    
    },

    pullout_submit: function(id){
    	var arr = createPostData('pull_shipment');
    	if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{ 

       		$('#pulloutbutton').addClass('disabled');
    		$('#pulloutbutton i').removeClass('hide');
			$.post("backstage/inbound/pullout/"+id, {d:arr['data']},function(data){
				if(data.status==200){
					toastr["success"]('Successfully saved.');
					$('#pullout_shipment').modal('hide');
					$('#pulloutbutton').removeClass('disabled');
					$('#pulloutbutton i').addClass('hide');
					getInbound();
				}else{
					toastr["error"]('Error.');
					$('#pulloutbutton').removeClass('disabled');
					$('#pulloutbutton i').addClass('hide');
				}
			}).fail(function(){
				toastr["error"]('Network error!<br> Please try again.');
				$('#pulloutbutton').removeClass('disabled');
				$('#pulloutbutton i').addClass('hide');
			}); 		

    	}
    }, 

    edit: function(id, type='edit'){

	$.post("backstage/inbound/edit/"+id, {},function(data){
		$.each(data, function( index, value ) {
			$('#inventory_modal [col="'+index+'"]').val(value);
		});
		
		updateid = data.id;
		inventory = data.inventory;
		$('#inventory_modal').modal();
		shipment.constructInventory();

		$('#clearinventory').hide();
		$('#postinventory').hide();
		$('#receiveinventory').hide();
		$('#saveinventory').hide();
		$('#updateinventory').show();

		if(type=='receive'){
			$('#updateinventory').hide();
			$('#receiveinventory').show();			
		}


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
    		$.post("backstage/inbound/update/"+updateid, {d:inv['data'], inventory:inventory},function(data){
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
    cleanerrors: function(){
    		$('#inventory-list tbody tr td input, #inventory-list tbody tr td select').removeClass('has-error');
    },
    receive: function(){
		
		var inv = createPostData('inv_form');
		var error = '';
		var listinv = [];
		shipment.cleanerrors();
		$('#inventory-list tbody tr').each(function(){
			var list = createPostData2($(this).attr('class'));
			listinv.push(list['data']);
			if(list['error']!=""){
				error = list['error'];
			}
		});

		if(inventory.length==0){
			toastr["error"]('Complete the fields');
			$('.inventory_table_container').addClass('has-error-container');
		}else if(inv['error']!="" || error!=''){
			$('.inventory_table_container').removeClass('has-error-container');
			toastr["error"]('Complete the fields');
		}else{

			$('#receiveinventory').addClass('disabled');
			$('#receiveinventory i').removeClass('hide');
    		$.post("backstage/inbound/receive/"+updateid, {d:inv['data'], inventory:listinv},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully Updated.');
						$('#inventory_modal').modal('hide');
						$('#receiveinventory').removeClass('disabled');
						$('#receiveinventory i').addClass('hide');
						getInbound();
				}else{
					toastr["error"]('Network error!<br> Please try again.');	
				}
    		}).fail(function(){
				toastr["error"]('Error.');
				$('#receiveinventory').removeClass('disabled');
				$('#receiveinventory i').addClass('hide');
			});
    	}
    },

    create: function(){

    	var arr = createPostData('addship');
    	var irr = createPostData('inv_form');
		$('#clearnewshipment').show();
    	if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
    		var arr = JSON.stringify(arr['data']);
    		var irr = JSON.stringify(irr['data']);
    		$('#savenewshipment').addClass('disabled');
    		$('#savenewshipment i').removeClass('hide');
			$.post("backstage/inbound/save/", {d:arr, i: irr, inv: inventory},function(data){
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
		$('#pallet_code_shipment').val('');
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
		// shipment.getpalletcode();
	},

    getNewBillOfLading: function(){
		var d = $('#addnew_billoflading');
		if(d.html().trim()==''){
			$.post("backstage/inbound/billoflading", {},function(data){
				var content = "<option></option>";
				$.each(data.data, function( index, value ) {
					content +='<option value="'+value.lading_number+'" data-qty="'+value.quantity+'" data-customer_name="'+value.customer_name+'"">'+value.lading_number+'</option>';
				});

				d.html(content);
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 300);
			});
		}

	},
	viewInventory: function(){
		$('#inventory_modal').modal();
		$('#add_shipment').modal('hide');
		$('#updateinventory').show();
		$('#backinventory').show();
		$('#clearinventory').hide();
		$('#saveinventory').hide();
		shipment.constructInventory();
	},
	backInventory: function(){
		$('#add_shipment').modal();
		$('#inventory_modal').modal('hide');
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
	addInventory: function(){
		shipment.clearInventory();
		// shipment.getitemmasterfile();
		$('#inventory_modal').modal();
		$('#updateinventory').hide();
		$('#receiveinventory').hide();
		$('#backinventory').hide();
		$('#clearinventory').show();
		$('#postinventory').show();
		$('#saveinventory').show();
		$('#receiveinventory').hide();
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
			content +='<tr data-key="'+index+'" class="inbound'+index+'">';
				content +='<td>'+value.stock_no+'</td>';
				content +='<td>'+value.description+'</td>';
				content +='<td class="numeric">'+value.pieces+'</td>';
				content +='<td class="numeric">'+value.box+'</td>';
				content +='<td class="numeric">'+value.carton+'</td>';
				content +='<td class="numeric">'+value.cbm+'</td>';
				content +='<td class="numeric">'+value.total_cbm+'</td>';
				content +='<td>'+value.batch_code+'</td>';
				content +='<td>'+value.exp_date+'</td>';

				if(user_type==10){
					content +='<td>'+action+'</td>';
				}else{

					if(value.wh_status!=null){
						var wh_status = value.wh_status;
					}else{
						var wh_status = 'can accommodate';
					}

					if(value.pallet_position_code!=null){
						var pallet_position_code = value.pallet_position_code;
					}else{
						var pallet_position_code = '';
					}

					content +='<td class="hide"><input type="text" col="updateid" value="'+value.id+'"></td>';
					content +='<td class="contenteditable"><input type="text" col="wh_status" value="'+wh_status+'"></td>';
					content +='<td class="contenteditable">'+CreateSelectOption(value.wh_storage,wh_location, 'wh_storage')+'</td>';
					content +='<td class="contenteditable">'+CreateSelectOption(value.storage_type,storage_type, 'storage_type')+'</td>';
					content +='<td class="contenteditable"><input type="text" col="pallet_position_code" value="'+pallet_position_code+'"></td>';
				}


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
    		$.post("backstage/inbound/save/"+posted, {d:inv['data'], inventory:inventory},function(data){
    			if(data.status==200){
						toastr["success"]('Successfully added.');
						$('#inventory_modal').modal('hide');
						$('#saveinventory').removeClass('disabled');
						$('#saveinventory i').addClass('hide');
						getInbound();
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
			shipment.rack_level(rack_level);
		});

		shipment.cleardata();

	},
	rack_level: function(rack_level){
		var content = '<option>Please Select</option>';
		for (i = 1; i <= rack_level; i++) { content +='<option value="'+i+'">'+i+'</option>';}
		$('#rack_level').html(content);
	},

	getstoragecode: function(t, c=''){
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
				d.val(c);
				
				d.chosen('destroy');
				setTimeout(function(){ 
					d.chosen({search_contains: true});
				}, 300);
			});
		}
	},
	getpalletcode: function(){
			$.post("backstage/inbound/getpallet/", {},function(data){
					$('#pallet_code_shipment').val(data);
			});
	},
	getrefno: function(t){
			$.post("backstage/inbound/getrefno/", {},function(data){
					$('#inventory_inbound_no').val('IB'+data);
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

	customer_name: function(){
		var customer = $('#addnew_billoflading :selected');
		$('#shipment_customer_name').val(customer.data('customer_name'));
		$('#quantity_shipment').val(customer.data('qty'));
	}


}
shipment.init();
search.init();
shipment.getitemmasterfile();
