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

    /* Responsive Styles */
    /* Tablet (768px - 991px) */
    @media (max-width: 991px) {
      .container {
        margin: 30px auto;
      }
      table th,
      table td {
        padding: 8px;
      }
    }

    /* Mobile (480px - 767px) */
    @media (max-width: 767px) {
      .container {
        margin: 20px auto;
        padding: 15px;
      }
      table {
        border: 0;
      }
      table caption {
        font-size: 1.3em;
      }
      table thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }
      table tr {
        border-bottom: 3px solid #ddd;
        display: block;
        margin-bottom: 0.625em;
      }
      table td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: 0.8em;
        text-align: right;
      }
      table td:before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
      }
      table td:last-child {
        border-bottom: 0;
      }
      .btn-container {
        flex-direction: column;
        align-items: flex-end;
      }
      .btn {
        margin-left: 0;
        margin-bottom: 10px;
        text-align: center;
      }
    }

    /* Mobile (max-width: 480px) */
    @media (max-width: 480px) {
      .container {
        width: 95%;
        margin: 15px auto;
        padding: 10px;
      }
      table td {
        font-size: 0.7em;
      }
      .btn {
        padding: 6px 12px;
      }
    }

    h1 {
      font-size: 24px;
    }
  </style>
  <link rel="stylesheet" href="adminpanel.css">
</head>

<body>

  <div class="container">
    <h1>Moderators Control Centre</h1>

    <a href="logout.php" class="btn" style="top: 20px; right: 20px;">Logout</a>

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
