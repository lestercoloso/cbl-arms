
<link rel="stylesheet" href="/assets/css/inbound.css?<?php echo rand();?>" type="text/css" />
<h2>Inbound Shipment</h2>
<div class="search-filter row" >
	<br>
	<div class="col-sm-4">	

			<input name="billoflandingno" placeholder="Bill of Lading No." type="text" class="form-control">
			<input name="customername" placeholder="Customer Name" type="text" class="form-control">
			<input name="deliveryreceipt" placeholder="Delivery Receipt" type="text" class="form-control">

	</div>
	<div class="col-sm-4">	

				<input name="billoflandingno" placeholder="Pallet Code" type="text" class="form-control">
				
				<select class="form-control chosen-select" id="s-type" data-placeholder="Storage Type">
				 		<option><option>
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

	<div>
		<button id="addnewshipment" class="button-class custombutton" >Add Shipment</button>
	</div>


<table class="table table-bordered" id="inbound-list">
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











<div id="add_shipment" title="Add new shipment">
			<form>
			<fieldset>

				<div class="form-group col-sm-12">
				  <label for="stype" class="col-sm-4">Storage Type : </label>
				  
				</div>
				
				<div class="form-group col-sm-12 rack" id="rackcode_container">
				    <label class="col-sm-4" for="textinput"><br>Rack Code : </label>
				    <div class="col-sm-8">

				        <span id="rackcode_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="racklength_container">
				    <label class="col-sm-4" for="racklength">Rack Lenth : </label>
				    <div class="col-sm-8">
				        <input name="racklength" type="number" col="rack_length" min="1" id="racklength" placeholder="Enter the rack length" class="form-control">
				        <span id="racklength_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="rackwidth_container">
				    <label class="col-sm-4" for="rackwidth">Rack Width : </label>
				    <div class="col-sm-8">
				        <input name="rackwidth" type="number" col="rack_width" min="1"  id="rackwidth" placeholder="Enter the rack width" class="form-control">
				        <span id="rackwidth_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="noofracklevel_container">
				    <label class="col-sm-4" for="textinput" >No. of rack level : </label>
				    <div class="col-sm-8">
				        <input name="noofracklevel" type="number" col="no_rack_level" min="1" id="noofracklevel" placeholder="Enter No. of rack level" class="form-control">
				        <span id="noofracklevel_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="racklevelheight_container">
				    <label class="col-sm-4" for="textinput">Rack level height : </label>
				    <div class="col-sm-8">
				        <input name="racklevelheight" type="number"  min="1" col="rack_level_height"  id="racklevelheight" placeholder="Enter the rack level height" class="form-control">
				        <span id="racklevelheight_error" class="text-danger"></span>
				    </div>
				</div>



				<div class="form-group col-sm-12 bay" id="baycode_container">
				    <label class="col-sm-4" for="textinput"><br>Bay Code : </label>
				    <div class="col-sm-8">

				        <span id="baycode_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 bay" id="bay_length_container">
				    <label class="col-sm-4" for="textinput">Bay Length : </label>
				    <div class="col-sm-8">
				        <input name="bay_length" type="number"  min="1" col="bay_length" id="bay_length" placeholder="Enter the bay length" class="form-control">
				        <span id="bay_length_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 bay" id="bay_width_container">
				    <label class="col-sm-4" for="textinput">Bay Width : </label>
				    <div class="col-sm-8">
				        <input name="bay_width" type="number"  min="1"  col="bay_width" id="bay_width" placeholder="Enter the bay width" class="form-control">
				        <span id="bay_width_error" class="text-danger"></span>
				    </div>
				</div>


		</fieldset>
		</form>
		</div>