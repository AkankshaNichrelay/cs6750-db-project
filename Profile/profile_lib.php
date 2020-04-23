<?php
function connectDB() {
  // include_once("../con.php"); // To connect to the database
  $con = new mysqli("localhost:3307", "musify", "musify1234", "musify");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  return $con;
}
?>