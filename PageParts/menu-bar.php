<body>
<div>
<ul class="dropdownmenu">
  <li><a href="index.html">Accueil</a>
  </li>
  <li><a href="#">Mes posts</a>
  </li>
  <li><a href="#">Salut, <?php echo $_COOKIE["login"]?></a>
  </li>
  <li><a href="#">Rechercher</a>
  </li>
  <div id="ID_myblog">
    <a href="./blog.php?userID=<?php echo $_COOKIE["id"]; ?>"></a>
  </div>
</ul>

</div>