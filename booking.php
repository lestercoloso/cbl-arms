<title>Booking</title>
<?php
		require_once("helper/utility_helper.php");

		
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('booking.css')];
		
		construct_style($css);

		$config['vehicle'] = [];
		$config['driver']  = [];
		$sqlvehicle = 'select `plate_no`, `type` from `vehicle`';
		foreach($db->select($sqlvehicle)['data'] as $vehicles){
			$vehicle_data[$vehicles['type']][] = $vehicles['plate_no']; 
		}
		$sqldriver = 'select `name` from `driver_profile`';
		foreach($db->select($sqldriver)['data'] as $drivers){
			$config['driver'][$drivers['name']] = $drivers['name']; 
		}

		require_once('config/booking.php');
?>

<div id="mainContainer">
<script>
	var vehicle_data = <?php echo json_encode($vehicle_data)?>;

</script>
<!-- Start of page -->


<h2>Booking</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="searchbookingnumber" id="searchbookingnumber" placeholder="Booking No." col="booking_no" type="text" class="form-control search-text not_mandatory">
			<input name="searchcustomername" id="searchcustomername" placeholder="Customer Name" type="text" col="customer_name" class="form-control search-text not_mandatory">
			<input name="searchcontactperson" id="searchcontactperson" placeholder="Contact Person" type="text" col="contact_person" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	
			    <div class="input-group date" id="search_booking_date_from">
			        <input type="text" class="form-control not_mandatory" col="date_from" id="search_date_from" placeholder="Booking Date From">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class="input-group date" id="search_booking_date_to">
			        <input type="text" class="form-control not_mandatory" col="date_to" id="search_date_to" placeholder="Booking Date To">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	</div>
	<div class="col-sm-4 searchdata">	
					<select class="form-control not_mandatory" id="search_mode_of_shipping" col="mode_of_shipping">
				 		<option value="">Select Mode of Shipping</option>
				 		<?php
				 			foreach($config['mode_of_shipment'] as $key => $option){
				 				echo "<option value='$key'>$option</option>";		
				 			}
				 		?>
					</select>

					<select class="form-control not_mandatory" id="search_status" col="booking_status">
				 		<option value="">Select status</option>
				 		<?php
				 			foreach($config['status'] as $key => $option){
				 				echo "<option value='$key'>$option</option>";		
				 			}
				 		?>
					</select>
	</div>	



	<div class="col-sm-3 col-md-offset-9 search-btn">	
		<button id="search" class="button-class custombutton">Search</button>
		<button id="clearsearch" class="button-class custombutton">Clear</button>
	</div>	

</div>

<div id="pagination-container"><ul class="pagination"><li class="active"><span>1</span></li><li><span class="pagenumber" data-page="2">2</span></li><li><span class="pagenumber" data-page="2">»</span></li></ul>
</div>

	<div class="side-btn">
		<button id="book_shipment" class="button-class custombutton">Book Shipment</button>
	</div>



<table class="table table-bordered table-striped table-list" id="search_result_list">
  <thead>
    <tr>
      <th>Booking No.</th>
      <th>Customer Name</th>
      <th>Booking Date</th>
      <th>Area</th>
      <th>Mode of Shipping</th>
      <th>Contact Person</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row" class="centered">1</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>
  </tbody>
</table>






		<div id="create_modal" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Book Shipment</h4>
		</div>

		<div class="modal-body">

	<form>
	<fieldset>


<?php
foreach($config['book_shipment'] as $forms){
	echo '<div class="col-sm-4 create_shippment" id="">';
	echo construct_form($forms);				
	echo '</div>';
}
?>	
</fieldset>
</form>











<div class="col-sm-12 bordered" style="overflow-x: auto;height: 210px;">

	<div class="col-sm-12 border_container">
			
			<div class="col-sm-12">
<!-- 				<div class="selector select_active" id="inventory_select">
					<i class="fa fa-inbox" aria-hidden="true"></i><div> INVENTORY </div>
				</div> -->
				<div class="selector select_active" id="vehicle_select">
				<i class="fa fa-truck" aria-hidden="true"></i><div> VEHICLE </div>
				</div>
			</div>

			<div class="col-sm-12 border_container" id="additional_table">
				<table class="table table-bordered table-striped table-list border_table" id="inventory_selected" style="display: none;">
				<thead>
				<tr>
				<th>Item ID</th>
				<th>Product Code</th>
				<!-- <th>Bar Code</th> -->
				<th>Item Type</th>
				<!-- <th>Case Bar Code</th> -->
				<th>UOM</th>
				<th>Packaging (pcs)</th>
				<th>Dimension</th>
				<th>Storage Type</th>
				<th>Unit Cost</th>
				<th>Unit Price</th>
				<!-- <th>Floor Level</th> -->
				<!-- <th>Ceiling Level</th> -->
				<th>Action</th>
				</tr>
				</thead>
				<tbody></tbody>
				<tfoot><tr><td colspan="14"><button id="add_new_inventory" class="button-class custombutton">Add Inventory</button></td></tr></tfoot>		
				</table>

				<table class="table table-bordered table-striped table-list border_table" id="vehicle_selected" style="display: table;">
				<thead>
				<tr>
				<th>Vehicle Type</th>
				<th>Plate No.</th>
				<th>Driver</th>
				<th>Action</th>
				</tr>
				</thead>
				<tbody></tbody>
				<tfoot><tr><td colspan="8"><button id="add_multiple_vehicle" class="button-class custombutton">Add Vehicle</button></td></tr></tfoot>
				</table>
			</div>
	</div>		
</div>










		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="updatecreate"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Update</button>
		<button type="button" class="btn btn-default" id="savecreate"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
		<button type="button" class="btn btn-default" id="clearecreate">Clear</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div>






	<div id="create_additional" class="modal fade col-sm-12 inventory" role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Iventory</h4>
		</div>

			<div class="modal-body">
			<fieldset>
<?php
foreach($config['inventory'] as $inv){
	echo '<div class="add_inventory col-sm-6">';
	echo construct_form($inv);				
	echo '</div>';
}
	echo '<div class="add_vehicle">';
	echo construct_form($config['multiple_vehicle']);				
	echo '</div>';

?>
			</fieldset>
			

		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="updateinventory">Update</button>
		<button type="button" class="btn btn-default" id="saveinventory">Save</button>
		<button type="button" class="btn btn-default" id="updatevehicle">Update</button>
		<button type="button" class="btn btn-default" id="savevehicle">Save</button>
		<button type="button" class="btn btn-default" id="clearadditional">Clear</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
	</div>






<?php
	$js = [ bowerpath('toastr/toastr.min.js'),
			bowerpath('bootstrap/dist/js/bootstrap.min.js'),
			javascript('main.js'),
			'/js/moment.js',
			bowerpath('eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'),
			bowerpath('chosen/chosen.jquery.js'),
			javascript('booking.js')
			];
	construct_js($js);


?>

<!-- END of page -->

</div>
</div>
</div>
</body>		