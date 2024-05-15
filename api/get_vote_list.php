<?php
session_start();
if ($_SESSION['user_id']) {
    $user_id = $_SESSION['user_id'];
    require_once 'db.php';

    $sql = "SELECT * FROM vote WHERE ag_id IN (SELECT ag_id FROM user_ag WHERE user_id = '$user_id')";
    $result = $conn->query($sql);
    $conn->close();

    $data = array();
    if ($result->num_rows > 0) {
        foreach ($result as $row) {
            $data[] = $row;
            $data['message'] = "Vote trouvé";
        }
    } else {
        $data['message'] = "Aucun vote trouvé";
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    


} else {
    echo "Erreur: utilisateur non connecté";
    http_response_code(403);
    exit(); // Terminer le script pour éviter toute exécution supplémentaire
}



?>