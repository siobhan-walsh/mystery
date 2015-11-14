<?php
	
	
	include("head.php");
	include("header.php");
	

?>
                <div class = 'content'>

                    <div class= 'hspace'>
                        <h2>Sign Up</h2>
                        <p>Already have an account? <a href = 'login.php'>Log in!</a></p>
                    </div>
                    <div class='center'>

                        <input type='text' id='fname' class='textbox'  placeholder="first name" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>

                        <input type='text' id='lname' class='textbox' placeholder="last" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$'>

                        <input type='email' id='email' class='textbox' placeholder="email@example.com" maxlength="70">

                        <input type='text' id='username' class='textbox' placeholder="username" required = 'true' pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>

                        <input type='password' id='pw' class='textbox' placeholder="password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" >

                        <input type='password' id='pwRetype' class='textbox' placeholder="retype password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" >

                        <input type='button' id='signup'  class='buttons' value="Sign up!">
                        <input type='button' id='fbbutton' class='buttons' value="Sign up with facebook">
                    </div>

                </div>

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
               
            
              
                
                signupbtn.onclick = function() {
                    
                    
                    console.log("clicked");
                 
                    //send stuff to database 
					
					$.ajax({
						url:"server.php",
						type:"POST",
						dataType:"JSON",
						data:{
							
							fname:fname.value,
							lname:lname.value,
							email:email.value,
							un:un.value,
							pw:pw.value
							
							},
						success:function(resp){
							
							console.log("yaya success resp is:", resp);	
							
							console.log("resp.first_name");
							var tyDiv = document.createElement('div');

							document.body.appendChild(tyDiv);
							tyDiv.innerHTML = "<p>Hey " + resp.first_name + ", thank you for making an account! <a href='themes.php'>Go check out our different themes to start a game!</a></p>";
							tyDiv.style.position = 'fixed';
							tyDiv.style.top = '200px';
							tyDiv.style.backgroundColor = '#C4FFe6';
							tyDiv.style.width = '80vw';
							tyDiv.style.left = '10vw';
							tyDiv.style.padding = '30px 10px ';
							tyDiv.style.boxShadow = "4px 4px 4px #666666";
								
							
						},
						error:function(err){
							console.log("sorry there was an error"); 	
						}
						
					});	
					  
                };
                
                
            
            
        
                function checkpass(input){
                    
                    if(input.validity.patternMismatch){
                        
                        input.setCustomValidity("Please enter a password with 1 Uppercase, 1 lowercase, and a number");
                        
                    } else if(pw.value != pwRetype.value){
                        
                        console.log("THEY DOnT MATCH");
                        console.log("pw", pw.value);
                        console.log("pwRetype", pwRetype.value);
                        input.style.borderColor = "#ffccee";
                        input.setCustomValidity("Your passwords don't match");
                        
                        
                    } else if(pw.value == pwRetype.value){
                        input.style.borderColor = "#ffffff";
                        input.setCustomValidity("");
                        validpw = true;
                        console.log("the pw good", validpw);
                        
                    }
                    
                }
                
                   
        function checkname(input){
                    if(input.validity.patternMismatch) {
                        
                        input.setCustomValidity("Please enter a name between 2-20 characters");
                        console.log("the things good", validnames);

                      } 

                       else if(input.validity.valueMissing) {
                           input.setCustomValidity("You must enter a name!");
                           console.log("the things good", validnames);

                      } else if(input.validity.typeMismatch){
                           input.setCustomValidity("Please enter a valid email address");
                          console.log("the things good", validnames);
                          
                      }else {
                          input.setCustomValidity("");
                          
                          validnames = true;
                          console.log("the things good", validnames);
                
                          
                      }
                 
                }
        }
        
  );
    </script>  
    </body>
</html>