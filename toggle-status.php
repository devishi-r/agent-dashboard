<?php
require 'database.php';

$id = $_POST['id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE `agent-details` SET status = ? WHERE id = ?");
$stmt->execute([$status, $id]);

echo "Updated agent ID $id to status $status";
