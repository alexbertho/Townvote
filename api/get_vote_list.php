<?php
session_start();
if ($_SESSION['user_id']) {
    $user_id = $_SESSION['user_id'];
    require_once 'db.php';
    echo "Utilisateur connecté";
    echo "<br>";
    echo "user_id: " . $user_id;
    echo "<br>";
    
    $sql = "SELECT * FROM vote WHERE ag_id IN (SELECT ag_id FROM user_ag WHERE user_id = '$user_id')";
    $result = $conn->query($sql);
    $data = array();
    echo $result->num_rows;
    echo "<br>";



} else {
    echo "Erreur: utilisateur non connecté";
    http_response_code(403);
    exit(); // Terminer le script pour éviter toute exécution supplémentaire
}



?>