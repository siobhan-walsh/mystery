<?php

	include("head.php");
	include("header.php");

?>


            <div class='content'>

                <h1> Start Round 1 </h1>


                <div id = 'rinfo'>
                 
                </div>

               <div id= 'cpbtn'>
               		<button id='gotor2' class= 'btn' >Next Round </button>
               </div>

                   
            

            </div>
            
 		<script>
		
			var rinfo = document.getElementById('rinfo');
			var gotor2 = document.getElementById('gotor2');
			
			gotor2.style.float = 'right';
			
			gotor2.onclick = function(){
				window.location = 'round2.php';	
			};
			
			
			$.ajax({
				 url:"server/roundinfo.php",
				 type:"POST",
				 dataType:"JSON",
				 data:{
					 round:'round1'
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
