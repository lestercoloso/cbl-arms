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
				stylessheet('warehouse.css'),
				stylessheet('inbound.css'),
				];
		
		construct_style($css);
		require_once('config/warehouse.php');
		$warehouselinks = CreateWarehouseLinks($config['warehouse_links']);

?>




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


<h2>Inbound Shipment</h2>
<div class="search-filter row" >
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="billoflandingno" id="search_bill_of_lading" placeholder="Bill of Lading No." col="bill_of_lading" type="text" class="form-control search-text not_mandatory">
			<input name="customername"  id="search_customer_name"  placeholder="Customer Name" type="text"  col="customer_name" class="form-control search-text not_mandatory">
			<input name="deliveryreceipt"  id="search_delivery_receipt"  col="delivery_receipt" placeholder="Delivery Receipt" type="text" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	

				<input name="search_pallet_code"  id="search_pallet_code"  col="pallet_code" placeholder="Pallet Code" type="text" class="form-control search-text not_mandatory">
				
				<select class="form-control chosen-select not_mandatory" id="s-type" col="storage_type" data-placeholder="Storage Type">
							<option><option>
						<?php
							foreach($config['storage_type'] as $key=>$tos){
								if($key!=''){
									echo "<option value='$key'>$tos<option>";									
								}
							}
						?>
				</select>

				<select class="form-control chosen-select not_mandatory" id="si-type" col="inventory_type" data-placeholder="Sub-inventory Location Type">
				 		<option><option>
						<?php
							foreach($config['subinventory_type'] as $key=>$tos){
								if($key!=''){
									echo "<option value='$key'>$tos<option>";									
								}
							}
						?>
				</select>

		

	</div>
	<div class="col-sm-4 searchdata">	


			    <div class='input-group date' id='exdate_group'>
			        <input type='text' class="form-control not_mandatory" col="ex_date" name="exdate" id="exdate" placeholder="Expiration Date"/>
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class='input-group date' id='endate_group'>
			        <input type='text' class="form-control not_mandatory" col="en_date" name="endate" id="endate" placeholder="Entry Date"/>
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	
			    <div class='input-group date' id='pudate_group'>
			        <input type='text' class="form-control not_mandatory" col="pu_date" name="pudate" id="pudate" placeholder="Pickup Date" />
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	

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
		<button id="addnewshipment" class="button-class custombutton" >Add Shipment</button>
	</div>


<table class="table table-bordered  table-striped" id="inbound-list">
  <thead>
    <tr>
      <th>Bill of<br>Landing No.</th>
      <th>Customer Name</th>
      <th>Deliver Receipt</th>
      <th>Pallet Code</th>
      <th>Quantity</th>
      <!-- <th>Description</th> -->
      <th>Storage<br>Type</th>
      <th>Sub-inventory<br>Location Type</th>
      <!-- <th>Expiration<br>Date</th>
      <th>Entry<br>Date</th>
      <th>Pick Up<br>Date</th> -->
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
			<h4 class="modal-title">Inbound/Receiving Report</h4>
		</div>

		<div class="modal-body">
<?php
			foreach($config['inventory'] as $forms){
				echo '<div class="col-sm-4 inv_form" id="" style="padding-left: 0px;">';
				echo construct_form($forms);				
				echo '</div>';
			}

?>
		<div class="inventory_label">Inbound/Receiving Report</div>

<div class="inventory_table_container">
<table class="table table-bordered  table-striped" id="inventory-list">
  <thead>
    <tr>
      <th>PC ID #</th>
      <th>Item No.</th>
      <th>Material Description</th>
      <th>QTY</th>
      <th>UOM</th>
      <th>Batch Code</th>
      <th>Expiry Date</th>
      <th>CBM</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
  <tfoot class="add_inventory">
    <tr>
      <td><input type="number" col="pcid"></td>
      <td><input type="number" col="item_no"></td>
      <td>
      <!-- <input type="text" col="material_desc"> -->
		<select col="material_desc">
		</select> 

      </td>
      <td><input type="number" col="qty" min="1"></td>
      <td><input type="text" col="uom" disabled="disabled">
      	<!-- <select col="uom">
      		<?php
      			// echo htmloption(array_merge([''=>'Select UOM'],$config['unit_of_measurement']));
      		?>
      	</select> -->
      </td>
      <td><input type="number" col="batch_code"></td>
      <td><input type="text" col="exp_date" ></td>
      <td><input type="text" col="cbm" disabled="disabled"></td>
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
		<div class="inv_form" style="float: left;"><input type="checkbox" col="maintain" value="1"> Maintain some item Batch Code and Expiry Date</div>
		
          <button type="button" class="btn btn-default" id="saveinventory">Save</button>
          <!-- <button type="button" class="btn btn-default" id="updateinventory">Update</button> -->
          <button type="button" class="btn btn-default" id="backinventory">Back</button>
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
















