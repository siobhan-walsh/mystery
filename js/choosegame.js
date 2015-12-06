// create game

$(document).ready(function(){
				
				
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
				
				document.getElementById('header').appendChild(frienddiv);
				
				
				
				$.ajax({
					url:"server/character-server.php",
					type:"POST",
					dataType:"JSON",
					success:function(characterresp){
							charstuff = characterresp;
						
						
							var charcterrespLength = objectSize(characterresp[0]);
							
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
								
								console.log("character error", jqXHR.statusText, textStatus);
						  
					
				
					}
					
				});	
				
				
				
				 function bindClick(i) {
				  return function(){
						 
						 	var character_id = this.id;
							
							
							$.ajax({
							url:"server/setupgame.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								theme_id:1,
								character_id: character_id,
								status:2
								
								},
							success:function(gresp){
								
								var ch_id = gresp['gameinfo'][0]['character_id'];
								var player_id = gresp
								
								if(gresp['msg'] == 'alreadygame'){
									
									
									var msgdiv = document.createElement('div');
									frienddiv.style.display = 'block';
									msgdiv.style.padding = '4%';
									
									msgdiv.innerHTML = 'sorry, you already are part of a game.<a href = "direction.php">go to current game</a>';
									frienddiv.appendChild(msgdiv);
									
									
								} else {
									
									window.location = "assignch.php";
										
								};
									
												
												
									
									
									
									
								
								
									
							
							
							},
							error: function(jqXHR, textStatus, errorThrown) {
								
								console.log('setup error', jqXHR.statusText, textStatus, errorThrown);
							
							
						
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