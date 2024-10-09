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
  <style>
      body {
          background-color: black;
          color: white;
          font-family: Poppins;
          margin: 0;
          padding: 0;
      }
      .add-button {
          position: absolute;
          top: 10px;
          right: 10px;
          background-color: white;
          color: black;
          font-size: 20px;
          font-weight: 600;
          padding: 12px;
          border-radius: 20px;
          font-family: Poppins;
      }
      .search-container {
          position: absolute;
          top: 180px;
          left: 50%;
          transform: translateX(-50%);
          width: 80%;
          max-width: 800px; /* Maximum width for larger screens */
      }
      .search-form {
          display: flex;
          flex-wrap: wrap; /* Allows items to wrap on small screens */
          gap: 12%; /* Gap between elements */
      }
      .input-group {
          flex: 1; /* Allows the input groups to grow equally */
          min-width: 250px; /* Minimum width for small screens */
      }
      input[type="text"] {
          width: 100%; /* Full width of the parent container */
          height: 40px;
          border-radius: 20px;
          padding: 0 10px; /* Padding inside input */
      }
      input[type="submit"] {
          width: 120px;
          height: 30px;
          border-radius: 12px;
          margin-top: 12px;
          font-family: Poppins;
          font-weight: 600;
          font-size: 14px;
          align-self: flex-start; /* Aligns the button to the start of the flex container */
      }

      /* Media queries for further adjustments */
      @media (max-width: 600px) {
          input[type="text"] {
              height: 35px; /* Adjust height for smaller screens */
          }
          input[type="submit"] {
              width: 100%; /* Full width for the submit button on small screens */
              margin-left: 0px; /* Reset margin */
          }
      }
  </style>
</head>

<body>
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
        <input type="submit" id="search" value="Search" name="submit" style="width: 20%; height: 40px; border-radius: 12px; font-family: Poppins; font-weight: 600; font-size: 14px;">
      </div>
    </form>
  </div>

</body>
</html>
