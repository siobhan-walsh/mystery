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
            // yes, is AJAX call
            // answer POST call and get the data that was sent
            if(isset($_POST["fuid"]) && !empty($_POST["fuid"])
			   &&  isset($_POST["fun"]) && !empty($_POST["fun"])){


                // get the data from the post and store in variables
                $fuid = $_POST["fuid"];
				$user_id = $_SESSION['user_id'];
				$status = 0;
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM friends WHERE user_id = :user_id AND user_b = :user_b;";
					
					//SELECT * FROM friends WHERE user_id = 4 AND user_b = 1;
					
					//"INSERT INTO friends (user_id, user_b, status) VALUES (:user_id,  :userb, :status)";
					
					//"SELECT * FROM users WHERE user_name = $login AND password = $password;";

//SELECT * FROM users WHERE user_name = 'mickeymouse' AND password = 'Mickey!1';

                    $statement = $conn->prepare($sql);
                    $statement->execute(array(":user_id" => $user_id,  ":user_b" => $fuid));
					$statement->execute();
					
					
					
					 $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
					 
					// $data = var_dump($rows);
					 
					 if($rows[0]['status'] == 3){
							$data = 'request already pending'; 
					 } else if ($rows[0]['status'] == 1){
							$data = 'already friends'; 
					 } else if ($rows[0]['status'] == 2){
							$data = 'friend blocked'; 
					 } else {
						 
						
						$insertsql = "INSERT INTO friends (user_id, user_b, status) VALUES (:user_id,  :userb, :status)";
						
						$insertstatement = $conn->prepare($insertsql);
						$insertstatement->execute(array(":user_id" => $user_id, ":userb" => $fuid, ":status" => 3));
						//$insertstatement->execute();
						
						
						
						$moresql = "UPDATE users SET notification = 1  WHERE user_id= :userb";
						
						$selectstatement = $conn->prepare($moresql);
						$selectstatement->execute(array(":userb" => $fuid));
						$selectstatement->execute();
						
						$data = 'request sent';
					 };
					

                } catch(PDOException $e) {
                    $data = array("status" => "fail", "msg" => $e->getMessage());
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

