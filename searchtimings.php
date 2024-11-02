<?php
  include("connection.php");
  if(isset($_POST['submit'])) {
    $searchterm = $_POST['searchterm'];
    $destination = $_POST['destination'];
  
    $sql = "SELECT * FROM stop_times WHERE stop_id LIKE '%$searchterm%' AND routes LIKE '%$destination%'";
    $result = mysqli_query($conn, $sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>

  <!-- CSS -->
  <link rel="stylesheet" href="searchtimings.css">

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body style="background-color: black; color: white; font-family: Poppins; align-items: center;">
  <!-- addbutton -->
  <form method="POST" action="index.php">
    <button type="submit" name="homebutton" id="addbutton" style="position: absolute; top: 10px; right: 10px; 
    background-color: white; color: black; font-size: 20px; font-weight: 600;
    padding: 12px; border-radius: 20px; font-family: Poppins;">Home</button>
  </form>

<?php
  if ($result->num_rows > 0) {
    echo "<h2>Search Results:</h2>";
    echo "<table>";
    echo "<tr><th>Stop ID</th><th>Arrival Time</th><th>Route</th></tr>";
    // Output data for each row
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td class='stop-id'>" . $row["stop_id"] . "</td>";
      echo "<td class='arrival-time'>" . $row["arrival_time"] . "</td>";
      echo "<td class='route'>" . $row["routes"] . "</td>";
      echo "</tr>";
    }
  } else {
    echo "<p>No results found for '$searchterm'.</p>";
  }
  mysqli_close($conn);
?>

</body>
</html>