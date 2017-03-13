<title>Bill of Lading</title>
<?php
	require_once("helper/utility_helper.php");

	$css = [ bowerpath('bootstrap/dist/css/bootstrap.min.css'),bowerpath('font-awesome/css/font-awesome.min.css')];
	construct_style($css);
	
	require_once('header.php');	
	
	$css = [bowerpath('toastr/toastr.min.css'),
			bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
			bowerpath('chosen/chosen.css'),
			stylessheet('bill_of_lading.css')];
	construct_style($css);
	require_once('config/bill_of_lading.php');
?>

<div id="mainContainer">

<!-- Start of page -->


<h2>Bill of Lading</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="billoflandingno" id="search_bill_of_lading" placeholder="Bill of Lading No." col="bill_of_lading" type="text" class="form-control search-text not_mandatory">
			<input name="customername" id="search_customer_name" placeholder="Customer Name" type="text" col="customer_name" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	

			    <div class="input-group date" id="bill_of_lading_from_container">
			        <input type="text" class="form-control not_mandatory" col="date" name="search_date_from" id="search_date_from" placeholder="Bill of Lading date from">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class="input-group date" id="bill_of_lading_to_container">
			        <input type="text" class="form-control not_mandatory" col="date" name="search_date_to" id="search_date_to" placeholder="Bill of Lading date to">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	</div>
	<div class="col-sm-4 searchdata">	
				<select class="form-control not_mandatory" id="search_status" col="status">
				 		<option value="">Select status</option>
				 		<?php
				 			foreach($config['status'] as $key => $option){
				 				echo "<option value='$key'>$option</option>";		
				 			}
				 		?>
				</select>
	</div>	



	<div class="col-sm-3 col-md-offset-9 search-btn">	
		<button id="searchbill" class="button-class custombutton">Search</button>
		<button id="clearsearchbill" class="button-class custombutton">Clear</button>
	</div>	

</div>

<div id="pagination-container"><ul class="pagination"><li class="active"><span>1</span></li><li><span class="pagenumber" data-page="2">2</span></li><li><span class="pagenumber" data-page="2">»</span></li></ul>
</div>

	<div class="side-btn">
		<button id="add_bill_of_lading" class="button-class custombutton">Add Bill of Lading</button>
		<button id="generate_billing_report" class="button-class custombutton">Generate Billing Report</button>
	</div>



<table class="table table-bordered table-striped table-list" id="search_result_list">
  <thead>
    <tr>
      <th><input type="checkbox" value=""></th>
      <th>Bill of<br>Lading No.</th>
      <th>Recipient</th>
      <th>Shipper</th>
      <th>Bill of Lading Date</th>
      <th>Amount</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="centered"><input type="checkbox" value=""></td class="centered">
      <td scope="row" class="centered">1</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>
  </tbody>
</table>





		<div id="create_bill_of_lading" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Bill of Lading</h4>
		</div>

		<div class="modal-body">
			<div class="col-sm-12 bordered">
				<div class="col-sm-6"><div class="col-sm-3">Bill of Lading No. </div>  
					<div  class="col-sm-4 display">
						<input name="bill_no" type="text" col="bill_no" id="bill_no" class="form-control" disabled="disabled" value="">
					</div>
				</div> 
				<div class="display hide" ><input type="text" col="client_id" id="bill_client_id"></div>
				<div class="col-sm-4 col-md-offset-2"><div class="col-sm-4"> Booking No. </div> <div class="col-sm-8 bill_booking_no display"><select class="form-control" name="booking_no" id="booking_no" col="booking_no" data-placeholder=""></select></div></div> 
				<div class="col-sm-8"><div class="col-sm-3">Delivery Status</div></div> 
			</div>


<?php
$i = 0;
foreach($config['add_shipment'] as $label => $forms){
	$i++;
	echo '<div class="no-pad form_'.$i.'" id="add_billing_container_'.$i.'">';
	echo '<div class="col-sm-12 bordered">';
	echo "<label>$label</label>";
	echo construct_form($forms);				
	echo '</div>';
	echo '</div>';
}

?>	

			<div class="col-sm-12 bordered">
				<div class="col-sm-4">Created By:</div> 
				<div class="col-sm-4">Reviewed By:</div>
				<div class="col-sm-4">Approved By:</div> 
			</div>

		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="savenewbilling"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
		<button type="button" class="btn btn-default" id="updatebilling"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Update</button>
		<button type="button" class="btn btn-default" id="clearnewbilling">Clear</button>
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
			javascript('bill_of_lading.js')
			];
	construct_js($js);
?>
<!-- END of page -->

</div>
</div>
</div>
</body>		