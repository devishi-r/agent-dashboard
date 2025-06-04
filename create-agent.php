<?php

session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $status = 'Active';
    $created_at = date("Y-m-d H:i:s");
    $updated_at = $created_at;

    $stmt = $conn->prepare("INSERT INTO `agent-details` 
        (name, email, username, password, status, created_at, modified_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $username, $hashed_password, $status, $created_at, $updated_at);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
