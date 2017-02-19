<title>Booking</title>
<?php
		require_once("helper/utility_helper.php");

		$css = [ bowerpath('bootstrap/dist/css/bootstrap.min.css'),bowerpath('font-awesome/css/font-awesome.min.css')];
		construct_style($css);
		
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('booking.css')];
		
		construct_style($css);

		$config['vehicle'] = [];
		$config['driver']  = [];
		foreach($db->select('select `type` from `vehicle`' )['data'] as $vehicles){
			$config['vehicle'][$vehicles['type']] = $vehicles['type']; 
		}

		foreach($db->select('select `name` from `driver_profile`' )['data'] as $drivers){
			$config['driver'][$drivers['name']] = $drivers['name']; 
		}

		require_once('config/booking.php');
?>

<div id="mainContainer">

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

		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="savecreate"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
		<button type="button" class="btn btn-default" id="clearecreate">Clear</button>
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