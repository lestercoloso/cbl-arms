<title>Bill of Lading</title>
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />		
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />		  	

<?php

	require_once('header.php');
	require_once("helper/utility_helper.php");
	require_once('config/bill_of_lading.php');

?>


<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />
<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="/bower_components/chosen/chosen.css" />
<link rel="stylesheet" href="/assets/css/bill_of_lading.css?<?php echo rand();?>" type="text/css" />


<body onResize="updateToolbarPos();">
<div class="scrollingContainer">
<div class="subContainer " style="width: 950px;">
<div class="buff10"><!-- --></div>
<div class="buff10"><!-- --></div>
<div class="buff10"><!-- --></div>
<div class="buff10"><!-- --></div>
<div style="clear: left; float: left;"><a href="homepage.php"><img src="" width=445 height=70 alt="" title="" border=0></a></div>
<div style="clear: left; padding-left: 5px; height: 30px;" class="normalTextSmall">
Welcome <b><?php echo $_SESSION['profilename'];?></b> <?php echo " (" .$_SESSION['profilestats'] . ")" ; ?>
<br>
<div style="clear: left; float: left; width: 250px;">
Last Login: <span id="head_lastlogin"></span><a href="">[view log]</a>
</div>
<div style="clear: left; float: left; width: 250px;">
System Date/Time: <span id="systemTimeContent"><?php echo $system_time ;?></span>
</div>
<div style="float: left;">
Your session will expire in <span id="timerContent"><?php echo "NEED HEADER HERE"; ?>:00</span>
</div>
<div style="clear: left; float: left; width: 250px;">
<select id="selPort"></select><span id=""> </span><a href="" id="switchPort">[switch]</a>
</div>
</div>
<br>
<div id="mainContainer">

<!-- Start of page -->


<h2>Bill of Lading</h2>
<div class="search-filter row">
	<br>
	<div class="col-sm-4 searchdata">	

			<input name="billoflandingno" id="search_bill_of_lading" placeholder="Bill of Lading No." col="bill_of_lading" type="text" class="form-control search-text not_mandatory">
			<input name="customername" id="search_customer_name" placeholder="Customer Name" type="text" col="customer_name" class="form-control search-text not_mandatory">

	</div>
	<div class="col-sm-4 searchdata">	

			    <div class="input-group date" id="bill_of_lading_from_container">
			        <input type="text" class="form-control not_mandatory" col="date" name="search_date_from" id="search_date_from" placeholder="Bill of Lading date from">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>

			    <div class="input-group date" id="bill_of_lading_to_container">
			        <input type="text" class="form-control not_mandatory" col="date" name="search_date_to" id="search_date_to" placeholder="Bill of Lading date to">
			        <span class="input-group-addon">
			            <span class="fa fa-calendar"></span>
			        </span>
			    </div>
	</div>
	<div class="col-sm-4 searchdata">	
				<select class="form-control not_mandatory" id="search_status" col="status">
				 		<option value="">Select status</option>
				 		<option value="1">Reviewed</option>
				 		<option value="2">Approved</option>
				</select>
	</div>	



	<div class="col-sm-3 col-md-offset-9 search-btn">	
		<button id="searchbill" class="button-class custombutton">Search</button>
		<button id="clearsearchbill" class="button-class custombutton">Clear</button>
	</div>	

</div>

<div id="pagination-container"><ul class="pagination"><li class="active"><span>1</span></li><li><span class="pagenumber" data-page="2">2</span></li><li><span class="pagenumber" data-page="2">»</span></li></ul>
</div>

	<div class="side-btn">
		<button id="generate_billing_report" class="button-class custombutton">Generate Billing Report</button>
		<button id="add_bill_of_lading" class="button-class custombutton">Add Bill of Lading</button>
	</div>



<table class="table table-bordered table-striped table-list" id="bill_of_lading-list">
  <thead>
    <tr>
      <th><input type="checkbox" value=""></th>
      <th>Bill of<br>Landing No.</th>
      <th>Recipient</th>
      <th>Shipper</th>
      <th>Bill of Lading Date</th>
      <th>Amount</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="centered"><input type="checkbox" value=""></td class="centered">
      <td scope="row" class="centered">1</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
      <td>test</td>
    </tr>
  </tbody>
</table>





		<div id="create_bill_of_lading" class="modal fade col-sm-12 " role="dialog">
		<div class="modal-dialog custom-class">
		<div class="modal-content">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add Bill of Lading</h4>
		</div>

		<div class="modal-body">
			<div class="col-sm-12 bordered">
				<div class="col-sm-8">Bill of Lading No.</div> 
				<div class="col-sm-4">Booking No.</div>
				<div class="col-sm-8">Delivery Status</div> 
			</div>


<?php
$i = 0;
foreach($config['add_shipment'] as $label => $forms){
	$i++;
	echo '<div class="col-sm-4 no-pad form_'.$i.'" id="add_billing_container_'.$i.'">';
	echo '<div class="col-sm-12 bordered">';
	echo "<label>$label</label>";
	echo construct_form($forms);				
	echo '</div>';
	echo '</div>';
}

?>	

			<div class="col-sm-12 bordered">
				<div class="col-sm-4">Created By:</div> 
				<div class="col-sm-4">Reviewed By:</div>
				<div class="col-sm-4">Approved By:</div> 
			</div>

		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" id="savenewbilling"><i class="fa fa-circle-o-notch fa-spin hide" style=""></i> Save</button>
		<button type="button" class="btn btn-default" id="clearnewbilling">Clear</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div>




<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js?<?php echo rand();?>"></script>
<script src="/js/moment.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/bower_components/chosen/chosen.jquery.js"></script>
<script src="/assets/js/bill_of_lading.js?<?php echo rand();?>"></script>

<!-- END of page -->

</div>
</div>
</div>
</body>		