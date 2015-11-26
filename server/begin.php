<?php
    
include("connection.php");

    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            if(isset($_POST["startgame"]) && !empty($_POST["startgame"])){
				
				$host_id = $_SESSION['user_id'];

                // get the data from the post and store in variables
                
				
				//"UPDATE game SET stage = 5 WHERE host_id= host_id;
								
						//then update the host to stage 4
											
			//UPDATE game SET stage = 4 WHERE player_id = host_id;
									
				
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					
					$begingame = $conn->prepare("UPDATE game SET stage = 5 WHERE host_id = :host");
					$begingame->bindParam(":host",  $host_id);
					
					$begingame->execute();
					
					$fbegingame = $conn->prepare("UPDATE game SET stage = 4 WHERE player_id = :host");
					$fbegingame->bindParam(":host",  $host_id);
					
					$fbegingame->execute();
					
					
					$data = array("status" => "success", 'msg' => "start");
						
					
                    
	
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

