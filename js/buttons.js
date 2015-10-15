 
 //to provide feedback from buttons:
 
        var buttons = document.querySelectorAll('.buttons');

            
            for(i=0; i < buttons.length; i++){
                
                
                buttons[i].onmousedown = function(){  
                   this.style.backgroundColor = '#888888';      

                }
                buttons[i].onmouseup = function(){  
                   this.style.backgroundColor = '#cccccc';    
                }
            }