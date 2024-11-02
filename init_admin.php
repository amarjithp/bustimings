<?php
// Include database connection file
include 'connection.php'; // Adjust the path as needed

// Create the table
$tableCreationQuery = "CREATE TABLE IF NOT EXISTS admin (
    admin_id VARCHAR(255) NOT NULL,
    admin_pass VARCHAR(255) NOT NULL,
    PRIMARY KEY (admin_id)
)";

if (mysqli_query($conn, $tableCreationQuery)) {
    echo "Table 'admin' created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Prepare admin data
$admin_id = 'overl0rd';
$admin_pass = password_hash('g0dpass', PASSWORD_DEFAULT); // Hashing the password

// Insert admin data
$insertQuery = "INSERT INTO admin (admin_id, admin_pass) VALUES (?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("ss", $admin_id, $admin_pass);

if ($stmt->execute()) {
    echo "Admin record inserted successfully.";
} else {
    echo "Error inserting admin record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
mysqli_close($conn);
?>
