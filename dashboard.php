<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

require 'database.php';

$agents = $conn->query("SELECT * FROM `agent-details`");

?>

<h1> Agent List</h1>
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
            <input type="submit" value="<?= $agent['status'] == 'active' ? 'Deactivate' : 'Activate' ?>">
        </form>
    </td>
</tr>
<?php endwhile; ?>
</table>