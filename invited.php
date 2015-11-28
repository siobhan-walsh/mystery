<?php

	include("head.php");
	include("header.php");

?>

<div class = 'content'>

	<div id = 'invitedmsg' class = 'hspace'>
       
	</div>

</div>

      
      <script>
	  
	  window.onload = function(){
	  
	  //need to get gameinfo and characterinfo
	  
	  var host = '';
	  var character = '';
	  var theme = 1;
	  var invitedmsg = document.getElementById('invitedmsg');
	  
	  	$.ajax({
			url:"server/gamecheck.php",
			type:"POST",
			dataType:"JSON",
			data:{
				
				mode:'checkgame',
				
				
				},
			success:function(gcheck){
				
				
				
				console.log("gamecheck info returned: ", gcheck);
				console.log("gamecheck hostid", gcheck['gamecheck'][0]['host_id']);
				
				
				
				// who is inviting you == select username from users where user-id = gcheck hostid
				host = gcheck['gamecheck'][0]['host_id']
				
				// what theme it is (theme will be 1 for now) === SELECT title FROM themes WHERE theme_id = 1;
				
				theme = gcheck['gamecheck'][0]['theme_id']
				console.log("gamecheck themeid", theme);
				
				// what character you are == SELECT * from characters WHERE character_id = gcheck charcter_id;
				
				character = gcheck['gamecheck'][0]['character_id']
				console.log("gamecheck characterid", character);
				
				inviteinfo();
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
					//console.log(jqXHR.statusText, textStatus, errorThrown);
					console.log('gcheck fail', jqXHR.statusText, textStatus);
			  
			}
			
		});	
		
		
		//to get information
		
		function inviteinfo(){
		
			$.ajax({
				url:"server/inviteinfo.php",
				type:"POST",
				dataType:"JSON",
				data:{
					
					host: host,
					theme: theme,
					character: character
					
					},
				success:function(inviteinfo){
					
					
					
					console.log("inviteinfo is", inviteinfo);
					console.log('charcterinfo is', inviteinfo.characterinfo.character_name);
					
					var h3 = document.createElement('p');
					h3.innerHTML = inviteinfo.hostname + 'has invited you to play ' + inviteinfo.characterinfo.character_name + ' in ' + inviteinfo.themetitle +'!';
					
					var infodiv = document.createElement('div');
					
					infodiv.innerHTML = '<img src = "' + inviteinfo.characterinfo.character_img + '" > <br> <p>' + inviteinfo.characterinfo.character_description + '</p>';
					
					var acceptbttn = document.createElement('button');
					acceptbttn.innerHTML = 'Accept';
					acceptbttn.className = 'whitebtn';
					
					var declinebttn = document.createElement('button');
					declinebttn.innerHTML = 'Decline';
					declinebttn.className = 'whitebtn';
					
					invitedmsg.appendChild(h3);
					invitedmsg.appendChild(infodiv);
					invitedmsg.appendChild(acceptbttn);
					invitedmsg.appendChild(declinebttn);
					
					
					acceptbttn.onclick = function(){
						console.log('clicked acceptbtn');
						 $.ajax({
							url:"server/accept.php",
							type:"POST",
							dataType:"JSON",
							success:function(accept){
								window.location = "direction.php";
								
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('accept', jqXHR.statusText, textStatus);
							  
							}
							
						});	
					};
					
					declinebttn.onclick = function(){
						console.log('clicked declinebtn');
						 //on decline delete the row, then go back to direction page
						  $.ajax({
							url:"server/decline.php",
							type:"POST",
							dataType:"JSON",
							success:function(decline){
								console.log('declined', decline);
								window.location = "direction.php";
								
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('accept', jqXHR.statusText, textStatus);
							  
							}
							
						});	
					};
					
					
					
					
				
				},
				error: function(jqXHR, textStatus, errorThrown) {
						//console.log(jqXHR.statusText, textStatus, errorThrown);
						console.log('gcheck fail', jqXHR.statusText, textStatus);
				  
				}
				
			});	

		};
	  
	  
	  		//on the rounds page you need to get gameinof where playerid = sessionuserid, then use the characterid from that to get round info
	  
	 
	  
	  };
	  
	  </script>
      

<?php include("footer.php"); ?>
     
    
