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