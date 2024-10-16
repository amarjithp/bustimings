<?php
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

// Check if an edit request was made
if (isset($_POST['edit'])) {
    $stop_id = $_POST['stop_id'];
    $routes = $_POST['routes'];
    $arrival_time = $_POST['arrival_time']; // Treat arrival_time as string
    
    $updateQuery = "UPDATE stop_times SET routes = '$routes', arrival_time = '$arrival_time' WHERE stop_id = '$stop_id'";
    mysqli_query($conn, $updateQuery);
    header("Location: adminpanel.php"); // Refresh the page after editing
}

// Fetch all rows from the stop_times table
$query = "SELECT stop_id, routes, arrival_time FROM stop_times";
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
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
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
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
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
</head>
<body>

<div class="container">
    <h1>Admin Panel - Stop Timings</h1>

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
                    <!-- Display Data -->
                    <form method="POST" action="adminpanel.php">
                        <td data-label="Stop ID"><?php echo $row['stop_id']; ?></td>
                        <td data-label="Routes">
                            <input type="text" name="routes" value="<?php echo $row['routes']; ?>" required>
                        </td>
                        <td data-label="Arrival Time">
                            <input type="text" name="arrival_time" value="<?php echo $row['arrival_time']; ?>" required>
                        </td>
                        <td class="btn-container" data-label="Actions">
                            <input type="hidden" name="stop_id" value="<?php echo $row['stop_id']; ?>">
                            <button type="submit" name="edit" class="btn edit">Edit</button>
                        </form>
                        <form method="GET" action="adminpanel.php">
                            <input type="hidden" name="stop_id" value="<?php echo $row['stop_id']; ?>">
                            <input type="hidden" name="routes" value="<?php echo $row['routes']; ?>">
                            <input type="hidden" name="arrival_time" value="<?php echo $row['arrival_time']; ?>">
                            <button type="submit" name="delete" class="btn delete" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
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
