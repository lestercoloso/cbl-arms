//alil's js code
var selectModule =function (){
			$('#moduleChecker').val();
			var current_view = $('#moduleChecker').val();
			if (current_view=="Customer Info") {
				$('#csSet').css("display","block");
				$('#InboundSet').css("display","none");
				$('#BookSet').css("display","none");
			}else if(current_view=="Booking"){
				$('#csSet').css("display","none");
				$('#InboundSet').css("display","none");
				$('#BookSet').css("display","block");
			}else if(current_view=="Inbound Shipment"){
				$('#csSet').css("display","none");
				$('#InboundSet').css("display","block");
				$('#BookSet').css("display","none");
			}
		}
		var addItem = function(column,name,div,title){
				$('#'+div).append("<div id="+name+" style='display:none;' title='Add "+ title +"'></div>")
				$("#"+name).dialog({
				    modal: true,
				    autoOpen: false,
				    draggable: false,
				    resizable: false,
				    show: {
				    		effect:'blind'
				    },
				    hide: {
				    		effect:'blind'
				    },
				    width: 350,
				    height: 320,
				    buttons: {
				    	"Save":function(){

				    	},
				    	"Close":function(){

				    	}
				    }
				});

				$('#'+name).dialog('open');
		}


var maintenance = {
	init: function(){
		$('.add-maintenance').click(function(){
			maintenance.add($(this).parent().parent().attr('id'));
		});

		$('.edit-maintenance').click(function(){
			maintenance.edit($(this).parent().parent().attr('id'));
		});

		$('.delete-maintenance').click(function(){
			maintenance.delete($(this).parent().parent().attr('id'));
		});

		$('#save').click(function(){
			maintenance.save();
		});

		$('#update').click(function(){
			maintenance.update();
		});



	},

	add: function(id){
		var title = $('#'+id+' label').html();
		$('#add_maintenance').modal();
		$('#maintenance_description').val('');
		$('#hidden_particulars').val(id);
		$('#add_maintenance .modal-title').html('Add '+title);
		$('#update').hide();
		$('#save').show();

	},

	save: function(){
		var arr = createPostData('add_maintenance');
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$.post("backstage/maintenance/save/", { input:arr['data']},function(data){
				if(data.status==200){
					var part = $('#hidden_particulars').val();
					var val = $('#maintenance_description').val();
					var content = "<option value='"+data.id+"'>"+val+"</option>";
					toastr["success"]('Successfully added.');
					$('#select-'+part).append(content);
					$('#add_maintenance').modal('hide');
				}
			}).fail(function(){
					toastr["error"]('Network Error!<br>Please try again.');
			});
		}
	},

	edit: function(id){
		var obj = $('#select-'+id);
		var title = $('#'+id+' label').html();
		var val = obj.val();
		var txt = $('#select-'+id+' :selected').text();
		if(val==''){
			alert('Please Select '+title.toLowerCase());
		}else{
			$('#add_maintenance').modal();
			$('#maintenance_description').val(txt);
			$('#hidden_particulars').val(id);
			$('#edit_id').val(val);
			$('#add_maintenance .modal-title').html('Edit '+title);		
			$('#update').show();
			$('#save').hide();
		}
	},

	update: function(){

		var id = $('#edit_id').val();
		var arr = createPostData('add_maintenance');
		var part = $('#hidden_particulars').val();
		if(arr['error']){
    		toastr["error"](arr['error']);
    	}else{
			$.post("backstage/maintenance/update/"+id, { input:arr['data'] },function(data){
				if(data.status==200){
					toastr["success"]('Successfully updated.');
					$('#select-'+part+' :selected').text($('#maintenance_description').val());
					$('#add_maintenance').modal('hide');
				}
			}).fail(function(){
					toastr["error"]('Network Error!<br>Please try again.');
			});
		}

	},

	delete: function(id){
		var obj = $('#select-'+id);
		var title = $('#'+id+' label').html();
		var val = obj.val();
		var txt = $('#select-'+id+' :selected').text();
		if(val==''){
			alert('Please Select '+title.toLowerCase());
		}else{
			if(confirm('Are you sure you want to delete "'+txt+'" from '+title)){
				$.post("backstage/maintenance/delete/"+val, {},function(data){
					if(data.status==200){
						toastr["success"]('Successfully deleted.');
						$('#select-'+id+' :selected').remove();
					}
				}).fail(function(){
						toastr["error"]('Network Error!<br>Please try again.');
				});
			}
		}
	}



}


maintenance.init();