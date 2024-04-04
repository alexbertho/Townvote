<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once 'db.php';

    $username = $_GET['username'];
    $password = $_GET['password'];
    echo "<br>";
    echo $username;
    echo "<br>";
    echo $password;
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    echo "<br>";
    echo $result;
    echo "<br>";
    echo "aaaaaaaaaaaaaaaa";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        }
    }
    $error = 'Invalid username or password';
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     require_once 'db.php';
//     $username = $_POST['username'];
//     $password = $_POST['password'];
    
//     $sql = "SELECT * FROM users WHERE username = '$username'";

    

//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         if (password_verify($password, $row['password'])) {
//             $_SESSION['user_id'] = $row['id'];
//             header("Location: index.php");
//             exit();
//         }
//     }
//     $error = 'Invalid username or password';
// }


?>