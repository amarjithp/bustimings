<?php
  include("connection.php");

  if (isset($_POST['submit'])) {
    $searchterm = $_POST['searchterm'];
    $destination = $_POST['destination'];

    $sql = "SELECT * FROM stop_times WHERE stop_id LIKE '%$searchterm%' AND routes LIKE '%$destination%'";
    $result = mysqli_query($conn, $sql);

    // Debugging
    if (!$result) {
      echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
    } elseif (mysqli_num_rows($result) == 0) {
      $no_results = true;
    }
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    /* Include the animated background CSS and responsive styles as previously provided */
  </style>
</head>
<body>
  <div class="area">
    <ul class="circles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>

  <div class="button-container">
    <form method="POST" action="index.php">
      <button type="submit" name="homebutton">Home</button>
    </form>
  </div>

  <div class="context">
    <h2>Search Results</h2>
  </div>

  <div class="table-container">
    <?php
      if (isset($no_results) && $no_results) {
        echo "<p>No results found for '$searchterm' and '$destination'.</p>";
      } elseif ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Stop ID</th><th>Arrival Time</th><th>Route</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td class='stop-id'>" . $row["stop_id"] . "</td>";
          echo "<td class='arrival-time'>" . $row["arrival_time"] . "</td>";
          echo "<td class='route'>" . $row["routes"] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      } elseif (!isset($result)) {
        echo "<p>Please submit a search to see results.</p>";
      }
      mysqli_close($conn);
    ?>
  </div>
</body>
</html>
