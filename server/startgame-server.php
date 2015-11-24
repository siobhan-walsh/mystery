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
				$status = 'idk';
				
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "INSERT INTO game FROM characters WHERE player_id = :uid AND status = 2";
                    
					
                    $statement = $conn->prepare($sql);
                    $statement->execute(array(":uid" => $user_id));
					$statement->execute();
					
					
					
					$data = $statement;
                
                    $count = $statement->rowCount();
				
                 
                        
						
                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
					
					$invitefrd = array();
					
					

				   
				   
				    if($count > 0) {
                        // success, so fetch the first and hopefully only record

                        // http://stackoverflow.com/questions/15287905/convert-pdo-recordset-to-json-in-php
                        // http://php.net/manual/en/pdostatement.fetchall.php
                        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $theme= $rows[0]['theme_id'];
						$email= $rows[0]['email'];
						$character= $rows[0]['character_id'];
                        $player= $rows[0]['user_id'];
                       
                        $data = array("status" => "success", "theme" => $theme, "email" => $email, "character" => $character, "user id" => $player);


                    } else {
                        $data = "sorry";
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

