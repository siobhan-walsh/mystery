// signup 

$(document).ready(function(){
                
                var signupbtn = document.getElementById('signup');
                var fname = document.getElementById('fname');
                var lname = document.getElementById('lname');
                var email = document.getElementById('email');
                var un = document.getElementById('username2');
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
				
				function validation(){
		
					var nval = document.querySelectorAll('.nval');
					var p = document.createElement('p');
					
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
											this.setCustomValidity("Please fill this out");
										  
											
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
				};
				
				validation();
					
			  
			  
                
                signupbtn.onclick = function() {
                    
                    
                    
				
                
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
							avatar: "img/friends/" + document.querySelector('input[name="avi"]:checked').value +".png"
							
							
							},
						success:function(signupresp){
							
							console.log("yaya success resp is:", signupresp);	
							
							if(signupresp.account == 'hasaccount'){
										
										document.getElementById('content').innerHTML = '<p class = "hspace" >You already have an account, please go to <a href = "login.php">login</a></p>'
										
							} else if(signupresp.msg == 'missing'){
										
										document.getElementById('content').innerHTML = '<p class = "hspace" >Due to an error, we were unable to create an account for you, <a href = "signup.php">please try again</a></p>'
										
							} else {
							
								$.ajax({
									url:"server/login-server.php",
									type:"POST",
									dataType:"JSON",
									data:{
									
										email:signupresp.email,
										pw:signupresp.pw
										
										},
									success:function(loginresp){
										
										console.log("loginresp is:", loginresp);	
										
										
										
										if(loginresp.status == 'success'){
											
											window.location = "direction.php"
											
											
											
										} else if(loginresp.status == 'fail'){
											
											console.log('login problems');
											//window.location = 'login.php'
										
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
				
					  
		
						}
					});	
					  
                };
                
              
        });