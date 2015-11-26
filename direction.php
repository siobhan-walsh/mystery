<?php
	include("head.php");
    include("header.php");
    
?>
   
        
        <div class='content'>
        
        
        </div>

		
        <script>
			$(document).ready(function(){
				
				//check if they already have a game
				
			
				
						$.ajax({
							url:"server/gamecheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(gcheck){
								
								
								
								console.log("gamecheck info returned: ", gcheck);
								
								if(gcheck['gamecheck'][0] == null){
									console.log('no game go to homepage');
									
									window.location = "themes.php";	
									
								} else if (gcheck['gamecheck'][0]['stage'] == 1){
									
									console.log('they have their own character picked, but not others');
									window.location = "assignch.php";	
									
								}  else if (gcheck['gamecheck'][0]['stage'] == 2){
									console.log('they have been invited to play a game');
									
									window.location = 'invited.php';
								} else if (gcheck['gamecheck'][0]['stage'] == 3){
									
									//stage 3 they have accepted but are not the host
									
									console.log('they should go to rounds');
									
									//window.location = 'rounds.php';
								
								};
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('gcheck fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
				
				
				
				
				
				//check if they've been invited to a game
				
				//go to current game status
				
				
				
		
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
