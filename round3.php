<?php

	include("head.php");
	include("header.php");

?>


            <div class='content'>

                <h1> Start Round 3 </h1>


                <div id = 'rinfo'>
                    
                 
                </div>

                <div id='btndiv'>

                    <button id='backbtn' class="btn">Back</button> 
                   
                    <a href='guess.php' class="btn btn-blue" > Next</a>
                     
                </div>


            </div>
            
 		<script>
		
			var rinfo = document.getElementById('rinfo');
			
			
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
<script src='js/btndiv.js'></script>
<script src='js/backbtn.js'></script>
