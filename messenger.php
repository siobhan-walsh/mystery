<?php

	include("head.php");
	include("header.php");

?>

        
        <div class = 'content'>
            <h4>Messenger</h4>
            <div>
                <input id="msg">
                <button id="send">Send</button>
                
            </div>
            <button id='backbtn' class="btn">Back</button> 
        </div>
     <script src='js/backbtn.js'></script>   
    <script>
        window.onload = function(){
	           "use restrict";
            var send = document.getElementById("send");
            var msg = document.getElementById("msg");
            
            send.onclick = function(){
                var dp1 = document.createElement("img");
                var div1 = document.createElement("div");
                var newTxt = document.createElement("h3");
                var txt = msg.value;
                document.body.appendChild(div1);
                div1.appendChild(newTxt);
                div1.appendChild(dp1);
                newTxt.innerHTML = txt;
                dp1.src = "img/characters/character1.png";
                dp1.style.width = "20px";
                dp1.style.position = "absolute";
                newTxt.style.position = "absolute";
                newTxt.style.width="100%";
                
                div1.style.width = "90vw";
                div1.style.height = "90vh";
                div1.style.display = "inline-block";
                

                
                
            };
          };
         
  
    </script>  
  <?php include("footer.php"); ?>