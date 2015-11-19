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

                    $sql = "INSERT INTO users (user_name, first_name, last_name, password, email, avatar) VALUES (?,  ?, ?,  ?,  ?, ?)";
					
					//INSERT INTO users (user_name, first_name, last_name, password, email, avatar) VALUES ('mickeymouse','mickey', 'mouse', 'Mickey!1', 'mmouse@gmail.com', "img/friends/f1.png");

                    $statement = $conn->prepare($sql);
                    $statement->execute(array($username, $fname, $lname,  $password,  $email, $avatar));
					$statement->execute();
					
					
                 $data = $statement;


                } catch(PDOException $e) {
                    $data = array("status" => "fail", "msg" => $e->getMessage());
                }


            } else {
                $data = array("status" => "fail", "msg" => "Either login or password were absent.");
            }



        } else {
            // not AJAX
            $data = array("status" => "fail", "msg" => "Has to be an AJAX call.");
        }


    } else {
        // simple error message, only taking POST requests
        $data = array("status" => "fail", "msg" => "Error: only POST allowed.");
    }

    echo json_encode($statement, JSON_FORCE_OBJECT);

?>

