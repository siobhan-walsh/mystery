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

            if(isset($_POST["character_id"]) && !empty($_POST["character_id"])
			   &&  isset($_POST["theme_id"]) && !empty($_POST["theme_id"])){


                // get the data from the post and store in variables
                
				
                
                $theme_id = 1;
                $host_id = $_SESSION['user_id'];
                $player_id = $_SESSION['user_id'];
                $character_id = $_POST['character_id'];
			
				
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					
					$checkgame = $conn->prepare("SELECT * FROM game WHERE host_id = :host");
					$checkgame->bindParam(":host",  $host_id);
					
					$checkgame->execute();
					
					
					
					$count = $checkgame->rowCount();
					
					
					
					if($count > 0){
						$rows = $checkgame->fetchAll(PDO::FETCH_ASSOC);
						$data = array("status" => "success", 'msg' => "alreadygame", 'gameinfo' => $rows);
						
					} else {
					
					

						$statement = $conn->prepare("INSERT INTO game (host_id, theme_id, player_id, character_id) VALUES (:host,  :theme, :player,  :character);");
						
						$statement->bindParam(":host",  $host_id);
						$statement->bindParam(":theme",  $theme_id);
						$statement->bindParam(":player",  $player_id);
						$statement->bindParam(":character",  $character_id);
						
						
					   
						$statement->execute();
						
						$data = 'you donnt already have a game';	
						
						
						$checkgame = $conn->prepare("SELECT * FROM game WHERE host_id = :host");
						$checkgame->bindParam(":host",  $host_id);
					
						$checkgame->execute();
						$rows = $checkgame->fetchAll(PDO::FETCH_ASSOC);
						
						 $data = array("status" => "success", 'message' => 'newgame', 'gameinfo' => $rows);
						
						
					
					}
					
                    
	
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

