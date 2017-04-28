<title>Warehouse</title>	  	
<?php

session_start();
$_SESSION['page']="view1";
require_once('header.php');
$version =rand();


		require_once("helper/utility_helper.php");
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('warehouse.css')];
		
		construct_style($css);
		require_once('config/warehouse.php');
		require_once('config/location_management.php');
		$warehouselinks = CreateWarehouseLinks($config['warehouse_links']);

?>
<!-- end  -->
<script type="text/javascript">
	
	var warehouse_scale = 1.6;

</script>
</head>



		<div id="mainContainer">

				<div class="sub-container">
					<h1>CBL WAREHOUSE</h1>
				</div>
				<div id="tabs">
				  <ul>
					<?php echo $warehouselinks['menu']?>
				  </ul>
				  <div id="<?php echo $warehouselinks['selected']; ?>" style="display: none;">
				  	<div style="margin-top: 3%;width: 25%;float:left">

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


				  		<div class="left-container legend-container">
					  		<label>Legend :</label>
					  		<div class="legend"><span class="wh_green"></span></div> <div class="legend_meaning"> - Vacant</div>
					  		<div class="legend"><span class="wh_red"></span></div>	 <div class="legend_meaning"> - Occupied</div>
					  		<div class="legend"><span class="wh_yellow"></span></div><div class="legend_meaning"> - Nearing for Expiration</div>	
					  		<div class="legend"><span class="wh_orange"></span></div><div class="legend_meaning"> - No. Movement for 3 Months</div>	

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

				  		<div class="wh_header_option">
				  			<div class="wh_select"> 
				  			<span>Warehouse Location :</span> 
				  			<select class="form-control">
				  				<option>Select Warehouse Location</option>
								<?php echo htmloption($config['warehouse_location_option']); ?>
				  			</select></div>
				  			<div class="wh_storage_type"> 
				  			<span>Storage Type :</span> 
				  			<select class="form-control" >
				  				<option>Select Storage Type</option>
				  				<?php echo htmloption($config['storage_type']); ?>
				  			</select></div>

				  		</div>

				  		<div id="warehouse">



							<div class="warehouse_border">
							<div class="warehouse_container">
								
								<div class="warehouse_gate">
								</div>

								<div class="area block_A"><em>Block A</em><div class="container"></div></div>
								<div class="area block_B"><em>Block B</em><div class="container"></div></div>
								<div class="area block_C"><em>Block C</em><div class="container"></div></div>
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
				<?php
					echo '<div>';
					echo construct_form($config['warehouse_form']);				
					echo '</div>';
				?>
				<div class="col-sm-12 wh_form_link rack">
					<a style="float: left;"   class="no_access" 	id="appbtn">Assign Pallet Position</a>
					<a style="float: right;"  class="no_access"	id="apptbtn">Assign Pallet Position Type</a>
				</div>
				</fieldset>
			</form>
		</div>

		 <div class="modal-footer">
          <button type="button" class="btn btn-default" id="savestorage" ><i class="fa fa-circle-o-notch fa-spin hide"></i> Save</button>
          <button type="button" class="btn btn-default" onclick="cleardata();">Clear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

        </div>
        </div>
		

		</div>



		<div class="modal fade" id="additional_modal" role="dialog">
    	<div class="modal-dialog custom-class2">
		<div class="modal-content">
		
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Pallet Position</h4>
        </div>
		<div class="modal-body">
			<form>
				<fieldset>
				<?php
					echo '<div class="app">';
					echo construct_form($config['assign_pallet_position']);				
					echo '</div>';
					echo '<div class="appt">';
					echo construct_form($config['assign_pallet_position_type']);				
					echo '</div>';
				?>
				</fieldset>


			<div id="pallet_position_container">
			<table class="table table-bordered table-striped table-list" id="pallet_position_table">
				<thead><tr>
					<td>Rack Section</td>
					<td>Rack Level</td>
					<td>No. of Pallet Positon</td>
					<td class="lrw">Wing Side</td>
					<td>Action</td>
				</tr></thead>
				<tbody>
					<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
				</tbody>
			</table>	
			</div>			
			</form>
		</div>
		 <div class="modal-footer">
          <button type="button" class="btn btn-default" id="saveadditional" >Save</button>
          <button type="button" class="btn btn-default" id="clearadditional">Clear</button>
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




<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js?<?php echo $version;?>"></script>
<script src="/assets/js/warehouse.js?<?php echo $version;?>"></script>


<!-- for inbound/outbound -->
<script src="/js/moment.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/bower_components/chosen/chosen.jquery.js"></script>
<!-- end -->
</body>

<?php require_once('warehouse_footer.php');?>