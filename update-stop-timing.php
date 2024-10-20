<?php
// Include database connection file
include 'connection.php';

if (isset($_GET['stop_id']) && isset($_GET['routes']) && isset($_GET['arrival_time'])) {
  $stopId = $_GET['stop_id'];
  $updatedRoutes = $_GET['routes'];
  $updatedArrivalTime = $_GET['arrival_time'];

  $updateQuery = "UPDATE stop_times SET routes = ?, arrival_time = ? WHERE stop_id = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("sss", $updatedRoutes, $updatedArrivalTime, $stopId);
  if ($stmt->execute()) {
    echo "Stop timing updated successfully!";
  } else {
    echo "Error updating stop timing: " . $conn->error;
  }
  $stmt->close();
  $conn->close();
} else {
  echo "Invalid request.";
}
