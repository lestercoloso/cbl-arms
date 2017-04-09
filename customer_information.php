<title>Customer Information</title>
<?php
	require_once("helper/utility_helper.php");
		require_once('header.php');	
		
		$css = [
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('customer_information.css')];
		
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
		<button id="add_customer_info" class="button-class custombutton">Add New Customer</button>
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



<input type="hidden" id="updateid">


		<div id="create_modal" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Customer Information</h4>
		</div>

		<div class="modal-body">

	<form>
	<fieldset>


<?php

foreach($config['create_customer'] as $forms){
	echo '<div class="col-sm-3 create_customer" id="">';
	echo construct_form($forms);				
	echo '</div>';
}
?>	
</fieldset>
</form>

<div class="col-sm-12 bordered" style="overflow-x: auto;">

	<div class="col-sm-12 border_container">
			
			<div class="col-sm-12">
				<div class="selector select_inactive" id="address_select">
					<img src="/img/ci_address_inactive.png" class="img_inactive">
					<img src="/img/ci_address_active.png" class="img_active">
				</div>
				<div class="selector select_inactive"  id="contact_select">
					<img src="/img/ci_contact_inactive.png" class="img_inactive">
					<img src="/img/ci_contact_active.png" class="img_active">
				</div>
				<div class="selector select_inactive"  id="billing_select">
					<img src="/img/ci_billing_inactive.png" class="img_inactive">
					<img src="/img/ci_billing_active.png" class="img_active">
				</div>
			</div>

			<div class="col-sm-12 border_container" id="additional_table">
				<table class="table table-bordered table-striped table-list border_table" id="address_selected" >
				<thead>
				<tr>
				<th>Address Type</th>
				<th>Address</th>
				<th>City</th>
				<th>Region</th>
				<th>Area</th>
				<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
				</tbody>
				<tfoot><tr><td colspan="7"><button id="add_customer_address" class="button-class custombutton">Add Address</button></td></tr></tfoot>		
				</table>

				<table class="table table-bordered table-striped table-list border_table" id="contact_selected" >
				<thead>
				<tr>
				<th>Name</th>
				<th>Birth Date</th>
				<th>Contact No.</th>
				<th>Moble No.</th>
				<th>Email Address</th>
				<th>Department</th>
				<th>Designation</th>
				<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
				</tbody>
				<tfoot><tr><td colspan="8"><button id="add_customer_contact" class="button-class custombutton">Add Contact Person</button></td></tr></tfoot>
				</table>

				<table class="table table-bordered table-striped table-list border_table" id="billing_selected" >
				<thead>
				<tr>
				<th>Billing Statement No.</th>
				<th>Date Received</th>
				<th>Amount</th>
				<th>Aging</th>
				<th>Remarks</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
				</tbody>
				</table>
			</div>
	</div>		
</div>



		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="savecreate"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
		<button type="button" class="btn btn-default" id="saveedit"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Update</button>
		<button type="button" class="btn btn-default" id="clearecreate">Clear</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div>








	<div id="create_additional" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Address</h4>
		</div>

			<div class="modal-body">
			<fieldset>
<?php
	echo '<div class="create_contact" id="">';
	echo construct_form($config['contact_person']);				
	echo '</div>';

	echo '<div class="create_address" id="">';
	echo construct_form($config['address']);				
	echo '</div>';
?>


			</fieldset>
			

		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="saveaddress">Save</button>
		<button type="button" class="btn btn-default" id="savecontact">Save</button>
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
			javascript('customer_info.js')
			];
	construct_js($js);


?>

<!-- END of page -->

</div>
</div>
</div>
</body>		