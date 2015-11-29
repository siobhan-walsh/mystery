<?php

	include("head.php");
	include("header.php");

?>


            <div class='content'>

                <h1> Start Round 2 </h1>


                <div id = 'rinfo'>
                    
                 
                </div>

            </div>
            
 		<script>
		
			var rinfo = document.getElementById('rinfo');
			
			
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
<script>

 document.getElementById('buttonDiv').innerHTML = "<button id='backbtn' class='btn'>Back</button><a href='round3.php' class='btn btn-blue'>Next</a>"

</script>
<script src='js/backbtn.js'></script>
