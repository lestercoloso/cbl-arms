<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');


?>

<head>
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
				  		<div style="display: none;">
				  		<button id="storView" class="button-class hide">STORAGE VIEW</button>
				  		<button id="storView" class="button-class hide">SHELVES VIEW</button><br/><br/><br/><br/><br/><br/><br/><br/>
				  		</div>
				  		<label for="sbox"><b>Search Bill of Lading no.:</b></label>
				  		<input type="text" id="sbox" name="sbox"><br/><br/>
				  		<label for="nbox"><b>Search Customer Name:</b></label>
				  		<input type="text" id="nbox" name="nbox">
				  		<button id="search" class="button-class-s" style="">Search</button>
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
		<div id="zoom_block" title="Block"></div>



<script src="/assets/js/warehouse.js"></script>

</body>