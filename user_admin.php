<title>User Administration</title>
<?php
		require_once("helper/utility_helper.php");

		
		require_once('header.php');	
		
		$css = [bowerpath('toastr/toastr.min.css'),
				bowerpath('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
				bowerpath('chosen/chosen.css'),
				stylessheet('user_admin.css')];
		
		construct_style($css);
		require_once('config/user_admin.php');

		 $user_type = json_encode($config['user_type']);
?>

<div id="mainContainer">
<!-- Start of page -->
<script>
var user_type = <?php echo $user_type; ?>;
</script>

<h2>User Administration</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	
				<input name="searchloginid" id="searchloginid" placeholder="Login ID" col="username" type="text" class="form-control search-text not_mandatory">

				<input name="searchloginid" id="searchname" placeholder="User Name" col="name" type="text" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	
			    <div class="input-group date" id="search_date_created_from">
			        <input type="text" class="form-control not_mandatory" col="date_from" id="search_date_from" placeholder="Date Created From">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class="input-group date" id="search_date_created_to">
			        <input type="text" class="form-control not_mandatory" col="date_to" id="search_date_to" placeholder="Date Created To">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	</div>
	<div class="col-sm-4 searchdata">	

					<select class="form-control not_mandatory" id="searchusertype" col="user_type">
				 		<option value="">Select User Type</option>
				 		<?php
				 			foreach($config['user_type'] as $key => $option){
				 				echo "<option value='$key'>$option</option>";		
				 			}
				 		?>
					</select>

					<select class="form-control not_mandatory" id="searchstatus" col="status">
				 		<option value="">Select Status</option>
				 		<?php
				 			foreach($config['user_status'] as $key => $option){
				 				echo "<option value='$key'>$option</option>";		
				 			}
				 		?>
					</select>
	</div>
	

	<div class="col-sm-3 col-md-offset-9 search-btn">	
		<button id="search" class="button-class custombutton">Search</button>
		<button id="clearsearch" class="button-class custombutton">Clear</button>
	</div>	

</div>

<div id="pagination-container"><ul class="pagination"><li class="active"><span>1</span></li><li><span class="pagenumber" data-page="2">2</span></li><li><span class="pagenumber" data-page="2">»</span></li></ul>
</div>

	<div class="side-btn">
		<button id="new_user" class="button-class custombutton">Add New User</button>
	</div>



<table class="table table-bordered table-striped table-list" id="search_result_list">
  <thead>
    <tr>
      <th> </th>
      <th>User Name</th>
      <th>Login ID</th>
      <th>User Type</th>
      <th>Last Login</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row" class="centered">1</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>
  </tbody>
</table>






		<div id="create_modal" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add New User</h4>
		</div>

		<div class="modal-body">

	<form>
	<fieldset>


<?php
foreach($config['user_form'] as $forms){
	echo '<div class="col-sm-6 user_form" id="">';
	echo construct_form($forms);				
	echo '</div>';
}
?>	
</fieldset>
</form>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="savecreate"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
		<button type="button" class="btn btn-default" id="clearecreate">Clear</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
			javascript('user_admin.js')
			];
	construct_js($js);


?>

<!-- END of page -->

</div>
</div>
</div>
</body>		