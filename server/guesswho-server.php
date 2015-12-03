<?php
   
   include("connection.php");


    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    if ($methodType === 'POST') {


        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
 
            if(isset($_POST["guesswho"]) && !empty($_POST["guesswho"])){

                   // $guesswho = $_POST["guesswho"];
                // get the data from the post and store in variables
               
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $statement = $conn->prepare("SELECT character_id, character_name, character_img, murderer FROM characters WHERE theme_id = 1");
        
                    $statement->execute();
					
					$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						
					$data = $rows;
					
					
                       // $data = array("status" => "success", "characters" => $guesswhoinfo);





                } catch(PDOException $e) {
                    $data = array("status" => "fail", "msg" => $e->getMessage());
                }


            } else {
                $data = array("status" => "fail", "msg" => "Either login or password were absent.");
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
