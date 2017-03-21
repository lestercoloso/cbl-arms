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

$version =rand();
?>




<head>
<!-- <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="/assets/css/warehouse.css?<?php echo $version;?>" type="text/css" />
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />

<!-- for inbound/outbound -->
<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="/bower_components/chosen/chosen.css" />
<!-- end  -->
<script type="text/javascript">
	
	var warehouse_scale = 1.6;

</script>
</head>



		<div id="mainContainer">
			<div id="sampleA">
				<div style="margin-top:3%;margin-left:3%;color:#cc0000;">
				
				<h1>CBL WAREHOUSE</h1>
				</div>
				<div id="tabs">
				  <ul>
				    <li><a href="#tabs-1">WAREHOUSE</a></li>
				    <li><a href="inbound.php">INBOUND</a></li>
				    <li><a href="outbound.php">OUTBOUND</a></li>
				    <li><a href="#tabs-4">LOCATION MANAGEMENT</a></li>
				  </ul>
				  <div id="tabs-1" style="display: none;">
				  	<div id="tab1-div1" style="margin-top: 3%;width: 25%;float:left">

						<div id="shelfinfo">

						</div>

						<div class="left-container col-sm-12" id="left-container">

							<label class="storage_type_container col-sm-12"><b>Rack Storage</b></label><br>
							<div class="storage_preview_container col-sm-12">
								
								<span class="col-sm-6">Rack Code : </span> <span class="col-sm-6"> - </span> 
								<span class="col-sm-6">Rack Code : </span> <span class="col-sm-6"> - </span> 

							</div> <br>

						
							<button id="" class="button-class custombutton view_storage" >View</button>
							<button id="" class="button-class custombutton delete_storage" >Delete</button>

		<button id="" class="button-class custombutton rotate_left" > <i class="fa fa-undo" aria-hidden="true"></i> left</button>
		<button id="" class="button-class custombutton rotate_right" > <i class="fa fa-repeat" aria-hidden="true"></i> right</button>		



							

						</div>

				  		<div style="float: left;width: 100%;">				  		
				  			<button id="addStorage" class="button-class">ADD STORAGE</button>
				  		</div>
				  		<div class="left-container">
					  		<label for="sbox"><b>Search Bill of Lading no.:</b></label>
					  		<input type="text" id="sbox" name="sbox"><br/><br/>
					  		<label for="nbox"><b>Search Customer Name:</b></label>
					  		<input type="text" id="nbox" name="nbox">
					  		<button id="search" class="button-class custombutton" >Search</button>
					  		<button id="clearsearch" class="button-class custombutton" >Clear</button>
				  		</div>
				  	</div>


				  	<div  class="ware-tab">


				  		<div id="warehouse">
							<div class="warehouse_border">
							<div class="warehouse_container">
								
								<div class="warehouse_gate">
								</div>

								<div class="area block_A"><em>Block A</em><div></div></div>
								<div class="area block_B"><em>Block B</em><div></div></div>
								<div class="area block_C"><em>Block C</em><div></div></div>
								<div class="freezer"></div>

							</div>
							</div>
							<div id="savewarehouse">
								<button id="saveOrder" class="button-class custombutton" >Save</button>
								<button id="cancelOrderStorage" class="button-class custombutton" >Cancel</button>
							</div>
						</div>


						<div id="shelves">
							<div class="shelves-text">
								<span>Available Slots: </span>
								<span style="float: right;text-decoration: underline;">View Packing List </span>
							</div>							





							<div class="function-button">
								<button id="editAddRackLevel" class="button-class custombutton" style="width: 150px;margin: 0px;" >Add Rack Level</button>
							</div>

								<div id="shelf_container">

									<div class="rack-level">
										<div class="support-left"></div>
										<div class="support-bottom"></div>
										<div class="support-right"></div>
									</div>

									<div class="rack-level">
										<div class="support-left"></div>
										<div class="support-bottom"></div>
										<div class="support-right"></div>
									</div>


								</div>
								<div id="saveshelf">
									<button id="saveShelves" class="button-class custombutton" >Save</button>
									<button id="cancelShelves" class="button-class custombutton" >Cancel</button>
								</div>

<div id="rotate_shelves">
		<button class="custombutton rl"> <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
		<button class="custombutton rr"> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		<button class="custombutton ru"> <i class="fa fa-arrow-up" aria-hidden="true"></i></button>
		<button class="custombutton rd"> <i class="fa fa-arrow-down" aria-hidden="true"></i></button>
</div>


                

						</div>

				  	</div>
				  	<div style="clear:both"></div>
				  	<div></div>
				  	<div></div>
				  	
				  </div>
				</div>

			</div>
		</div>
		</div>
		</div>

		<div class="modal fade" id="add_storage" role="dialog">
    	<div class="modal-dialog custom-class2">
		<div class="modal-content">
		
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Storage</h4>
        </div>
		<div class="modal-body">
			<form>
			<fieldset>
				<div class="form-group col-sm-12">
				  <label for="stype" class="col-sm-4">Storage Type * </label>
				  <div class="col-sm-8">
					  <select class="form-control" id="stype">
					    <option value="rack">Rack</option>
					    <option value="bay">Bay</option>
					  </select>
				  </div>
				</div>				


				
				<div class="form-group col-sm-12 rack" id="rackcode_container">
				    <label class="col-sm-4" for="textinput">Rack Code * </label>
				    <div class="col-sm-8">
				        <input name="name" type="text" id="rackcode" col="code" disabled="disabled" class="form-control">
				        <span id="rackcode_error" class="text-danger"></span>
				    </div>				    
				</div>
				<div class="form-group col-sm-12 rack" id="rblock_container">
				  <label for="stype" class="col-sm-4">Block </label>
				  <div class="col-sm-8">
					  <select class="form-control" id="rblock"  col="block">
					    <option value="">Select Block</option>
					    <option value="A">Block A</option>
					    <option value="B">Block B</option>
					    <option value="C">Block C</option>
					  </select>
				  </div>
				</div>


				<div class="form-group col-sm-12 rack" id="racklength_container">
				    <label class="col-sm-4" for="racklength">Rack Lenth * </label>
				    <div class="col-sm-8">
				        <input name="racklength" type="number" col="rack_length" min="1" id="racklength" placeholder="Enter the rack length" class="form-control">
				        <span id="racklength_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack" id="rackwidth_container">
				    <label class="col-sm-4" for="rackwidth">Rack Width * </label>
				    <div class="col-sm-8">
				        <input name="rackwidth" type="number" col="rack_width" min="1"  id="rackwidth" placeholder="Enter the rack width" class="form-control">
				        <span id="rackwidth_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 rack"  id="noofracklevel_container">
				  <label for="noofracklevel" class="col-sm-4">No. of Rack level * </label>
				  <div class="col-sm-8">
					  <select class="form-control" col="no_rack_level" id="noofracklevel">
					    <option value="">Select No of Rack level</option>
					    <option value="1">1</option>
					    <option value="2">2</option>
					    <option value="3">3</option>
					    <option value="4">4</option>
					    <option value="5">5</option>
					    <option value="6">6</option>
					  </select>
				  </div>
				</div>				

				<div class="form-group col-sm-12 rack" id="racklevelheight_container">
				    <label class="col-sm-4" for="textinput">Rack level height * </label>
				    <div class="col-sm-8">
				        <input name="racklevelheight" type="number"  min="1" col="rack_level_height"  id="racklevelheight" placeholder="Enter the rack level height" class="form-control">
				        <span id="racklevelheight_error" class="text-danger"></span>
				    </div>
				</div>
				<div class="form-group col-sm-12 rack" id="noracksection_container">
				    <label class="col-sm-4" for="textinput">No. of Rack section * </label>
				    <div class="col-sm-8">
				        <input name="no_rack_section" type="number"  min="1" col="no_rack_section"  id="noracksection" placeholder="Enter No. of Rack section" class="form-control">
				        <span id="noracksection_error" class="text-danger"></span>
				    </div>
				</div>
				<div class="form-group col-sm-12 rack" id="nopalletposition_container">
				    <label class="col-sm-4" for="textinput">No. of Pallet Position * </label>
				    <div class="col-sm-8">
				        <input name="no_pallet_position" type="number"  min="1" col="no_pallet_position"  id="nopalletposition" placeholder="Enter No. of Pallet position" class="form-control">
				        <span id="nopalletposition_error" class="text-danger"></span>
				    </div>
				</div>



				<div class="form-group col-sm-12 bay" id="baycode_container">
				    <label class="col-sm-4" for="textinput">Bay Code * </label>
				    <div class="col-sm-8">
				        <input name="racklevelheight" col="code" type="text" id="baycode" disabled="disabled" class="form-control">
				        <span id="baycode_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 bay" id="bblock_container">
				  <label for="stype" class="col-sm-4">Block * </label>
				  <div class="col-sm-8">
					  <select class="form-control" id="bblock"  col="block">
					    <option value="">Select Block</option>
					    <option value="A">Block A</option>
					    <option value="B">Block B</option>
					    <option value="C">Block C</option>
					  </select>
				  </div>
				</div>
				<div class="form-group col-sm-12 bay" id="bay_length_container">
				    <label class="col-sm-4" for="textinput">Bay Length * </label>
				    <div class="col-sm-8">
				        <input name="bay_length" type="number"  min="1" col="bay_length" id="bay_length" placeholder="Enter the bay length" class="form-control">
				        <span id="bay_length_error" class="text-danger"></span>
				    </div>
				</div>

				<div class="form-group col-sm-12 bay" id="bay_width_container">
				    <label class="col-sm-4" for="textinput">Bay Width * </label>
				    <div class="col-sm-8">
				        <input name="bay_width" type="number"  min="1"  col="bay_width" id="bay_width" placeholder="Enter the bay width" class="form-control">
				        <span id="bay_width_error" class="text-danger"></span>
				    </div>
				</div>
		</fieldset>
		</form>
		</div>

		 <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="saveStorage();">Save</button>
          <button type="button" class="btn btn-default" onclick="cleardata();">Clear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

        </div>
        </div>
		

		</div>





<div id="storage_view" class="modal fade" role="dialog">
	<div class="modal-dialog custom-class">
	 <div class="modal-content">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> - </h4>
	</div>
	<div class="modal-body">


<div style="margin-top: 55px;">

		<div class="shelves_container" style="transform: rotateX(-15deg) rotateY(30deg);"> <div class="back"></div><div class="bottom"></div> <div class="left storage_height"></div><div class="right storage_height"></div> </div>			
		
		
		
</div>

<!-- https://desandro.github.io/3dtransforms/docs/rectangular-prism.html -->


	</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" id="savestorageview"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
          <button type="button" class="btn btn-default" id="resetstorageview">Reset</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</div>
		</div>
		</div>



<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js?<?php echo $version;?>"></script>
<script src="/assets/js/warehouse.js?<?php echo $version;?>"></script>


<script type="text/javascript">
	$( "#tabs" ).tabs({ active: 0 });
</script>
<!-- for inbound/outbound -->
<script src="/js/moment.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/bower_components/chosen/chosen.jquery.js"></script>
<!-- end -->
</body>