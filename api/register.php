<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['username']) && isset($_GET['password'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];
    } else {
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }
    require_once 'db.php';


    echo "<br> username:";
    echo $username;
    echo "<br> password:";
    echo $password;
    echo "<br>";
    echo "<br>";
    
    $sql = "SELECT * FROM clients WHERE login = '$username'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo $row['id'] . " - login: " . $row['login'] . " - password: " . $row['pass'] . "<br>";
        }
    } else {
        echo "0 results";
    }
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['pass']) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        }
    } else {
        $error = 'Invalid username or password';
    }
}



?>