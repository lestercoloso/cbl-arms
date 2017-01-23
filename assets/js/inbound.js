            $(function () {
               $('#exdate_group, #endate_group, #pudate_group').datetimepicker({
                 format: 'MM/DD/YYYY'
           		});

                $('#s-type, #si-type').chosen({
                	no_results_text: "Oops, nothing found!"
                });
            });



function addShipment(){
	$( "#add_shipment" ).dialog('destroy');
	$( "#add_shipment" ).dialog({
	      autoOpen: true,
	      width: 400,
	      modal: true,
	 	  resizable: false,
	 	  movable: false,
	 	  draggable: false, 
	 	  buttons: {
			        Save: function() {
			          saveStorage(this);
			        },			        
			        Clear: function() {
			          cleardata();
			        },
			        Cancel: function() {
			          $( this ).dialog( "close" );
			        }
      	  }
	});	
}


$('#addnewshipment').click( function(){
	addShipment();
});


$( "#add_shipment" ).dialog({autoOpen: false});	