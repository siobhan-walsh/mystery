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
<div class="wrapper">
                <div class= 'hspace message'>
                    <h2>Log in</h2><br>
                    <p>Don't have an account yet? <a href = 'signup.php'>Sign up!</a></p><br>
                </div>
                <div class=' center'>
                	<div class="container">
							<form class="form">
                   <h1>Welcome</h1>
                    <span id='warn' style='color:red'></span>
                    <input type='text' id='username' class='textbox' placeholder="username" required='true'>
                    <input type='password' id='password' class='textbox' placeholder="password" required='true'>
                    
                   <!-- <p class='right-text '><small>Forgot your password?</small></p><br>
                    
                   
                   
                   <img src='img/enter-btn.png' id='enter'> 
                   
                   -->
                   <input type='button' id='loginbtn' class='buttons' value="Login">
                  <!--  <input type='button' id='fbbutton' class='buttons' value="Login through facebook">
                   		
                    <button id='check'>check</button> -->
                    		</form>
                    			</div>
                </div>
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
        
  			
       </div> 
    <script src="js/buttons.js"></script>    

    <script>
	
	var un = document.getElementById('username');
	var pw = document.getElementById('password');
	var loginbtn = document.getElementById('loginbtn');
	var check = document.getElementById('check');
	
	loginbtn.onclick = function(){
		document.getElementById('warn').innerHTML = '';
		$.ajax({
			url:"server/login-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
			
				un:un.value,
				pw:pw.value
				
				},
			success:function(resp){
				
			
				
				if(resp.status == 'success'){
					
					window.location = "direction.php"
					
				} else if(resp.status == 'fail'){
					
					document.getElementById('warn').innerHTML = "Sorry, that is not the correct username or password";
						
				}
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log(jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
					  
              
	
		
		
	};
	
    </script>  
    </body>
</html>