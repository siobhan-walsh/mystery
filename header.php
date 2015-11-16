<body> 
        
	<div class = 'tablet-size'>	
    <div class = 'scroll'>
    <div class = 'header'>

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
