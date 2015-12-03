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
				
				validation();
					
			  
			  
                
                signupbtn.onclick = function() {
                    
                    
                    
					avatar = document.querySelector('input[name="avi"]:checked').value;
                
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
										
										
										
										if(loginresp.status == 'success'){
											
											window.location = "direction.php"
											
											
											
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
				
					  
		
						}
					});	
					  
                };
                
              
        });