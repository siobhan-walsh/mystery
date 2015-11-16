<?php

session_start();
//tell server to communicate with the database:
include("connection.php");


if($_POST['mode'] == 'signup'){
	signingup();

}


if($_POST['mode'] == 'login'){
	
	login();
}

if($_POST['mode'] == 'checksession'){
	checksess();	
}

if($_POST['mode'] == 'logout'){
	
	logout();	
}

function logout(){
	session_destroy();	
	$_SESSION = array();
}
function checksess(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
		
    }
   // data that would
   
   $data = array('status' => 'notloggedin');
   
   if($_SESSION['loggedin'] == true){
      $data = array("status" => "success", "username" => $_SESSION['user_name'], "password" => $_SESSION['password'], "avatar" => $_SESSION['avatar']);   
   }
    echo json_encode($data, JSON_FORCE_OBJECT);
  };
  
  
  
function login(){
	
	global $con;
	
	$match = "no";
	
	
	$loginarr = array();
	
	$searchquery = "SELECT * FROM users";
	
	
	$loginresults = mysqli_query($con, $searchquery);
	
	while($row = mysqli_fetch_array($loginresults)){
	
	
		$arr = array(
					"user_name" => $row['user_name'],
					"password" => $row['password'],
					"avatar" => $row["avatar"]
					
				);
			
			
			if($_POST['un'] == $arr['user_name'] && $_POST['pw'] == $arr['password']){
				
			
				$match = "yes";
				
				
				$_SESSION['user_name'] = $arr['user_name'];
				$_SESSION['password'] = $arr['password'];
				$_SESSION['avatar'] = $arr['avatar'];
				$_SESSION['loggedin'] = true;
				
				$sid = session_id();
				
				//echo $_SESSION['user_name'];	
				
			}
			
			
		}
		
			
			
			echo json_encode($match);
		
	}
	
	

/*	
	
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['isloggedin'] = true;
				
				$sid = session_id();
				
				$data = array("status" => "success", "sid" => $sid);
			}
	*/

function signingup(){
	
	global $con;
	
	$arrToSend = array();
	
	$insertquery = "INSERT INTO users (user_name, first_name, last_name, password, email, avatar) VALUES ('" . $_POST['un'] . "','" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_POST['pw'] . "', '" . $_POST['email'] . "', '" . $_POST['avatar'] . "');";
	
	
	$insertresult = mysqli_query($con, $insertquery);
	
	
	$selectquery = "SELECT user_name, first_name, last_name, email, avatar FROM users WHERE user_name ='" . $_POST['un']. "' AND password ='" . $_POST['pw'] . "';";
	
	
	
	$showresult = mysqli_query($con, $selectquery);
	
	
	if($showresult){
		
		
		
		while($row = mysqli_fetch_array($showresult)){
			
			$arr = array(
				"user_name" => $row['user_name'],
				"first_name" => $row['first_name'],
				"last_name" => $row['last_name'],
				"email" => $row['email'],
				"avatar" => $row['avatar']
			
			);
			
			//array_push($arrToSend, $arr);
				
			
		}
		
	}

	
	echo json_encode($arr);
	

}



?>