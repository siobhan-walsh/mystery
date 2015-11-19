<?php
	include("head.php");
	include("header.php");
?>
  
<h2> Notifications</h2>
            
        <div id = 'noticontent' class = 'noticontent'>
   <!--
            <div class="notice info"><img id="green" src="img/circle_green.png"/><img src="img/frdsList/F1.png"/><p>Alison accepted your friend request!</p></div>

			<div class="notice success"><img id="green" src="img/circle_green.png"/><img src="img/frdsList/F2.png"/><p>Dylan accepted your request to play Murder in Sin City!</p></div>

			<div class="notice warning"><img id="green" src="img/circle_yellow.png"/><img src="img/frdsList/F4.png"/><p>Bella invited you to play Once Upon A Murder!</p></div>
			
            <div class="notice error"><img id="green" src="img/circle_purple.png"/><img src="img/frdsList/F2.png"/><p>Joshua sent you a message!</p></div>
             <br></br>  <br></br>
                -->
             </div>
             
     
               <div class='buttonDiv'>

                    <button id='backbtn' class="btn">Back</button> 
                  
                     
                </div>



<script src='js/backbtn.js'></script>
      
     
        
             

        
 

<?php include("footer.php"); ?>
<script> 
    
    


    
$(document).ready(function(){

 /*   
    var height = document.getElementById("buttoncase");

			var height = $('#buttoncase').height();
				
				
				height.style.position = 'absolute';
				height.style.backgroundColor = '#eee';
                height.style.left ='2';
				height.style.top = height + "px";
				height.style.width= '15%';
				height.style.padding = '3%';
				
				

            
*/
		
		seen();
		getrequestinfo();
		
		function seen(){	
			$.ajax({
				url:"server/seennotification.php",
				type:"POST",
				dataType:"JSON",
				data:{
					status:'seen'	
				},
				success:function(seennotification){
					
					console.log('seennotification', seennotification);
					
					
			
				},
				error: function(jqXHR, textStatus, errorThrown) {
						console.log('getrequest error');
						console.log(jqXHR.statusText, errorThrown, textStatus);
				  
				}
				
			});	
		};
		
		function getrequestinfo(){
			
			$.ajax({
				url:"server/seerequest.php",
				type:"POST",
				dataType:"JSON",
				data:{
					status:'list'	
				},
				success:function(seerequest){
					
					
					var seerequestSize = objectSize(seerequest);
					
					console.log('seerequest', seerequest);
				
					for(var i =0; i < seerequestSize; i++){
						
						var div = document.createElement('div');
						div.class = 'notice info';
						
						var limg = document.createElement('img');
						$(limg).addClass('green');
						limg.src = 'img/circle_green.png';
						
						var img = document.createElement('img');
						img.src = seerequest[i][0].avatar;
						
						var p = document.createElement('p');
						p.innerHTML = seerequest[i][0].user_name + "sent you a friend request!"
						
						var abutton = document.createElement('button');
						abutton.innerHTML = 'accept';
						
						$(abutton).addClass('respbtn');
						$(abutton).data('frienduserid', seerequest[i][0].user_id);
						$(abutton).data('status', 'accept');
						//button.class = 'acceptbtn';
						
						var dbutton = document.createElement('button');
						dbutton.innerHTML = 'deny';
						$(dbutton).addClass('respbtn');
						$(dbutton).data('frienduserid', seerequest[i][0].user_id);
						$(dbutton).data('status', 'deny');
						var divcase = document.getElementById('noticontent');
						
						divcase.appendChild(div);
						divcase.appendChild(limg);
						divcase.appendChild(img);
						divcase.appendChild(p);
						divcase.appendChild(abutton);
						divcase.appendChild(dbutton);
						
						accept();
							
						
					}	
			
				},
				error: function(jqXHR, textStatus, errorThrown) {
						console.log('seerequest error');
						console.log(jqXHR.statusText, errorThrown, textStatus);
				  
				}
				
			});	
			
			
		};
		
		function accept(){
			
			var respbtn = document.querySelectorAll('.respbtn');
			
			var fuid = '';
			var statuss = '';
			
			for(var i=0; i< respbtn.length; i++) {
				   respbtn[i].addEventListener("click", bindClick(i));
			};
			
			 function bindClick(i) {
				return function(){
						 console.log("you clicked button number " + i);
						
						fuid = $(this).data('frienduserid');
						statuss = $(this).data('status');
						
						console.log('ajaja', statuss);
						console.log('fuiid', fuid);
						
						$.ajax({
							url:"server/frequestrespond.php",
							type:"POST",
							dataType:"JSON",
							data:{
								resp:statuss,
								fuid:fuid	
							},
							success:function(frequestrespond){
						
							},
							error: function(jqXHR, textStatus, errorThrown) {
									console.log('frequestrespond error');
									console.log(jqXHR.statusText, errorThrown, textStatus);
							  
							}
							
						});	
				};
			 };
			
			
			
		};
			/*
			for(var i = 0; i < respbtn.length; i++){
				
					respbtn[i].addEventListener('click', frequestrespond(i));
					fuid = $(this).data('frienduserid');
						statuss = $(this).data('status');
						
					
			};
			
			function frequestrespond(){
				
				
				
		
			
			
			
					console.log('ajaja', statuss);
					console.log('fuiid', fuid);
			
					
					
					
					
			
			};
			
			
		};
	
		
		*/
		
		
		function objectSize(the_object) {
		  /* function to validate the existence of each key in the object to get the number of valid keys. */
		  var object_size = 0;
		  for (key in the_object){
			if (the_object.hasOwnProperty(key)) {
			  object_size++;
			}
		  }
		  return object_size;
		}
		
});

</script>