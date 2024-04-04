<?php
$servername = "localhost";
$username = "toor";
$password = "\$ll5Yn793";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

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
//git add api/login.php api/db.php && git commit -m "cpt" && git push

?>