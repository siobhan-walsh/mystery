<?php

	include("head.php");
	include("header.php");

?>

<!--div class = 'content'>!-->

       <div class = 'sin'>
       		<img src = 'img/welcome1.png'>
       </div>
        
        
       <div id = 'p2' class="p2" >
       
       <!--
       		It has been a year since the Paramount Casino has changed ownership
			and Ronald Trump, the new owner, is ready to celebrate!As the largest 
            and most extravagant casino on the Las Vegas strip,
			The Paramount Casino is throwing a party of epic proportions.
			With the highest rollers and the gutsiest  gamblers, the stakes are
			going to be high and there is no limit to what could happen.
            -->
             
       </div>
             
       <div class='buttonDiv'>

          <button id='backbtn' class="btn">Back</button>
    

           <a href="characters.php" class="bluetheme">Characters</a>
       </div>
            
           
      <script src='js/backbtn.js'></script>
      
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
     
    
