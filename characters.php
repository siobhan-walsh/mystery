<?php
	include("head.php");
    include("header.php");
    
?>
   
        
        <div class='content'>
        
            
           <h3 class='htitle'> Pick Your Characters </h3>
                
                <h3 class='charname'> Precious Trump: </h3> 
                <div class = "charrow">
                
                
                    <img class = 'charimg' src ="img/characters/character6.png"/>
                  
                    <div id ='test' class='add' data-char='Precious Trump'><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
               
        <div class = 'charcontent'>Floor manager. Precious is aware that the profits from casino are dwindling...and they 		can’t be attributed to gambling losses. Her job may be on the line if she can’t find the thief.</div>
    
               </div>
               
               <h3 class='charname'> Ronald Trump: </h3> 
               <div class = "charrow">
                
                    <img class = 'charimg' src ="img/characters/character11.png"/>
                   
                    <div class='add' data-char='ronald-trump'><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
                     <div class = 'charcontent'>Casino owner. Ronald is the owner of the Paramount Casino, the largest and grandest 		casino on the Las Vegas strip. Ronald is a man you don’t want to betray—the result could be deadly!</div>
                </div>
                
                <h3 class='charname'> Mimi Martini: </h3>
                <div class = "charrow">
                    
                    <img class = 'charimg' src ="img/characters/character10.png"/>
         
                    <div class='add' data-char='mimi martini'><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
        <div class = 'charcontent'>Cocktail Waitress. A money-hungry cocktail waitress, Mimi will do anything (and use 		anyone) to advance herself out of the casino lounge. 
        </div>
                  
               </div>
            
               <h3 class='charname'> Paula Piano: </h3>
               <div class = "charrow">
               
                
                    <img class = 'charimg' src ="img/characters/character8.png"/>
             
                    <div class='add' data-char='paula piano' ><img class = 'plusimg' src="img/plusbutton.png"/><span>Add friend</span></div>
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
				cancel.className = 'btn';
				
				frienddiv.style.position = 'absolute';
				frienddiv.style.top = theight + 'px';
				frienddiv.style.width = '100%';
				frienddiv.style.bottom = bheight + 'px';
				frienddiv.style.backgroundColor = '#ffffff';
				frienddiv.style.zIndex = 2;
				frienddiv.style.boxShadow = "0px -2px 4px #666666";
				frienddiv.style.display = 'none';
				
				frienddiv.innerHTML = '';
				document.getElementById('header').appendChild(frienddiv);
				
				
			
				for( var i = 0; i < add.length; i++){
					
					add[i].addEventListener('click', function(){
						frienddiv.innerHTML = "<br><h1><br>" + this.getAttribute('data-char') + "</h1><br><h2>Friends:</h2>";
						cancel.innerHTML = 'cancel';
						
						frienddiv.style.display = 'block';
						frienddiv.appendChild(cancel);
						
					});
					
				};
			
				cancel.onclick = function(){
					frienddiv.style.display = 'none';	
				}
			
			});
		
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
