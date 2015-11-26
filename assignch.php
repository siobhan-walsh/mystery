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
				var characterstuff = [];
				var chid = '';
				var pendingarr = [];
				var acceptedarr = [];
				
				//global array for pending response characters
				
				//acceptedarr = [] global array for accepted response characters
				
				
				//if characterid is not in accepter array, AND is not in pending
				var frienddiv = document.createElement('div');
				var theight = $('.header').height();
				var bheight = $('.footer').height();
				var takenchinfo = [];
				
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
				
				
				getcharacters();
				
				
				
				//first get the character info and push to the global array
				
				function getcharacters(){
				
					$.ajax({
						url:"server/character-server.php",
						type:"POST",
						dataType:"JSON",
						success:function(characterresp){
							
							
								//console.log('characterresp zero is', characterresp[0]);
								
								characterrespSize = objectSize(characterresp);
								
							
									characterstuff = characterresp[0];
									
								
								
								console.log('characterstuff is', characterstuff);
								
								
	/*--------------- show hosts character --------------------------*/
								hostscharacter();
				
								
								
								
						},
						error: function(jqXHR, textStatus, errorThrown) {
										
										console.log(jqXHR.statusText, textStatus, errorThrown);
										console.log('search error');
										  
									
								
						}
								
					});	
				
				};
				
				//then get the host's character info
				
				function hostscharacter(){
				
				$.ajax({
							url:"server/gamecheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(gcheck){
								
								
								
								console.log("gamecheck info returned: ", gcheck);
								
								console.log('this ch id is', gcheck['gamecheck'][0]['character_id']);
								
								chid = gcheck['gamecheck'][0]['character_id'];
								
								console.log('pushing chid', chid);
								pendingarr.push(chid);
								
								chindex = chid - 1;
								
								console.log("my character is", chid);	
											
											var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[chindex]['character_name'];
											
											console.log('charname is', characterstuff[chindex]['character_name']);
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = chid;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[chindex]['character_img'];
											
											
											var checkimg = document.createElement('img');
											checkimg.className = 'plusimg';
											checkimg.src = 'img/circle_green.png';
											
											var span = document.createElement('span');
											span.style.color = '#000000';
											span.style.fontSize = '16pt';
											span.innerHTML = "You are playing this character";
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[chindex]['character_description'];
											
											
											
											add.appendChild(checkimg);
											add.appendChild(span);
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
	/*--------------- show accepted characters --------------------------*/
	
					acceptedusers();			
	
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('gcheck fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
					
					
					
						
				};
						
						
				function acceptedusers(){
				
					$.ajax({
							url:"server/accepcharcheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(accepchar){
								
								
								
								console.log("accepchar is returned: ", accepchar);
								
								
								accepcharinfo = accepchar.acceptinfo;
								
								accepcharSize = objectSize(accepcharinfo) 
								
								console.log('accepchar is', accepchar);
								
								for(var i = 0; i< accepcharSize; i++){
									
									console.log('this is an array right');
									
									pendingarr.push(accepcharinfo[i].accch);
									
									achnum = accepcharinfo[i].accch - 1;
									usname = accepcharinfo[i].accinfo;
									
									
									console.log('achnum is', achnum);
									
									
									
									var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[achnum]['character_name'];
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = accepcharinfo[i].accch;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[achnum]['character_img'];
											
											
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[achnum]['character_description'];
											
											
											add.innerHTML = '<img class="plusimg" src ="img/circle_green.png"><span>' + usname +' has accepted this character</span>';
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
											
									
								};
	
			/*--------------- show pending characters -------*/
								otheruserscharacters();	
								
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('accepchar fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
						
						
						
				};
						
					//then show the characters that have already been assigned to a user	
					
				function otheruserscharacters(){
				
					$.ajax({
							url:"server/gamecharcheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(gamecharcheck){
								
								
								
								console.log("gamecharcheck info returned: ", gamecharcheck);
								
								takenchinfo = gamecharcheck.takeninfo;
								
								takenchinfoSize = objectSize(takenchinfo) 
								
								console.log('takenchinfo is', takenchinfo);
								
								for(var i = 0; i< takenchinfoSize; i++){
									
									console.log('this is an array right');
									
									pendingarr.push(takenchinfo[i].takench);
									
									chnum = takenchinfo[i].takench - 1;
									usname = takenchinfo[i].takeninfo;
									
									
									console.log('chnum is', chnum);
									
									
									
									var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[chnum]['character_name'];
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = chid;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[chnum]['character_img'];
											
											
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[chnum]['character_description'];
											
											
											add.innerHTML = '<img class="plusimg" src ="img/circle_purple.png"><span>You invited ' + usname +', their response is pending</span>';
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
											
									
								};
	
								unassignedCharacters();
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('gcheck fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
						
						
						
				};
				
				function unassignedCharacters(){
						console.log('characterstuff is a thing', characterstuff);
						
						characterstuffSize = objectSize(characterstuff);
						
						
						
						
						var takenresult = (jQuery.inArray('4', pendingarr));
						
						console.log('is 4 in the array', takenresult);
						
						for(var i = 0; i < characterstuffSize; i++){
							
							
							if(jQuery.inArray(characterstuff[i]['character_id'], pendingarr) == -1){
								
								console.log('these characters are free', characterstuff[i]['character_id']);
								
								
								
											var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[i]['character_name']
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[i]['character_img'];
											
											var add = document.createElement('div');
											add.className = 'add';
											add.id = characterstuff[i]['character_id'];
											add.addEventListener("click", blindClick(i));
											
											var plusimg = document.createElement('img');
											plusimg.className = 'plusimg';
											plusimg.src = 'img/plusbutton.png';
											
											var span = document.createElement('span');
											span.innerHTML = "assign character";
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[i]['character_description'];
											
											console.log('img src is', characterstuff[i]['character_img']);
											
											
											
											add.appendChild(plusimg);
											add.appendChild(span);
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
								
								
								
								
								
								
								
							} else if(jQuery.inArray(characterstuff[i]['character_id'], pendingarr) == 0){
								
								console.log('these characters are not free', characterstuff[i]['character_id']);
								
							}
							
							
						};
					bbtn();	
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
													
													if(respInv == 'unavailable'){
														resultsdiv.innerHTML = "Sorry, that user is unavailable";
													} else if(respInv == 'invited'){
													
														var thisdiv = document.getElementById(character_id);
														
														thisdiv.innerHTML = '<img class="plusimg" src ="img/circle_purple.png"><span>You invited ' + resultsun +', their response is pending</span>';
														
														frienddiv.innerHTML = '';
														frienddiv.style.display = 'none';
													};
													
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
  
				
            	  
		
				function bbtn(){	 
					var bigbtn = document.createElement('button');
					var clicked = false;
					bigbtn.innerHTML = "Begin Game";
					bigbtn.style.width = '80%';
					bigbtn.style.height = '40px';
					bigbtn.style.border = 'none';
					bigbtn.style.borderRadius = '10px';
					bigbtn.style.margin = '2% 10%';
					bigbtn.style.fontSize = '14pt';
					bigbtn.style.backgroundColor = '#298F73';
					bigbtn.style.textAlign = 'center';
					
					$(content).after( bigbtn );
					//content.appendChild(bigbtn);
					
					
					bigbtn.onmousedown = function(){
						bigbtn.style.backgroundColor = '#35C4B6';
					};
					bigbtn.onmouseup= function(){
						bigbtn.style.backgroundColor = '#298F73';
					};
					bigbtn.onclick = function(){
						
						
							//send host_id (user_id);
							
							//update all the players to stage 5
							
								//"UPDATE game SET stage = 5 WHERE host_id= host_id;
								
							//then update the host to stage 4
							
								//UPDATE game SET stage = 4 WHERE player_id = host_id;
							
							//on success redirect to rounds page
					};
					
				};
				
				
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
