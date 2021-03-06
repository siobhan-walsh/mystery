<?php
    
  include("connection.php");

    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            if(isset($_POST["character_id"]) && !empty($_POST["character_id"])
			   &&  isset($_POST["frienduid"]) && !empty($_POST["frienduid"])){


                // get the data from the post and store in variables
                
				
                
                $theme_id = 1;
                $host_id = $_SESSION['user_id'];
				$friendid = $_POST["frienduid"];
                $character_id = $_POST['character_id'];
	
				
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					
					$dotheyplay = $conn->prepare("SELECT * FROM game WHERE player_id = :friendid;");
					$dotheyplay->bindParam(":friendid",  $friendid);
					$dotheyplay->execute();
					
					$rows = $dotheyplay->fetchAll(PDO::FETCH_ASSOC);
					$count = $dotheyplay->rowCount();


					if($count > 0){
						$data = 'unavailable';	
					} else {
                    	$statement = $conn->prepare("INSERT INTO game (host_id, theme_id, player_id, character_id, stage) VALUES (:host,  :theme, :player,  :character, 2);");
						
						$statement->bindParam(":host",  $host_id);
						$statement->bindParam(":theme",  $theme_id);
						$statement->bindParam(":player",  $friendid);
						$statement->bindParam(":character",  $character_id);
						
						
					   
						$statement->execute();
						
						$notistatement = $conn->prepare("UPDATE users SET notification = 2  WHERE user_id= :friendid;");
						$notistatement->bindParam(":friendid",  $friendid);
						$notistatement->execute();
						
						$data = 'invited';	
						
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

