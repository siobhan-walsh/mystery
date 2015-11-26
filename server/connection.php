    
<?php

    // get the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "$methodType");

    $DBHost = "localhost";
    $dblogin = "root";
    $DBpassword = "root";
    $DBname = "mystery";
	
?>