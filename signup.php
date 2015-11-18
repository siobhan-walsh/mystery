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
                        <h2>Sign Up</h2><br>
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
				
				
					pw.addEventListener("blur",
						function checkpass(){
							
							if(pw.validity.patternMismatch){
								
								pw.setCustomValidity("Please enter a password with 1 Uppercase, 1 lowercase, and a number");			
								$("<p id ='p'><small>Please enter a password with 1 Uppercase, 1 lowercase, and a number</small></p>").insertAfter(pw);
								
							} else if(this.validity.valueMissing) {
						   
						   		this.setCustomValidity("Please enter a password with 1 Uppercase, 1 lowercase, and a number");	
								$("<p id ='p'><small>Please enter a password with 1 Uppercase, 1 lowercase, and a number</small></p>").insertAfter(pw);
					 	 	} else{
								 $('#p').remove();
							}
						 
						});
							
					pwRetype.addEventListener("blur",
						function(){	
							if(pw.value != pwRetype.value){
								
								pw.style.borderColor = "#ffccee";
								pw.setCustomValidity("Your passwords don't match");
								pwRetype.style.borderColor = "#ffccee";
								pwRetype.setCustomValidity("Your passwords don't match");
								
								
								$("<p id ='pm'><small>Your passwords don't match</small></p>").insertAfter(pwRetype);
								
								
							} else if(pw.value == pwRetype.value){
								pw.style.borderColor = "#ffffff";
								pw.setCustomValidity("");
								pwRetype.style.borderColor = "#ffffff";
								pwRetype.setCustomValidity("");
								
								$('#p').remove();
								
								 
                				validpw = true;
								
							}
							
						}
						
				);
						
					
				
				
				
				for(var i = 0; i < nval.length; i++){    
            
					nval[i].addEventListener("input", 
					
	   
						function checkname(){
							if(this.validity.patternMismatch) {
								
								this.setCustomValidity("Please enter a name between 2-20 characters");
								
								
								$("<p id ='s" + i + "'><small>Please enter a name between 2-20 characters</small></p>").insertAfter(this);
								
							  } 
		
							   else if(this.validity.valueMissing) {
									this.setCustomValidity("You must enter a name");
								  
									
									$("<p id ='s" + i + "'><small>Please enter a name between 2-20 characters</small><p>").insertAfter(this);
								   
								
							  } else if(this.validity.typeMismatch){
								   this.setCustomValidity("Please enter a valid email address");
								  	
									p.innerHTML = "<small>Please enter a valid email address</small>";
									//this.appendChild(p);
									$(this).after(p);
								 
							  } else {
								  this.setCustomValidity("");
								  
								  $('#s' + i).remove();
								  p.innerHTML = "";
								  validnames = true;
								  
							  }
						 
						}
								
								
						//myScript
						
						);
				
			}
			  
			  
			  
                
                signupbtn.onclick = function() {
                    
                    
                    
					avatar = document.querySelector('input[name="avi"]:checked').value;
                
					console.log("clicked", avatar);
					//var avatar = "<img src='" + avi + ".png'>";
					
				  
                    //send stuff to database 
					
					$.ajax({
						url:"server.php",
						type:"POST",
						dataType:"JSON",
						data:{
							
							mode:'signup',
							fname:fname.value,
							lname:lname.value,
							email:email.value,
							un:un.value,
							pw:pw.value,
							avatar: "img/friends/" + avatar +".png"
							
							
							},
						success:function(resp){
							
							console.log("yaya success resp is:", resp);	
							
							console.log("resp.first_name");
							
							
							var tyDiv = document.createElement('div');

							document.body.appendChild(tyDiv);
							tyDiv.innerHTML = "<p>Hey " + resp.first_name + ", thank you for making an account! <button class='buttons' id='getstarted'>get started</button></p>";
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
									url:"server.php",
									type:"POST",
									dataType:"JSON",
									data:{
										
										mode:'login',
										un:un.value,
										pw:pw.value
										
										},
									success:function(resp){
										
										console.log("yaya success resp is:", resp);	
										
										if(resp == 'yes'){
											
											window.location = "/themes.php";
											
											
											
										} else if(resp == 'no'){
											
											window.location = "/login.php"
												
										}
										
										
										
									},
									error:function(err){
										console.log("sorry there was an error"); 	
									}
									
								});	
								
								
							}
								
							
						},
						error:function(err){
							console.log("sorry there was an error"); 	
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
		  FB.getLoginStatus(function(fbresp){
				
				console.log("login status is", fbresp);	
				
				if(fbresp.status == "connected"){
						//document.body.removeChild(logBtn);
						FB.api("/me",{fields: 'first_name,last_name,gender,email,picture'},function(fbresp1){
						
                            
							
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
								url:"server.php",
								type:"POST",
								dataType:"JSON",
								data:{
									
									mode:'signup',
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
									tyDiv.innerHTML = "<p>Hey " + resp.first_name + ", thank you for making an account! <button class='buttons' id='getstarted'>get started</button></p>";
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
											url:"server.php",
											type:"POST",
											dataType:"JSON",
											data:{
												
												mode:'login',
												un:un.value,
												pw:pw.value
												
												},
											success:function(resp){
												
												console.log("yaya success resp is:", resp);	
												
												if(resp == 'yes'){
													
													window.location = "/themes.php";
													
													
													
												} else if(resp == 'no'){
													
													window.location = "/login.php"
														
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
		  
	  
  
      FB.login(function(resp){
        console.log("resp is", resp);
          if(resp.status == "connected"){
			  
			  console.log('connected!');
	
            alert("You Logged in");
			
			window.location="/themes.php" ;
			
            var txt = "Welcome!" ;
              document.write("<p>Link: " + txt.link("themes.php") + "</p>");
              
             
			
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
 