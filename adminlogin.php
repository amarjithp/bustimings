<?php
session_start();
include 'connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];
    $admin_pass = $_POST['admin_pass'];

    // Fetch the admin password from the database
    $query = "SELECT admin_pass FROM admin WHERE admin_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_pass);
        $stmt->fetch();

        // Verify the password
        if (password_verify($admin_pass, $hashed_pass)) {
            $_SESSION['loggedin'] = true;
            header("Location: adminpanel.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No such admin found.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
    <div class="container">
        <form class="form" method="POST" action="">
            <div class="control">
                <h1>Admin Login</h1>
            </div>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <div class="control block-cube block-input">
                <input type="text" id="admin_id" name="admin_id" required placeholder="Admin ID">
                <div class="bg-top">
                    <div class="bg-inner"></div>
                </div>
                <div class="bg-right">
                    <div class="bg-inner"></div>
                </div>
                <div class="bg">
                    <div class="bg-inner"></div>
                </div>
            </div>
            <div class="control block-cube block-input">
                <input type="password" id="admin_pass" name="admin_pass" required placeholder="Password">
                <div class="bg-top">
                    <div class="bg-inner"></div>
                </div>
                <div class="bg-right">
                    <div class="bg-inner"></div>
                </div>
                <div class="bg">
                    <div class="bg-inner"></div>
                </div>
            </div>
            <button class="btn block-cube block-cube-hover" type="submit">
                <div class="bg-top">
                    <div class="bg-inner"></div>
                </div>
                <div class="bg-right">
                    <div class="bg-inner"></div>
                </div>
                <div class="bg">
                    <div class="bg-inner"></div>
                </div>
                <div class="text">Log In</div>
            </button>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
