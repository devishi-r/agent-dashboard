<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

require 'database.php';

$agents = $conn->query("SELECT * FROM `agent-details`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            width: 100%;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .action-form {
            display: inline;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h1>Dashboard</h1>

<h2>Agent List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
        <th>Created At</th>
        <th>Modified At</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php while($agent = $agents->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($agent['id']) ?></td>
        <td><?= htmlspecialchars($agent['name']) ?></td>
        <td><?= htmlspecialchars($agent['email']) ?></td>
        <td><?= htmlspecialchars($agent['username']) ?></td>
        <td><?= htmlspecialchars($agent['password']) ?></td>
        <td><?= htmlspecialchars($agent['created_at']) ?></td>
        <td><?= htmlspecialchars($agent['modified_at']) ?></td>
        <td><?= htmlspecialchars($agent['status']) ?></td>
        <td>
            <form action="toggle-status.php" method="POST" class="action-form">
                <input type="hidden" name="id" value="<?= $agent['id'] ?>">
                <input type="submit" value="<?= $agent['status'] == 'Active' ? 'Deactivate' : 'Activate' ?>">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<h2>Add New Agent</h2>
<form action="create-agent.php" method="POST">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Create Agent">
</form>

<h2 style="text-align: center;">Logout</h2>
<form action="index.php" method="POST" style="max-width: 200px; margin: 0 auto;">
    <input class="logout-btn" type="submit" value="Logout">
</form>

</body>
</html>
