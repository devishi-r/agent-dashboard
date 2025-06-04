<?php
session_start();
include("database.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error_message = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($username) || empty($password)) {
        $error_message = "Please fill all fields.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = 'Active';
        $created_at = date("Y-m-d H:i:s");
        $updated_at = $created_at;

        $stmt = $conn->prepare("INSERT INTO `agent-details` (name, email, username, password, status, created_at, modified_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $username, $hashed_password, $status, $created_at, $updated_at);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Agent</title></head>
<body>
<h2>Add New Agent</h2>

<?php if ($error_message): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <input type="submit" value="Add Agent">
</form>

<button type="button" onclick="window.location.href='index.php'">Login</button>
</body>
</html>
