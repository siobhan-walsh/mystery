<?php
	include("head.php");
    include("header.php");
    
?>
   
        
        <div class='content'>
        
            
           <h3 class='htitle'> Pick Your Characters </h3>
                
                <h3 class='charname' id='prec'> Precious Trump: </h3> 
                
                <!--
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
  -->
        
        </div>

		<!--<script src='js/backbtn.js'></script>-->
        
        <script>
			$(document).ready(function(){
				
				var add = document.querySelectorAll('.add');
				var frienddiv = document.createElement('div');
				var theight = $('.header').height();
				var bheight = $('.footer').height();
				var test = document.getElementById('test');
				
				var character = 'b';
				
				
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
				
				for( var i = 0; i < add.length; i++){
					
					add[i].addEventListener("click", bindClick(i));
				};
			
			
				
				
				 function bindClick(i) {
				  return function(){
						 console.log('popuptosearchfriends');	
			
							var inp = document.createElement('input');
							var searchbtn = document.createElement('button');
							
							searchbtn.id = 'searchbtn';
							searchbtn.innerHTML = 'search';
							inp.placeholder = 'search by user email';
							
							
							
							var resultsdiv = document.createElement('div');
							var cancel = document.createElement('button');
							
							frienddiv.appendChild(cancel);
							frienddiv.appendChild(inp);
							frienddiv.appendChild(searchbtn);
							frienddiv.style.display = 'block';
							document.getElementById('header').appendChild(frienddiv);
							
							cancel.onclick = function(){
								frienddiv.style.display = 'none';
								frienddiv.innerHTML = '';	
						
							};
						
							
					
						
						searchbtn.onclick = function(){
							
							
							
							$.ajax({
							url:"server/friends-server.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								
								term:inp.value
								
								
								},
							success:function(sresp){
								
								console.log("sresp:", sresp);	
								
								if(sresp == 'sorry'){
									
									resultsdiv.innerHTML = "Sorry, there are no users with that email";
									frienddiv.appendChild(resultsdiv);
									
								} else {
									
									
										
										var img = document.createElement('img');	
										var p = document.createElement('p');
										var addbtn = document.createElement('button');
										
										var resultsun = sresp.username;
										var resultsavi = sresp.avatar;
										var resultsuid = sresp.uid;
										
										
										addbtn.innerHTML = "Invite to play";
										
										
										img.src = resultsavi;
										p.innerHTML = resultsun;
										
										resultsdiv.appendChild(img);
										resultsdiv.appendChild(p);
										resultsdiv.appendChild(addbtn);
										
										frienddiv.appendChild(resultsdiv);
										
										addbtn.onclick = function(){
											
											console.log('sending request');
											
										/*	$.ajax({
												url:"server/frequest-server.php",
												type:"POST",
												dataType:"JSON",
												data:{
													
													
													fun: resultsun,
													fuid: resultsuid
													
													},
												success:function(requestresp){
													
													console.log("requestresp:", requestresp);
													
													
													
													frienddiv.innerHTML = '';	
													
													var sentdiv = document.createElement('div');
													sentdiv.innerHTML = requestresp;
													sentdiv.style.fontSize = '16pt';
													sentdiv.style.width = '100vw';
													sentdiv.style.margin = '20%';
													frienddiv.appendChild(sentdiv);
													$(sentdiv).fadeIn('slow').delay(1000).fadeOut('slow', function(){
																$(sentdiv).remove();
																frienddiv.style.display = 'none';
															
														});
													
											
													
												},
												error: function(jqXHR, textStatus, errorThrown) {
													
													console.log(jqXHR.statusText, textStatus, errorThrown);
													console.log('friendrequest error');
													  
												
											
												}
												
											});	
											*/
											
										};
										
										
										
									
								}
								
							
							},
							error: function(jqXHR, textStatus, errorThrown) {
								
								console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log('search error');
								  
							
						
								}
							
							});	
							
						};
						
					};
				};
				
	
  
				
            	  
			  $.ajax({
					url:"server/character-server.php",
					type:"POST",
					dataType:"JSON",
					success:function(characterresp){
						
						console.log("characterresp is:", characterresp);	
						
						//var p2 = document.getElementById('p2');
						
						//console.log('descriptionis', characterresp[0].description);
						
						//p2.innerHTML = characterresp[0].description;
						
						
						
					},
					 error: function(jqXHR, textStatus, errorThrown) {
								//console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log("character error", jqXHR.statusText, textStatus);
						  
					
				
					}
					
				});	
		
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
