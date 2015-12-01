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
									//no game goes to homepage
									
									window.location = "themes.php";	
									
								} else if (gcheck['gamecheck'][0]['stage'] == 1){
									
									//stage 1 they are the host, and have their own character picked, but not others'
									window.location = "assignch.php";	
									
								}  else if (gcheck['gamecheck'][0]['stage'] == 2){
									//stage 2 they are not the host and have been invited to play a game'
									
									window.location = 'invited.php';
								} else if (gcheck['gamecheck'][0]['stage'] == 3){
									
									//stage 3 they have accepted but are not the host
									
									console.log('they should go to theme and character');
									
									window.location = 'waiting.php';
								
								} else if (gcheck['gamecheck'][0]['stage'] == 4){
									
									console.log('they are the host and have started the round');
									
									//window.location = 'round1.php';
									
									//stage 4 they are the host and have started the rounds
										//planning for rounds pages
											//have to get gameinfo
											//roundspage select character_id from game where player_id = user_id
											//then Select round1 from characters where character_id = gameinfocharacterid
									
								} else if (gcheck['gamecheck'][0]['stage'] == 5){
									
									console.log('they are NOT the host and have started the round');
									
									//window.location = 'round1.php';
									//stage 5 they are not the host but have started the rounds	
								}
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('gcheck fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
				
		
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
