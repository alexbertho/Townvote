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

    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $data = array();

    
    if ($result->num_rows == 1) { // Si un utilisateur a été trouvé
        
        $data = [
            'success' => false,
            'message' => 'Utilisateur déjà existant'
        ];
    } else if ($result->num_rows == 0) { // Si aucun utilisateur n'a été trouvé

        $sql = "INSERT INTO users (login, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $data = [
                'success' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur'
            ];
            header('Content-Type: application/json');
            echo json_encode($data);
            $conn->close();
            exit();
        }
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            $data = [
                'success' => true,
                'message' => 'Utilisateur créé'
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur'
            ];
        }
        
        $stmt->close();
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();

}
?>


