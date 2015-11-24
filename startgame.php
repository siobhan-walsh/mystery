<?php
	include("head.php");
    include("header.php");
    
?>
   
        
        <div class='content'>
        
            
           <h3 class='htitle'> Pick Your Character </h3>
                
                
                 <!--
                
       
             
           <div class='buttonDiv'>
                
                 <button id='backbtn' class="btn1">Back</button> 
            
                
                <a href="game.php" class="btnchar-blue"> Start Game!</a>
          </div>
           -->
        
        </div>

		<!--<script src='js/backbtn.js'></script>-->
        
        <script>
			$(document).ready(function(){
				
				//var add = document.querySelectorAll('.add');
				
				var content = document.querySelector('.content');
				
				var character = 'b';
				
				var frienddiv = document.createElement('div');
				var theight = $('.header').height();
				var bheight = $('.footer').height();
				
				frienddiv.style.position = 'absolute';
				frienddiv.style.top = theight + 'px';
				frienddiv.style.width = '100%';
				frienddiv.style.bottom = bheight + 'px';
				frienddiv.style.backgroundColor = '#ffffff';
				frienddiv.style.zIndex = 2;
				frienddiv.style.boxShadow = "0px -2px 4px #666666";
				frienddiv.style.display = 'none';
				frienddiv.style.overflow = 'scroll';
				
				frienddiv.innerHTML = '';
				
				
				$.ajax({
					url:"server/character-server.php",
					type:"POST",
					dataType:"JSON",
					success:function(characterresp){
						
						console.log("characterresp is:", characterresp);	
						
						
							var charcterrespLength = objectSize(characterresp[0]);
							console.log('yknow', charcterrespLength);
							
							
						
						for( var i = 0; i < charcterrespLength; i++){
							
							var charname = document.createElement('h3');
							charname.className = 'charname';
							charname.innerHTML = characterresp[0][i]['character_name']
							
							var charrow = document.createElement('div');
							charrow.className = 'charrow';
							
							var img = document.createElement('img');
							img.className = 'charimg';
							img.src = characterresp[0][i]['character_img'];
							
							var add = document.createElement('div');
							add.className = 'add';
							add.id = characterresp[0][i]['character_id'];
							add.addEventListener("click", bindClick(i));
							
							var plusimg = document.createElement('img');
							plusimg.className = 'plusimg';
							plusimg.src = 'img/plusbutton.png';
							
							var span = document.createElement('span');
							span.innerHTML = "I want to play this character";
							
							var charcontent = document.createElement('div');
							charcontent.className = 'charcontent';
							charcontent.innerHTML = characterresp[0][i]['character_description'];
							
							console.log('img src is', characterresp[0][i]['character_img']);
							
							
							
							add.appendChild(plusimg);
							add.appendChild(span);
							
							
							
							charrow.appendChild(img);
							charrow.appendChild(add);
							charrow.appendChild(charcontent);
							
							content.appendChild(charname);
							content.appendChild(charrow);
							
							
							
							
						};
						
				
					},
					 error: function(jqXHR, textStatus, errorThrown) {
								//console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log("character error", jqXHR.statusText, textStatus);
						  
					
				
					}
					
				});	
				
				
				
				
		document.getElementById('header').appendChild(frienddiv);
			
			
				
				
				 function bindClick(i) {
				  return function(){
						 console.log('starting game');	
						 
						 	var character_id = this.id;
							
							console.log('character_id is', character_id);
			
							$.ajax({
							url:"server/startgame-server.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								theme_id:1,
								character_id: character_id
								
								},
							success:function(gresp){
								
								console.log("gresp:", gresp);	
								
								
								var ch_id = gresp['gameinfo'][0]['character_id'];
								var player_id = gresp
								
								
								console.log('gamemememe', gresp['msg'] );
								
								/*if(gresp['msg'] == 'alreadygame'){
									
									console.log("sorry you already have a game");
									
									var msgdiv = document.createElement('div');
									//frienddiv.style.display = 'block';
									msgdiv.style.padding = '4%';
									
									//msgdiv.innerHTML = 'sorry, you already are part of a game.<a href = "game.php">go to current game</a>';
									//frienddiv.appendChild(msgdiv);
									
									
								} else {
									*/
									console.log("ok game get started");	
									$('#' + ch_id + ' span').html('you');
									$('#' + ch_id + ' img').attr('src', 'img/circle_green.png');
									
									
									
									
									
									
									
								
								
									
							
							
							},
							error: function(jqXHR, textStatus, errorThrown) {
								
								console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log('search error');
								  
							
						
							}
							
							});	
					
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
							};
  
				
            	  
			  
		
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
