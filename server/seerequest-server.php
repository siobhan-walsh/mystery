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
            // yes, is AJAX call
            // answer POST call and get the data that was sent
            if(isset($_POST["status"]) && !empty($_POST["status"])){


                // get the data from the post and store in variables
                
				$user_id = $_SESSION['user_id'];
				$status = $_POST['status'];
				
               
	
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM friends WHERE user_b = :uid AND status = 0";
					
                    $statement = $conn->prepare($sql);
                    $statement->execute(array(":uid" => $user_id));
					$statement->execute();
					
					
					
					$data = $statement;
                
                    $count = $statement->rowCount();
				
                 
                        
						
                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                        
						/*
						$user_id= $rows[0]['user_id'];
						$userbthatsyou= $rows[0]['user_b'];
						$status= $rows[0]['status'];
						
						
						$requestarr = array();
					
					
                       while( $rows = $statement->fetchAll(PDO::FETCH_ASSOC)){
	
	
						$sarr = array(
									"fid "=> $rows['user_id'],
									"user_id" => $rows['user_b'],
									"status" => $rows['status']
								
								);
								
								//array_push($requestarr, $sarr);
								
							
							
						}
						*/
									   
                        $data = array("status" => "success", "notifications" => $count);


                  
				

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
