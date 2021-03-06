<?php

	include("head.php");
	include("header2.php");

?>

        
        <div class = 'content'>
            <h1>Contact Us</h1>
            
            <div id="form-main">
              <div id="form-div">
                  <h2>Drop us a line, let us know what you think.</h2>
                  <form action="" method="post" class="form" id="form1">
                          <p class="fn">
                            <input name="firstname" type="text" required = 'true' pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' class="nval validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Name" id="fn" />
                          </p>
                          <p class="ln">
                            <input name="lastname" type="text" required = 'true' pattern = '^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$' class="nval validate[required,custom[email]] feedback-input" id="ln" placeholder="Last Name" />
                          </p>
                      <div id="stars">
                      
                          <label>
                          	<img id="ratingstar" src="img/rating.png"/>
                          	<input name="1star" type="checkbox" value="1star" /><br />
                          </label>
                          
                          <label>
                          	<img id="ratingstar" src="img/rating.png"/>
                            <img id="ratingstar" src="img/rating.png"/>
                          	<input name="2stars" type="checkbox" value="2stars" />
                          	<br />
                          </label>
                          
                          <label>
                          	<img id="ratingstar" src="img/rating.png"/>
                            <img id="ratingstar" src="img/rating.png"/>
                            <img id="ratingstar" src="img/rating.png"/>
                          	<input name="3stars" type="checkbox" value="3stars" />
                            <br />
                          </label>
                          
                          <label>
                          	<img id="ratingstar" src="img/rating.png"/>
                            <img id="ratingstar" src="img/rating.png"/>
                            <img id="ratingstar" src="img/rating.png"/>
                            <img id="ratingstar" src="img/rating.png"/>
                          	<input name="4stars" type="checkbox" value="4stars" />
                            <br />
                          </label>
                          
                          
                          <label>
                          	  <img id="ratingstar" src="img/rating.png"/>
                              <img id="ratingstar" src="img/rating.png"/>
                              <img id="ratingstar" src="img/rating.png"/>
                              <img id="ratingstar" src="img/rating.png"/>
                              <img id="ratingstar" src="img/rating.png"/>
                          	  <input name="5stars" type="checkbox" value="5stars" />
                              <br />
                         </label>
               
                         
                      	</div>  
                        <p class="msgFee">
                        	<textarea name="comments" required = 'true' class="validate[required,length[6,300]] feedback-input" id="msgFee" placeholder="Comment"></textarea>
                        </p>
                         
                        <div class="feedback">
                            <input id="feedback" class='buttons' name="submitted" type="submit" value="Submit" />
                      		<input id="feedback" class='buttons' name="reset" type="reset" value="Reset Form" />
                     
                            <div class="ease"></div>
                            
                        </div>
                   </form>
                </div>
              </div>    
                
               
            

            
        </div>

     
<script>
 $(document).ready(function() {
	 
	 var nval = document.querySelectorAll('.nval');
	 
	 	for(var i = 0; i < nval.length; i++){    
	
			nval[i].addEventListener("input", 
			

				function checkname(){
					if(this.validity.patternMismatch) {
						
						this.setCustomValidity("Please enter a name between 2-20 characters");
						
						
						$("<p id ='s" + i + "'><small>Please enter a name between 2-20 characters</small></p>").insertAfter(this);
						
					  } 

					   else if(this.validity.valueMissing) {
							this.setCustomValidity("You must enter a name");
						  
							
							$("<p id ='s" + i + "'><small>Please enter a name between 2-20 characters</small><p>").insertAfter(this);
						   
						
					  } else {
						  this.setCustomValidity("");
						  
						  $('#s' + i).remove();
						  p.innerHTML = "";
						  validnames = true;
						  
					  }
				 
				});
		
 		};
	 
	 
	 
    $("#feedback").click(function() {                

      $.ajax({    
        type: "GET",
        url: "get.php",             
        dataType: "html",                 
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
       
			alert("Data: " + data + "\nStatus: " + status);
		}
    	});
	});
   
});
</script> 
   
<?php 
if (isset($_REQUEST['submitted'])) {

  $errors = array();
 
  if (!empty($_REQUEST['firstname'])) {
  $firstname = $_REQUEST['firstname'];
  $pattern = "/^[a-zA-Z0-9\_]{2,20}/";
  if (preg_match($pattern,$firstname)){ $firstname = $_REQUEST['firstname'];}
  else{ $errors[] = 'Your Name can only contain _, 1-9, A-Z or a-z 2-20 long.';}
  } else {$errors[] = 'You forgot to enter your First Name.';}
  

  if (!empty($_REQUEST['lastname'])) {
  $lastname = $_REQUEST['lastname'];
  $pattern = "/^[a-zA-Z0-9\_]{2,20}/";
  if (preg_match($pattern,$lastname)){ $lastname = $_REQUEST['lastname'];}
  else{ $errors[] = 'Your Name can only contain _, 1-9, A-Z or a-z 2-20 long.';}
  } else {$errors[] = 'You forgot to enter your Last Name.';}
  
 
  if (!empty($_REQUEST['comments'])) {
  $comments = $_REQUEST['comments'];
  $pattern = "/^[a-zA-Z0-9\_]{0,2000}/";
  if (preg_match($pattern,$comments)){ $comments = $_REQUEST['comments'];}
  else{ $errors[] = 'Your comments can only contain _, 1-9, A-Z or a-z 0-2000 long.';}
  } else {$errors[] = 'You forgot to enter your comments.';}
  
  if (!empty($_REQUEST['1star']) || !empty($_REQUEST['2stars']) || !empty($_REQUEST['3stars']) || !empty($_REQUEST['4stars']) || !empty($_REQUEST['5stars'])) {
  $check1 = $_REQUEST['1star'];
  if (empty($check1)){$check1 = 'Unchecked';}else{$check1 = 'Checked';}
  $check2 = $_REQUEST['2stars'];
  if (empty($check2)){$check2 = 'Unchecked';}else{$check2 = 'Checked';}
  $check3 = $_REQUEST['3stars'];
  if (empty($check3)){$check3 = 'Unchecked';}else{$check3 = 'Checked';}
  $check4 = $_REQUEST['4stars'];
  if (empty($check4)){$check4 = 'Unchecked';}else{$check4 = 'Checked';}
  $check5 = $_REQUEST['5stars'];
  if (empty($check5)){$check5 = 'Unchecked';}else{$check5 = 'Checked';}
  } else {$errors[] = 'You forgot to rate.';}
  }

if (isset($_REQUEST['submitted'])) {
  if (empty($errors)) { 
  $from = "From: Mystery";
  
  $to = "swalsh32@my.bcit.ca"; 
  $subject = "Admin - Mystery Site Comment from " . $name . "";
  
  $message = "Message from " . $firstname . " " . $lastname . " 
  Comments: " . $comments . " 
  1star: " . $check1 ."
  2stars: " . $check2 ."
  3stars: " . $check3 ."
  4stars: " . $check4 ."
  5stars: " . $check5 ."";
  mail($to,$subject,$message,$from);
  }
}
?>
   
<?php 
 
  if (isset($_REQUEST['submitted'])) {
 
  if (!empty($errors)) { 
 	echo "<script>window.location = 'contactus.php'"; 
   
  } else{echo "<script>window.location = 'thankyou.php'</script>"; 
	  echo "Message from " . $firstname . " " . $lastname . " <br />Comments: ".$comments." <br />";
	  echo "<br />1star: " . $check1 . "";
	  echo "<br />2stars: " . $check2 . "";
	  echo "<br />3stars: " . $check3 . "";
	  echo "<br />4stars: " . $check4 . "";
	  echo "<br />5stars: " . $check5 . "";
	  }
  }

  ?>
    
  <?php include("footer.php"); ?>