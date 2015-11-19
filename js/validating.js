
function validation(){
	
	var nval = document.querySelectorAll('.nval');
	var p = document.createElement('p');
	
pw.addEventListener("blur",

		function checkpass(){
			
			if(pw.validity.patternMismatch){
				
				pw.setCustomValidity("Please enter a password with 1 Uppercase, 1 lowercase, and a number");			
				$("<p id ='p'><small>Please enter a password with 1 Uppercase, 1 lowercase, and a number</small></p>").insertAfter(pw);
				
			} else if(this.validity.valueMissing) {
		   
				this.setCustomValidity("Please enter a password with 1 Uppercase, 1 lowercase, and a number");	
				$("<p id ='p'><small>Please enter a password with 1 Uppercase, 1 lowercase, and a number</small></p>").insertAfter(pw);
			} else{
				 $('#p').remove();
			}
		 
});
			
	pwRetype.addEventListener("blur",
		function(){	
			if(pw.value != pwRetype.value){
				
				pw.style.borderColor = "#ffccee";
				pw.setCustomValidity("Your passwords don't match");
				pwRetype.style.borderColor = "#ffccee";
				pwRetype.setCustomValidity("Your passwords don't match");
				
				
				$("<p id ='pm'><small>Your passwords don't match</small></p>").insertAfter(pwRetype);
				
				
			} else if(pw.value == pwRetype.value){
				pw.style.borderColor = "#ffffff";
				pw.setCustomValidity("");
				pwRetype.style.borderColor = "#ffffff";
				pwRetype.setCustomValidity("");
				
				$('#p').remove();
				
				 
				validpw = true;
				
			}
			
		}
		
);
						
					
				
				
				
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
						   
						
					  } else if(this.validity.typeMismatch){
						   this.setCustomValidity("Please enter a valid email address");
							
							p.innerHTML = "<small>Please enter a valid email address</small>";
							//this.appendChild(p);
							$(this).after(p);
						 
					  } else {
						  this.setCustomValidity("");
						  
						  $('#s' + i).remove();
						  p.innerHTML = "";
						  validnames = true;
						  
					  }
				 
				}
						
						
				//myScript
				
				);
		
	}
};
			  