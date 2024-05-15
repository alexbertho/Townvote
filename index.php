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