<head>
<title>User Login</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./libraries/styles.css" type="text/css" />
<link rel="stylesheet" href="/bower_components/jquery-ui/themes/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="/bower_components/toastr/toastr.min.css" />
<link rel="stylesheet" href="/assets/css/login.css?2313122" type="text/css" />
</head>
<body style="background-color: #cccccc;">
	<div id="mainBody">
		<div id="subBody">
			<div id="log-Body">

				<div class="loader">
					<i class="fa fa-spinner fa-spin" style="font-size:24px"></i><em>Loading...</em>
				</div>

				<form id="loginForm">
						<h2>User Login</h2>
						<div class="formlogin"><span>User ID</span><input class="txtField" id="usrname" name="login" type="text"></div>
						<div class="formlogin"><span>Password</span><input class="txtField" id="usrpass" name="pass" type="password" >
						<b id="sub"><a><u>Login:.</u></a></b></div>
						<p class="loginfoot"><a href="#" id="loginFormForgotPassword" title="Please contact CBL System Administrator for Change in Password.">Forgot Password?</a> &nbsp; &bull; &nbsp; <a href="#">No User ID?</a> 
				</form>
				
			</div> 

		</div>
		<br>
			<p style="text-align: center;width: 100%;    font-family: cursive;"> 
			© Copyright <b>CBL WMS</b> All rights reserved.<br>
			Powered by <b>ARM Solutions</b>
			</p>		

	</div>


<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/bower_components/toastr/toastr.min.js"></script>
<script src="/assets/js/login.js?2399"></script>


</body>