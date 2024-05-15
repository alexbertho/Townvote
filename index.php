<?php
    session_start();

    function generateBuildings($buildings) {
        $html = '';
        foreach ($buildings as $building) {
            $id = $building['id'];
            $id = 1
            // $desciption = $building['description'];
            $adresse = $building['adresse'];
            $html .= "
            <div class='frame'>
                <div id='$id' class='picFrame'>
                    <script>
                        document.getElementById('$id').addEventListener('click', function() {
                            window.location.href = 'vote.php?id=$id';
                        });
                    </script>
                    <img src='img/building.png'/>
                </div>
            <h3>$adresse</h3>
            </div>
            ";
        }
        return $html;
    }

    $buildings = array();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        require_once 'api/db.php';

        $sql = "SELECT * FROM ag WHERE id IN (SELECT ag_id FROM user_ag WHERE user_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        foreach ($result as $row) {
            $buildings[] = $row;
        }


    } else {
        header("Location: login.php");
        exit();
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
