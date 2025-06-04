<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "agent-management-module";

$conn = mysqli_connect($servername, $username, $password, $db_name);
if($conn){
    echo("Connected successfully");
}
else{
    echo("Connection failed");
}

?>