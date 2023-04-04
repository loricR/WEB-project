<body>
<div>
<ul class="dropdownmenu">
  <li><a href="index.html">Accueil</a>
  </li>
  <li><a href="#">Mes posts</a>
  </li>
  <li> 
  <?php
    if(isset($_COOKIE["login"]))
	{
	    echo '<a href=./blog.php?userID=' . $_COOKIE["id"] . '>Mon profil</a>';	
	}
    else
	{
		echo '<a id="show-login-btn" href="#">Connexion</a>';
	}
  ?>
      
  </li>
  <li><a href="#">Rechercher</a>
  </li>
  <div id="ID_myblog">
	<?php 
		if(isset($_COOKIE["id"]))
		{
			echo '<a href="./blog.php?userID=<?php echo $_COOKIE["id"]; ?>"></a>';
		}
		else
		{
			echo '<a href="#"></a>';
		}
	?>
  </div>
</ul>

</div>