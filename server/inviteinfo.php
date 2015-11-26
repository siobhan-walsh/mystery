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

           if(isset($_POST["host"]) && !empty($_POST["host"])
			   &&  isset($_POST["theme"]) && !empty($_POST["theme"])
			    &&  isset($_POST["character"]) && !empty($_POST["character"])){


                // get the data from the post and store in variables
				
				$player_id = $_SESSION['user_id'];
				$host = $_POST['host'];
				$theme = $_POST['theme'];
				$character = $_POST['character'];
                
				// who is inviting you == select username from users where user-id = gcheck hostid
				
				
				// what theme it is (theme will be 1 for now) === SELECT title FROM themes WHERE theme_id = 1;
				
				
				// what character you are == SELECT * from characters WHERE character_id = gcheck charcter_id;
				
                
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					
					$hostname = $conn->prepare("SELECT user_name FROM users WHERE user_id = :host");
					$hostname->bindParam(":host",  $host);
					
					$hostname->execute();
					$hostrows = $hostname->fetchAll(PDO::FETCH_ASSOC);
					
					$themesql = $conn->prepare("SELECT title FROM themes WHERE theme_id = :theme");
					$themesql->bindParam(":theme",  $theme);
					
					$themesql->execute();
					$themerows = $themesql->fetchAll(PDO::FETCH_ASSOC);
					
					$charactersql = $conn->prepare("SELECT character_name, character_description, character_img FROM characters WHERE character_id = :character");
					$charactersql->bindParam(":character",  $character);
					
					$charactersql->execute();
					$characterrows = $charactersql->fetchAll(PDO::FETCH_ASSOC);
					
					
					
					
					$data = array("status" => "success", 'hostname' => $hostrows[0]['user_name'], 'themetitle' => $themerows[0]['title'], 'characterinfo' => $characterrows[0]);
				
	
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

