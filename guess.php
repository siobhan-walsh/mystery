	<?php
	include("head.php");
	include("header2.php");
?>



    <div class = 'content'>

           <h1> Click On Your Guess</h1>
            
            <div class = 'hspace guesscase'>

            
            </div>
            
            
            
        
        </div>

   
<script>
    
    
	  var murdereris = '';
	  var charinfo = [];

	  
	  $.ajax({
			url:"server/guesswho-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				guesswho: 'showcharacters'
				},
			success:function(guesswhoresp){
				
				var guesswholength = objectSize(guesswhoresp);
                

                charinfo.push(guesswhoresp);
                
				var guesscase = document.querySelector('.guesscase');
               
        
				
				for(var i=0; i< guesswholength; i++){
					
					
                    
                    var chara = document.createElement('img');
					var charname = document.createElement('h3');
					var chardiv = document.createElement('chardiv');
                    
                 
                    chara.src = guesswhoresp[i].character_img;
					chara.style.width = '100%';
                    charname.innerHTML = guesswhoresp[i].character_name;
					
					chardiv.id = guesswhoresp[i].character_id;
					
					chardiv.addEventListener('click', subGuess(i));
					
					chardiv.style.float = 'left';
					chardiv.style.width = '40%';
					chardiv.style.margin = '5%';

                    
                    chardiv.appendChild(chara);
                    chardiv.appendChild(charname);
                    
					guesscase.appendChild(chardiv);
                    
					
					if(guesswhoresp[i].murderer == 1){
						
						murdereris = guesswhoresp[i].character_id;
					};
					
                    
                };
				
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log("guesswho error", jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
		

		function subGuess(i){
			return function(){
				
				var mid = this.id;
			
				
				
				if(mid == murdereris){
					
					console.log('you are right yay');
					
					window.location = 'youwon.php';
					
				} else {
					console.log('you are wrong boooooo');
					
					window.location = 'wrong.php';
				};
				
			};
		};
		

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

    
</script>


    
<?php
	include("footer.php");
?>