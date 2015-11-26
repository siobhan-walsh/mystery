<?php
    
   include("connection.php");


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
					
					
					//all character_id in game, player_id in game, username from user where user_id is player_id
					
					
						$rows = $checkgame->fetchAll(PDO::FETCH_ASSOC);
						
						$takencharacters = array();
						
						for($i = 0; $i < count($rows); $i++){
							
							if($rows[$i]['player_id'] == $rows[$i]['host_id']){
								
							} else {
								
								$chuser = $conn->prepare("SELECT user_name FROM users WHERE user_id = :player");
								$chuser->bindParam(":player",  $rows[$i]['player_id']);
					
								$chuser->execute();
								
								$chresult = $chuser->fetchAll(PDO::FETCH_ASSOC);
							
								$playcharinfo = array(
								
									'takench' => $rows[$i]['character_id'],
									'takenuser' => $rows[$i]['player_id'],
									'takeninfo' => $chresult[0]['user_name']
								
								);
								
								array_push($takencharacters, $playcharinfo);
							};
						};
						
						//SELECT * FROM users WHERE user_id IN (playerid);
						
						$data = array("status" => "success", 'takeninfo' => $takencharacters);
				
	
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

