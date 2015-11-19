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
					
					if(sess.userProfile.notification == 2){
						console.log("no notifications");	
					} else {
						console.log('hey you have a friend request');
						
						$.ajax({
						url:"server/notification-check.php",
						type:"POST",
						dataType:"JSON",
						data:{
							
							status:'check'
							
							},
						success:function(checking){
							
							console.log('checking', checking);
							
							var footer = document.getElementById('footer');
						
							var notialert = document.createElement('div');
							
							var notiwidth = $('#noti').width() *3.5;
							
							var footerheight = $('.footer').height() - 20;
							
						
							notialert.id = 'notialert';
							notialert.style.width = '30px';
							notialert.style.height = '20px';
							notialert.style.borderRadius = '50%';
							notialert.style.backgroundColor = '#ff0000';
							notialert.style.position = 'absolute';
							notialert.style.left = notiwidth + 'px';
							notialert.style.bottom = footerheight + 'px';
							notialert.style.textAlign = 'center';
							notialert.style.lineHeight = "2";
							notialert.style.color = '#ffffff';
							notialert.style.fontWeight = '400';
							notialert.style.fontSize = '16pt';
							
							notialert.innerHTML = checking.notifications;
							
							footer.appendChild(notialert);
								
							
							
						},
						error: function(jqXHR, textStatus, errorThrown) {
							//console.log(jqXHR.statusText, textStatus, errorThrown);
							console.log(jqXHR.statusText, textStatus);
                  
						}
				
						});	

						
						
						
								
					}
					
					
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
			var sendData = {logout: "true"};
			
			$.ajax({
			url:"server/logout-server.php",
			type:"POST",
			dataType:"JSON",
			data:sendData,
			success:function(){
				
				console.log("logout ");
				window.location = "index.php";
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log(jqXHR.statusText, textStatus);
                  
				console.log('lame errors');
				//window.location = "/index.php";
			}
			
		});	
			
				
		}
		
		
});

	</script>
