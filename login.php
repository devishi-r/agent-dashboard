<?php

session_start();
include("database.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $conn->real_escape_string($_POST["username"]); // Basic sanitation
    $password = $conn->real_escape_string($_POST["password"]); // Password will be hashed, so no real_escape_string here

    $sql = "SELECT username, password FROM `agent-details` WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $error_message = "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // if (password_verify($password, $row["password"])) { 
            if($password==$row["password"]){

                $_SESSION['username'] = $row['username']; 

                header("Location: dashboard.php");
                exit();
            } else {
                $error_message = "Invalid password";
            }
        } else {
            $error_message = "Invalid username";
        }
        $stmt->close();
    }
}