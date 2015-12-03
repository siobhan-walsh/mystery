<?php

	include("head.php");
	include("header2.php");

?>


                <h1> YOU ARE CORRECT!</h1>
<br></br>

                <div class = 'p2'>
                   You are a awesome detective, maybe you should consider it as a career! 
          
             
                </div>
        
     
            	
                    <button id="finishg"class="wrongbtn" > HOST A NEW GAME</button>


           
<script>

$(document).ready(function(){

	var endgame = document.getElementById('finishg');
	
	
	animaate();
	
	function animaate() {
			
			
			
			
			
				for(var i=0; i < 60; i++){
					
					
					var rando = Math.floor(Math.random() * 100) + 1;
					var rando2 = Math.floor(Math.random() * 100) + 1;
					var rando3 = Math.floor(Math.random() * 1000) + 1;
					var rando4 = Math.floor(Math.random() * 3000) + 100;
					
					var red = Math.floor(Math.random() * 255) + 1;
					var blue = Math.floor(Math.random() * 255) + 1;
					var green = Math.floor(Math.random() * 255) + 1;
					
					var circ = document.createElement('div');
					circ.id = 'circ';
					
					
					
					circ.style.display = 'block';
					circ.style.borderRadius = '50%';
					circ.style.width = '10px';
					circ.style.height = '10px';
					circ.style.position = 'fixed';
					circ.style.top = '-100px';
					circ.style.left = rando2 +'%';
				
					
					document.body.appendChild(circ);
					
					$(circ).delay(rando4).css("background-color","rgb(" + red + "," + green + "," + blue + ")").animate(
					
					{"top":"100%"}, rando4,
						function(){
							this.remove();
							
							
							
						}
					);
						
					
				}
				
			};
			

	
	endgame.onclick = function(){
		
		$.ajax({
			url:"server/endgame.php",
			type:"POST",
			dataType:"JSON",
			success:function(endgame){
				
				window.location = 'direction.php';
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
							
				console.log(jqXHR.statusText, textStatus, errorThrown);
				console.log('endgame error');
							  
						
					
			}
					
		});	
		
		
	};

});
    

</script>

<?php

	include("footer.php");
?>