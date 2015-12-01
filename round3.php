<?php

	include("head.php");
	include("header.php");

?>


            <div class='content'>

                <h1> Start Round 3 </h1>


                <div id = 'rinfo'>
                    
                 
                </div>
                <div id= 'cpbtn'>
               		<button id='gotoguess' class= 'btn' >Guess the murderer! </button>
               </div>

            </div>
            
 		<script>
		
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
					console.log('roundinfo is', roundinfo);
					
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
<script>

 document.getElementById('buttonDiv').innerHTML = "<button id='backbtn' class='btn'>Back</button><a href = 'guess.php' class='btn btn-blue' > Next</a>"

</script>
<script src='js/backbtn.js'></script>
