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

    if ($methodType === 'GET') {

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true  && isset($_SESSION['username']) && !empty(($_SESSION['username']) && isset($_SESSION['user_id'])) && !empty(($_SESSION['user_id']))){

                $login = $_SESSION['username'];
                // if the above worked then we got the session back and the minimal
                // data that we stored inside of the session
                try {
                    $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM users WHERE user_name = :log";

                    $statement = $conn->prepare($sql);
                    $statement->execute(array(":log" => $login));

                    // this should be one if there's a user by that user value
                    $count = $statement->rowCount();

                    if($count > 0) {
                        // success, so fetch the first and hopefully only record

                        // http://stackoverflow.com/questions/15287905/convert-pdo-recordset-to-json-in-php
                        // http://php.net/manual/en/pdostatement.fetchall.php
                        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $data = array("status" => "success", "userProfile" => $rows[0]);

                    } else {
                        $data = array("status" => "fail", "msg" => "User name and/or password not correct.");
                    }


                } catch(PDOException $e) {
                    $data = array("status" => "fail", "msg" => $e->getMessage());
                }

            } else {
                $data = array("status" => "fail", "msg" => "Not logged in.");
            }

        } else {

            $data = array("status" => "fail", "msg" => "Has to be an AJAX call.");

        }

    } else {

        $data = array("status" => "fail", "msg" => "Error: only GET allowed.");

    }

    echo json_encode($data, JSON_FORCE_OBJECT);

?>

