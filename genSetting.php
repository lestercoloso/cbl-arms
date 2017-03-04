<title>Maintenance</title>
<?php


		require_once("helper/utility_helper.php");

		$css = [ bowerpath('bootstrap/dist/css/bootstrap.min.css'),bowerpath('font-awesome/css/font-awesome.min.css')];
		construct_style($css);
		
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('maintenance.css')];
		
		construct_style($css);

		require_once('config/maintenance.php');	

?>
<!-- end  -->
	<script type="text/javascript">
		
	</script>
</head>



<div class="mainContainer">
<div class="subContainer">
		
<div class="set">
	<div class="col-sm-6">
		<h3>Customer Information</h3>
		<?php construct_maintenance($config['customer_info'], $db);?>
		<div class="col-sm-12 optionlist" style="font-size: 13px;">PRICE LIST</div>
		<?php construct_maintenance($config['price_list'], $db);?>
	</div>

	<div class="col-sm-6">
		<h3>Booking</h3>
		<?php echo construct_maintenance($config['booking'], $db);?>
	</div>

	<div class="col-sm-6">
		<h3>Inbound</h3>
		<?php echo construct_maintenance($config['inbound'], $db);?>
	</div>
	<div class="col-sm-6">
		<h3>Bill of Lading</h3>
		<?php echo construct_maintenance($config['bol'], $db);?>
	</div>
</div>
 		
</div>
</div>



	<div id="add_maintenance" class="modal fade col-sm-12 add_maintenance" role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> </h4>
		</div>

			<div class="modal-body">
			<fieldset>
				<div class="form-group col-sm-12" id="maintenance_description_container" title="">

				<input name="description" type="text" col="description" id="maintenance_description" class="form-control" placeholder="Add Description">
				<input type="hidden" id="hidden_particulars" class="not_mandatory" col="particulars" >
				<input type="hidden" id="edit_id">
				<span id="address_error" class="text-danger"></span>
				</div>


			</fieldset>
			

		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="update">Update</button>
		<button type="button" class="btn btn-default" id="save">Add</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
			javascript('maintenance.js')
			];
	construct_js($js);
?>