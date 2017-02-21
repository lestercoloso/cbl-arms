<title>Warehouse</title>
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />		
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />		  	
<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');
require_once("helper/utility_helper.php");
// $db = new database();
// $racks = $db->select('select * from rack_storage where status=1' );
// $bays = $db->select('select * from bay_storage where status=1' );
require_once('config/add_shipment_forms.php');
?>


	    



<head>
<!-- <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="/assets/css/warehouse.css?<?php echo rand();?>" type="text/css" />
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />

<!-- for inbound/outbound -->
<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="/bower_components/chosen/chosen.css" />
<!-- end  -->

</head>



		<div id="mainContainer">
			<div id="sampleA">
				<div style="margin-top:3%;margin-left:3%;color:#cc0000;">
				
				<h1>CBL WAREHOUSE</h1>
				</div>
				<div id="tabs">
				  <ul>
				    <li><a href="warehouse.php">WAREHOUSE</a></li>
				    <li><a href="#tabs-2">INBOUND</a></li>
				    <li><a href="outbound.php">OUTBOUND</a></li>
				    <li><a href="#tabs-4">LOCATION MANAGEMENT</a></li>
				  </ul>
				  <div id="tabs-1" style="display: none;">				  	
				  </div>
				  
				  <div id="tabs-2">

<link rel="stylesheet" href="/assets/css/inbound.css?<?php echo rand();?>" type="text/css" />
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


<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js?<?php echo rand();?>"></script>
<script src="/assets/js/warehouse.js?<?php echo rand();?>"></script>
<script type="text/javascript">
	$( "#tabs" ).tabs({ active: 1 });
</script>
<!-- for inbound/outbound -->
<script src="/js/moment.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/bower_components/chosen/chosen.jquery.js"></script>
<script src="/assets/js/inbound.js?<?php echo rand();?>"></script>
<!-- end -->
</body>





















