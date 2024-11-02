<?php
session_start();
include 'connection.php'; // Include your database connection file

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: adminlogin.php"); // Redirect to login page if not logged in
  exit;
}

// Check if a delete request was made
if (isset($_GET['delete'])) {
  $username = $_GET['username']; // Retrieve the moderator's username
  $deleteQuery = "DELETE FROM users WHERE username = ?";
  $stmt = $conn->prepare($deleteQuery);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->close();
}

// Check if an add request was made
if (isset($_POST['add'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
  $insertQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
  $stmt = $conn->prepare($insertQuery);
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $stmt->close();
}

// Fetch all moderators
$query = "SELECT username FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="adminpanel.css">
</head>

<body>
  <div class="container">
    <h1>Admin Panel</h1>
    <h2>Moderators</h2>

    <form method="POST" action="">
      <input type="text" name="username" placeholder="Moderator Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="add">Add Moderator</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>Username</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['username']; ?></td>
            <td>
              <form method="GET" action="">
                <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                <button type="submit" name="delete">Delete</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>