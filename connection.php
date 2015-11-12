<?php
/*
 echo "yo";
//makes connection to mySql

$con = mysqli_connect("localhost", "funkint1_siobhan_funkint1_mystery", "");


		
if(mysqli_connect_errno()){
	echo "mysql has failed .... reason:" . myspli_connect_error();	
}


*/


//lab5 search
echo 'hello';

    $methodType = $_SERVER['REQUEST_METHOD'];

        $servername = 'localhost';
        $username = 'funkint1_siobhan';
        $password = '';
        $dbname = 'funkint1_mystery';
        
        echo "<p> database name is $dbname </p>";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users";

        $statement = $conn->prepare($sql);

        $statement->execute();
        
        $count = $statement->rowCount();

        echo "<p> count is $count </p>";

       // $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        

    /*
        foreach($row as $key => $row){
               $rows = $row[i];
                echo "<p> the thing is $rows[first_name]<p>";
                $i = $i + 1;
        }
*/

       
       echo "<p> row is {$row['first_name']} {$row['last_name']} </p>";
        
    //   var_dump($row);

        

?>

