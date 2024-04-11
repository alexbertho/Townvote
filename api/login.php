<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    

//     $sql = "SELECT * FROM clients WHERE login = '$username'";

//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         // output data of each row
//         while($row = $result->fetch_assoc()) {
//         echo $row['id'] . " - login: " . $row['login'] . " - password: " . $row['pass'] . "<br>";
//         }
//     } else {
//         echo "0 results";
//     }
//     if ($result->num_rows == 1) {
//         $row = $result->fetch_assoc();
//         if ($password == $row['pass']) {
//             $_SESSION['user_id'] = $row['id'];
//             header("Location: index.php");
//             exit();
//         }
//     } else {
//         $error = 'Invalid username or password';
//     }
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    } else {
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }

    $sql = "SELECT * FROM clients WHERE login = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) { // Si un utilisateur a été trouvé
        $row = $result->fetch_assoc();
        if ($password == $row['pass']) { // Si le mot de passe est correct
            $data = [
                'success' => true,
                'message' => 'Login successful'
            ];
            $_SESSION['user_id'] = $row['id'];
        }
    } else if ($result->num_rows == 0) { // Si aucun utilisateur n'a été trouvé
        $data = [
            'success' => false,
            'message' => 'Username not found'
        ];
    } else { 
        $data = [
            'success' => false,
            'message' => 'Incorrect password'
        ];
    }

    $jsonData = json_encode($data);

    // Set the content type header
    header('Content-Type: application/json');

    // Output the JSON data
    echo $jsonData;
}
?>

?>