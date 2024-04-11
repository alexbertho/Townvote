<?php
$servername = "localhost";
$bdUsername = "toor";
$bdPassword = "\$ll5Yn793";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $bdUsername, $bdPassword, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

?>