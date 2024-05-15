<?php
// Path: api/get_messages.php
// Permet de récupérer les messages d'un groupe
// https://claveille.web-edu.fr/api/get_messages.php?ag_id=1
session_start();
if ($_SESSION['user_id'] == null) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

function a_acces($conn, $user_id, $ag_id) {
    $stmt = $conn->prepare("SELECT * FROM user_ag WHERE user_id = ? AND ag_id = ?");
    $stmt->bind_param("ii", $user_id, $ag_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}





if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['ag_id'])) {
        $ag_id = $_GET['ag_id'];
    } else {
        echo "Erreur: ag_id non défini";
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }
    require_once 'db.php';

    if (!a_acces($conn, $user_id, $ag_id)) {
        echo "Vous n'avez pas accès à ce groupe";
        exit();
    }
    

    $sql = "SELECT `login`,`username`,`message` FROM `message` INNER JOIN `users` ON `message`.`user_id` = `users`.`id` WHERE `ag_id`='$ag_id'";
    $result = $conn->query($sql);
    $data = array();
    
    if ($result->num_rows > 0) {
        // $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $row) {
            $miniData = ['message' => $row['message']];
            if ($row['username'] == null) {
                $miniData['username'] = $row['login'];
            } else {
                $miniData['username'] = $row['username'];
            }
            $data[] = $miniData;            
        }

    } else {
        echo "Aucun message trouvé";
    }

    
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();

}
?>


