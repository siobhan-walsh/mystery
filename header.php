<?php
	
	
?>


<body> 
        
	<div class = 'tablet-size'>	
    <div class = 'scroll'>
    <div class = 'header'>
        <br><br>
        <div><img src = 'img/logo.png'></div>
        <p id='userinfo'>
        	
        
        
        </p>
    
    </div>
    
    <script>
		$(document).ready(function(){
		$.ajax({
			url:"server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				
				mode:'checksession',
				
				
				},
			success:function(sessyo){
				
				console.log("Session GET returned: ", sessyo);
				var user = sessyo.username;	
				
				//document.getElementById('userinfo').innerHTML = user;
				
			},
			error:function(err){
				console.log("error"); 	
			}
			
		});	
});

	</script>
