<?php
    
include("connection.php");

    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            if(isset($_POST["round"]) && !empty($_POST["round"])){
				
				$round = $_POST["round"];
				
				$player = $_SESSION['user_id'];
				
					//SELECT character_id FROM game WHERE player_id = $_SESSION['user_id'];
					
					//SELECT round1 FROM characters WHERE character_id = $thing i just got back;
					
					//display round1 stuff
					
				   
		
					try {
						$conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						
						$gamestuff = $conn->prepare("SELECT character_id FROM game WHERE player_id = :player;");
						$gamestuff->bindParam(":player",  $player);
						
						$gamestuff->execute();
						
						$rows = $gamestuff->fetchAll(PDO::FETCH_ASSOC);
						
						$chid = $rows[0]['character_id'];
						
						
						
						if($round == 'round1'){	
						
							$round1stuff = $conn->prepare("SELECT character_name, character_img, round1 FROM characters WHERE character_id = :chid;");
							$round1stuff->bindParam(":chid",  $chid);
							
							$round1stuff->execute();
							
							$round1rows = $round1stuff->fetchAll(PDO::FETCH_ASSOC);
					
				
						
							$data = array("status" => "success", 'chname' => $round1rows[0]['character_name'], 'chimg' => $round1rows[0]['character_img'], 'msg' => $round1rows[0]['round1']);
							
					
						} else if($round == 'round2'){
							
							$round2stuff = $conn->prepare("SELECT character_name, character_img, round2 FROM characters WHERE character_id = :chid;");
							$round2stuff->bindParam(":chid",  $chid);
							
							$round2stuff->execute();
							
							$round2rows = $round2stuff->fetchAll(PDO::FETCH_ASSOC);
					
				
						
							$data = array("status" => "success", 'chname' => $round2rows[0]['character_name'], 'chimg' => $round2rows[0]['character_img'], 'msg' => $round2rows[0]['round2']);
					
						} else if($round == 'round3'){
							
							$round3stuff = $conn->prepare("SELECT character_name, character_img, round3 FROM characters WHERE character_id = :chid;");
							$round3stuff->bindParam(":chid",  $chid);
							
							$round3stuff->execute();
							
							$round3rows = $round3stuff->fetchAll(PDO::FETCH_ASSOC);
					
				
						
							$data = array("status" => "success", 'chname' => $round3rows[0]['character_name'], 'chimg' => $round3rows[0]['character_img'], 'msg' => $round3rows[0]['round3']);
							
						};
		
					} catch(PDOException $e) {
						$data = array("status" => "fail", "msg" => $e->getMessage());
					}
				
				
				

            } else {
                $data = array("status" => "fail", "msg" => "round info was absent.");
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

