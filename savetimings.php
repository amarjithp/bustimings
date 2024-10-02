<?php
  include("connection.php");
  if(isset($_POST['submit'])) {
    $stop = $_POST['stop'];
    $time = $_POST['time'];

    $sql = "INSERT INTO stop_times (stop_id, arrival_time) VALUES ('$stop', '$time')";
    $status = mysqli_query($conn, $sql);
    /*
    //print all stops
    if ($status) {
      $sql = "SELECT stop_id, arrival_time FROM stop_times";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Output data for each row
        while($row = $result->fetch_assoc()) {
          echo "Stop ID: " . $row["stop_id"]. " - Arrival Time: " . $row["arrival_time"]. "<br>";
        }
      } else {
          echo "0 results";
      }
    } else {
      echo "Error: ".mysqli_error($conn);
    }
    */
    header("Location: index.php");
    mysqli_close($conn);
  }

?>