<?php 
  include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Timings</title>
</head>
<body style="background-color: gray;">
  <form name="form" action="savetimings.php" onsubmit="" method="POST">
      <label>Bus stop: </label>
      <input type="text" id="stop" name="stop">
      <br><br>
      <label>Time</label>
      <input type="text" id="time" name="time">
      <br><br>
      <input type="submit" id="btn" value="submit" name="submit">
  </form>
  <br>
  <form name="form1" action="searchtimings.php" onsubmit="" method="POST">
      <label>Bus stop: </label>
      <input type="text" id="searchterm" name="searchterm">
      <br><br>
      <input type="submit" id="btn1" value="search" name="submit">
  </form>
</body>
</html>