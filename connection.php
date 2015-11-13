<?php

session_start();
//makes connection to mySql

$con = mysqli_connect("localhost", "funkint1_siobhan", "", "funkint1_mystery");

if(mysqli_connect_errno()){
	echo "mysql has failed .... reason:" . myspli_connect_error();	
}

?>

