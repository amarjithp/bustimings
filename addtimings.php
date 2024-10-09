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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body style="background-color: black; color: white; font-family: Poppins;">
  <form method="POST" action="index.php">
    <button type="submit" name="addbutton" id="addbutton" style="position: absolute; top: 10px; right: 10px; 
    background-color: white; color: black; font-size: 20px; font-weight: 600;
    padding: 12px; border-radius: 20px; font-family: Poppins;">Search Timings</button>
  </form>
  
  <form name="form" action="savetimings.php" onsubmit="" method="POST">
      <label>Bus stop: </label>
      <input type="text" id="stop" name="stop">
      <br><br>
      <label>Time</label>
      <input type="text" id="time" name="time">
      <br><br>
      <label>Route: </label>
      <input type="text" id="routes" name="routes">
      <br><br>
      <input type="submit" id="btn" value="submit" name="submit">
  </form>
</body>
</html>