<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles/popup.css" />
    <script type="text/javascript" src="scripts/popup.js"></script>
    <title></title>
</head>
<body>

    <button id="show-login-btn">Login</button>

<!-- CONNEXION -->

    <div id="popup-login" class="popup">
        <button id="close-login-btn" class="close-popup">&times;</button>
        <div class="form">
            <h2>Formulaire de connexion</h2>

            <form id="form-connexion" method="POST" action="login.php">
                <div class="form-element">
                    <label for="pseudo">Pseudo : 
                        <input id="input-connexion-pseudo" name="login" type="text" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="mdp">Mot de passe : 
                        <input id="input-connexion-mdp" name="mdp" type="password" required />
                    </label>
                </div>
                <div class="form-element">
                    <input type="submit" value="Submit" />
                </div>
            </form>
            <div id="retour-connexion"><ul></ul></div>
            <a id="show-register-link" href="#">Pas de compte?</a>
        </div>
    </div>

<!-- INSCRIPTION -->

    <div id="popup-register" class="popup">
        <button id="close-register-btn" class="close-popup">&times;</button>
        <div class="form">
            <h2>Formulaire d'inscription</h2>

            <form id="form-inscription" method="POST" action="insert-inscription.php">
                <div class="form-element">
                    <label for="prenom">Pr�nom : 
                        <input id="input-prenom" name="prenom" type="text" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="nom">Nom : 
                        <input id="input-nom" name="nom" type="text" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="email">Email : 
                        <input id="input-inscription-email" name="email" type="email" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="date-naissance">Date de naissance : 
                        <input id="input-inscription-date" name="date-naissance" type="date" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="pseudo">Pseudo : 
                        <input id="input-inscription-pseudo" name="pseudo" type="text" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="mdp">Mot de passe : 
                        <input id="input-inscription-mdp" name="mdp" type="password" required />
                    </label>
                </div>
                <div class="form-element">
                    <label for="mdp-confirm">Confirmation du mot de passe : 
                        <input id="input-inscription-mdp-confirm" name="mdp-confirm" type="password" required />
                    </label>
                </div>
                <div class="form-element">
                    <input type="submit" value="Submit" />
                </div>
            </form>
            <div id="retour-inscription"><ul></ul></div>
            <a id="show-login-link" href="#">Déjà un compte?</a>
        </div>
    </div>




</body>
</html>