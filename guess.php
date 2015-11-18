	<?php
	include("head.php");
	include("header.php");
?>



                <h1> Click On Your Guess</h1>


         <div id = "guess">
        <a href="wrong.php"><img id="first"  src="img/characters/character6.png"></a>
         <a href="youwon.php"><img src="img/characters/character7.png"></a>
          <a href="wrong.php"><img src="img/characters/character8.png"></a>
       	 <a href="wrong.php"><img id="first" src="img/characters/character5.png"></a>
      	 <a href="wrong.php"><img src="img/characters/character9.png"></a>
      	  <a href="youwon.php"><img src="img/characters/character10.png"></a>
       	 <a href="wrong.php"><img id="first" src="img/characters/character3.png"></a>
		 <a href="wrong.php"><img src="img/characters/character11.png"></a>
       	 <a href="wrong.php"><img id="last" src="img/characters/character4.png"> </a>
       
    </div>


                <div class='buttonDiv'>

                    <a href='game.php' ><button id='backbtn' class="btn">Back</button> </a>
                
                 <a href='game.php' class="btn btn-blue" > Cancel</a>
                     
                </div>


        <script src='js/backbtn.js'></script>
    
<?php
	include("footer.php");
?>