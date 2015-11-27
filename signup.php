<?php
	
	
	include("head.php");
	
?>
<body> 
        
	<div class = 'tablet-size'>	
    	<div class = 'scroll'>
            <div class = 'header'>
                <br><br>
                <div class='blogo'><img src = 'img/logo.png'></div>
                
            </div> 
                <div id = 'content' class = 'content'>

                    <div class= 'hspace'>
                        <h2>Sign Up</h2><br>
                        <p>Already have an account? <a href = 'login.php'>Log in!</a></p><br>
                    </div>
                    <div class='center'>
						<input type='button' id='fbbutton' class='buttons' value="Sign up with facebook"> 
                        
                        <input type='text' id='fname' class='nval textbox'  placeholder="first name" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>

                        <input type='text' id='lname' class='nval textbox' placeholder="last" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$'>

                        <input type='email' id='email' class='nval textbox' placeholder="email@example.com" maxlength="70">

                        <input type='text' id='username' class='nval textbox' placeholder="username" required = 'true' pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>

                        <input type='password' id='pw' class='textbox' placeholder="password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" >

                        <input type='password' id='pwRetype' class='textbox' placeholder="retype password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" >
                        
                        <input type="radio" name="avi" value="f1" id="f1">
						<label for="f1"><img src="img/friends/f1.png"></label>

						<input type="radio" name="avi" value="f2" id="f2">
						<label for="f2"><img src="img/friends/f2.png"></label>
                        
                        <input type="radio" name="avi" value="f4" id="f4">
						<label for="f4"><img src="img/friends/f4.png"></label>
                       
                        <br><br>
                        <input type='button' id='signup'  class='buttons' value="Sign up!">
                       
                    </div>

                </div>
			<div class='underfooter'></div>
            <div class = 'footer'>

            </div>
            </div>

    <script src="js/buttons.js"></script> 
    <script src='js/validating.js'></script>

    
    <script>
        $(document).ready(function(){
                
                var signupbtn = document.getElementById('signup');
                var fname = document.getElementById('fname');
                var lname = document.getElementById('lname');
                var email = document.getElementById('email');
                var un = document.getElementById('username');
                var pw = document.getElementById('pw');
                var pwRetype = document.getElementById('pwRetype');
                var validnames = false;
                var validpw = false;
				var nval = document.querySelectorAll('.nval');
				var msg = document.createElement('span');
				var radio = document.getElementsByName("avi");
                var avatar = "";
				var p = document.createElement('p');
				
				
              	//validating while inputing:
				
				validation();
					
			  
			  
                
                signupbtn.onclick = function() {
                    
                    
                    
					avatar = document.querySelector('input[name="avi"]:checked').value;
                
					console.log("clicked", avatar);
					//var avatar = "<img src='" + avi + ".png'>";
					
				  
                    //send stuff to database 
					
					$.ajax({
						url:"server/signup-server.php",
						type:"POST",
						dataType:"JSON",
						data:{
							
							un:un.value,
							pw:pw.value,
							fname:fname.value,
							lname:lname.value,
							email:email.value,
							avatar: "img/friends/" + avatar +".png"
							
							
							},
						success:function(signupresp){
							
							console.log("yaya success resp is:", signupresp);	
							
							if(signupresp.account == 'hasaccount'){
										
										document.getElementById('content').innerHTML = '<p class = "hspace" >You already have an account, please go to <a href = "login.php">login</a></p>'
										
							} else {
							
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
										
										
										
										if(loginresp.account == 'success'){
											
											window.location = "themes.php"
											
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
										  
							};
						
						},
						 error: function(jqXHR, textStatus, errorThrown) {
							console.log(jqXHR.statusText, textStatus, errorThrown);
							console.log(jqXHR.statusText, textStatus);
					  		console.log("blah error signupu");
			
		
						}
					});	
					  
                };
                
              
        });
			

//signup with fb

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '989824554418300',
      xfbml      : true,
      version    : 'v2.5'
    });
  
      
      
      var but = document.getElementById("fbbutton");
      var userinfo = document.getElementById("userinfo");
      but.onclick = function(){
		  FB.getLoginStatus(function(fbresp){
				
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



    </script>  
 	  