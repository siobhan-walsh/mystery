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
 
         


                // get the data from the post and store in variables
               
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT character_id, character_name, character_description, character_img FROM characters WHERE theme_id = 1";
	

                    $statement = $conn->prepare($sql);
        
					$statement->execute();

                    // this should be one if there's a user by that user value and password value
                    $count = $statement->rowCount();
				
               		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						
					
					/*
						$char = array();
						
							for($i = 0; $i < $count; $i++){
								
								$charinfo = array(
												"character_id" => $rows[$i]['character_id'],
												"character_name" => $rows[$i]['character_name'],
												"character_description" => $rows[$i]['character_description'],
												"character_img" => $rows[$i]["character_img"]
											);
				
								array_push($char, $charinfo);
								
							}
								
						*/
						
						//var_dump($rows);
						
						$data = array($rows);



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

