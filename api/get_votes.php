<?php
session_start();
if ($_SESSION['user_id'] == null) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['vote_id']) ) {
        $vote_id = $_GET['vote_id'];
    } else {
        echo "Erreur: var non défini";
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }
}

// verifier si l'utilisateur a accès au vote
$stmt = $conn->prepare("SELECT * FROM vote WHERE id = ? AND ag_id IN (SELECT ag_id FROM user_ag WHERE user_id = ?)");
$stmt->bind_param("ii", $vote_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $data = [
        'success' => false,
        'message' => 'Vous n\'avez pas accès à ce vote'
    ];
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();
    exit();
}


// recupere les differents choix pour un vote
$stmt = $conn->prepare("SELECT * FROM choix WHERE vote_id = ?");
$stmt->bind_param("i", $vote_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$choix = array();
while ($row = $result->fetch_assoc()) {
    $choix[] = $row;
}

$stmt = $conn->prepare("SELECT * FROM vote WHERE id = ?");
$stmt->bind_param("i", $vote_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$vote = $result->fetch_assoc();

$data = $vote;
$data['choix'] = $choix;

header('Content-Type: application/json');
echo json_encode($data);
$conn->close();
exit();

?>