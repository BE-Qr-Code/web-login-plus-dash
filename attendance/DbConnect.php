<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";
// $servername = "34.93.155.184";
// $username = "root";
// $password = "apkove";
// $database = "test"; 
 
//creating a new connection object using mysqli 
$conn = new mysqli($servername, $username, $password, $database);
 
//if there is some error connecting to the database
//with die we will stop the further execution by displaying a message causing the error 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    
}

?>