<title>Customer Information</title>
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
		require_once('config/customer_information.php');
?>



<div id="mainContainer">

<!-- Start of page -->


<h2>Customer Information</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="searchbookingnumber" id="searchcustomername" placeholder="Customer Name" col="customer_name" type="text" class="form-control search-text not_mandatory">
			<input name="searchcustomername" id="searcharea" placeholder="Area" type="text" col="area" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	
				<input name="searchcontactperson" id="searchregion" placeholder="Region" type="text" col="region" class="form-control search-text not_mandatory">

					<select class="form-control not_mandatory" id="search_industry_type" col="industry_type">
				 		<option value="">Select Industry Type</option>
				 		<?php
				 			foreach($config['industry_type'] as $key => $option){
				 				echo "<option value='$key'>$option</option>";		
				 			}
				 		?>
					</select>

	</div>	

	<div class="col-sm-4 searchdata">	
					<select class="form-control not_mandatory" id="search_customer_status" col="customer_status">
				 		<option value="">Select Customer Status</option>
				 		<?php
				 			foreach($config['customer_status'] as $key => $option){
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
		<button id="book_shipment" class="button-class custombutton">Add New Customer</button>
	</div>



<table class="table table-bordered table-striped table-list" id="search_result_list">
  <thead>
    <tr>
      <th>Customer<br>Code</th>
      <th>Customer Name</th>
      <th>Industry<br>Type</th>
      <th>Area</th>
      <th>Region</th>
      <th>Payment<br>Terms</th>
      <th>Aging</th>
      <th>Credit<br>Limit</th>
      <th>Outstanding<br>Balance</th>
      <th>Amount<br>Due</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row" class="centered">1</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
    </tr>
  </tbody>
</table>






		<div id="create_modal" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Customer</h4>
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

<script>
	var datetoday = '<?php echo date('m/d/Y');?>';

</script>

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