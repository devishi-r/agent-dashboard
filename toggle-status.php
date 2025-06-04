<?php

session_start();
include("database.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("SELECT status FROM `agent-details` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Toggle logic
        $current_status = $row['status'];
        $new_status = ($current_status === 'Active') ? 'Inactive' : 'Active';

        $update_stmt = $conn->prepare("UPDATE `agent-details` SET status = ?, modified_at = NOW() WHERE id = ?");
        $update_stmt->bind_param("si", $new_status, $id);
        $update_stmt->execute();
    }

    header("Location: dashboard.php");
    exit();
}
?>
