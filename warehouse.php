<title>Warehouse</title>
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />				  	
<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');


?>

<head>
<!-- <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="/assets/css/warehouse.css?<?php echo rand();?>" type="text/css" />
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
				    <li><a href="#tabs-1">WAREHOUSE</a></li>
				    <li><a href="#tabs-2">INBOUND</a></li>
				    <li><a href="#tabs-3">OUTBOUND</a></li>
				    <li><a href="#tabs-4">LOCATION MANAGEMENT</a></li>
				  </ul>
				  <div id="tabs-1" style="display: none;">
				  	<div id="tab1-div1" style="margin-top: 3%;width: 25%;float:left">
				  		<div style="float: left;width: 100%;">				  		
				  			<button id="addStorage" class="button-class">ADD STORAGE</button>
				  		</div>
				  		<div style="float: left;">
				  		<label for="sbox"><b>Search Bill of Lading no.:</b></label>
				  		<input type="text" id="sbox" name="sbox"><br/><br/>
				  		<label for="nbox"><b>Search Customer Name:</b></label>
				  		<input type="text" id="nbox" name="nbox">
				  		<button id="search" class="button-class" style="">Search</button>
				  		</div>
				  	</div>


				  	<div id="warehouse" class="ware-tab" style="">

						<div class="warehouse_border">
						<div class="warehouse_container">
							
							<div class="warehouse_gate">
							</div>

							<div class="area block_a"><em>Block A</em></div>
							<div class="area block_b"><em>Block B</em></div>
							<div class="area block_c"><em>Block C</em></div>
							<div class="freezer"></div>

						</div>
						</div>


				  	</div>
				  	<div style="clear:both"></div>
				  	<div></div>
				  	<div></div>
				  	<div id="tab1-div2">
	



				  	</div>
				  </div>
				  <div id="tabs-2">  
				   </div>
				  <div id="tabs-3">
				  </div>
				  <div id="tabs-4">
				  </div>
				</div>

			</div>
		</div>
		</div>
		</div>

		<div id="add_storage" title="Add new storage">
			<form>
			<fieldset>

				<div class="form-group col-sm-12">
				  <label for="stype" class="col-sm-4">Storage Type : </label>
				  <div class="col-sm-8">
					  <select class="form-control" id="stype">
					    <option value="rack">Rack</option>
					    <option value="bay">Bay</option>
					  </select>
				  </div>
				</div>
				
				<div class="form-group col-sm-12 rack" id="rackcode">
				    <label class="col-sm-4" for="textinput"><br>Rack Code : </label>
				    <div class="col-sm-8">
				        <input name="name" type="text" id="rackcode" disabled="disabled" class="form-control">
				        <span id="rackcode_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="racklength_container">
				    <label class="col-sm-4" for="racklength">Rack Lenth : </label>
				    <div class="col-sm-8">
				        <input name="racklength" type="number" min="1" id="racklength" placeholder="Enter the rack length" class="form-control">
				        <span id="racklength_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="rackwidth_container">
				    <label class="col-sm-4" for="rackwidth">Rack Width : </label>
				    <div class="col-sm-8">
				        <input name="rackwidth" type="number" min="1"  id="rackwidth" placeholder="Enter the rack width" class="form-control">
				        <span id="rackwidth_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="noofracklevel_container">
				    <label class="col-sm-4" for="textinput" >No. of rack level : </label>
				    <div class="col-sm-8">
				        <input name="noofracklevel" type="number"  min="1" id="noofracklevel" placeholder="Enter No. of rack level" class="form-control">
				        <span id="noofracklevel_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="racklevelheight_container">
				    <label class="col-sm-4" for="textinput">Rack level height : </label>
				    <div class="col-sm-8">
				        <input name="racklevelheight" type="number"  min="1"  id="racklevelheight" placeholder="Enter the rack level height" class="form-control">
				        <span id="racklevelheight_error" class="text-danger"></span>
				    </div>
				</div>



				<div class="form-group col-sm-12 bay" id="baycode_container">
				    <label class="col-sm-4" for="textinput"><br>Bay Code : </label>
				    <div class="col-sm-8">
				        <input name="racklevelheight" type="text" id="racklevelheight" disabled="disabled" class="form-control">
				        <span id="racklevelheight_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 bay" id="bay_length_container">
				    <label class="col-sm-4" for="textinput">Bay Length : </label>
				    <div class="col-sm-8">
				        <input name="bay_length" type="number"  min="1"  id="bay_length" placeholder="Enter the bay length" class="form-control">
				        <span id="bay_length_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 bay" id="bay_width_container">
				    <label class="col-sm-4" for="textinput">Bay Width : </label>
				    <div class="col-sm-8">
				        <input name="bay_width" type="number"  min="1"  id="bay_width" placeholder="Enter the bay width" class="form-control">
				        <span id="bay_width_error" class="text-danger"></span>
				    </div>
				</div>


		</fieldset>
		</form>
<script src="/assets/js/warehouse.js?<?php echo rand();?>"></script>

</body>