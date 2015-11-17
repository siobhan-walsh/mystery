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

if($_POST['mode'] == 'getfriends'){
	
	getfriends();	
}

if($_POST['mode'] == 'searchppl'){
	
	searchppl();	
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
      $data = array("status" => "success", "users_id" => $_SESSION['users_id'], "username" => $_SESSION['user_name'], "password" => $_SESSION['password'], "avatar" => $_SESSION['avatar']);   
   }
    echo json_encode($data, JSON_FORCE_OBJECT);
  };
  

function searchppl(){
	
	global $con;
	
	
	$term = "No-one"; //$_POST['term'];
	
	$searcharr = array();
	
	$squery = "SELECT * FROM users WHERE user_name = '" . $term . "';";
	
	
	
	
	$searchresults = mysqli_query($con, $squery);
	
	
	while($srow = mysqli_fetch_array($searchresults)){
	
	
		$sarr = array(
					"users_id" => $srow['users_id'],
					"user_name" => $srow['user_name'],
					"email" => $srow['email'],
					"avatar" => $srow["avatar"]
					
				);
				
				array_push($searcharr, $sarr);
				
			
			
		}
		
			
			
			echo json_encode($searcharr);
	
}
 
 
function getfriends(){
	global $con;
	

	
	//SELECT * FROM friends WHERE users_ID = 3 AND status = 1;
	
	$friendsarr = array();
	$finfoarray = array();
	$fnums = array();
	
	$id = (int) $_SESSION['users_id'];
	
	
	
	
	
	$friendssql = "SELECT * FROM friends WHERE users_ID = " . $id . " AND status = 1;";
	
	//echo "wow id" . $friendssql;
	
	$friendsresults = mysqli_query($con, $friendssql);
	
	
	
	while($row = mysqli_fetch_array($friendsresults)){
	
		
	/*	
		
		$friend = array(
					"users_ID" => $row['users_ID'],
					"user_b" => $row['user_b'],
					"status" => $row["status"]
					
				);
		
				array_push($friendsarr, $friend);
				
				*/
				$num = $row['user_b'];
				
				array_push($fnums, $num);
			
			
	};
		
		//echo json_encode($friendsarr);
		$userData = array();
	
		foreach ($fnums as $friend) {
			
			$userData[] = $friend['users_ID'];
		};
			$query = 'SELECT * FROM users WHERE users_ID IN (' . implode(', ', $userData) . ');';
			$finfo = mysqli_query($con, $query);
			
			
			
		while($frow = mysqli_fetch_array($finfo)){
			
			$friend = array(
					"users_id" => $frow['users_id'],
					"user_name" => $frow['user_name'],
					"email" => $frow['email'],
					"avatar" => $frow["avatar"]
					
				);
				
				array_push($friendsarr, $friend);
			
			
		};

		echo json_encode($friendsarr);
		
		
	};


  
function login(){
	
	global $con;
	
	$match = "no";
	
	
	$loginarr = array();
	
	$searchquery = "SELECT * FROM users";
	
	
	$loginresults = mysqli_query($con, $searchquery);
	
	while($row = mysqli_fetch_array($loginresults)){
	
	
		$arr = array(
					"users_id" => $row['users_id'],
					"user_name" => $row['user_name'],
					"password" => $row['password'],
					"avatar" => $row["avatar"]
					
				);
			
			
			if($_POST['un'] == $arr['user_name'] && $_POST['pw'] == $arr['password']){
				
			
				$match = "yes";
				
				$_SESSION['users_id'] = $arr['users_id'];
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