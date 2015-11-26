	<?php
	include("head.php");
	include("header.php");
?>



    <div class = 'content'>
            <h2>Take a Guess!</h2>
            
            <div class = 'guesscase'>

            
            </div>
            
            
            
        
        </div>

                <h1> Click On Your Guess</h1>



                <div class='buttonDiv'>

                    <a href='game.php' ><button id='backbtn' class="btn">Back</button> </a>
                
                 <a href='game.php' class="btn btn-blue" > Cancel</a>
                     
                </div>
                
                
       <script src='js/backbtn.js'></script>


<script>
    
    
	  console.log('hi');
	  
	  
	  
	  $.ajax({
			url:"server/guesswho-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				guesswho: 'showcharacters'
				},
			success:function(guesswhoresp){
				
				console.log("guesswhoresp is:", guesswhoresp);	
				
				var guesswholength = objectSize(guesswhoresp);
                
                console.log('guesswholength', guesswholength);
                
				var guesscase = document.querySelector('.guesscase');
                var charname = document.createElement('h3');
        
				
				for(var i=0; i< guesswholength; i++){
                    
                    var chara = document.createElement('img');
                    
                    console.log('chara:', guesswhoresp[i].character_img);
                    chara.src = guesswhoresp[i].character_img;
                    charname.innerHTML = guesswhoresp[i].character_name;

                    
                    guesscase.appendChild(chara);
                    guesscase.appendChild(charname);
                    
                    
                    
                };
				
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log("guesswho error", jqXHR.statusText, textStatus);
                  
			
		
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