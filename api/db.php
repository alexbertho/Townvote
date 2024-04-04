<?php
$servername = "localhost";
$username = "toor";
$password = "pO0b4f5#1";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
echo "---<br>";
echo $result;
echo "<br>----";
?>