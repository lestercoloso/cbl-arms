<title>Employee Information</title>
<?php
		require_once("helper/utility_helper.php");
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('vehicle.css')];
		
		construct_style($css);
		require_once('config/booking.php');
?>

<div id="mainContainer">

<!-- Start of page -->


<h2>Employee Information</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="searchcode" id="searchcode" placeholder="Driver Code" col="code" type="text" class="form-control search-text not_mandatory">


	</div>
	<div class="col-sm-4 searchdata">	
				<input name="searchdrivername" id="searchdrivername" placeholder="Driver Name" type="text" col="name" class="form-control search-text not_mandatory">
	</div>
	<div class="col-sm-4 searchdata">	
					<select class="form-control not_mandatory" id="searchvehicletype" col="vehicle_type">
						<option value="">Select Vehicle Type</option>
				 		<?php
				 			foreach($config['vehicle_type'] as $key => $option){
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
		<button id="addmodal" class="button-class custombutton">Add Driver Profile</button>
	</div>



<table class="table table-bordered table-striped table-list" id="search_result_list">
  <thead>
    <tr>
      <th>Driver Code</th>
      <th>Driver Name</th>
      <th>Vehicle Type</th>
      <th>Action</th>
      </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row" class="centered">1</td>
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
		<h4 class="modal-title">Add Driver Profile</h4>
		</div>

		<div class="modal-body">

	<form>
	<fieldset>


<?php
foreach($config['driver_form'] as $forms){
	echo '<div class="col-sm-12 createform" id="">';
	echo construct_form($forms);				
	echo '</div>';
}
?>	
</fieldset>
</form>

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


<?php
	$js = [ bowerpath('toastr/toastr.min.js'),
			bowerpath('bootstrap/dist/js/bootstrap.min.js'),
			javascript('main.js'),
			'/js/moment.js',
			bowerpath('eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'),
			bowerpath('chosen/chosen.jquery.js'),
			javascript('driver.js')
			];
	construct_js($js);


?>

<!-- END of page -->

</div>
</div>
</div>
</body>		