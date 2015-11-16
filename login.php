<?php
	include("head.php");
	include("header.php");
?>
                <div class = 'content'>

                    <div class= 'hspace message'>
                        <h2>Log in</h2>
                        <p>Don't have an account yet? <a href = 'signup.php'>Sign up!</a></p>
                    </div>
                    <div class='center'>


                        <input type='text' id='username' class='textbox' placeholder="username">
                        <input type='password' id='password' class='textbox' placeholder="password">
                        
                        <p class='right-text '><small>Forgot your password?</small></p>
                       <!-- 
                       
                       <button id="loginFB">Login with Facebook</button>
                       <img src='img/enter-btn.png' id='enter'> 
                       
                       -->
                       <input type='button' id='loginbtn' class='buttons' value="Login">
                        <input type='button' id='fbbutton' class='buttons' value="Login through facebook">
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
	
	loginbtn.onclick = function(){
	
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