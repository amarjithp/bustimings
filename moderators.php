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
  $id = $_GET['id']; // Retrieve the row's unique id

  // Use id only to delete the specific row
  $deleteQuery = "DELETE FROM stop_times WHERE id = '$id'";
  mysqli_query($conn, $deleteQuery);
  header("Location: moderators.php"); // Refresh the page after deletion
}

// Check if an edit request was made
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $routes = $_POST['routes'];
    $arrival_time = $_POST['arrival_time']; // Treat arrival_time as string

    // Use prepared statement to prevent SQL injection
    $updateQuery = "UPDATE stop_times SET routes = ?, arrival_time = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssi", $routes, $arrival_time, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: moderators.php"); // Refresh the page after editing
}

// Fetch all rows from the stop_times table
$query = "SELECT id, stop_id, routes, arrival_time FROM stop_times";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moderators Control Centre</title>
  <link rel="stylesheet" href="moderators.css">
</head>

<body>

  <div class="container">
    <h1>Moderators Control Centre</h1>

    <a href="logout.php" class="btn logout">Logout</a>

    <table id="stop-timings-table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Stop ID</th>
          <th>Routes</th>
          <th>Arrival Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td class="id"><?php echo $row['id']; ?></td> <!-- Use the 'id' column here -->
        <td class="stop-id"><?php echo $row['stop_id']; ?></td>
        <td class="routes" contenteditable="false"><?php echo $row['routes']; ?></td>
        <td class="arrival-time" contenteditable="false"><?php echo $row['arrival_time']; ?></td>
        <td>
          <button class="btn edit-btn" onclick="toggleEdit(this)">Edit</button>
          <button class="btn save-btn" style="display: none;" onclick="saveEdits(this)">Save</button>
          <form method="GET" action="moderators.php" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="delete" class="btn delete-btn">Delete</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
    </table>

    <script>
      function toggleEdit(editBtn) {
        const row = editBtn.closest('tr');
        const routesCell = row.querySelector('.routes');
        const arrivalTimeCell = row.querySelector('.arrival-time');
        const saveBtn = row.querySelector('.save-btn');

        routesCell.setAttribute('contenteditable', 'true');
        arrivalTimeCell.setAttribute('contenteditable', 'true');
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
      }

      function saveEdits(saveBtn) {
        const row = saveBtn.closest('tr');
        const id = row.querySelector('.id').textContent;
        const routesCell = row.querySelector('.routes');
        const arrivalTimeCell = row.querySelector('.arrival-time');
        const editBtn = row.querySelector('.edit-btn');

        const updatedRoutes = routesCell.textContent;
        const updatedArrivalTime = arrivalTimeCell.textContent;

        // Send AJAX request to update database using 'id' instead of 'stop_id'
        fetch(`update-stop-timing.php?id=${id}&routes=${updatedRoutes}&arrival_time=${updatedArrivalTime}`)
          .then(response => response.json())
          .then(data => {
            if (data.status === "success") {
              console.log(data.message); // Success message
            } else {
              console.error(data.message); // Error message
            }
          })
          .catch(error => console.error('Error:', error));

        routesCell.setAttribute('contenteditable', 'false');
        arrivalTimeCell.setAttribute('contenteditable', 'false');
        saveBtn.style.display = 'none';
        editBtn.style.display = 'inline-block';
      }
    </script>

  </div>

</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
