<?php
	include("head.php");
	include("header.php");
?>
  
<h2> Notifications</h2>
            
        <div class = 'noticontent'>
    
            <div class="notice info"><img src="img/frdsList/F1.png"/><p>Alison accepted your friend request!</p></div>

			<div class="notice success"><img src="img/frdsList/F2.png"/><p>Dylan accepted your request to play Murder in Sin City!</p></div>

			<div class="notice warning"><img src="img/frdsList/F4.png"/><p>Bella invited you to play Once Upon A Murder!</p></div>
			<div class="notice error"><img src="img/frdsList/F2.png"/><p>Joshua sent you a message!</p></div>
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




</script>