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
  
  <style>
    body {
      background-color: black;
      color: white;
      font-family: Poppins;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh; /* Full height for vertical centering */
    }

    .button-container {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .button-container button {
      background-color: white;
      color: black;
      font-size: 20px;
      font-weight: 600;
      padding: 12px;
      border-radius: 20px;
      font-family: Poppins;
      border: none; /* Remove default border */
      cursor: pointer; /* Change cursor to pointer */
    }

    form {
      display: flex;
      flex-direction: column;
      width: 70%; /* Full width on smaller screens */
      max-width: 400px; /* Maximum width for larger screens */
      margin-top: 60px; /* Space above the form */
    }

    .search-form {
      display: flex;
      flex-direction: row; /* Horizontal layout for search fields and button */
      align-items: center; /* Center align items vertically */
      gap: 10px; /* Space between items */
    }

    label {
      margin-bottom: 5px; /* Space between label and input */
      font-size: 16px; /* Consistent font size for labels */
    }

    input[type="text"], input[type="submit"] {
      width: 100%; /* Full width of the parent container */
      height: 40px; /* Consistent height for inputs */
      border-radius: 20px;
      padding: 0 10px; /* Padding inside input */
      margin-bottom: 20px; /* Space between inputs */
      border: 1px solid #ccc; /* Light border for input fields */
      font-size: 16px; /* Consistent font size for inputs */
    }

    input[type="submit"] {
      background-color: #28a745; /* Green background for submit button */
      color: white;
      border: none; /* Remove default border */
      cursor: pointer; /* Change cursor to pointer */
    }

    input[type="submit"]:hover {
      background-color: #218838; /* Darker green on hover */
    }

    /* Media queries for further adjustments */
    @media (max-width: 600px) {
      .button-container button {
        font-size: 18px; /* Smaller font size on small screens */
      }
      input[type="text"], input[type="submit"] {
        height: 35px; /* Adjust height for smaller screens */
      }
    }
  </style>
</head>
<body>
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
