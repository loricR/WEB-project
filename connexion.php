<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Blog - connexion</title>
        <link rel="stylesheet" href="styles/styles.css" />
  	    <script type="text/javascript" src="scripts/script.js"></script>
    </head>
<body>
    <h1>Formulaire de connexion</h1>

    <form id="form-connexion" method="POST" action="login.php">
        <label for="pseudo">Pseudo : 
            <input id="input-connexion-pseudo" name="login" type="text" required />
        </label>
        <label for="mdp">Mot de passe : 
            <input id="input-connexion-mdp" name="mdp" type="password" required />
        </label>
        <input type="submit" value="Submit" />
    </form>
    <div id="retour-connexion"><ul></ul></div>
</body>
</html>