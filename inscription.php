<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Blog - inscription</title>
        <link rel="stylesheet" href="styles/styles.css" />
  	    <script type="text/javascript" src="scripts/script.js"></script>
    </head>
<body>
    <h1>Formulaire d'inscription</h1>

    <form id="form-inscription" method="POST" action="insert-inscription.php">
        <label for="prenom">Prénom : 
            <input id="input-prenom" name="prenom" type="text" required />
        </label>
        <label for="nom">Nom : 
            <input id="input-nom" name="nom" type="text" required />
        </label>
        <label for="avatar">Avatar : 
            <input id="input-avatar" name="avatar" type="file" />
        </label>
        <label for="email">Email : 
            <input id="input-inscription-email" name="email" type="email" required />
        </label>
        <label for="date-naissance">Date de naissance : 
            <input id="input-inscription-date" name="date-naissance" type="date" required />
        </label>
        <label for="pseudo">Pseudo : 
            <input id="input-inscription-pseudo" name="pseudo" type="text" required />
        </label>
        <label for="mdp">Mot de passe : 
            <input id="input-inscription-mdp" name="mdp" type="password" required />
        </label>
        <label for="mdp-confirm">Confirmation du mot de passe : 
            <input id="input-inscription-mdp-confirm" name="mdp-confirm" type="password" required />
        </label>
        <input type="submit" value="Submit" />
    </form>
    <div id="retour-inscription"><ul></ul></div>
</body>
</html>