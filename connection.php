<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "bustimings";
  $conn = new mysqli($servername, $username, $password, $db_name, 3306);
  if (!$conn) {
    die("connection failed".$conn->connect_error);
  }
  echo "";
?>