<?php
    include("connection.php");
    $sql = "CREATE TABLE stop_times (
        id INT AUTO_INCREMENT PRIMARY KEY,
        stop_id VARCHAR(255),
        arrival_time VARCHAR(255),
        routes VARCHAR(255)
    )";

    $status = mysqli_query($conn, $sql);
    if ($status) {
        echo "database created successfully.";
    }
?>