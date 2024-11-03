<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Bus Timings</title>

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Exo:400,700" rel="stylesheet">
  <link rel="stylesheet" href="addtimings.css">
</head>
<body>
  <div class="area">
    <ul class="circles">
      <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
    </ul>
  </div>

  <!-- Main page content -->
  <div class="button-container">
    <form method="POST" action="index.php">
      <button type="submit" name="homebutton" id="homebutton">Search Timings</button>
    </form>
  </div>

  <form name="form" action="savetimings.php" method="POST">
    <label for="stop">Bus stop:</label>
    <input type="text" id="stop" name="stop" required>

    <label for="time">Time:</label>
    <input type="text" id="time" name="time" required>

    <label for="routes">Route:</label>
    <input type="text" id="routes" name="routes" required>

    <div class="search-form">
      <input type="submit" id="btn" value="Submit" name="submit">
    </div>
  </form>
</body>
</html>
