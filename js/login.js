// login

window.onload = function(){

	var email = document.getElementById('email');
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
			
				email:email.value,
				pw:pw.value
				
				},
			success:function(resp){
				
			
				
				if(resp.status == 'success'){
					
					window.location = "direction.php"
					
				} else if(resp.status == 'fail'){
					
					document.getElementById('warn').innerHTML = "Sorry, that is not the correct email or password";
						
				}
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log(jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
					  
              
	
		
		
	};
};