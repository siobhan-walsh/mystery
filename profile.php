<?php

	include("head.php");
	include("header.php");

?>

    <div class = 'content'>
        <h2>Profile</h2>
        
        <div id = "DP">
          <h4><div id="name"></div></h4> 
            <img id = 'dpimg' src="img/profile.png"/>
        </div>
        
        <!-- i don't think it's necessary to have two images. just change the src of the first one
        <div id = "display">

            <img src="img/characters/character1.png"/>

         </div>
        -->

		
        <div id="options">
            <a href='friend.php'><button id="friends">Friends</button></a>
            <a href='messenger.php'><button id="messenger">Messenger</button></a>
            <a href='login.php'><button id="logout">Log Out</button></a>
        </div>
    </div>
    <script>
        window.onload = function(){
			"use strict";
            var displays = document.getElementById("DP");
            var img = document.getElementById("dpimg");
            var bdis = document.getElementById("name");
            var newp = document.createElement("p");
            var usern = document.getElementById("usern");
           
            var userpic = document.getElementById('userpic');
            
            img.src = userpic.getAttribute('src');
           
          src.value = usern.value;
            (userpic).appendChild(newp);
            
            
            
            
            displays.onclick = function(){
                
                var buttons = document.createElement("div");
                var upload = document.createElement("button");
                    upload.innerHTML="Use FaceBook Photo";
                var camera = document.createElement("button");
                    camera.innerHTML="camera";
                var cancel = document.createElement("button");
                    cancel.innerHTML="cancel";
                document.body.appendChild(buttons);
                (buttons).appendChild(upload);
                (buttons).appendChild(camera);
                (buttons).appendChild(cancel);
                buttons.style.width="100px";
                buttons.style.height="50px";
                buttons.style.position="fixed";
                buttons.style.bottom="400px";
                buttons.style.left="60px";
                buttons.style.clear="both";
                buttons.style.float="centre";
                buttons.style.width="70%";
                buttons.style.margin="auto";
                
                upload.style.backgroundColor="white";
                upload.style.borderStyle="solid";
                upload.style.borderColor="white";
                upload.style.borderWidth="1px";
                upload.style.clear="both";
                upload.style.float="centre";
                upload.style.width="100%";
                upload.style.fontSize="12pt";
                upload.style.marginBottom="20px";
                upload.style.padding="10px";
                upload.style.borderRadius="80px";
                
                camera.style.backgroundColor="white";
                camera.style.borderStyle="solid";
                camera.style.borderColor="white";
                camera.style.borderWidth="1px";
                camera.style.clear="both";
                camera.style.float="centre";
                camera.style.width="100%";
                camera.style.fontSize="12pt";
                camera.style.marginBottom="20px";
                camera.style.padding="10px";
                camera.style.borderRadius="80px";
                
                cancel.style.backgroundColor="white";
                cancel.style.borderStyle="solid";
                cancel.style.borderColor="white";
                cancel.style.borderWidth="1px";
                cancel.style.clear="both";
                cancel.style.float="centre";
                cancel.style.width="100%";
                cancel.style.fontSize="12pt";
                cancel.style.marginBottom="20px";
                cancel.style.padding="10px";
                cancel.style.borderRadius="80px";
                
                
                cancel.onclick = function(){
                    buttons.remove();
                  
                    //document.body.appendChild(displays);
                };
                
                camera.onclick = function(){
                    
                };
                
                upload.onclick = function(){

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '902879339797602',
      xfbml      : true,
      version    : 'v2.5'
    });
      console.log(FB);
      
      FB.login(function(resp){
          var name=document.getElementById("name");
        console.log(resp);
          if(resp.status == "connected"){
            //alert("You Logged in");
              FB.api("/me", function(resp2){
                console.log(resp2);
                  name.innerHTML = "Hi " + resp2.name;
              });
              
              FB.api("/me/picture", function(resp3){
                console.log(resp3);
                  var new_img = document.createElement("img");
                  new_img.src = resp3.data.url;
                  DP.appendChild(new_img);
              });
          }
          if(resp.status == "unknown") {
            //alert("Go log in!");
          }
      });
 };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

                    
                    buttons.remove();
                };
                
            };
        };
        
</script>
<script>
    
        
$fb = new Facebook\Facebook([
  'app_id' => '{app-id}',
  'app_secret' => '{app-secret}',
  'default_graph_version' => 'v2.2',
  ]);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', '{access-token}');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user['name'];
// OR
// echo 'Name: ' . $user->getName();
                            
$fb = new Facebook\Facebook(/* . . . */);

// Send the request to Graph
try {
  $response = $fb->get('/me');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

var_dump($response);
// class Facebook\FacebookResponse . . .
        
        
        </script>
<?php include("footer.php"); ?>