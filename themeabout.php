<?php

	include("head.php");
	include("header.php");

?>

<!--div class = 'content'>!-->

       <div class = 'sin'>
       		<img src = 'img/welcome1.png'>
       </div>
        
        
       <div id = 'p2' class="p2" >
      
       </div>
             
       
		<div class = 'buttonDiv'>
        
        	<a href="themes.php" class="themebtn">Back</button>
        
        	<a href="choosegame.php" class="bluetheme">Start Game</a>
        
        </div>
       
            
           
     
      
      <script>
	
	  
	  $.ajax({
			url:"server/theme-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				theme: 'showthemes'
				},
			success:function(themeresp){
				
				console.log("themeresp is:", themeresp);	
				
				var p2 = document.getElementById('p2');
				
				console.log('descriptionis', themeresp[0].description);
				
				p2.innerHTML = themeresp[0].description;
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log("theme error", jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
		
	  
	  
	  </script>
    

<?php include("footer.php"); ?>
