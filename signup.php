<?php
	
	
	include("head.php");
	
?>
<body> 
        
	<div class = 'tablet-size'>	
    	<div class = 'scroll'>
            <div class = 'header'>
               
                <div class='blogo'><img src = 'img/logo.png'></div>
                
            </div> 
           
            <div id = 'content' class = 'content'>
            

                        
                 
                    
                    <div class='center'>
                    <p>Already have an account? <a href = 'login.php'>Log in!</a></p>
                        <div class="container">
                        
                            <form class="form">
                       			<h1>Welcome</h1>
                                
                                <input type='button' id='fbbutton' class='buttons' value="Sign up with facebook"> 
                                
                                <h2>Or sign up below:</h2>
                                
                            	<input type='text' id='fname' class='nval textbox'  placeholder="first name" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>
    
                            	<input type='text' id='lname' class='nval textbox' placeholder="last" pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$'>
    
                            	<input type='email' id='email' class='nval textbox' placeholder="email@example.com" maxlength="70">
    
                            	<input type='text' id='username2' class='nval textbox' placeholder="username" required = 'true' pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' max-length='20'>
    
                            	<input type='password' id='pw' class='textbox' placeholder="password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" >
    
                            	<input type='password' id='pwRetype' class='textbox' placeholder="retype password" required = 'true' pattern = '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' maxlength="20" >
                            
                           
                           		<br>
                            	<p style='font-size:16px'>Choose an avatar:</p>
                            
                            	<input type="radio" name="avi" value="f1" id="f1">
                            	<label for="f1"><img src="img/friends/f1.png"></label>
    
                            	<input type="radio" name="avi" value="f2" id="f2">
                            	<label for="f2"><img src="img/friends/f2.png"></label>
                            
                            	<input type="radio" name="avi" value="f4" id="f4">
                            	<label for="f4"><img src="img/friends/f4.png"></label>
                           
                            	<br><br>
                            	<input type='button' id='signup'  class='buttons' value="Sign up!">
                          </form>
                    </div>
                </div>
                
        		<div class="wrapper">
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                  </div>

        	</div>
        </div>
        
        <div class='underfooter'></div>
        <div class = 'footer'>

        </div>
	
</div>
    <script src="js/validating.js"></script> 
    <script src="js/signup.js"></script> 
    <script src="js/fblogin.js"></script> 
</body>
</html>