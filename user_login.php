<head>
<title>User Login</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./libraries/styles.css" type="text/css" />
<link rel="stylesheet" href="/bower_components/jquery-ui/themes/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />
<link rel="stylesheet" href="/assets/css/login.css" type="text/css" />
</head>
<body style="background-color: #cccccc;">
	<div id="mainBody">
		<div id="subBody">
			<div id="logBody">
				<img src="./img/login_header.png" style="width:inherit;">

				<div class="loader">
					<i class="fa fa-spinner fa-spin" style="font-size:24px"></i><em>Loading...</em>
				</div>

				<form id="loginForm">
					<div style="padding-top:20px;padding-left: 20%">
						<div><span style="	padding-left: 20px;
    										padding-right: 10px;"> User ID</span><input class="txtField" id="usrname" name="login" type="text"></div>
						<div style=" 		padding-top: 5px;"><span style="	padding-right: 17px;"> Password</span><input class="txtField" id="usrpass" name="pass" type="password" ></div>
						<div><button id="sub" style="border-color: white;
    										background: white;
    										margin-left: 130px;
    										border: none;"><a><img src="./img/button_login.gif"></a></button></div>
					</div>
					<p style="padding-left: 20%;"><a href="#" id="loginFormForgotPassword" title="Please contact CBL System Administrator for Change in Password.">Forgot Password?</a>
				</form>
				
			</div> 
			<p style="margin-left:12px;margin-top:110px;font-weight:bolder; bottom:85; left:0; z-index: 50; font-size:11px; color:black;"> 
			© Copyright 2010 - 2016 CBL Freight Forwarder and Courier Express Int'l, Inc. All rights reserved.</p>


			<img id="footimg" src="./img/login_footer.jpg">
		</div>
		

	</div>


<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/assets/js/login.js?232"></script>


</body>