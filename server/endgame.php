<?php
    
  include("connection.php");

    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				
				$user = $_SESSION['user_id'];
            
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				
					$endsql = $conn->prepare("DELETE FROM game WHERE player_id = :user OR host_id = :user");
					$endsql->bindParam(":user",  $user);
					$endsql->execute();
					
					
					
					$data = 'gameended';

                } catch(PDOException $e) {
                    $data = array("status" => "fail", "msg" => $e->getMessage());
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

