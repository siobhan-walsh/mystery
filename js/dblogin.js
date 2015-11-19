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
				
				console.log("resp is:", resp);	
				
				if(resp.status == 'success'){
					
					window.location = "themes.php"
					
					
					
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