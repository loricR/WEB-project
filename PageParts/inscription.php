<form id="form-inscription" method="POST" action="insert-inscription.php" encrypt="multipart/form-data">
    <div id="nom-complet">
        <div id="inscription-prenom" class="form-element">
            <label for="prenom">Prénom : 
                <input id="input-prenom" name="prenom" type="text" required />
            </label>
        </div>
        <div id="inscription-nom" class="form-element">
            <label for="nom">Nom : 
                <input id="input-nom" name="nom" type="text" required />
            </label>
        </div>
    </div>
    <div class="form-element">
        <label for="avatar">Avatar : 
            <input id="input-avatar" name="avatar" type="file" accept="image/*"/>
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
        <input type="submit" value="Submit" >
    </div>
</form>
<div id="retour-inscription"><ul></ul></div>