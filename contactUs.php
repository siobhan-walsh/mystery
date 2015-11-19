<?php

	include("head.php");
	include("header.php");

?>

        
        <div class = 'content'>
            <h4>Contact Us</h4>
             
            <div id="">
                
                <button id="feedback">Your Feedback</button><br>
                <input id="msgFee"><br><br>
                <button id="sendFee">Send</button>  
            </div>
            
        </div>
     <script src='js/backbtn.js'></script>  
     
<script>
 $(document).ready(function() {

    $("#feedback").click(function() {                

      $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "get.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }
alert("Data: " + data + "\nStatus: " + status);
    });
});
});
</script> 
   

    
  <?php include("footer.php"); ?>