<?php
    session_start();

    function generateBuildings($buildings) {
        $html = '';
        foreach ($buildings as $building) {
            $html .= "
            <div>
                <a href='vote.php?id='>
                    <img src='img/building.png'/>
                </a>
            </div>";
        }
        return $html;
    }

    $buildings = [""];
    $buildings = array();

    if ($_SESSION['user_id']) {
        $user_id = $_SESSION['user_id'];
        require_once 'api/db.php';

        $sql = "SELECT * FROM vote WHERE ag_id IN (SELECT ag_id FROM user_ag WHERE user_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        foreach ($result as $row) {
            $buildings[] = $row;
        }


    } else {
        echo "Erreur: utilisateur non connecté";
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>TownVote</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/index.css">
        <script src="js/main.js"></script>
    </head>
 
    <body>
 
        <header>
            <h1>TownVote</h1>
            <hr>
            <h2>Acceuil</h2>
        </header>
 
        <section class='flexcontainer'>
            <?php echo generateBuildings($buildings); ?>

        </section>
    </body>
 
</html>