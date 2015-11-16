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
                    <p>Don't have an account yet? <a href = 'signup.php'>Sign up!</a></p>
                </div>
                <div class='center'>

                    <span id='warn' style='color:red'></span>
                    <input type='text' id='username' class='textbox' placeholder="username">
                    <input type='password' id='password' class='textbox' placeholder="password">
                    
                    <p class='right-text '><small>Forgot your password?</small></p>
                   <!-- 
                   
                   <button id="loginFB">Login with Facebook</button>
                   <img src='img/enter-btn.png' id='enter'> 
                   
                   -->
                   <input type='button' id='loginbtn' class='buttons' value="Login">
                    <input type='button' id='fbbutton' class='buttons' value="Login through facebook">
                    <button id='check'>check</button>
                </div>

            </div>
        
        	<div class ='underfooter'></div>
            <div class = 'footer'>

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
								
								//window.location = "/themes.php"
								
								
							} else if(resp == 'no'){
								
								document.getElementById('warn').innerHTML = "Sorry, that is not the correct username or password";
									
							}
							
							
							
						},
						error:function(err){
							console.log("sorry there was an error"); 	
						}
						
					});	
					  
              
	
		
		
	};
	
	
	check.onclick = function(){
		$.ajax({
						url:"server.php",
						type:"POST",
						dataType:"JSON",
						data:{
							
							mode:'checksession',
							
							
							},
						success:function(sessyo){
							
							console.log("Session GET returned: ", sessyo);	
							
							
						},
						error:function(err){
							console.log("error"); 	
						}
						
					});	
					  
	}
	function getUserProfileInfo() {

                $.ajax({
                    url: "sessions.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
						mode:'checksession'
						},
                    success: function(resultData) {
                        console.log("Session GET returned: ", resultData);

					/*
                        var status = resultData['status'];
                        if(status == 'success') {

                            var userProfileData = "";
                            for(var key in resultData) {
                                if(key != 'status') {
                                    userProfileData += key + ":" + resultData[key] + " ";
                                }
                            }
                           
						   
						
                        } else {
							
							console.log("idk");
						}
						   */

                    },
                    error: function() {
                        console.log("error");
                    }
                });

            }
	
	
	
	
	
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
        console.log(resp);
          if(resp.status == "connected"){
			  

            alert("You Logged in");
			
			window.location="/themes.php" ;
			
            /*var txt = "Welcome!";
              document.write("<p>Link: " + txt.link("themes.php") + "</p>");
			*/
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
    </body>
</html>