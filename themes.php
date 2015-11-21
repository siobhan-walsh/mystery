<?php

	include("head.php");
	include("header.php");

?>

    
        
        
        <div class = 'content'>
            <h2>Choose a theme!</h2>
            
            <div class = 'themecase'>
            
            <a href='themeabout.php'><img src="img/themes/murder.png"></a>
            <h2>Coming soon:</h2>
            
            </div>
            
            
            
        
        </div>

        
  <script>
  

	  console.log('hi');
	  
	  
	  
	  $.ajax({
			url:"server/theme-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				theme: 'showthemes'
				},
			success:function(themeresp){
				
				console.log("themeresp is:", themeresp);	
				
				var themelength = objectSize(themeresp);
				var themecase = document.querySelector('.themecase');
				
				for(var i=1; i< themelength; i++){
                    
                    var imge = document.createElement('img');
                    
                    console.log('imgsrs', themeresp[i].img);
                    imge.src = themeresp[i].img;
                    
                    //themecase.innerHTML = '<a href = "game.html"><img src ="' + themeImg[i] + '">';
                    
                    themecase.appendChild(imge);
                    
                    
                    
                    
                };
				
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log("theme error", jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
		
		function objectSize(the_object) {
		  /* function to validate the existence of each key in the object to get the number of valid keys. */
		  var object_size = 0;
		  for (key in the_object){
			if (the_object.hasOwnProperty(key)) {
			  object_size++;
			}
		  }
		  return object_size;
		}
  
  /*
   var themes = ["cruising", "hoho", "lightscamera",  "onceuponamurder"];
                var themeImg = ["img/themes/cruising.png", "img/themes/hoho.png",  "img/themes/lightscamera.png", "img/themes/onceuponamurder.png"];
                
                var themecase = document.querySelector('.themecase');
               
                for(var i=0; i<themes.length; i++){
                    
                    var imge = document.createElement('img');
                    
                    
                    imge.src = themeImg[i];
                    
                    //themecase.innerHTML = '<a href = "game.html"><img src ="' + themeImg[i] + '">';
                    
                    themecase.appendChild(imge);
                    
                    
                    
                    
                };
            
*/
  
  </script>        

    <?php
			include("footer.php");
	?>
 