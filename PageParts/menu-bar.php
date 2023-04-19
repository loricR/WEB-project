<?php
if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}
include_once(__ROOT__."/helpz/functions.php");
?>

<body>
<div>
<nav>
<ul class="dropdownmenu">
  <li><a href="index.php">Accueil</a>
  </li>
  <li><a href="#">Liste des blogs</a>
  </li>
  <li><a href="#">Rechercher</a></li>
	<?php 
		if(isset($_SESSION["id"]))
		{
			echo '<li id=ID_myblog class=menu-deroulant><a href=./blog.php?userID=' . $_SESSION["id"] . '><img src=' . getAvatarLink($_SESSION["id"]) . ' alt=avatar> ' . $_SESSION["login"] . '</a>';
			echo '<ul class=sous-menu>';
			echo '<li><a href=./blog.php?userID=' . $_SESSION["id"] . '>Mon Blog</a></li>';
			echo '<li><a href=#>Mon Profil</a></li>';
			echo '<li><a href=./logout.php>Déconnexion</a></li>';
			echo '<ul>';
			echo '</li>';
		}
		else
		{
			echo '<li>';
			echo '<a id="show-login-btn" href="#">Connexion</a>';
			echo '</li>';
		}
	?>
</ul>
</nav>

</div>