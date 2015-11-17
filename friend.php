	<?php
	include("head.php");
	include("header.php");
?>
  
        
        <div class = 'content'>
            <h4>Friends</h4>
            <div id="AllFriends">
                <div class='frndrow'><img src="img/frdsList/F1.png" />
                     <p>Alison</p><hr/>
                </div>
                <div><img src="img/frdsList/F2.png" />
                     <p>Dylan</p><hr/>
                </div>
                <div><img src="img/frdsList/F4.png" />
                     <p>Bella</p><hr/>
                </div>
                <div><img src="img/frdsList/F2.png" />
                     <p>Joshua</p>
                </div>
            </div>
            <button id='backbtn' class="btn">Back</button>
        </div>
<script src='js/backbtn.js'></script>    

<script>

	$(document).ready(function(){
		
		var allfriends = document.getElementById('AllFriends');
		
		$.ajax({
			url:"server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				
				mode:'getfriends',
				
				
				},
			success:function(fresp){
				
				console.log("yaya friends:", fresp);	
				
				
				
			},
			error:function(err){
				console.log(" oh error"); 
				
			}
			
		});	
	
		
		
	});
	
	
	
</script>

    
<?php
	include("footer.php");
?>