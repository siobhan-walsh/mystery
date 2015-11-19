<?php
	include("head.php");
	include("header.php");
?>
  
<h2> Notifications</h2>
            
        <div class = 'noticontent'>
    
            <div class="notice info"><img id="green" src="img/circle_green.png"/><img src="img/frdsList/F1.png"/><p>Alison accepted your friend request!</p></div>

			<div class="notice success"><img id="green" src="img/circle_green.png"/><img src="img/frdsList/F2.png"/><p>Dylan accepted your request to play Murder in Sin City!</p></div>

			<div class="notice warning"><img id="green" src="img/circle_yellow.png"/><img src="img/frdsList/F4.png"/><p>Bella invited you to play Once Upon A Murder!</p></div>
			
            <div class="notice error"><img id="green" src="img/circle_purple.png"/><img src="img/frdsList/F2.png"/><p>Joshua sent you a message!</p></div>
             <br></br>  <br></br>
             
             </div>
             
        
               <div class='buttonDiv'>

                    <button id='backbtn' class="btn">Back</button> 
                  
                     
                </div>



<script src='js/backbtn.js'></script>
      
     
        
             

        
 

<?php include("footer.php"); ?>
<script> 
    
    


    
$(document).ready(function(){

    
    var height = document.getElementById("buttoncase");

			var height = $('#buttoncase').height();
				
				
				height.style.position = 'absolute';
				height.style.backgroundColor = '#eee';
                height.style.left ='2';
				height.style.top = height + "px";
				height.style.width= '15%';
				height.style.padding = '3%';
				
				

                });

/*
			$.ajax({
				url:"server/seerequest-server.php",
				type:"POST",
				dataType:"JSON",
				data:{
					
					uid:sess.userProfile.user_id
					
				},
				success:function(requestinfo){
					
					console.log('requestinfo is', requestinfo);
			
				},
				error: function(jqXHR, textStatus, errorThrown) {
						console.log('getrequest error');
						console.log(jqXHR.statusText, textStatus);
				  
				}
				
			});	

*/

</script>