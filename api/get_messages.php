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


    $sql = "SELECT * FROM `message` WHERE `ag_id`='$ag_id' INNER JOIN `users` ON `message`.`user_id` = `users`.`id`";
    $result = $conn->query($sql);
    $data = array();
    echo $result->num_rows;
    echo "<br>";
    
    if ($result->num_rows > 0) {
        echo "Message trouvé";
        echo "<ul>";
        foreach ($result as $row) {
            echo "<li>" . $row['message'] . " from : ". $row['username'] . "</li>";
        }
        echo "</ul>";

    } else {
        echo "Aucun message trouvé";
    }

    
    // header('Content-Type: application/json');
    // echo json_encode($data);
    // $conn->close();

}
?>


