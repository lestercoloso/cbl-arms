<title>Location Management</title>
<?php
		require_once("helper/utility_helper.php");
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				bowerpath('bootstrap_toggle/css/boostrap-toggle.min.css'),
				stylessheet('location_management.css')];
		
		construct_style($css);
		require_once('config/location_management.php');

		$lcoation_status = json_encode($config['wh_status']);

?>
<div id="mainContainer">

<!-- Start of page -->
<script>
var lcoation_status = <?php echo $lcoation_status; ?>;
</script>

<h2>Location Management</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="sarachwhlocationcode" id="sarachwhlocationcode" placeholder="WH Location Code" col="code" type="text" class="form-control search-text not_mandatory">
			<input name="searchwhlocation" id="searchwhlocation" placeholder="Warehouse Location" col="location" type="text" class="form-control search-text not_mandatory">


	</div>
	<div class="col-sm-4 searchdata">	
					<select class="form-control not_mandatory" id="searchvehicletype" col="storage_type">
						<option value="">Select Storage Type</option>
				 		<?php echo htmloption($config['storage_type']);
				 		?>
					</select>
	</div>		

	<div class="col-sm-4 searchdata">	
					<select class="form-control not_mandatory" id="searchwhstatus" col="status">
						<option value="">Select Status</option>
				 		<?php echo htmloption($config['wh_status']);
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
		<button id="addmodal" class="button-class custombutton">Add Warehouse Location</button>
	</div>



<table class="table table-bordered table-striped table-list" id="search_result_list">
  <thead>
    <tr>
      <th> </th>
      <th>WH Location Code</th>
      <th>Warehouse Location</th>
      <th>Address</th>
      <th>Storage Type</th>
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
    </tr>
  </tbody>
</table>






		<div id="create_modal" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Warehouse Location</h4>
		</div>

		<div class="modal-body">

	<form>
	<fieldset>


<?php
foreach($config['warehouse_location'] as $forms){
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
			// bowerpath('bootstrap_toggle/js/boostrap-toggle.min.js'),
			javascript('location_management.js')
			];
	construct_js($js);


?>

<!-- END of page -->

</div>
</div>
</div>
</body>		