<head>
<title>User Login</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./libraries/styles.css" type="text/css" />
<link rel="stylesheet" href="/bower_components/jquery-ui/themes/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />
<link rel="stylesheet" href="/assets/css/login.css?lester" type="text/css" />
</head>
<body style="background-color: #cccccc;">


	<div id="mainBody">
<div class="login_container">
	<div class="login_top">
	<div class="login_img_container login_logo"> 
		<img src="img/img-first.png">
		<div>CBL Warehouse Management System</div>
	</div>
	<div class="login_img_container"> <img src="img/img-second.png"></div>
	</div>
	<div class="login_bottom">
		<div class="login_img_container symbol">
			<img src="img/img-third.png">
		</div>
		<div class="login_img_container slant"></div>

		<div class="login_img_container" id="log-Body">
			


				<div class="loader">
					<i class="fa fa-spinner fa-spin" style="font-size:24px"></i><em>Loading...</em>
				</div>

				<form id="loginForm">
						<h2>User Login</h2>
						<div class="formlogin"><span>User ID</span><input class="txtField" id="usrname" name="login" type="text"></div>
						<div class="formlogin"><span>Password</span><input class="txtField" id="usrpass" name="pass" type="password" >
						<b id="sub"><a><button  style="text-decoration: none;">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button></a></b></div>
						<p class="loginfoot"><a href="#" id="loginFormForgotPassword" title="Please contact CBL System Administrator for Change in Password.">Forgot Password?</a> &nbsp; &bull; &nbsp; <a href="#">No User ID?</a> 
				</form>
				
			


		</div>
	</div>
</div>
		<br>
		<div>
			<p class="footer"> 
			© Copyright <b>CBL WMS</b> All rights reserved.<br>
			Powered by <b>ARM Solutions</b>
			</p>	
		</div>	

	</div>





<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/assets/js/login.js?2399"></script>


</body>