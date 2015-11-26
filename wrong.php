<?php

	include("head.php");
	include("header.php");

?>


            <!-- <div class='content'> !-->

                <h1> YOU ARE WRONG!</h1>
<br></br>

                <div class = 'p2'>
                
                GAME OVER.
                    Sorry, you guessed wrong.
          
             
                </div>
     
            		<img class="sad" src="img/sadface.png"/><br></br>
                    <button id="wrongb"class="wrongbtn" > End Game</button>
                          
        


           
<script>


$(document).ready(function(){

	var endgame = document.getElementById('wrongb');
	
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