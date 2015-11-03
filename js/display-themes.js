 var themes = ["Cruising", "HoHo", "lightscamera",  "murderinsincity", "onceuponamurder"];
                var themeImg = ["img/themes/Cruising.png", "img/themes/HoHo.png",  "img/themes/lightscamera.png", "img/themes/murderinsincity.png", "img/themes/onceuponamurder.png"];
                
                var themecase = document.querySelector('.themecase');
               
                for(var i=0; i<themes.length; i++){
                    
                    var imge = document.createElement('img');
                    
                    
                    imge.src = themeImg[i];
                    
                    //themecase.innerHTML = '<a href = "game.html"><img src ="' + themeImg[i] + '">';
                    
                    themecase.appendChild(imge);
                    
                    
                    
                    
                }
            