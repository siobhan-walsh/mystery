<?php

include("connection.php");



    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            // yes, is AJAX call
            // answer POST call and get the data that was sent
            if(isset($_POST["un"]) && !empty($_POST["un"])
                && isset($_POST["pw"]) && !empty($_POST["pw"])
				 && isset($_POST["fname"]) && !empty($_POST["fname"])
				  && isset($_POST["lname"]) && !empty($_POST["lname"])
				   && isset($_POST["email"]) && !empty($_POST["email"])
				    && isset($_POST["avatar"]) && !empty($_POST["avatar"])
				){


                // get the data from the post and store in variables
                $username = $_POST["un"];
                $password = $_POST["pw"];
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];
				$email = $_POST["email"];
				$avatar = $_POST["avatar"];
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = $conn->prepare( "SELECT * FROM users WHERE email = :email;");
					$sql->bindParam(":email",  $email);
					$sql->execute();
					
					$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
					
					$count = count($rows);
					
					if($count > 0){
						$data =  array("un" => $username, "pw" => $password, 'email' => $email, 'account' =>'hasaccount' ); 	
					} else {

						$statement = $conn->prepare("INSERT INTO users (user_name, first_name, last_name, password, email, avatar) VALUES (:un,  :fn, :ln,  :pw,  :email, :avatar);");
						
						$statement->bindParam(":un",  $username);
						$statement->bindParam(":fn",  $fname);
						$statement->bindParam(":ln",  $lname);
						$statement->bindParam(":pw",  $password);
						$statement->bindParam(":email",  $email);
						$statement->bindParam(":avatar",  $avatar);
					   
						$statement->execute();
						
						
					 $data = array("un" => $username, "pw" => $password, 'email' => $email);
					}

                } catch(PDOException $e) {
                    $data = array("status" => "fail", "msg" => $e->getMessage());
                }


            } else {
                $data = array("status" => "fail", "msg" => "missing");
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

