<?php
// Path: api/vote.php
// Permet de voter pour un choix
// https://claveille.web-edu.fr/api/vote.php?vote_id=1&choix_id=1

function peut_voter($user_id, $vote_id) {
    require_once 'db.php';
    $stmt = $conn->prepare("SELECT * FROM user_vote WHERE user_id = ? AND vote_id = ?");
    $stmt->bind_param("ii", $user_id, $vote_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $vote = $result->fetch_assoc();
    $stmt->close();

    if ($vote) {
        return false;
    } else {
        return true;
    }
}



session_start();
if ($_SESSION['user_id'] == null) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ( isset($_GET['vote_id']) && isset($_GET['choix_id'])) {
        $ag_id = $_GET['choix_id'];
        $vote_id = $_GET['vote_id'];

    } else {
        echo "Erreur: var non défini";
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }
    require_once 'db.php';

    if (peut_voter($user_id, $vote_id)) {
        $stmt = $conn->prepare("INSERT INTO user_vote (user_id, vote_id, choix_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ii", $user_id, $vote_id, $choix_id);
        $stmt->execute();
        $stmt->close();

        $data = [
            'success' => true,
            'message' => 'Vote enregistré'
        ];
    } else {
        $data = [
            'success' => false,
            'message' => 'Vous avez déjà voté pour cette proposition'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();
}

?>