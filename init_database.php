<?php
    include("connection.php");

    // SQL for creating stop_times table
    $sql1 = "CREATE TABLE stop_times (
        id INT AUTO_INCREMENT PRIMARY KEY,
        stop_id VARCHAR(255),
        arrival_time VARCHAR(255),
        routes VARCHAR(255)
    )";

    // SQL for creating users table
    $sql2 = "CREATE TABLE users (
        username VARCHAR(30),
        password VARCHAR(255)
    )";

    // Execute the first query
    $status1 = mysqli_query($conn, $sql1);

    // Execute the second query
    $status2 = mysqli_query($conn, $sql2);

    // Check if both tables were created successfully
    if ($status1 && $status2) {
        echo "Tables created successfully.";
    } else {
        echo "Error creating tables: " . mysqli_error($conn);
    }
?>
