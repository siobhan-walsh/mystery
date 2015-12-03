<?php
	include("head.php");
?>

    <body> 
 
        <div class = 'tablet-size'>
        <div class = 'scroll'>   
        
        <div class = 'content'>
            
            
            <div><img class = 'biglogo' src = 'img/logo.png'></div>
          
            <div class='login-buttons'>
                
                
                <a href = 'login.php'><input type='button' class='buttons' id='loginbutton' value="Login"></a>
                <a href = 'signup.php'><input type='button' id='signupbutton' class='buttons' value="Sign up"></a>
                <input type='button' id='fbbuttonIn' class='buttons' value="Log in with facebook"> 
               
            </div>
            
        </div>

        <div class = 'footer'>
        
        </div>
        </div>
        
        </div>
<script src="js/fblogin.js"></script>        


<!--
    <script>
        window.onload = function(){

         //signup with fb

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '989824554418300',
      xfbml      : true,
      version    : 'v2.5'
    });
  
      
      
      var but = document.getElementById("fbbuttonIn");
      var userinfo = document.getElementById("userinfo");
      but.onclick = function(){
		  FB.getLoginStatus(function(fbresp){
				but.style.backgroundColor="#3b5998";
				console.log("login status is", fbresp);	
				
				if(fbresp.status == "connected"){
						//document.body.removeChild(logBtn);
						FB.api("/me",{fields: 'first_name,last_name,gender,email,picture'},function(fbresp1){
						
                            
							
							console.log("resp1 is", fbresp1);	
							var fname = fbresp1.first_name;
							var lname = fbresp1.last_name;
							var un = fname + lname;
							var pw = fbresp1.id;
							var avatar = fbresp1.picture.data.url;
                            var email = fbresp1.email;
							
							console.log("un is", un);
							console.log("pw is", pw); 
							console.log('avatar is', avatar);
							
							
							$.ajax({
								url:"server/signup-server.php",
								type:"POST",
								dataType:"JSON",
								data:{
									
									un:un,
									pw:pw,
									fname:fname,
									lname:lname,
									email:email,
									avatar: avatar
									
									
									},
								success:function(signupresp){
									
									console.log("yaya success resp is:", signupresp);	
								
									
										$.ajax({
											url:"server/login-server.php",
											type:"POST",
											dataType:"JSON",
											data:{
											
												un:signupresp.un,
												pw:signupresp.pw
												
												},
											success:function(loginresp){
												
												console.log("loginresp is:", loginresp);	
												
												if(loginresp.status == 'success'){
													
													window.location = "direction.php"
													
													console.log("ya you're logged in ok");
													
												} else if(loginresp.status == 'fail'){
													
													document.getElementById('warn').innerHTML = "Sorry, that is not the correct username or password";
														
												}
												
												
												
											},
											 error: function(jqXHR, textStatus, errorThrown) {
														//console.log(jqXHR.statusText, textStatus, errorThrown);
														console.log(jqXHR.statusText, textStatus);
												  
											
										
											}
											
										});	
												  
								
								},
								 error: function(jqXHR, textStatus, errorThrown) {
									console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log(jqXHR.statusText, textStatus);
									console.log("blah error signupu");
					
				
								}
							});	
							
							
					

						});

				} else {
					
					console.log("it did not connect");
					
				};
				
			});
		  
	
  };};

  (function(d, s, id){  
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


            
        };
         
  
    </script> 
    --> 
    </body>
</html>