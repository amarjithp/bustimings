<?php
  include("connection.php");
  if(isset($_POST['submit'])) {
    $searchterm = $_POST['searchterm'];
  
    $sql = "SELECT * FROM stop_times WHERE stop_id LIKE '%$searchterm%'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      // Output data for each row
      while($row = $result->fetch_assoc()) {
        echo "Stop ID: " . $row["stop_id"]. " - Arrival Time: " . $row["arrival_time"]. "<br>";
      }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
  }
?>