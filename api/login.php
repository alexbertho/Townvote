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
            $_SESSION['user_id'] = $row['id'];
            $data = [
                'success' => true,
                'message' => 'Login successful'
            ];
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
    $conn->close();

}
?>


