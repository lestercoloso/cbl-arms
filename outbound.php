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
				stylessheet('warehouse.css')];
		
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
	<div style="height: 80px">
		<!-- <button id="addnewshipment" class="button-class custombutton"  data-toggle="modal" data-target="#add_shipment" >Add Shipment</button> -->
		<!-- <button id="addnewshipment" class="button-class custombutton" >Add Shipment</button> -->
	</div>


<table class="table table-bordered  table-striped" id="inbound-list">
  <thead>
    <tr>
      <th>Bill of<br>Landing No.</th>
      <th>Customer Name</th>
      <th>Delivery<br>Receipt</th>
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


  
				  </div>
				  
				</div>

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
			javascript('outbound.js')
			];
	construct_js($js);
	
	require_once('warehouse_footer.php');

?>

</body>




















