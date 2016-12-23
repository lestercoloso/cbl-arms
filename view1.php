<?php

session_start();
$_SESSION['page']="view1";

require_once('header.php');


?>

<head>

<style type="text/css">
	
	#mainBody{
		width: 1000px;
		height: 700px;
		background-color: white;
		margin: auto;
		margin-top: 35px;
		box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		padding-top: 20px;
	}

	.list{
		border:solid 1px;
	}

	.items .ui-selected {
	    background: red;
	    color: white;
	    font-weight: bold;
	}
 
	.items {
	    list-style-type: none;
	    margin-left: 10px;
	    padding: 0;
	    width: 100px;
	    float: left;
	}
 
 
  	#blockA 
  	{ 
  		width: 500px; 
  		height: 200px;
  		border: 
  		solid 1px; 
  	}
  	.ui-resizable-helper { 
  		border: .2px dotted #b00; 
  	}

  	#blockB { 
  		width: 500px; 
  		height: 300px;
  		border: solid 1px; 
  	}

  	#sortable { 
  		list-style-type: none; 
  		margin: 0; padding: 0; 
  		width: 450px; 
  	}

  	#sortable li { 
  		margin: 3px 3px 3px 0; 
  		padding: 1px; 
  		float: left; 
  		width: 100px; 
  		height: 90px; 
  		font-size: 4em; 
  		text-align: center; 
  	}

  	#sampleA{
	    height: 98%;
  	}

  	.button-class {
  		width: 70%;
  		margin: inherit;
	    background-color: #cc0000; /* Green */
	    border: none;
	    color: white;
	    padding: 15px 32px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
}
.button-class-s {
  		width: 40%;
  		margin: inherit;
	    background-color: #cc0000; /* Green */
	    border: none;
	    color: white;
	    padding: 15px 32px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
}
	  	.button-class1 {
  		margin: 20px;
	    background-color: #cc0000; /* Green */
	    border: none;
	    color: white;
	    padding: 6px 30px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

	.ware-tab{
		margin-top: 3%;
		float: left;
		width: 70%;
		margin-left: 3%;
		height: 80%;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.draggableDiv{
		width:200px;
		height:100px;
		background: aqua;
	}

</style>

<script type="text/javascript">

	$(document).ready(function(){

		$( "#tabs" ).tabs();



	$(function () {


		$("#storView").click(function(){
			var a = true;
			$.post("storeView.php",function(data){

				if(a===true){
				$("#tab1-div2").html(data);
				a=false;
			}else{
					alert("You are on storage View");

				}
			})
		});

		//$('.draggable').draggable();


		 /*   $( "#sortable" ).sortable({
		    	containment:"#blockB"
		    });
		    $(".ui-state-default").resizable({
		    	containment:"#blockB",
		    	animate:true,
    			grid:10
		    })
    		$( "#sortable" ).disableSelection();
        $("#items1,#items2,#items3").sortable({

                connectWith: "#items1,#items2,#items3",
                start: function (event, ui) {
                        ui.item.toggleClass("highlight");
                },
                stop: function (event, ui) {
                        ui.item.toggleClass("highlight");
                }
        });
         $(".list").resizable({
         	containment:"#blockA,.list"
         });
        $("#items1,#items2,#items3").disableSelection();
*/
		});

	})

</script>


</head>
<body onResize="updateToolbarPos();">

		<div class="scrollingContainer">
		<div class="subContainer">
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>


		<div id="mainBody">
			<!--<div id="blockA">
				<ul id="items1" class="items">
				    <li class="list">Item 1-1</li>
				    <li class="list">Item 1-2</li>
				    <li class="list">Item 1-3</li>
				    <li class="list">Item 1-4</li>
				    <li class="list">Item 1-5</li>
				    <li class="list">Item 1-6</li>    
				</ul>
				<ul id="items2" class="items">
				    <li class="list">Item 2-1</li>
				    <li class="list">Item 2-2</li>
				    <li class="list">Item 2-3</li>
				    <li class="list">Item 2-4</li>
				    <li class="list">Item 2-5</li>
				    <li class="list">Item 2-6</li>    
				</ul>
				<ul id="items3" class="items">
				    <li class="list">Item 3-1</li>
				    <li class="list">Item 3-2</li>
				    <li class="list">Item 3-3</li>
				    <li class="list">Item 3-4</li>
				    <li class="list">Item 3-5</li>
				    <li class="list">Item 3-6</li>    
				</ul>			</div>
			<div id="blockB">
				<ul id="sortable">
				  <li class="ui-state-default">1</li>
				  <li class="ui-state-default">2</li>
				  <li class="ui-state-default">3</li>
				  <li class="ui-state-default">4</li>
				  <li class="ui-state-default">5</li>
				  <li class="ui-state-default">6</li>
				  <li class="ui-state-default">7</li>
				  <li class="ui-state-default">8</li>
				  <li class="ui-state-default">9</li>
				  <li class="ui-state-default">10</li>
				  <li class="ui-state-default">11</li>
				  <li class="ui-state-default">12</li>
				</ul>

			</div>-->
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
				  <div id="tabs-1">
				  	<div id="tab1-div1" style="margin-top: 3%;width: 25%;float:left">
				  		<button id="storView" class="button-class">STORAGE VIEW</button>
				  		<button id="storView" class="button-class">SHELVES VIEW</button><br/><br/><br/><br/><br/><br/><br/><br/>
				  		<label for="sbox"><b>Search Bill of Lading no.:</b></label>
				  		<input type="text" id="sbox" name="sbox"><br/><br/>
				  		<label for="nbox"><b>Search Customer Name:</b></label>
				  		<input type="text" id="nbox" name="nbox">
				  		<button id="search" class="button-class-s" style="">Search</button>
				  	</div>
				  	<div id="tab1-div2" class="ware-tab" style="">
						
				  	</div>
				  	<div style="clear:both"></div>
				  	<div></div>
				  	<div></div>
				  	<div id="tab1-div2">
				  		<!--<button id="storView">STORAGE VIEW</button>-->
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
</body>