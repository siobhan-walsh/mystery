// fb api login

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
				
				  if(resp.status == "connected"){
					  
					 
					FB.api("/me",{fields: 'first_name,last_name,gender,email,picture'},function(fbresp1){
						
					
						
						var fname = fbresp1.first_name;
						var lname = fbresp1.last_name;
						var un = fname + lname;
						var pw = fbresp1.id;
						var email = fbresp1.email;
						var avatar = fbresp1.picture.data.url
						
						
						$.ajax({
										url:"server/signup-server.php",
										type:"POST",
										dataType:"JSON",
										data:{
											
											un:un,
											pw:pw,
											fname:fname,
											lname:lname,
											email:email,
											avatar: avatar
											
											
											},
										success:function(signupresp){
							
												$.ajax({
													url:"server/login-server.php",
													type:"POST",
													dataType:"JSON",
													data:{
													
														email:signupresp.email,
														pw:signupresp.pw
														
														},
													success:function(loginresp){
														
														
														if(loginresp.status == 'success'){
															
															window.location = "direction.php"
															
														} else if(loginresp.status == 'fail'){
															
															document.getElementById('warn').innerHTML = "Sorry, that is not the correct email or password";
																
														}
														
														
														
													},
													 error: function(jqXHR, textStatus, errorThrown) {
																
																console.log('login', jqXHR.statusText, textStatus);
														  
													
												
													}
													
												});	
														  
										
										},
										 error: function(jqXHR, textStatus, errorThrown) {
											console.log('signup', jqXHR.statusText, textStatus, errorThrown);
											
						
										}
									});	
									
						
						
						
					});
					
		
					
									
									
					
				  } else if(resp.status == "not_authorized") {
					console.log('not authorized');
					 
				  } else {
						console.log('cannot find facebook');  
				  }
			  }, {scope: 'public_profile, email'}); 
		  
			 
	  
  };};
  (function(d, s, id){  
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));