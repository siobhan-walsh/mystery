	<?php
	include("head.php");
	include("header.php");
	
?>
  
        
        <div class = 'content'>
       
            <h4>Friends</h4>
            
            <button id='addfriend' class='btnf'>Add Friend</button><br>
            
            <div id="AllFriends">
            
            
            <!--
                <div class='frndrow'><img src="img/frdsList/F1.png" />
                     <p>Alison</p><hr/>
                </div>
                <div><img src="img/frdsList/F2.png" />
                     <p>Dylan</p><hr/>
                </div>
                <div><img src="img/frdsList/F4.png" />
                     <p>Bella</p><hr/>
                </div>
                <div><img src="img/frdsList/F2.png" />
                     <p>Joshua</p>
                </div>
                
                -->
            </div>
           <!-- <button id='backbtn' class="btn">Back</button> 
           <script src='js/backbtn.js'></script>  
           -->
        </div>
  

<script>

	$(document).ready(function(){
		
		var allfriends = document.getElementById('AllFriends');
		var test = document.getElementById('test');
		var addf =  document.getElementById('addfriend');
		
		
		
	
		/*
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
						var p = document.createElement('p');
						
						img.src = fresp[i].avatar;
						p.innerHTML = fresp[i].user_name;
						p.id = "pid" + i;
						$('#pid' + i).data('friendid', fresp[i].users_id);
						
						frndrow.appendChild(img);
						frndrow.appendChild(p);
						
						allfriends.appendChild(frndrow);
					}
					
				}
		
				
				
			},
			error:function(err){
				console.log(" oh error"); 
				
			}
			
		});	
	
		*/
		
		var theight = $('.header').height();
		var bheight = $('.footer').height();
		
		
		
		
		addf.onclick = function(){
			
			console.log('popuptosearchfriends');	
			
			var inp = document.createElement('input');
			var searchbtn = document.createElement('button');
			
			searchbtn.id = 'searchbtn';
			searchbtn.innerHTML = 'search';
			inp.placeholder = 'search by username';
			
			frienddiv = document.getElementById('popdiv');
			
			var resultsdiv = document.createElement('div');
			
			var cancel = document.createElement('button');
			
			cancel.className = 'btnf';
			
			frienddiv.style.position = 'absolute';
			frienddiv.style.top = theight + 'px';
			frienddiv.style.width = '100%';
			frienddiv.style.bottom = bheight + 'px';
			frienddiv.style.backgroundColor = '#ffffff';
			frienddiv.style.zIndex = 2;
			frienddiv.style.boxShadow = "0px -2px 4px #666666";
			frienddiv.style.display = 'block';
			
			cancel.innerHTML = 'cancel';
			
			frienddiv.appendChild(cancel);
			frienddiv.appendChild(inp);
			frienddiv.appendChild(searchbtn);
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
					
					resultsdiv.innerHTML = "Sorry, there are no users with that name";
					frienddiv.appendChild(resultsdiv);
					
				} else {
					
					
						
						var img = document.createElement('img');	
						var p = document.createElement('p');
						var addbtn = document.createElement('button');
						
						var resultsun = sresp.username;
						var resultsavi = sresp.avatar;
						var resultsuid = sresp.uid;
						
						
						addbtn.innerHTML = "Send Friend Request";
						
						
						img.src = resultsavi;
						p.innerHTML = resultsun;
						
						resultsdiv.appendChild(img);
						resultsdiv.appendChild(p);
						resultsdiv.appendChild(addbtn);
						
						frienddiv.appendChild(resultsdiv);
						
						addbtn.onclick = function(){
							
							console.log('add as friend');
							
							$.ajax({
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
	
	
	});
	
	
	
</script>

    
<?php
	include("footer.php");
?>