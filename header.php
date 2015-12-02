<body> 
        
	<div class = 'tablet-size'>	
    <div class = 'scroll'>
    <div class= 'header' id = 'header'>
    


        	<div class = 'logospot'>
            	<img id='logo' src = 'img/logo.png'>
            </div>
            <div id='userinfo'>
                <img id='userpic' src='img/friends/f1.png'><br>
                <span id='usern'>name</span>
        	</div>
            <div id = 'popdiv'>
            	
            </div>
   
    	
    </div>
    
    <script>
		$(document).ready(function(){
			
			var logmenu = document.createElement('div');
			var header = document.getElementById('header');
			var mclick = false;
		
			$.ajax({
				url:"server/sessioninfo.php",
				type:"GET",
				dataType:"JSON",
				data:{
					
					mode:'checksession',
					
					
					},
				success:function(sess){
					
					console.log("Session info returned: ", sess);
					
					
					document.getElementById('userpic').src = sess.userProfile.avatar;
					document.getElementById('usern').innerHTML = sess.userProfile.user_name;
					var usrdata = document.getElementById('usern').getAttribute('data-usr');
					
					
					$('#usern').data('user', sess.userProfile.user_id);
					
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log(jqXHR.statusText, textStatus);
                  
				}
				
			});	
		
		
		var userinfo = document.getElementById('userinfo');
		
		userinfo.onclick = function(){
			
			if(mclick == false){
		
				
				
				var height = $('#userinfo').height();
				
				logmenu.innerHTML = 'logout';
				
				logmenu.style.position = 'absolute';
				logmenu.style.right ='0';
				logmenu.style.top = height + 2 + "px";
				logmenu.style.width= '20%';
				logmenu.style.backgroundColor = '#42C0C0';
				logmenu.style.padding = '10px';
				
				console.log("logmenu", logmenu);
				
				header.appendChild(logmenu);
				
				mclick = true;
		
			} else if( mclick == true){
				
				logmenu.remove();
				mclick = false;
			}
		};
		
		logmenu.onclick = function(){
			
			console.log("i wanna log out");
			var sendData = {logout: "true"};
			
			$.ajax({
			url:"server/logout-server.php",
			type:"POST",
			dataType:"JSON",
			data:sendData,
			success:function(data){
				
				console.log("logout", data);
				window.location = "index.php";
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        
				window.location = "/index.php";
			}
			
		});	
			
				
		};
		
		
});

	</script>
