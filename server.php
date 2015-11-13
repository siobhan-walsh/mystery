<?php

//start session first:


//tell server to communicate with the database:
include("connection.php");


function signingup(){
	
	global $con;
	
	$arrToSend = array();
	
	$insertquery = "INSERT INTO users (user_name, first_name, last_name, password, email) VALUES ('" . $_POST['un'] . "','" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_POST['pw'] . "', '" . $_POST['email'] . "');";
	
	
	$insertresult = mysqli_query($con, $insertquery);
	
	
	$selectquery = "SELECT user_name, first_name, last_name, email FROM users WHERE user_name ='" . $_POST['un']. "' AND password ='" . $_POST['pw'] . "';";
	
	
	$showresult = mysqli_query($con, $selectquery);
	
	
	if($showresult){
		
		
		
		while($row = mysqli_fetch_array($showresult)){
			
			$arr = array(
				"user_name" => $row['user_name'],
				"first_name" => $row['first_name'],
				"last_name" => $row['last_name'],
				"email" => $row['email']
			
			);
			
			//array_push($arrToSend, $arr);
				
			
		}
		
	}

	
	echo json_encode($arr);
	

}

signingup();

?>