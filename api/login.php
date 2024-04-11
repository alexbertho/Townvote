<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    } else {
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }
    require_once 'db.php';

    $sql = "SELECT * FROM clients WHERE login = '$username'";
    $result = $conn->query($sql);
    $data = array();

    if ($result->num_rows == 1) { // Si un utilisateur a été trouvé
        $row = $result->fetch_assoc();
        if ($password == $row['pass']) { // Si le mot de passe est correct
            $data = [
                'success' => true,
                'message' => 'Login successful'
            ];
            $_SESSION['user_id'] = $row['id'];
            header("Location: ../index.php");
            exit();
        } else {
            $data = [
                'success' => false,
                'message' => 'Incorrect password'
            ];

        }
    } else if ($result->num_rows == 0) { // Si aucun utilisateur n'a été trouvé
        $data = [
            'success' => false,
            'message' => 'Username not found'
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);

}
// session_start();
// // error_log("login.php", 1, "tollmeface@gmail.com");
// // if (isset($_SESSION['user_id'])) {
// //     header("Location: ../index.php");
// //     exit();
// // }
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['username']) && isset($_POST['password'])) {
//         error_log(json_encode($_POST), 0);
//         $username = $_POST['username'];
//         $password = $_POST['password'];
//     } else {
//         http_response_code(403);
//         exit(); // Terminer le script pour éviter toute exécution supplémentaire
//     }
//     require_once 'db.php';
    
//     $sql = "SELECT * FROM clients WHERE login = '$username'";
//     $result = $conn->query($sql);
//     $data = array();

//     $data = [
//         'success' => false,
//         'message' => 'Incorrect password'
//     ];
//     error_log("login12.php", 0);
//     if ($result->num_rows == 1) { // Si un utilisateur a été trouvé
//         $row = $result->fetch_assoc();
//         if ($password == $row['pass']) { // Si le mot de passe est correct
//             $data = [
//                 'success' => true,
//                 'message' => 'Login successful'
//             ];
//             $_SESSION['user_id'] = $row['id'];
//             // header("Location: ../index.php");
//         }
//     } else if ($result->num_rows == 0) { // Si aucun utilisateur n'a été trouvé
//         $data = [
//             'success' => false,
//             'message' => 'Username not found'
//         ];
//     } 
//     // else { 
//     //     $data = [
//     //         'success' => false,
//     //         'message' => 'Incorrect password'
//     //     ];
//     // }
    
//     error_log("login542.php", 0);
//     error_log(json_encode($data), 0);
//     // Set the content type header
//     // header('Content-Type: application/json');
//     // error_log(json_encode($data), 0);
//     // Output the JSON data
//     echo json_encode($data);
// }
?>


