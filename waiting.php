<?php

	include("head.php");
	include("header2.php");

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
					h3.innerHTML = inviteinfo.hostname + ' has invited you to play ' + inviteinfo.characterinfo.character_name + ' in ' + inviteinfo.themetitle +'!';
					
					var infodiv = document.createElement('div');
					
					infodiv.innerHTML = '<img src = "' + inviteinfo.characterinfo.character_img + '" > <p>' + inviteinfo.characterinfo.character_description + '</p><br><p> Please wait until ' + inviteinfo.hostname + ' starts the game.' ;
					
					
					
					
					invitedmsg.appendChild(h3);
					invitedmsg.appendChild(infodiv);
					
					
					
					
				
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
     
    
