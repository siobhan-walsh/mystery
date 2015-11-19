<?php
    // http://php.net/manual/en/function.session-start.php
    // http://stackoverflow.com/questions/11768816/php-session-variables-not-preserved-with-ajax
    // http://stackoverflow.com/questions/9560240/how-session-start-function-works
    // get the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

	$DBHost = 'localhost';
	$dblogin = 'root';
	$DBpassword = 'root';
	$DBname = 'mystery';




    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
           
            if(isset($_POST["resp"]) && !empty($_POST["resp"])
				&& isset($_POST["fuid"]) && !empty($_POST["fuid"])
					){


                // get the data from the post and store in variables
                
				$fuid = $_POST['fuid'];
				$resp = $_POST['resp'];
				$user_b = $_SESSION['user_id'];
				
				if($resp == 'deny'){
					
					try {
						$conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
						$sql ="UPDATE friends SET status = 2 WHERE user_b = :uid AND user_id = :fuid";
						
						 //"UPDATE friends SET status = 2 WHERE user_b = 4 AND user_id = 3;";
						
						
						//"SELECT * FROM friends WHERE user_b = :uid AND user_id = :fuid";
						
					
						
						$statement = $conn->prepare($sql);
						$statement->execute(array(":uid" => $user_b, ":fuid" => $fuid));
						$statement->execute();
						
						
						
						$data = 'denied';
					
					  
					
	
					} catch(PDOException $e) {
						$data = array("status" => "fail", "msg" => $e->getMessage());
					}
					
					
					
				} else if($resp == 'accept'){
				   
					$data = 'tryina accept';
					
					try {
						$conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
						$sql ="UPDATE friends SET status = 1 WHERE user_b = :uid AND user_id = :fuid";
						
						 //"UPDATE friends SET status = 2 WHERE user_b = 4 AND user_id = 3;";
						
						
						//"SELECT * FROM friends WHERE user_b = :uid AND user_id = :fuid";
						
					
						
						$statement = $conn->prepare($sql);
						$statement->execute(array(":uid" => $user_b, ":fuid" => $fuid));
						$statement->execute();
						
						$moresql = "INSERT INTO friends (user_id, user_b, status) VALUES ((SELECT user_id from users WHERE user_id= :user_id), :userb , 1);";
						
						
						
						$otherstatement = $conn->prepare($moresql);
						$otherstatement->execute(array(":user_id" => $user_b, ":userb" => $fuid));
						
						
						
						$data = 'accepted';
					
					
	
					} catch(PDOException $e) {
						$data = array("status" => "fail", "msg" => $e->getMessage());
					}
					

				}
            } else {
                $data = array("status" => "fail", "msg" => "search term was absent.");
            }



        } else {
            // not AJAX
            $data = array("status" => "fail", "msg" => "Has to be an AJAX call.");
        }


    } else {
        // simple error message, only taking POST requests
        $data = array("status" => "fail", "msg" => "Error: only POST allowed.");
    }

    echo json_encode($data, JSON_FORCE_OBJECT);

?>

