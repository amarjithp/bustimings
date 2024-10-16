<?php
session_start();
include 'connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume you have a users table with username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basic validation
    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'"; // Use hashed passwords in a real application
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['loggedin'] = true; // Set session variable
            $_SESSION['username'] = $username; // Store username in session
            header("Location: adminpanel.php"); // Redirect to admin panel
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Please fill in both fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
