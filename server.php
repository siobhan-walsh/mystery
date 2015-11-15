<?php

//start session first:


//tell server to communicate with the database:
include("connection.php");


if($_POST['mode'] == 'signup'){
	signingup();

}


if($_POST['mode'] == 'login'){
	
	login();
}

function login(){
	
	global $con;
	
	$loginarr = array();
	
	$searchquery = "SELECT * FROM users";
	
	
	$loginresults = mysqli_query($con, $searchquery);
	
	if($loginresults){
		
		while($row = mysqli_fetch_array($loginresults)){
			
			if($_POST['un'] == $row['user_name'] && $_POST['pw'] == $row['password']){
			
				$match = "wow a match";	
				
			}
			
		
		}
		
		echo json_encode($match);
		
	}
	
	/*if($loginresults){
		
		
		
		while($row = mysqli_fetch_array($loginresults)){
			
			
			$arr = array(
				"user_name" => $row['user_name'],
				"first_name" => $row['first_name'],
				"last_name" => $row['last_name'],
				"email" => $row['email']
			
			);
			
			//array_push($arrToSend, $arr);
				
			
		}
	*/
	
}


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



?>