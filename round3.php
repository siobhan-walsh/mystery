<?php

	include("head.php");
	include("header2.php");

?>


            <div class='content'>
            	
                    <div id = 'chreminder'>
                    
                    </div>
                  
                        <h1 id='stitle'>Start Round 3 </h1>
                  
			
                <div id = 'rinfo'>
                 
                </div>

               <div id= 'cpbtn'>
               		<button id='gotoguess' class= 'btn' >Guess the murderer </button>
               </div>

                   
            

            </div>
            
 		<script>
			var chreminder = document.getElementById('chreminder');
			var stitle = document.getElementById('stitle');
			var rinfo = document.getElementById('rinfo');
			var gotoguess = document.getElementById('gotoguess');
			
			gotoguess.style.float = 'right';
			
			gotoguess.onclick = function(){
				window.location = 'guess.php';	
			};
			
			
			$.ajax({
				 url:"server/roundinfo.php",
				 type:"POST",
				 dataType:"JSON",
				 data:{
					 round:'round3'
					},
				success:function(roundinfo){
					
					var img = document.createElement('img');
					var p = document.createElement('p');
					
					img.src = roundinfo['chimg'];
					img.style.width = '20%';
					p.innerHTML = roundinfo['chname'];
					
					p.style.margin = '0';
					
					stitle.style.fontSize = '350%';
					
					chreminder.style.width = '80%';
					chreminder.style.margin = '0 10%';
					
					chreminder.style.float = 'left';
					
					chreminder.appendChild(img);
					chreminder.appendChild(p);
					
					
					rinfo.style.float = 'left';
					rinfo.innerHTML = roundinfo['msg'];
					
					
				},
				error: function(jqXHR, textStatus, errorThrown) {

					console.log(jqXHR.statusText, textStatus, errorThrown);
					console.log('begin error');
				  
			
		
				}

		});
			
		
		
		</script>

<?php
	
	include("footer.php");
	
?>
