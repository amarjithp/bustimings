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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="index.css" type="text/css">
</head>

<body>
  <div class="area">
    <div class="context">
      <h1>Bus Timings</h1>
    </div>
    
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
    
    <form method="POST" action="addtimings.php">
      <button type="submit" name="addbutton" id="addbutton" class="add-button">Add Bus Timings</button>
    </form>
    
    <div class="search-container">
      <form name="searchtimings" action="searchtimings.php" method="post" class="search-form">
        <div class="input-group">
          <label style="font-size: 40px;">From</label>
          <br>
          <input type="text" name="searchterm">
        </div>

        <div class="input-group">
          <label style="font-size: 40px;">To</label>
          <br>
          <input type="text" name="destination">
        </div>
        
        <div class="input-group" style="flex-basis: 100%; margin-top: 12px;">
          <input type="submit" id="search" value="Search" name="submit" class="search-button">
        </div>
      </form>
    </div>
  </div>

  <script src="index.js"></script>
</body>
</html>
