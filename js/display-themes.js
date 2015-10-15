 var themes = ["Murder in Sin City", "Killing for the Crown", "Once Upon A Murder",  "Cruising for murder", "totally rad 80's prom gone bad", "Lights! Camera! Murder!"];
                var themeImg = ["img/murderinsincity.png", "img/killingforthecrown.png",  "img/onceuponamurder.png", "img/cruisingformurder.png", "img/totallyrad.png", "img/lightscameramurder.png"];
                
                var themecase = document.querySelector('.themecase');
               
                for(var i=0; i<themes.length; i++){
                    
                    var imge = document.createElement('img');
                    
                    imge.src = themeImg[i];
                    

                    
                    themecase.appendChild(imge);
                    
                    
                    
                }
            