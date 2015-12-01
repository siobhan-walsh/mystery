<?php

	include("head.php");
	include("header.php");

?>


            <div class='content'>

                <h1> Start Round 2 </h1>


                <div id = 'rinfo'>
                    
                 
                </div>
				
                <div id= 'cpbtn'>
               		<button id='gotor3' class= 'btn' >Next Round </button>
               </div>
               
            </div>
            
 		<script>
		
			var rinfo = document.getElementById('rinfo');
			var gotor3 = document.getElementById('gotor3');
			
			gotor3.style.float = 'right';
			
			gotor3.onclick = function(){
				window.location = 'round3.php';	
			};
			
			
			$.ajax({
				 url:"server/roundinfo.php",
				 type:"POST",
				 dataType:"JSON",
				 data:{
					 round:'round2'
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

