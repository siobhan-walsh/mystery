<?php
	include("head.php");
	include("header.php");
?>
                <div class = 'content'>

                    <div class= 'hspace message'>
                        <h2>Log in</h2>
                        <p>Don't have an account yet? <a href = 'signup.html'>Sign up!</a></p>
                    </div>
                    <div class='center'>


                       <input type='text' id='username' class='textbox' placeholder="username">
                        <input type='password' id='password' class='textbox' placeholder="password">
                        <button id="loginFB">Login with Facebook</button>
                        <p class='right-text '><small>Forgot your password?</small></p>
                        <img src='img/enter-btn.png' id='enter'>
                        <input type='button' id='fbbutton' class='buttons' value="Login through facebook">
                    </div>

                </div>
        
        
            <div class = 'footer'>

            </div>
        
  
        
    <script src="js/buttons.js"></script>    
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '902879339797602',
      xfbml      : true,
      version    : 'v2.5'
    });
      console.log(FB);
      
      var but = document.getElementById("loginFB");
      var userinfo = document.getElementById("userinfo");
      but.onclick = function(){
      FB.login(function(resp){
        console.log(resp);
          if(resp.status == "connected"){
            alert("You Logged in");
            var txt = "Welcome!";
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
    </body>
</html>