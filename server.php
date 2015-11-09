<?php

//start session first:



//tell server to communicate with the database:
include("connection.php");


function getAllUsers(){
	
	global $con;
	
	$arrToSend = array();
	
	$query = "SELECT username, password FROM user";
	$result = mysqli_query($con, $query);
	
	
	
	if($result){
		
		
		
		while($row = mysqli_fetch_array($result)){
			
			$arr = array(
				"username" => $row['username'],
				"password" => $row['password'],
				
			
			);
			
			$_SESSION['username'] = $row['username'];
			
			$_SESSION['isloggedin'] = TRUE;
			
			
			array_push($arrToSend, $arr);
			
			//var_dump($arr);
			
			
			
		}
			
	}
	
	
	echo json_encode($arrToSend);
	
	/*
	echo "<pre>" ;
	echo var_dump($arrToSend);
	echo "</pre>";
	*/
}


function getOneUser(){
	
	global $con;
	
	$arrToSend = array();
	
	$query = "SELECT username, password FROM user WHERE username ='" . $_POST['un']. "' AND password ='" . $_POST['pw'] . "';";
	$result = mysqli_query($con, $query);
	
	
	
	if($result){
		
		
		
		while($row = mysqli_fetch_array($result)){
			
			$arr = array(
				"username" => $row['username'],
				"password" => $row['password']
				
			);
			
			array_push($arrToSend, $arr);
			
			//var_dump($arr);
			
			
			
		}
			
	}
	
	
	echo json_encode($arrToSend);
	
	/*
	echo "<pre>" ;
	echo var_dump($arrToSend);
	echo "</pre>";
	*/
}


if($_POST['mode'] == 0){
	getAllUsers();
} 

if($_POST['mode'] == 1){
	getOneUser();	
}

?>