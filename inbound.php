<title>Warehouse</title>
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />		
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />		  	
<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');
// require_once("db_connect.php");
// $db = new database();
// $racks = $db->select('select * from rack_storage where status=1' );
// $bays = $db->select('select * from bay_storage where status=1' );

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
<body onResize="updateToolbarPos();">

		<div class="scrollingContainer">
		<div class="subContainer">
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>


		<div id="mainBody">
			<div id="sampleA">
				<div style="margin-top:3%;margin-left:3%;color:#cc0000;">
				
				<h1>CBL WAREHOUSE</h1>
				</div>
				<div id="tabs">
				  <ul>
				    <li><a href="warehouse.php">WAREHOUSE</a></li>
				    <li><a href="#tabs-2">INBOUND</a></li>
				    <li><a href="#tabs-3">OUTBOUND</a></li>
				    <li><a href="#tabs-4">LOCATION MANAGEMENT</a></li>
				  </ul>
				  <div id="tabs-1" style="display: none;">				  	
				  </div>
				  
				  <div id="tabs-2">

<link rel="stylesheet" href="/assets/css/inbound.css?<?php echo rand();?>" type="text/css" />
<h2>Inbound Shipment</h2>
<div class="search-filter row" >
	<br>
	<div class="col-sm-4">	

			<input name="billoflandingno" placeholder="Bill of Lading No." type="text" class="form-control search-text">
			<input name="customername" placeholder="Customer Name" type="text" class="form-control search-text">
			<input name="deliveryreceipt" placeholder="Delivery Receipt" type="text" class="form-control search-text">

	</div>
	<div class="col-sm-4">	

				<input name="search_pallet_code" placeholder="Pallet Code" type="text" class="form-control search-text">
				
				<select class="form-control chosen-select" id="s-type" data-placeholder="Storage Type">
						<option value=""></option>
					    <option value="rack">Rack</option>
					    <option value="bay">Bay</option>
				</select>

				<select class="form-control chosen-select" id="si-type" data-placeholder="Sub-inventory Location Type">
				 		<option><option>
				</select>

		

	</div>
	<div class="col-sm-4">	


			    <div class='input-group date' id='exdate_group'>
			        <input type='text' class="form-control"  name="exdate" id="exdate" placeholder="Expiration Date"/>
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class='input-group date' id='endate_group'>
			        <input type='text' class="form-control"  name="endate" id="endate" placeholder="Entry Date"/>
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	
			    <div class='input-group date' id='pudate_group'>
			        <input type='text' class="form-control" name="pudate" id="pudate" placeholder="Pickup Date" />
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


<ul class="pagination"><li class="active"><a href="#">1</a></li><li><a href="/wilson/?&amp;page=2" data-ci-pagination-page="2">2</a></li><li><a href="/wilson/?&amp;page=3" data-ci-pagination-page="3">3</a></li><li><a href="/wilson/?&amp;page=2" data-ci-pagination-page="2" rel="next">»</a></li></ul>

	<div>
		<button id="addnewshipment" class="button-class custombutton"  data-toggle="modal" data-target="#add_shipment" >Add Shipment</button>
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
      <th scope="row">1</th>
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

	<div class="col-sm-4 row" id="">
		
		<div class="form-group col-sm-12" id="">
		<label class="col-sm-4" for="textinput">Bill of Lading: </label>
		<div class="col-sm-8">
		<input name="bill_of_lading" type="text"  min="1" col="bill_of_lading" id=""  class="form-control" value="This is autogenerated" disabled="disabled">
		</div>
		</div>

		<div class="form-group col-sm-12" id="customer_name_container">
		<label class="col-sm-4" for="textinput">Customer Name: </label>
		<div class="col-sm-8">
		<input name="customer_name" type="text"  min="1" col="client_id" id=""  class="form-control">
		<span id="customer_name_error" class="text-danger"></span>
		</div>
		</div>

		<div class="form-group col-sm-12" id="delivery_receipt_container">
		<label class="col-sm-4" for="textinput">Delivery Receipt: </label>
		<div class="col-sm-8">
		<input name="delivery_receipt" type="text"  min="1" col="client_id" id=""  class="form-control">
		<span id="delivery_receipt_error" class="text-danger"></span>
		</div>
		</div>

		<div class="form-group col-sm-12" id="invoice_no_container">
		<label class="col-sm-4" for="textinput">Invoice No.: </label>
		<div class="col-sm-8">
		<input name="invoice_no" type="text"  min="1" col="invoice_no" id=""  class="form-control">
		<span id="invoice_no_error" class="text-danger"></span>
		</div>
		</div>

		<div class="form-group col-sm-12" id="pallet_code_container">
		<label class="col-sm-4" for="textinput">Pallet Code: </label>
		<div class="col-sm-8">
		<input name="bill_of_lading" type="text"  min="1" col="pallet_code" id="pallet_code"  class="form-control" value="This is autogenerated" disabled="disabled">
		<span id="pallet_code_error" class="text-danger"></span>
		</div>
		</div>



	</div>		

	<div class="col-sm-4 row" id="">

			<div class="form-group col-sm-12" id="quantity_container">
			<label class="col-sm-4" for="textinput">Quantity: </label>
			<div class="col-sm-8">
			<input name="quantity" type="number"  min="1" col="quantity" id="quantity"  class="form-control">
			<span id="quantity_error" class="text-danger"></span>
			</div>
			</div>

			<div class="form-group col-sm-12">
			<label for="stype" class="col-sm-4">Storage: </label>
			<div class="col-sm-8">
			<select class="form-control" id="storage">
			<option value="rack">Rack</option>
			<option value="bay">Bay</option>
			</select>
			</div>
			</div>

			<div class="form-group col-sm-12" id="rack_code_container">
			<label class="col-sm-4" for="textinput">Rack Code: </label>
			<div class="col-sm-8">
			<input name="invoice_no" type="text"  min="1" col="rack_code" id=""  class="form-control">
			<span id="pallet_code_error" class="text-danger"></span>
			</div>
			</div>
			
			<div class="form-group col-sm-12" id="rack_level_container">
			<label class="col-sm-4" for="textinput">Rack Level: </label>
			<div class="col-sm-8">
			<select class="form-control" id="rack_level">
			<option value="1">1</option>
			<option value="2">2</option>
			</select>
			</div>
			</div>
			
			<div class="form-group col-sm-12" id="subinventorylocation_type_container">
			<label class="col-sm-4" for="textinput">Sub-inventory Location Type: </label>
			<div class="col-sm-8">
			<select class="form-control" id="subinventorylocation_type">
			<option value="1">1</option>
			<option value="2">2</option>
			</select>
			</div>
			</div>
	    
	</div>

		<div class="col-sm-4 row" id="">

			<div class="form-group col-sm-12" id="description_container">
			<label class="col-sm-4" for="textinput">Description: </label>
			<div class="col-sm-8">
			<input name="description" type="text"  min="1" col="description" id="description"  class="form-control">
			<span id="description_error" class="text-danger"></span>
			</div>
			</div>

			<div class="form-group col-sm-12" id="invoice_no_container">
			<label class="col-sm-4" for="textinput">Location: </label>
			<div class="col-sm-8">
			<input name="location" type="text"  min="1" col="location" id="location"  class="form-control">
			<span id="location_error" class="text-danger"></span>
			</div>
			</div>

			<div class="form-group col-sm-12" id="ex_date_container">
			<label class="col-sm-4" for="textinput">Expiration Date: </label>
			<div class="input-group date  col-sm-8  create-date">
			<input type="text" class="form-control" name="ex_date" col="ex_date" id="ex_date">
			<span class="input-group-addon">
			<span class="fa fa-calendar"></span>
			</span>
			</div>
			</div>

			<div class="form-group col-sm-12" id="en_date_container">
			<label class="col-sm-4" for="textinput">Entry Date: </label>
			<div class="input-group date  col-sm-8 create-date">
			<input type="text" class="form-control" name="en_date" col="en_date" id="en_date">
			<span class="input-group-addon">
			<span class="fa fa-calendar"></span>
			</span>
			</div>
			</div>

			<div class="form-group col-sm-12" id="pu_date_container">
			<label class="col-sm-4" for="textinput">Expiration Date: </label>
			<div class="input-group date  col-sm-8 create-date" >
			<input type="text" class="form-control" name="pu_date" col="pu_date" id="pu_date">
			<span class="input-group-addon">
			<span class="fa fa-calendar"></span>
			</span>
			</div>
			</div>


		</div>
				

		</fieldset>
		</form>

		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Clear</button>
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

<!-- for inbound/outbound -->
<script src="/js/moment.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/bower_components/chosen/chosen.jquery.js"></script>
<script src="/assets/js/inbound.js?<?php echo rand();?>"></script>
<!-- end -->
</body>





















