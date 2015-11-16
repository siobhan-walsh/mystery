 var themes = ["cruising", "hoho", "lightscamera",  "onceuponamurder"];
                var themeImg = ["img/themes/cruising.png", "img/themes/hoho.png",  "img/themes/lightscamera.png", "img/themes/onceuponamurder.png"];
                
                var themecase = document.querySelector('.themecase');
               
                for(var i=0; i<themes.length; i++){
                    
                    var imge = document.createElement('img');
                    
                    
                    imge.src = themeImg[i];
                    
                    //themecase.innerHTML = '<a href = "game.html"><img src ="' + themeImg[i] + '">';
                    
                    themecase.appendChild(imge);
                    
                    
                    
                    
                }
            