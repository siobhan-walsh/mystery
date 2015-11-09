<!DOCTYPE html>
<html>
  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>Sign Up</title>
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/mediaqueries.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>

    <body> 
        
        <div id='device'>  
            <div class='scroll'>
                <div class = 'header'>
                    <div><img src = 'img/logo.png'></div>

                </div>


                <div class = 'content'>

                    <div class= 'hspace'>
                        <h2>Sign Up</h2>
                        <p>Already have an account? <a href = 'login.html'>Log in!</a></p>
                    </div>
                    <div class='center'>

                        <input type='text' id='fname' class='textbox'  placeholder="first name" oninput ="checkname(this);" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>

                        <input type='text' id='lname' class='textbox' placeholder="last" oninput ="checkname(this);" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$'>

                        <input type='email' id='email' class='textbox' placeholder="email@example.com" maxlength="70">

                        <input type='text' id='username' class='textbox' placeholder="username" required = 'true' oninput ="checkname(this);" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>

                        <input type='password' id='pw' class='textbox' placeholder="password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" onblur ="checkpass(this);" >

                        <input type='password' id='pwRetype' class='textbox' placeholder="retype password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" onblur ="checkpass(this);">

                        <input type='button' id='signup'  class='buttons' value="Sign up!">
                        <input type='button' id='fbbutton' class='buttons' value="Sign up with facebook">
                    </div>

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
                //var input = document.querySelector('input');
            
              
                
                signupbtn.onclick = function() {
                    
                    success();
                    console.log("clicked");
                 
                    //send stuff to database 
					
					$.ajax({
						url:"server.php",
						type:"post",
						dataType:"json",
						data:{
							mode:1, //0 to get all users, 1 is to get a specific user
							un:un,
							pw:pw
							
							},
						success:function(resp){
							
							console.log("yaya success resp is:", resp);	
							
							var msgDiv = document.getElementById('msg');
							
							
							
							for(i = 0; i< resp.length; i++){
								var newh3 = document.createElement('h3');
					
								newh3.innerHTML = "hi " + resp[i].username + ", your password is: " + resp[i].password + "<br>";
								
								msgDiv.appendChild(newh3);
								
								if(resp[i].img != null){
									var newimg = document.createElement('img');
									newimg.src = resp[i].img;
									newh3.appendChild(newimg);	
								}
								
							}
							
							
						}
						
					});	
					  
                };
                
                
            
                function success(){
                        var tyDiv = document.createElement('div');

                        document.body.appendChild(tyDiv);
                        tyDiv.innerHTML = "<p>Hey " + fname.value + ", thank you for making an account! Please check your email for a confirmation link.</p>";
                        tyDiv.style.position = 'fixed';
                        tyDiv.style.top = '200px';
                        tyDiv.style.backgroundColor = '#C4FFe6';
                        tyDiv.style.width = '80vw';
                        tyDiv.style.left = '10vw';
                        tyDiv.style.padding = '30px 10px ';
                        tyDiv.style.boxShadow = "4px 4px 4px #666666";


                    }
            
          
        

        
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