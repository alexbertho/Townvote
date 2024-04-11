<?php
	if (!isset($_SESSION['user_id'])) {
		// echo "Logged in as user " . $_SESSION['user_id'];
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>TownVote - Acceuil</title>
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

        <div  class="flex-container">

		<h2>
			<?php  
				echo "Bienvenue " . $_SESSION['user_id'];
				echo "Bienvenue " . $_SESSION['user_login'];
			?>
		</h2>

        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
        <div class="batiment"></div>
    </body>

</html>