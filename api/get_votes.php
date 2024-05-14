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

    // recupere les differents choix pour un vote
    $stmt = $conn->prepare("SELECT * FROM choix WHERE vote_id = ?");
    $stmt->bind_param("i", $vote_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $choix = array();
    while ($row = $result->fetch_assoc()) {
        $choix[] = $row;
    }
    $stmt->close();

    

?>