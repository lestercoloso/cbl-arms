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
				    <li><a href="inbound.php">INBOUND</a></li>
				    <li><a href="#tabs-3">OUTBOUND</a></li>
				    <li><a href="#tabs-4">LOCATION MANAGEMENT</a></li>
				  </ul>
				  <div id="tabs-1" style="display: none;">				  	
				  </div>
				  
				  <div id="tabs-3">

<link rel="stylesheet" href="/assets/css/inbound.css?<?php echo rand();?>" type="text/css" />
<h2>Outbound Shipment</h2>
<div class="search-filter row" >
	<br>
	<div class="col-sm-4">	

			<input name="billoflandingno" placeholder="Bill of Lading No." type="text" class="form-control search-text">
			<input name="customername" placeholder="Customer Name" type="text" class="form-control search-text">
			<input name="deliveryreceipt" placeholder="Delivery Receipt" type="text" class="form-control search-text">

	</div>
	<div class="col-sm-4">	

				<input name="search_pallet_code" placeholder="Pallet Code" type="text" class="form-control search-text">

				<input name="search_location" placeholder="Location" type="text" class="form-control search-text">
				
				<select class="form-control chosen-select" id="s-type" data-placeholder="Type of shipment">
						<option><option>
						<?php
							foreach($config['type_of_shipment'] as $key=>$tos){
								if($key!=''){
								echo "<option value='$key'>$tos<option>";									
								}
							}
						?>

				</select>		

	</div>
	<div class="col-sm-4">	
			    <div class='input-group date' id='exdate_group'>
			        <input type='text' class="form-control"  name="exdate" id="exdate" placeholder="Expiration Date"/>
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
      <th>Deliver<br>Receipt</th>
      <th>Invoice<br>No.</th>
      <th>Pallet Code</th>
      <th>Quantity</th>
      <th>Location</th>
      <th>Expiration<br>Date</th>
      <th>Pickup<br>Date</th>
      <th>Type of<br>Shipment</th>
      <!-- <th>Expiration<br>Date</th>
      <th>Entry<br>Date</th>
      <th>Pick Up<br>Date</th> -->
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>-</td>
      <td>-</td>
      <td>-</td>
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


<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js?<?php echo rand();?>"></script>
<script src="/assets/js/warehouse.js?<?php echo rand();?>"></script>


<script type="text/javascript">
	$( "#tabs" ).tabs({ active: 2 });
</script>
<!-- for inbound/outbound -->
<script src="/js/moment.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/bower_components/chosen/chosen.jquery.js"></script>
<script src="/assets/js/inbound.js?<?php echo rand();?>"></script>
<!-- end -->
</body>





















