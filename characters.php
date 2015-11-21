<?php
	include("head.php");
    include("header.php");
    
?>
   
        
        <div class='content'>
        
            
           <h3 class='htitle'> Pick Your Characters </h3>
                
                <h3 class='charname' id='prec'> Precious Trump: </h3> 
                <div class = "charrow">
                
                
                    <img class = 'charimg' src ="img/characters/character6.png"/>
                  
                    <div id ='ptrump' class='add' data-char='Precious Trump'><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
               
        <div class = 'charcontent'>Floor manager. Precious is aware that the profits from casino are dwindling...and they 		can’t be attributed to gambling losses. Her job may be on the line if she can’t find the thief.</div>
    
               </div>
               
               <h3 class='charname' id='ron'> Ronald Trump: </h3> 
               <div class = "charrow">
                
                    <img class = 'charimg' src ="img/characters/character11.png"/>
                   
                    <div class='add' id='ron' data-char='ronald-trump'><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
                     <div class = 'charcontent'>Casino owner. Ronald is the owner of the Paramount Casino, the largest and grandest 		casino on the Las Vegas strip. Ronald is a man you don’t want to betray—the result could be deadly!</div>
                </div>
                
                <h3 class='charname' id='mimi'> Mimi Martini: </h3>
                <div class = "charrow">
                    
                    <img class = 'charimg' src ="img/characters/character10.png"/>
         
                    <div class='add' id = 'mimi' data-char='mimi martini'><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
        <div class = 'charcontent'>Cocktail Waitress. A money-hungry cocktail waitress, Mimi will do anything (and use 		anyone) to advance herself out of the casino lounge. 
        </div>
                  
               </div>
            
               <h3 class='charname' > Paula Piano: </h3>
               <div class = "charrow">
               
                
                    <img class = 'charimg' src ="img/characters/character8.png"/>
             
                    <div class='add' id='paula' data-char='paula piano' ><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
                    <div class = 'charcontent'> Lounge Singer. Money hungry and love hungry. Late nights in the lounge leave Paula singing a lonely tune.<br></br> </div>
             </div>
               
                
                
        
             
           <div class='buttonDiv'>
                
                 <button id='backbtn' class="btn1">Back</button> 
            
                
                <a href="game.php" class="btnchar-blue"> Start Game!</a>
  </div>

        
        </div>

		<script src='js/backbtn.js'></script>
        
        <script>
			$(document).ready(function(){
				
				var add = document.querySelectorAll('.add');
				var frienddiv = document.createElement('div');
				var theight = $('.header').height();
				var bheight = $('.footer').height();
				var test = document.getElementById('test');
				var cancel = document.createElement('button');
				var character = 'b';
				cancel.className = 'btn';
				
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
				document.getElementById('header').appendChild(frienddiv);
				
				function showfriends(){
				
				$.ajax({
					url:"server.php",
					type:"POST",
					dataType:"JSON",
					data:{
						
						mode:'getfriends'
						
						
						},
					success:function(fresp){
						
						console.log("yaya friends:", fresp);	
						
						if(fresp.length < 1){
							
							console.log("emptyyo");
							var words = document.createElement('div');
							
							
							
							words.innerHTML = "You don't have any friends yet! Click here to search for them!";
							
							
							
							
							
							allfriends.appendChild(words);
							
						} else {
						
							for(var i = 0; i < fresp.length; i++){
								
								var frndrow = document.createElement('div');
								var img = document.createElement('img');
								var worddiv = document.createElement('span');
								var assignbtn = document.createElement('button');
								var fnam = fresp[i].user_name;
								
								console.log('character is', character);
								
								assignbtn.class = "assnbtn";
								
								frndrow.style.float = 'left';
								frndrow.style.width = '100%';
								frndrow
								
								img.style.width = '20%';
								img.style.margin = '0 10%';
								img.src = fresp[i].avatar;
								
								worddiv.float = 'right';
								worddiv.width = '50%';
								worddiv.clear = 'none';
								worddiv.innerHTML = fresp[i].user_name;
								worddiv.id = "pid" + i;
								$('#pid' + i).data('friendid', fresp[i].users_id);
								
								assignbtn.innerHTML = "assign";
								
								worddiv.appendChild(assignbtn);
								
								frndrow.appendChild(img);
								frndrow.appendChild(worddiv);
								
								
								frienddiv.appendChild(frndrow);
								
								assignbtn.onclick = function(){
									
									console.log('hiiii');
									frienddiv.style.display = 'none';
									
									var thddiv = "'#" + character +" span'";
									
									console.log('char', character);
									$('#' + character + ' span').html(fnam);
									
										
								}
								
								
							}
							
						}
				//ALTER TABLE Murder in Sin City-Character RENAME TO character;
  
						
						
					},
					error:function(err){
						console.log(" oh error"); 
						
					}
					
				});		
					
				}
			
				for( var i = 0; i < add.length; i++){
					
					add[i].addEventListener('click', function(){
						frienddiv.innerHTML = "<br><h1><br>" + this.getAttribute('data-char') + "</h1><br><h2>Friends:</h2>";
						cancel.innerHTML = 'cancel';
						
						character = this.id;
						
						character = character.replace(/\s+/g, '');
						
					
					 
						console.log('character', character);
						
						frienddiv.style.display = 'block';
						
						
						showfriends();
						
						frienddiv.appendChild(cancel);
						
						
					});
					
				};
			
				cancel.onclick = function(){
					frienddiv.style.display = 'none';	
				}
				
				
			
			});
            
            	  
	  $.ajax({
			url:"server/character-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				character: 'showcharacters'
				},
			success:function(characterresp){
				
				console.log("characterresp is:", characterresp);	
				
				var p2 = document.getElementById('p2');
				
				console.log('descriptionis', characterresp[0].description);
				
				p2.innerHTML = characterresp[0].description;
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log("character error", jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
		
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
