<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>TownVote</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/vote.css">
        <script src="js/main.js"></script>
        <script src="js/vote.js"></script>
    </head>

    <body>

        <header>
            <h1>TownVote</h1>
            <hr>
            <h2>Votez !<h2>
        </header>
            <div  class="flex-container">
                <div class="voting-system">
                    <div class="list-container">
                        <ul id="options-list">
                            <li>Option 1</li>
                            <li>Option 2</li>
                            <li>Option 3</li>
                            <li>Option 4</li>
                            <li>Option 5</li>
                        </ul>
                    </div>
                    <div class="graph-container">
                    <canvas id="graph-canvas" width="400" height="400"></canvas>
                </div>
            </div>
    </body>

</html>