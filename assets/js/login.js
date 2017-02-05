


toastr.options = {
  "preventDuplicates": true,
  "positionClass": "toast-top-center"
}



$(document).ready(function(){

	var usr;
	var pss;
	$( document ).tooltip({
      track: true
    });
	validation();
	subValidation();

});


	var validation = function(){
		$('.txtField').bind({
			keypress: function(){
				//alert(123);
			}
		})


	};

	function relocate(){

		window.location="homepage.php";
	}

	var subValidation = function(){
							
		$('#sub').bind({
			click:function(e){
			e.preventDefault();
			//Do some validation here for txtFields
			var usr = $('#usrname').val();
			var pas = $('#usrpass').val();
			var error = '';
				if(usr.trim()==''){
					error +="Username must not be empty!<br>";
				}
				if(pas.trim()==''){
					error +="Password must not be empty!";
				}

				if(error!=''){
					toastr["error"](error);
				}else{
					$('.loader').show();
					$('#loginForm').hide();
					$.post('login.php',{usr:usr,pss:pas},function(data){
						var a; 
						$.each(data,function(index,value){
							a = data.feedstatus;
						});

							$('.loader').hide();
							$('#loginForm').show();
							if(a==0){
								toastr["error"]("User Account does not exist.");
							}else if(a==1){
								toastr["error"]("The Password you entered was incorrect.");
							}else if(a==2){									
									toastr["success"]("successfully logged in!");
									$('.loader').show();
									$('.loader').html('Redirecting...');
									$('#loginForm').hide();
									setTimeout(relocate, 2000);
							}else{
								toastr["error"]("Invalid username or password.");
							}

					},"json");

				}


			},
			mouseenter:function(){
				$(this).css({"cursor":"pointer"});
			}
		});
	}

