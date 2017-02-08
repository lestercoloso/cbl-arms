<?php
// 	$method = isset($_GET['method']) ? $_GET['method'] : "";		
// if(!empty($method)){
// 	unset($_GET['method']);
// 	$method = explode('/', $method);
// 	require_once($method[0].'.php');
// 	die;	
// }
session_start();
$_SESSION['page']="home";
require_once('header.php');
require_once('db_connect.php');


class Homepage extends Database{


	public $_conn;
	public $name;
	public $time;

	public function __construct(){
		
	//	$this->_conn=$this->getConnection();

	}

	public function getTime(){

		$this->time = date("Y-m-d");
		return $this->time;
	}

}
$homepage = new Homepage();
?>



<head>

<style type="text/css">

	.con{

    border: solid #7d7d7d 8px;
    width: 205px;
    height: 207px;
    float: left;
    margin: 5px;
    border-radius: 29px;
    color: #7d7d7d;
    cursor: pointer;

	}
	.con2{

    border: solid #7d7d7d 8px;
    width: 205px;
    height: 207px;
    float: left;
    margin: 5px;
    border-radius: 29px;
    color: #7d7d7d;
    cursor: pointer;

	}
	.con3{

    border: solid #7d7d7d 8px;
    width: 205px;
    height: 207px;
    float: left;
    margin: 50px;
    border-radius: 29px;
    color: #7d7d7d;
    cursor: pointer;

	}	
	
	#img{
		background-color: white;
	}
	#cellsID{
    		margin-top: 5%;
	}
	#cellsID2{

			margin-left: 3%;
	}

	


</style>


<script type="text/javascript">

$(document).ready(function(){

	

	Date.prototype.addMinutes = function(minutes) {
    var copiedDate = new Date(this.getTime());
    return new Date(copiedDate.getTime() + minutes * 60000);
}
	var a = new Date();
	var year = a.getFullYear();
	var day = a.getDate();
	var month = a.getMonth();
	var fullthis= '2017/'+month+'/'+day;



	fetchCells();

	$('#view1').on('click',function(){

		window.location.assign('view1.php');
	});

	$('#view2').on('click',function(){

		window.location.assign('inbound.php');
	});
		$('#view3').on('click',function(){

		window.location.assign('outbound.php');
	});




	$( ".onHover" )
  		.on( "mouseenter", function() {
    $( this ).css({
      "background-color": "#cc0000",
      "font-weight": "bolder",
      "color": "white"
    });
  })
  .on( "mouseleave", function() {
    var styles = {
      backgroundColor : "",
      fontWeight: "",
      color: "#7d7d7d"
    };
    $( this ).css( styles );
  });

});
$(function(){

	

	$("#view-dialog").dialog({
    modal: true,
    autoOpen: false,
    draggable: false,
    resizable: false,
    show: {
    		effect:'blind'
    },
    hide: {
    		effect:'blind'
    },
    width: 1100,
    height: 500,
    buttons: {
       
        "Close Dialog": function() {
            $(this).dialog("close");
        }

    }
});


	/*$('#view1').click(function(){

		window.location.replace('view1.php');
	});*/

})
	

var fetchCells = function(){

		$.post('fetchCells.php',function(data){

			var a = 1;
			$.each(data,function(index,value){

				var img;
				
				if (value.Selimg=="Reports") {
					img = "./img/"+value.Selimg+".jpg";
				}else{img = "./img/"+value.Selimg+".png";}

				$("#cellsID2").append("<div id="+value.Selimg+" class='con2' style='background-image: url("+img+");background-size: 110px 112px;background-repeat: no-repeat;background-position: center 25px;'><h3 style='text-align: -webkit-center;margin-top: 77%;font-weight: 700;'>"+value.SelName+"</h3>");
				$("#cellsID2").append("</div>");

			$('#'+value.Selimg).click(function(){
					if(value.Selimg=='Bill_of_Lading'){
						location.href="bill_of_lading.php";
					}else if(value.Selimg=="Warehouse") {
						location.href="warehouse.php";
					}else if(value.Selimg=="Customer_Info"){
						location.href="customerInfo.php";
					}else if(value.Selimg=="Booking"){
						location.href="booking.php";
					}else{
						alert("Not available");
					};
				});
			}) 
		},"json");
	}
</script>

</head>


<body onResize="updateToolbarPos();">


	<div class="scrollingContainer">
	<div class="subContainer">
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div class="buff10"><!-- --></div>
		<div style="clear: left; float: left;"><a href="homepage.php"><img src="./img/CBL.png" alt="" title="" border=0></a></div>
 		<div style="clear: left; padding-left: 5px; height: 30px;" class="normalTextSmall">

 			Welcome!
			<br>
 			<div style="clear: left; float: left; width: 250px;">
			System Date/Time: <span id="systemTimeContent"><? echo $system_time ;?></span>
			</div>
			<div style="float: left;">
			
			Your session will expire in <span id="timerContent"></span>
			
			</div>
 		</div>

 		<div style="clear: left; width: 970px; height: 550px; background-color: #fff; border: solid 1px #999;">

 			<div id="cellsID"></div>
 			<div id="cellsID2"></div>
 			<!--<br style="clear:left;">-->

 		</div>



	<div id="view-dialog" title="Pick view">
    <div style="margin-left: 23px;">

    	<div id="viewPoints" style="margin-left: 29px;
    								margin-top: 50px;">
    		<div id="view1" class='con3' style='background-size: 110px 112px;background-repeat: no-repeat;background-position: center 25px;'><h2 style='text-align: -webkit-center;margin-top: 77%;font-weight: 700;'>WAREHOUSE</h2></div>
    		<div id="view2" class='con3' style='background-size: 110px 112px;background-repeat: no-repeat;background-position: center 25px;'><h2 style='text-align: -webkit-center;margin-top: 77%;font-weight: 700;'>INBOUND SHIPMENT</h2></div>
    		<div id="view3" class='con3' style='background-size: 110px 112px;background-repeat: no-repeat;background-position: center 25px;'><h2 style='text-align: -webkit-center;margin-top: 77%;font-weight: 700;'>OUTBOUND SHIPMENT</h2></div>

    	</div>
    	

    </div>
	</div>


 	   		<div style="clear: both; width: 10px; height: 1px;"></div>
 		</div>
   		<div class="buff10"><!-- --></div>
   		<div class="buff10"><!-- --></div>
		<?
		// get the copyright text from the database
		
		$endtime = microtime();
		$endarray = explode(" ", $endtime);
		$endtime = $endarray[1] + $endarray[0];
		$totaltime = $endtime - $starttime;
		$totaltime = round($totaltime,5);
		?>
		<div style="clear: both; text-align: center;" class="normalTextSmall">
		Page loaded in <? echo $totaltime ?> seconds.<br />
		© Copyright 2010 - 2016 CBL Freight Forwarder and Courier Express Int'l, Inc. All rights reserved.<br />
		
		Powered by <!-- <a href="http://www.entuitivesolutions.com" target="_blank"> -->Komodo`Alil<!-- </a> -->
		</div>
   		<div class="buff10"><!-- --></div>
	</div>
</div>

</body>