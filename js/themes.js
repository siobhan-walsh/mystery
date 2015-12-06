// themes

window.onload = function(){
	
	
	  $.ajax({
			url:"server/theme-server.php",
			type:"POST",
			dataType:"JSON",
			data:{
				theme: 'showthemes'
				},
			success:function(themeresp){
				
				var themelength = objectSize(themeresp);
				var themecase = document.querySelector('.themecase');
				
				for(var i=1; i< themelength; i++){
                    
                    var imge = document.createElement('img');
                    
                   
                    imge.src = themeresp[i].img;
                    
                    themecase.appendChild(imge);
                    imge.style.transition="all 1s ease-out";

                    
                    
                    
                    
                };
				
				
				
				
			},
			 error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(jqXHR.statusText, textStatus, errorThrown);
                        console.log("theme error", jqXHR.statusText, textStatus);
                  
			
		
			}
			
		});	
		
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
  
	
	
	
	
	
	
	
	
	
};