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

                <div class= 'hspace message'>
                    <h2>Log in</h2><br>
                    <p>Don't have an account yet? <a href = 'signup.php'>Sign up!</a></p><br>
                </div>
                <div class=' center'>
                	<div class="container">
                        <form class="form">
                            <h1>Welcome</h1>
                            <span id='warn' style='color:red'></span>
                            <input type='email' id='email' class='textbox' placeholder="email" required='true'>
                            <input type='password' id='password' class='textbox' placeholder="password" required='true'>
                            
                           <input type='button' class='buttons2' id='loginbtn' value="Login">
                          
                    	</form>
                    </div>
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
                <div class ='underfooter'></div>
                <div class = 'footer'>
                </div>
           
            
        
  			
       </div> 


    <script src = 'js/login.js'></script>  
    </body>
</html>