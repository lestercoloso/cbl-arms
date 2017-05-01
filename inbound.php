<title>Warehouse</title>	
<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');
require_once("helper/utility_helper.php");
require_once('config/add_shipment_forms.php');

		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				// stylessheet('warehouse.css'),
				stylessheet('inbound.css'),
				];
		
		construct_style($css);
		require_once('config/warehouse.php');
		$warehouselinks = CreateWarehouseLinks($config['warehouse_links']);


		$inbound_status = json_encode($config['inbound_status']);
		$cbl_status = json_encode($config['cbl_status']);

?>

<script>
var inbound_status 	= <?php echo $inbound_status; ?>;
var cbl_status 		= <?php echo $cbl_status; ?>;
</script>



		<div id="mainContainer">
			<div id="sampleA">
				<div style="margin-top:3%;margin-left:3%;color:#cc0000;">
				
				<h1>CBL WAREHOUSE</h1>
				</div>
				<div id="tabs">
				   <ul>
					<?php echo $warehouselinks['menu']?>
				  </ul>

				  
				  <div id="<?php echo $warehouselinks['selected']; ?>">


<h2>Book Inbound Shipment</h2>
<div class="search-filter row" >
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="billoflandingno" id="search_inbound_ref_no" placeholder="Inbound Ref No." col="inbound_no" type="text" class="form-control search-text not_mandatory">
			<input name="customername"  id="search_booked_by"  placeholder="Booked By" type="text"  col="booked_by" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	

			    <div class='input-group date' id='exdate_group'>
			        <input type='text' class="form-control not_mandatory" col="req_date_from" name="req_date_from" id="req_date_from" placeholder="Request Date From"/>
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class='input-group date' id='endate_group'>
			        <input type='text' class="form-control not_mandatory" col="req_date_to" name="req_date_to" id="req_date_to" placeholder="Request Date To"/>
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

		

	</div>
	<div class="col-sm-4 searchdata">	

		<select class="form-control chosen-select not_mandatory" id="search-status" col="status">
					<option value="">Select Status</option>
					<?php echo htmloption($config['inbound_status']);?>
		</select>
	

	</div>


	<div class="col-sm-3  col-md-offset-9 inbound-search-btn">
		<button id="searchInbound" class="button-class custombutton" >Search</button>
		<button id="clearInbound" class="button-class custombutton" >Clear</button>
	</div>



</div>

<div id="pagination-container">
<ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="/wilson/?&amp;page=2" data-ci-pagination-page="2">2</a></li><li><a href="/wilson/?&amp;page=3" data-ci-pagination-page="3">3</a></li><li><a href="/wilson/?&amp;page=2" data-ci-pagination-page="2" rel="next">»</a></li></ul>
</div>
	<div>
		<!-- <button id="addnewshipment" class="button-class custombutton"  data-toggle="modal" data-target="#add_shipment" >Add Shipment</button> -->
		<button id="addnewshipment" class="button-class custombutton" >Book Inbound Shipment</button>
	</div>


<table class="table table-bordered  table-striped" id="inbound-list">
  <thead>
    <tr>
      <?php if($user_type==10) {?><th><input type="checkbox" value="all" id="checkall"></th><?php }?>
      <th>Inbound Ref No.</th>
      <th>Booked by</th>
      <th>Estimated Date/Time of Arrival</th>
      <th>Request Date</th>
      <th>Status</th>
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
    </tr>
  </tbody>
</table>


<div id="add_shipment" class="modal fade" role="dialog">
	<div class="modal-dialog custom-class">
	 <div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Shipment</h4>
		</div>

	<div class="modal-body">
	<form>
	<fieldset>


		<?php
			foreach($config['add_shipment'] as $forms){
				echo '<div class="col-sm-4 row" id="">';
				echo construct_form($forms);				
				echo '</div>';
			}

		?>	

				

		</fieldset>
		</form>

		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" id="updateshipment"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Update</button>
          <button type="button" class="btn btn-default" id="savenewshipment"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
          <button type="button" class="btn btn-default" id="viewinventory">View Inventory</button>
          <button type="button" class="btn btn-default" id="clearnewshipment">Clear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</div>
		</div>
		</div>
  
				  </div>
				  
				</div>

			</div>
		</div>
		</div>
		</div>


<div id="inventory_modal" class="modal fade" role="dialog">
	<div class="modal-dialog custom-class">
	 <div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Book Inbound Shipment</h4>
		</div>

		<div class="modal-body">
<?php
			foreach($config['inventory'] as $forms){
				echo '<div class="col-sm-6 inv_form" id="" style="padding-left: 0px;">';
				echo construct_form($forms);				
				echo '</div>';
			}

?>
		<div class="links"><a>Download Template</a> <a>Upload File</a></div>

		<div class="inventory_label hide">Inbound/Receiving Report</div>

<div class="inventory_table_container">
<table class="table table-bordered  table-striped" id="inventory-list">
  <thead>
    <tr>
      <th>Stock No.</th>
      <th>Description</th>
      <th>Pieces</th>
      <th>Boxes</th>
      <th>Cartons</th>
      <th>CBM</th>
      <th>Total CBM</th>
      <th>Batch Code</th>
      <th>Expiration Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
  <tfoot class="add_inventory">
    <tr>
      <td><select col="stock_no"></select> </td>
      <td><input type="text" col="description" style="text-align:center;" disabled="disabled"></td>
      <td><input type="number" col="pieces"  disabled="disabled"></td>
      <td><input type="number" col="box"  disabled="disabled"></td>
      <td><input type="number" col="carton"  disabled="disabled"></td>
      <td><input type="text" col="cbm" style="text-align:right;" disabled="disabled"></td>
      <td><input type="number" col="total_cbm" min="1"  disabled="disabled"></td>
      <td><input type="text" col="batch_code"></td>
      <td><input type="text" col="exp_date" ></td>
      <td>
      	<button type="button" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>
      	<button type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="hidden-xs"> </span> </button>
      </td>
    </tr>
  </tfoot>
</table>
</div>

		</div>
		<div class="modal-footer">
		<!-- <div class="inv_form" style="float: left;"><input type="checkbox" col="maintain" value="1"> Maintain some item Batch Code and Expiry Date</div> -->
		
          <button type="button" class="btn btn-default" id="saveinventory"><i class="fa fa-circle-o-notch fa-spin hide"></i> Save</button>

          <button type="button" class="btn btn-default" id="updateinventory"><i class="fa fa-circle-o-notch fa-spin hide"></i>Update</button>

          <button type="button" class="btn btn-default" id="postinventory"><i class="fa fa-circle-o-notch fa-spin hide"></i> Post</button>

          <button type="button" class="btn btn-default" id="clearinventory">Clear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</div>
		</div>
</div>



	<div id="pullout_shipment" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Pull-out Shipment</h4>
		</div>

			<div class="modal-body">
			<fieldset>

			<?php
				echo '<div class="pull_shipment" id="">';
				echo construct_form($config['pullout']);				
				echo '</div>';
			?>


			</fieldset>
			
 
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="pulloutbutton"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> <span> - </span> </button>
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
			javascript('inbound.js')
			];
	construct_js($js);
	
	require_once('warehouse_footer.php');

?>

</body>
















