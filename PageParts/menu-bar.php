<?php
if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}
include (__ROOT__."/helpz/functions.php");
?>

<body>
<div>
<ul class="dropdownmenu">
  <li><a href="index.php">Accueil</a>
  </li>
  <li><a href="#">Mes posts</a>
  </li>
  <li> 
  <?php
    if(isset($_SESSION["id"]))
	{
	    echo '<a href=./logout.php>Déconnexion</a>';	
	}
    else
	{
		echo '<a id="show-login-btn" href="#">Connexion</a>';
	}
  ?>
      
  </li>
  <li><a href="#">Rechercher</a></li>
  <li>
	  <div id="ID_myblog">
		<?php 
			if(isset($_SESSION["id"]))
			{
				echo '<img src=' . getAvatarLink($_SESSION["id"]) . ' alt=avatar>';
				echo '<a href=./blog.php?userID=' . $_SESSION["id"] . '>Mon Blog</a>';
			}
			else
			{
				echo '<a href="#"></a>';
			}
		?>
	  </div>
  </li>
</ul>

</div>