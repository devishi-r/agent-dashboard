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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #6c757d;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .login-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<h2>Add New Agent</h2>

<?php if ($error_message): ?>
    <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Add Agent">
</form>

<button class="login-btn" onclick="window.location.href='index.php'">Login</button>

</body>
</html>
    