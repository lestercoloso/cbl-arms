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

	var subValidation = function(){

		$('#sub').bind({
			click:function(){
			//Do some validation here for txtFields
			$.post('login.php',{usr:$('#usrname').val(),pss:$('#usrpass').val()},function(data){

				
				var a; 
				$.each(data,function(index,value){
					a = data.feedstatus;
				});
					if(a==0){
						alert('User Account does not exist.');
					}else if(a==1){
						alert("The Password you entered was incorrect.");
					}else if(a==2){
						window.location="homepage.php";
					}else{
						alert('Invalid username or password.');
					}

			},"json");
			},
			mouseenter:function(){
				$(this).css({"cursor":"pointer"});
			}
		});
	}