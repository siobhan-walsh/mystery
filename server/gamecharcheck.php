<?php
    
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

            if(isset($_POST["mode"]) && !empty($_POST["mode"])){


                // get the data from the post and store in variables
                
				
                
               
      
                $host_id = $_SESSION['user_id'];
               
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					
					$checkgame = $conn->prepare("SELECT * FROM game WHERE host_id = :host");
					$checkgame->bindParam(":host",  $host_id);
					
					$checkgame->execute();
					
					
					
					$count = $checkgame->rowCount();
					
					
					
					
						$rows = $checkgame->fetchAll(PDO::FETCH_ASSOC);
						
						for($i = 0; $i < count($rows); $i++){
							
							$takench = $rows[$i]['character_id'];
							$takenuser = $rows[$i]['player_id'];
							
							
						};
						
						//SELECT * FROM users WHERE user_id IN (playerid);
						
						$data = array("status" => "success", 'hostchcheck' => $rows);
				
	
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

