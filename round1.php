<?php

	include("head.php");
	include("header.php");

?>


            <div class='content'>

                <h1> Start Round 1 </h1>


                <div id = 'rinfo' class = 'p2'>
                    
                   <!-- 
                    The Paramount Casino is throwing a party of epic proportions.
                    With the highest rollers and the gutsiest gamblers, the stakes are
                    going to be high and there is no limit to what could happen. Mimi Martini, the cocktail waitress seems to be extra chatty tonight with all the high rollers and looks like she's collecting extra tips. Suddenly there's a scream from the Piano Lounge 
				-->
                </div>

                <div id='btndiv'>

                    <button id='backbtn' class="btn">Back</button> 
                   
                    <a href='round2.php' class="btn btn-blue" > Next</a>
                     
                </div>


            </div>
            
 		<script>
		
			var rinfo = document.getElementById('rinfo');
			
			
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
<script src='js/btndiv.js'></script>
<script src='js/backbtn.js'></script>
