<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

require 'database.php';

$agents = $conn->query("SELECT * FROM `agent-details`");

?>

<h1>Dashboard</h1>

<h2> Agent List</h2>
<table border = "1">
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Username</th>
    <th>Password</th>
    <th>Created at</th>
    <th>Modified at</th>
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
        <form action="toggle-status.php" method="POST" style="display:inline;">
            <input type="hidden" name="id" value="<?= $agent['id'] ?>">
            <input type="submit" value="<?= $agent['status'] == 'Active' ? 'Deactivate' : 'Activate' ?>">
        </form>
    </td>
</tr>
<?php endwhile; ?>
</table>

<h2>Add New Agent</h2>
<form action="create-agent.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Create Agent">
</form>

<br /><br />
<h2>Logout</h2>
<form action="index.php" method="POST" style="display:inline;">
    <input type="submit" value="Logout">
</form>