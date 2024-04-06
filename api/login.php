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
    
    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo $row['id'] . " - login: " . $row['login'] . " - password: " . $row['pass'] . "<br>";
        }
    } else {
        echo "0 results";
    }
    echo "---<br>";
    echo $result;
    echo "<br>----";
    //git add api/login.php api/db.php && git commit -m "cpt" && git push
    //git add api/db.php api/login.php && git commit -m "maj auto" && git push

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     if (password_verify($password, $row['password'])) {
    //         $_SESSION['user_id'] = $row['id'];
    //         header("Location: index.php");
    //         exit();
    //     }
    // }
    // $error = 'Invalid username or password';
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