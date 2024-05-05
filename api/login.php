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

    // Utilisation d'une requête préparée pour sécuriser la requête SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->bind_param("s", $username);  // fonction pour eviter les injections SQL

    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();

    if ($result->num_rows == 1) { // Si un utilisateur a été trouvé
        $row = $result->fetch_assoc();
        if ($password == $row['pass']) { // Si le mot de passe est correct
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_login'] = $row['login'];
            $data = [
                'success' => true,
                'message' => 'Login successful'
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Mot de passe incorrect'
            ];
        }
    } else if ($result->num_rows == 0) { // Si aucun utilisateur n'a été trouvé
        $data = [
            'success' => false,
            'message' => 'Nom d\'utilisateur incorrect'
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    $stmt->close();
    $conn->close();
}
?>
