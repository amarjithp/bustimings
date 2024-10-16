<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php"); // Redirect to login page if not logged in
  exit;
}

// Include the database connection file
include 'connection.php';

// Check if a delete request was made
if (isset($_GET['delete'])) {
  $stop_id = $_GET['stop_id'];
  $routes = $_GET['routes'];
  $arrival_time = $_GET['arrival_time'];

  $deleteQuery = "DELETE FROM stop_times WHERE stop_id = '$stop_id' AND routes = '$routes' AND arrival_time = '$arrival_time'";
  mysqli_query($conn, $deleteQuery);
  header("Location: adminpanel.php"); // Refresh the page after deletion
}

// Check if the add admin form was submitted
if (isset($_POST['add_admin'])) {
  $new_username = $_POST['new_username'];
  $new_password = $_POST['new_password'];

  // Hash the password for security
  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

  // Insert the new admin into the database
  $addAdminQuery = "INSERT INTO users (username, password) VALUES ('$new_username', '$hashed_password')";

  if (mysqli_query($conn, $addAdminQuery)) {
    echo "<script>alert('New admin added successfully.');</script>";
  } else {
    echo "<script>alert('Error adding admin: " . mysqli_error($conn) . "');</script>";
  }
}

// Check if an edit request was made
if (isset($_POST['edit'])) {
  $stop_id = $_POST['stop_id'];
  $routes = $_POST['routes'];
  $arrival_time = $_POST['arrival_time']; // Treat arrival_time as string

  $updateQuery = "UPDATE stop_times SET routes = '$routes', arrival_time = '$arrival_time' WHERE stop_id = '$stop_id'";
  mysqli_query($conn, $updateQuery);
  header("Location: adminpanel.php"); // Refresh the page after editing
}

// Check if Admin Kill request was made
if (isset($_POST['admin_kill'])) {
  $admin_username = $_POST['admin_username'];

  // Only allow the admin named 'overlord' to perform this action
  if ($_SESSION['username'] === 'overl0rd') {
    $killAdminQuery = "DELETE FROM users WHERE username = '$admin_username'";
    if (mysqli_query($conn, $killAdminQuery)) {
      echo "<script>alert('Admin $admin_username removed successfully.');</script>";
    } else {
      echo "<script>alert('Error removing admin: " . mysqli_error($conn) . "');</script>";
    }
  } else {
    echo "<script>alert('You do not have permission to perform this action.');</script>";
  }
}

// Fetch all rows from the stop_times table
$query = "SELECT stop_id, routes, arrival_time FROM stop_times";
$result = mysqli_query($conn, $query);

// Fetch all admins for the Admin Kill functionality
$adminQuery = "SELECT username FROM users";
$adminResult = mysqli_query($conn, $adminQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Stop Timings</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 90%;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      position: relative;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    .btn-container {
      display: flex;
      justify-content: flex-end;
    }

    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-left: 10px;
      text-decoration: none;
    }

    .btn.edit {
      background-color: #007BFF;
    }

    .btn.delete {
      background-color: #FF4C4C;
    }

    form {
      display: inline;
    }

    /* Popup Styles */
    .popup {
      display: none;
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .popup-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .close-btn {
      background-color: #FF4C4C;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 4px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
        width: 100%;
      }

      thead tr {
        display: none;
      }

      tr {
        margin-bottom: 15px;
        border-bottom: 2px solid #ddd;
      }

      td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        position: relative;
      }

      td:before {
        content: attr(data-label);
        font-weight: bold;
        text-transform: uppercase;
        flex-basis: 30%;
        color: #4CAF50;
      }

      .btn-container {
        flex-direction: column;
        gap: 10px;
      }

      .btn {
        width: 100%;
        margin-left: 0;
        padding: 10px;
        text-align: center;
      }
    }

    @media (max-width: 480px) {
      .container {
        width: 100%;
        margin: 20px;
        padding: 10px;
      }

      h1 {
        font-size: 24px;
      }
    }
  </style>
  <script>
    function togglePopup() {
      const popup = document.getElementById("addAdminPopup");
      popup.style.display = (popup.style.display === "flex") ? "none" : "flex";
    }

    function toggleAdminKillPopup() {
      const popup = document.getElementById("adminKillPopup");
      popup.style.display = (popup.style.display === "flex") ? "none" : "flex";
    }
  </script>
</head>

<body>

  <div class="container">
    <h1>Admin Panel - Stop Timings</h1>

    <button class="btn" onclick="togglePopup()">Admin+</button>
    <button class="btn" onclick="toggleAdminKillPopup()">Admin Kill</button>
    <a href="logout.php" class="btn" style="position: absolute; top: 20px; right: 20px;">Logout</a>

    <div class="popup" id="addAdminPopup">
      <div class="popup-content">
        <h2>Add New Admin</h2>
        <form method="POST" action="adminpanel.php">
          <input type="text" name="new_username" placeholder="Username" required>
          <input type="password" name="new_password" placeholder="Password" required>
          <button type="submit" name="add_admin">Add Admin</button>
          <button type="button" class="close-btn" onclick="togglePopup()">Close</button>
        </form>
      </div>
    </div>

    <div class="popup" id="adminKillPopup">
      <div class="popup-content">
        <h2>Admin Kill</h2>
        <form method="POST" action="adminpanel.php">
          <input type="text" name="admin_username" placeholder="Admin Username" required>
          <button type="submit" name="admin_kill">Remove Admin</button>
          <button type="button" class="close-btn" onclick="toggleAdminKillPopup()">Close</button>
        </form>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Stop ID</th>
          <th>Routes</th>
          <th>Arrival Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['stop_id']; ?></td>
            <td><?php echo $row['routes']; ?></td>
            <td><?php echo $row['arrival_time']; ?></td>
            <td>
              <form method="POST" action="adminpanel.php" style="display:inline;">
                <input type="hidden" name="stop_id" value="<?php echo $row['stop_id']; ?>">
                <input type="hidden" name="routes" value="<?php echo $row['routes']; ?>">
                <input type="hidden" name="arrival_time" value="<?php echo $row['arrival_time']; ?>">
                <button type="submit" name="edit" class="btn edit">Edit</button>
              </form>
              <form method="GET" action="adminpanel.php" style="display:inline;">
                <input type="hidden" name="stop_id" value="<?php echo $row['stop_id']; ?>">
                <input type="hidden" name="routes" value="<?php echo $row['routes']; ?>">
                <input type="hidden" name="arrival_time" value="<?php echo $row['arrival_time']; ?>">
                <button type="submit" name="delete" class="btn delete">Delete</button>
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