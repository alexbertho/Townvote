<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['ag_id'])) {
        $ag_id = $_GET['ag_id'];
    } else {
        echo "Erreur: ag_id non défini";
        // http_response_code(403);
        // exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }
    require_once 'db.php';

    $sql = "SELECT * FROM `message` WHERE `ag_id`=1";
    $result = $conn->query($sql);
    $data = array();

    echo "<h1>Messages</h1>";
    
    if ($result->num_rows == 1) {
        echo "<ul>";
        foreach ($result as $row) {
            echo "<li>" . $row['message'] . "</li>";
        }
        echo "</ul>";

    } else if ($result->num_rows == 0) {
        echo "Aucun message trouvé";
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();

}
?>


