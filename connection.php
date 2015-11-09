<?php

//makes connection to mySql

$con = mysqli_connect("localhost", "root", "root", "mystery");

if(mysqli_connect_errno()){
	echo "mysql has failed .... reason:" . myspli_connect_error();	
}

?>