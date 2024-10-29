<?php
// Include database connection file
include 'connection.php';

header('Content-Type: application/json'); // Set header for JSON response

if (isset($_GET['id'], $_GET['routes'], $_GET['arrival_time'])) {
    $id = $_GET['id'];
    $updatedRoutes = $_GET['routes'];
    $updatedArrivalTime = $_GET['arrival_time'];

    // Simple validation (adjust as needed)
    if (!is_numeric($id)) {
        echo json_encode(["status" => "error", "message" => "Invalid ID format."]);
        exit;
    }

    $updateQuery = "UPDATE stop_times SET routes = ?, arrival_time = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssi", $updatedRoutes, $updatedArrivalTime, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Stop timing updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating stop timing: " . $conn->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request parameters."]);
}
$conn->close();
?>
