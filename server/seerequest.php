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
            // yes, is AJAX call
            // answer POST call and get the data that was sent
            if(isset($_POST["status"]) && !empty($_POST["status"])){


                // get the data from the post and store in variables
                
				$user_id = $_SESSION['user_id'];
				$status = $_POST['status'];
				
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM friends WHERE user_b = :uid AND status = 3";
					
                    $statement = $conn->prepare($sql);
                    $statement->execute(array(":uid" => $user_id));
					$statement->execute();
					
					
					
					$data = $statement;
                
                    $count = $statement->rowCount();
				
                 
                        
						
                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
					
					$fidarr = array();
					
					
					
					for($i =0; $i < count($rows); $i++){
						
						$num = $rows[$i]['user_id'];
						
						$moresql = "SELECT * FROM users WHERE user_id IN ( :nums );";
				   
				   		$stmnt = $conn->prepare($moresql);
				   
				  		$stmnt->execute(array(":nums" => $num));
						
						$stmnt->execute();
						
						$nrows = $stmnt->fetchAll(PDO::FETCH_ASSOC);
						
						array_push($fidarr,  $nrows);
					}
                   
				   
				   
				    $data = $fidarr;


                  
				

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

