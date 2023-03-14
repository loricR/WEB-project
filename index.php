<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>

    <?php
    //Vérifier si on a reçu des données
    $displayResults = false;
    
    if(isset($_POST["first-name"]) && isset($_POST["last-name"]) && isset($_POST["email"]) && isset($_POST["new-password"]) ){
      $displayResults = true;
    }
    
    if ($displayResults == false){

    //En php, on se retrouve régulièrement à devoir faire de longs "echo". Il existe des techniques pour rendre ça plus lisible en séparant dans un
		//autre fichier, par exemple. Mais pour le moment, faisons tout ici. Conseil : écrivez d'abord le HTML, puis insérez-le dans un echo
		echo'
    <h1>Registration Form</h1>
    <p>Please fill out this form with the required information</p>
    <form method="post" action="">
      <fieldset>
        <label for="first-name">Enter Your First Name: <input id="first-name" name="first-name" type="text" required /></label>
        <label for="last-name">Enter Your Last Name: <input id="last-name" name="last-name" type="text" required /></label>
        <label for="email">Enter Your Email: <input id="email" name="email" type="email" required /></label>
        <label for="new-password">Create a New Password: <input id="new-password" name="new-password" type="password" required /></label>
      </fieldset>
      <input type="submit" value="Submit" />
    ';
    }else{
      echo '
      <h1>Données reçues! Donc on ne raffiche pas le formulaire</h3>
      <div>
      <p><b>Affichage du mdp envoyé par '.$_POST["first-name"].' '.$_POST["last-name"].' <i>( '.$_POST["email"].' )</i> :</b></p>
      <p>'.$_POST["new-password"].'</p>
      <hr>
      <p> Merci pour les données ! </p>
      </div>
      ';
    }	
  ?>
    </form>
  </body>
</html>