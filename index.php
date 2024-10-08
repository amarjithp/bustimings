<?php 
  include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Timings</title>
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body style="background-color: black; color: white; font-family: Poppins;">
  <button type="button" id="addbutton" style="position: absolute; top: 10px; right: 10px; 
  background-color: white; color: black; font-size: 20px; font-weight: 600;
  padding: 12px; border-radius: 20px; font-family: Poppins;">Add Bus Timings</button>

  <div style="position: absolute; top: 180px; left: 160px;">
    <form name="searchtimings" action="searchtimings.php" method="post">
      <label style="font-size: 40px;">From</label>
      <br>
      <input type="text" name="searchterm" style="width: 340px; height: 40px; border-radius: 20px;">
      <br>
      <input type="submit" id="search" value="Search" name="submit" style="width: 120px; height: 30px; border-radius: 12px;
      margin-top: 12px; margin-left: 220px; font-family: Poppins; font-weight: 600; font-size: 14px;">
    </form>
  </div>

</body>
</html>

<!-- <!DOCTYPE html>
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
      <label>Bus stoop: </label>
      <input type="text" id="searchterm" name="searchterm">
      <br><br>
      <input type="submit" id="btn1" value="search" name="submit">
  </form>
</body>
</html> -->