<body> 
        
	<div class = 'tablet-size'>	
    <div class = 'scroll'>
    <div class= 'header' id = 'header'>

        	<div class = 'logospot'>
            	<img id='logo' src = 'img/logo.png'>
            </div>
            <div id='userinfo'>
                <img id='userpic' src='img/frdsList/F1.png'><br>
                <span id='usern'>name</span>
        	</div>
   
    	
    </div>
    
    <script>
		$(document).ready(function(){
			
			var logmenu = document.createElement('div');
			var header = document.getElementById('header');
			var mclick = false;
		
		$.ajax({
			url:"server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				
				mode:'checksession',
				
				
				},
			success:function(sess){
				
				console.log("Session info returned: ", sess);
				var user = sess.username;	
				var pic = sess.avatar;
				
				//document.getElementById('userpic').src = "img/friends/" + sess.avatar +".png";
				//document.getElementById('usern').innerHTML = sess.username;
				
			},
			error:function(err){
				console.log("error"); 	
			}
			
		});	
		
		
		var userinfo = document.getElementById('userinfo');
		
		userinfo.onclick = function(){
			
			if(mclick == false){
		
				
				
				var height = $('#userinfo').height();
				
				logmenu.innerHTML = 'logout';
				
				logmenu.style.position = 'absolute';
				logmenu.style.right ='0';
				logmenu.style.top = height + "px";
				logmenu.style.width= '20%';
				logmenu.style.backgroundColor = '#2CA5E4';
				logmenu.style.padding = '10px';
				
				console.log("logmenu", logmenu);
				
				header.appendChild(logmenu);
				
				mclick = true;
		
			} else if( mclick == true){
				
				logmenu.remove();
				mclick = false;
			}
		}
		
		logmenu.onclick = function(){
			
			console.log("i wanna log out");
			
			<?php
				session_destroy();
			?>
			
				
		}
		
		
});

</script>
