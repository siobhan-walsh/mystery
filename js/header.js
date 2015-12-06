// header

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
				
					document.getElementById('userpic').src = sess.userProfile.avatar;
					document.getElementById('usern').innerHTML = sess.userProfile.user_name;
					var usrdata = document.getElementById('usern').getAttribute('data-usr');
					
					
					$('#usern').data('user', sess.userProfile.user_id);
					
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
                        console.log('session', jqXHR.statusText, textStatus, errorThrown);
                       
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
				
				header.appendChild(logmenu);
				
				mclick = true;
		
			} else if( mclick == true){
				
				logmenu.remove();
				mclick = false;
			}
		};
		
		logmenu.onclick = function(){
			
		
			var sendData = {logout: "true"};
			
			$.ajax({
			url:"server/logout-server.php",
			type:"POST",
			dataType:"JSON",
			data:sendData,
			success:function(){
				
			
				window.location = "index.php";
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
                       console.log(jqXHR.statusText, textStatus, errorThrown);
                     
				
				window.location = "index.php";
			}
			
		});	
			
				
		};
		
		
});
