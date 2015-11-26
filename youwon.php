<?php

	include("head.php");
	include("header.php");

?>


            <!-- <div class='content'> !-->

                <h1> YOU ARE CORRECT!</h1>
<br></br>

                <div class = 'p2'>
                   You are a awesome detective, maybe you should consider it as a career! 
          
             
                </div>
        
     
            		<br></br><img class="sad" src="img/star.png"/><br></br>
                    <button id="finishg"class="wrongbtn" > HOST A NEW GAME</button>
                          
        


           
<script>

$(document).ready(function(){

	var endgame = document.getElementById('finishg');
	
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