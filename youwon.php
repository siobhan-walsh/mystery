<?php

	include("head.php");
	include("header.php");

?>


            <!-- <div class='content'> !-->

                <h1> YOU ARE CORRECT!</h1>
<br></br>

                <div class = 'p2'>
                   You are a awesome detective, maybe you should consider it as a career! 
          
             
                </div>
        
     
            	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>	
                    <button id="finishg"class="wrongbtn" > HOST A NEW GAME</button>
<div id="starAnimation">
  <svg id="star" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
       viewBox="0 0 291.3 277.3" enable-background="new 0 0 291.3 277.3" xml:space="preserve">
    <polygon fill="yellow" points="145.5,0.2 185.2,99.4 291,105.9 209.7,174.9 235.4,276.9 145.5,221.6 55.6,276.9 81.2,174.9 0,105.9 105.8,99.4 "/>
  </svg>
</div>
        


           
<script>

$(document).ready(function(){

	var endgame = document.getElementById('finishg');
	
	endgame.onclick = function(){
		
		$.ajax({
			url:"server/endgame.php",
			type:"POST",
			dataType:"JSON",
			success:function(endgame){
				
				window.location = 'direction.php';
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
							
				console.log(jqXHR.statusText, textStatus, errorThrown);
				console.log('endgame error');
							  
						
					
			}
					
		});	
		
		
	};

});
    

</script>
<script>

var tl = new TimelineMax(),
    screenH = window.innerHeight,
    star = document.getElementById('star'),
    starAnimation = document.getElementById('starAnimation');

for (var i=0; i < 1000; i++) {
  var newStar = star.cloneNode(true);
  var xPos = Math.random()*80-40;
  var rotate = Math.random()*1440-720;
  starAnimation.appendChild(newStar);
  tl.fromTo(newStar, 0.5, 
    {
      opacity:0,
      top:screenH,
      rotation:rotate,
      display:'block'
    },
    {
      opacity:.9,
      width:(Math.random()*5+3)+'%',
      top:Math.random()*100,
      ease:Power1.easeOut,
      rotation:rotate/4,
      display:'block',
      left:(50+(xPos/2))+'%'
    },i/20)
    .to(newStar, 0.5, {
      opacity:0,
      rotation:0,
      top:'80%',
      left:(50+xPos)+'%',
      ease:Power1.easeIn
    },(i/20)+.45);
}

</script>
<?php

	include("footer.php");
?>