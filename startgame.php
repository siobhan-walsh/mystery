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
				var charstuff = '';
				
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
						
							charstuff = characterresp;
						
						
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
									
									
									console.log('now were here charstuff', charstuff);
									
									content.innerHTML = '';
									
									var charstuffLength = objectSize(charstuff[0]);
										
										
										console.log('charstuff id ', charstuff[0][0]['character_id']);
										console.log('charstuff length', charstuffLength);
										console.log('chid is', ch_id);
									
									for( var i = 0; i < charstuffLength; i++){
										
										
										if(charstuff[0][i]['character_id'] == ch_id){
											
											
											console.log("my character is", i, ch_id);	
											
											var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = charstuff[0][i]['character_name']
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = ch_id;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = charstuff[0][i]['character_img'];
											
											
											var checkimg = document.createElement('img');
											checkimg.className = 'plusimg';
											checkimg.src = 'img/circle_green.png';
											
											var span = document.createElement('span');
											span.style.color = '#000000';
											span.style.fontSize = '16pt';
											span.innerHTML = "You are playing this character";
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = charstuff[0][i]['character_description'];
											
											console.log('img src is', charstuff[0][i]['character_img']);
											
											
											
											add.appendChild(checkimg);
											add.appendChild(span);
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
												
											
											
											
										} else {
											console.log('not my character', i);	
											
											var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = charstuff[0][i]['character_name']
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = charstuff[0][i]['character_img'];
											
											var add = document.createElement('div');
											add.className = 'add';
											add.id = charstuff[0][i]['character_id'];
											add.addEventListener("click", blindClick(i));
											
											var plusimg = document.createElement('img');
											plusimg.className = 'plusimg';
											plusimg.src = 'img/plusbutton.png';
											
											var span = document.createElement('span');
											span.innerHTML = "assign character";
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = charstuff[0][i]['character_description'];
											
											console.log('img src is', charstuff[0][i]['character_img']);
											
											
											
											add.appendChild(plusimg);
											add.appendChild(span);
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
										}
										
										
										
										
									};
									
												
												
									
									
									
									
								
								
									
							
							
							},
							error: function(jqXHR, textStatus, errorThrown) {
								
								console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log('search error');
								  
							
						
							}
							
							});	
					
					}; 
				};
				
				
				
			function blindClick(i) {	
				 return function(){
				
					console.log('assigning character to firend');
					
					//put assigning character functionality here
					
					var character_id = this.id;
							
							console.log('character_id is', character_id);
			
							var inp = document.createElement('input');
							var searchbtn = document.createElement('button');
							var br = document.createElement('br');
							var cprow = document.createElement('div');
							cprow.style.width = '100%';
							
							searchbtn.id = 'searchbtn';
							searchbtn.innerHTML = 'search';
							searchbtn.className = 'whitebtn';
							searchbtn.style.backgroundColor = '#e3e3e3';
							inp.placeholder = 'search by user email';
							inp.style.margin = '4%';
							
							
							
							
							var resultsdiv = document.createElement('div');
							var cancel = document.createElement('button');
							
							cancel.innerHTML = 'cancel';
							cancel.style.backgroundColor = '#e3e3e3';
							
							cancel.className = 'whitebtn';
							
							cprow.appendChild(inp);
							
							cprow.appendChild(searchbtn);
							cprow.appendChild(cancel);
							
							frienddiv.appendChild(cprow);
							
							frienddiv.style.display = 'block';
							
							
							document.getElementById('header').appendChild(frienddiv);
							
							cancel.onclick = function(){
								frienddiv.style.display = 'none';
								frienddiv.innerHTML = '';	
						
							};
						
							
					
						
						searchbtn.onclick = function(){
							
							resultsdiv.innerHTML = '';
							
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
										
										addbtn.className = 'whitebtn';
										
										addbtn.innerHTML = "Invite to play";
										
										
										img.src = resultsavi;
										p.innerHTML = resultsun;
										
										resultsdiv.style.padding = '6%';
										resultsdiv.appendChild(img);
										resultsdiv.appendChild(p);
										resultsdiv.appendChild(addbtn);
										
										frienddiv.appendChild(resultsdiv);
										
										addbtn.onclick = function(){
											
											console.log('sending request');
											console.log('this character is', character_id);
											addbtn.style.backgroundColor = '#e3e3e3';
											
										/*	ajax call that sends request goes here. send the character_id (already made the variable character_id), user_id of friend is resulstsuid, these need to go into the game table			*/
                                        $.ajax({
				                                 url:"server/invite-server.php",
							                     type:"POST",
							                     dataType:"JSON",
							                     data:{
													 character_id: character_id,
													 frienduid: resultsuid
													 
								                    },
											 	success:function(respInv){
                                                 	console.log("game table", respInv);	
													
											 	},
											 	error: function(jqXHR, textStatus, errorThrown) {
								
													console.log(jqXHR.statusText, textStatus, errorThrown);
													console.log('search error');
												  
											
										
												}

										});
										
										
										
									
									};
									
								};
								
							
							},
							error: function(jqXHR, textStatus, errorThrown) {
								
								console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log('search error');
								  
							
						
								}
							
							});	
							
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
							};
  
				
            	  
			  
		
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
