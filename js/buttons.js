 
 //to provide feedback from buttons:
 
        var buttons = document.querySelectorAll('.buttons');

            
            for(i=0; i < buttons.length; i++){
                
                
                buttons[i].onmousedown = function(){  
                   this.style.backgroundColor = '#508d9a';      

                }
                buttons[i].onmouseup = function(){  
                   this.style.backgroundColor = '#599DAC';    
                }
            }