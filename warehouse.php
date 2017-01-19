<title>Warehouse</title>
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />				  	
<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');
require_once("db_connect.php");
$db = new database();
$racks = $db->select('select * from rack_storage where status=1' );
$bays = $db->select('select * from bay_storage where status=1' );

?>


<script>
	var racksjsondata = '<?php echo json_encode($racks['data']);?>';
	var baysjsondata  = '<?php echo json_encode($bays['data']);?>';

</script>

<head>
<!-- <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="/assets/css/warehouse.css?<?php echo rand();?>" type="text/css" />
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />
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
				  		<div id="warehousesearch" style="text-align: center;">
					  		<label for="sbox"><b>Search Bill of Lading no.:</b></label>
					  		<input type="text" id="sbox" name="sbox"><br/><br/>
					  		<label for="nbox"><b>Search Customer Name:</b></label>
					  		<input type="text" id="nbox" name="nbox">
					  		<button id="search" class="button-class custombutton" >Search</button>
					  		<button id="clearsearch" class="button-class custombutton" >Clear</button>
				  		</div>
				  	</div>


				  	<div id="warehouse" class="ware-tab">

						<div class="warehouse_border">
						<div class="warehouse_container">
							
							<div class="warehouse_gate">
							</div>

							<div class="area block_a"><em>Block A</em></div>
							<div class="area block_b"><em>Block B</em></div>
							<div class="area block_c"><em>Block C</em></div>
							<div class="freezer"></div>

				<?php
					// foreach($racks['data'] as $rack){
					// 	echo '<div class="rackStorage" data-racklevel="" data-racklevelheight="" id="rack-'.$rack['id'].'" style="height:'.$rack['rack_length'].';width:'.$rack['rack_width'].';'.$rack['style'].'"></div>';
					// }
					// foreach($bays['data'] as $bay){
					// 	echo '<div class="bayStorage" id="bay-'.$bay['id'].'" style="height:'.$bay['bay_length'].';width:'.$bay['bay_width'].';'.$bay['style'].'"></div>';
					// }

				?>





						</div>
						</div>
						<div id="savewarehouse">
							<button id="saveOrder" class="button-class custombutton" >Save</button>
							<button id="cancelOrderStorage" class="button-class custombutton" >Cancel</button>
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
				
				<div class="form-group col-sm-12 rack" id="rackcode_container">
				    <label class="col-sm-4" for="textinput"><br>Rack Code : </label>
				    <div class="col-sm-8">
				        <input name="name" type="text" id="rackcode" col="code" disabled="disabled" class="form-control">
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
				        <input name="racklevelheight" col="code" type="text" id="baycode" disabled="disabled" class="form-control">
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

<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/assets/js/main.js?<?php echo rand();?>"></script>
<script src="/assets/js/warehouse.js?<?php echo rand();?>"></script>

</body>