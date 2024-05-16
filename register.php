<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>TownVote</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/main.js"></script>
        <script src="js/register.js"></script>
    </head>

    <body>

        <header>
            <h1>TownVote</h1>
            <hr>
            <h2>S'enregistrer</h2>
        </header>

        <div class="flex-container">
            
            <div class="login-form">
                <div id="error-message" class="error-box">
                    <span class="error-text"></span>
                </div>
                <form action="login.php" method="POST">
                    <div class = "icon-login">
                        <img src="img/user.png" alt="user">
                        <input type="text" name="login" id="login" placeholder="Nom d'utilisateur" required>
                    </div>
                    <div class = "icon-login">
                        <img src="img/password.png" alt="password">
                        <input type="password" name="password" id="register_pass" placeholder="Mot de passe" required>
                    </div>
                    <div class = "icon-login">
                        <img src="img/password.png" alt="password">
                        <input type="password" name="password" id="register_pass_bis" placeholder="Confirmer mot de passe" required>
                    </div>
                    <hr>
                    <button class="loginbutton" type="button" id="toregister">S'inscrire</button>

                </form>
            </div>        
        </div>

    </body>

</html>