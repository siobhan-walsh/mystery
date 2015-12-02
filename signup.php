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
                <div class = 'content'>

                    <div class= 'hspace'>
                        <h2>change</h2><br>
                        <p>Already have an account? <a href = 'login.php'>Log in!</a></p><br>
                    </div>
                    <div class='center'>

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
                       <input type='button' id='fbbutton' class='buttons' value="Sign up with facebook"> 
                    </div>

                </div>
			<div class='underfooter'></div>
            <div class = 'footer'>

            </div>
            </div>

    <script src="js/buttons.js"></script> 
    
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
			
			
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '989824554418300',
      xfbml      : true,
      version    : 'v2.5'
    });
      console.log(FB);
      
      
      var but = document.getElementById("fbbutton");
      var userinfo = document.getElementById("userinfo");
      but.onclick = function(){
          	  FB.login(function(resp){
        console.log("resp is", resp);
          if(resp.status == "connected"){
			  
			  console.log('connected!');
	
            alert("You Logged in");
			

			
          
		  FB.getLoginStatus(function(fbresp){
				
				console.log("login status is", fbresp);	
				
				if(fbresp.status == "connected"){
						//document.body.removeChild(logBtn);
						FB.api("/me",{fields: 'first_name,last_name,gender,email,picture'},
                               
                function(fbresp1){
						
                            
							
							console.log("resp1 is", fbresp1);	
 FB.login(function(response) {
     if (response.authResponse) {
               console.log('Welcome!  Fetching your information.... ');
               FB.api('/me', function(response) {
                   console.log('Good to see you, ' + response.email + '.');
                   alert('Good to see you, ' + response.email + '.');
               });
            
							var fname = fbresp1.first_name;
							var lname = fbresp1.last_name;
							var un = fname + lname;
							var pw = fbresp1.id;
							var avatar = fbresp1.picture.data.url;
                            var email = fbresp1.email;
							
							console.log("un is", un);
							console.log("pw is", pw); 
							console.log(JSON.stringify(fbresp1));
						$.ajax({
								url:"server/signup-server.php",
								type:"POST",
								dataType:"JSON",
								data:{

									fname:fname,
									lname:lname,
                                    email:email,
									
									un:un,
									pw:pw,
									               avatar:fbresp1.picture.data.url
									
									
                                },
								success:function(resp){
									
									console.log("yaya success resp is:", resp);	
									
									console.log("resp.first_name");
									
												
							
							var tyDiv = document.createElement('div');
							document.body.appendChild(tyDiv);
							tyDiv.innerHTML = "<p>Hey " + resp.un + ", thank you for making an account! <button class='buttons' id='getstarted'>get started</button></p>";
							tyDiv.style.position = 'fixed';
							tyDiv.style.top = '200px';
							tyDiv.style.backgroundColor = '#C4FFe6';
							tyDiv.style.width = '80vw';
							tyDiv.style.left = '10vw';
							tyDiv.style.padding = '30px 10px ';
							tyDiv.style.boxShadow = "4px 4px 4px #666666";
							
							
									
									var start = document.getElementById('getstarted');
									
									start.onclick = function(){
										
										
										$.ajax({
											url:"server/login-server.php",
											type:"POST",
											dataType:"JSON",
											data:{
												
											mode:'login',
												un:un,
												pw:pw
												
												},
											success:function(resp2){
												
												console.log("yaya success resp is:", resp2);	
												
												if(resp2.status == "success"){
													

												window.location="themes.php" ;				
													
													
												} else {
													
			window.location="login.php" ;
														
												}
												
												
												
											},
											error:function(err){
												console.log("sorry there was an error"); 	
											}
											
										});	
										
										
									};
										
									
								},
								error:function(err){
									console.log("sorry there was an error"); 	
								}
								
							});	
							  
				} else {
                console.log('User cancelled login or did not fully authorize.');
            }
        },
   // handle the response
  {scope: 'public_profile,email'});
							
						});
                   
					 	
						
				} else {
					
					console.log("it did not connect");
					
				};
				
			});
		  
          }
          if(resp.status == "unknown") {
            alert("Login Failed");
             
          }
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