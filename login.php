<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>EveryVote</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/main.js"></script>
    </head>

    <body>

        <header>
            <h1>TownVote</h1>
            <hr>
            <h2>Connexion</h2>
        </header>

        <div class="flex-container">
            
            <div class="login-form">
                <form method="get">
                    <div id="resultat" style="position: absolute;"></div>     
                    <div class = "icon-login">
                        <img src="img/user.png" alt="user">
                        <input type="text" name="login" id="username" placeholder="Nom d'utilisateur" required>
                    </div>
                    <div class = "icon-login">
                        <img src="img/password.png" alt="password">
                        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                    </div>
                    <button class="loginbutton" id="tologin" type="submit">Se connecter</button>
                    <hr>
                    <button class="loginbutton" type="button">S'inscrire</button>
                </form>
            </div>
        </div>

    </body>

</html>