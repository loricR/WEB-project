<?php
	//ecrit dans __ROOT__ le chemin "disque dur" du fichier de la page
    define('__ROOT__', dirname(__FILE__) );

	//Require_once est une version plus stricte de "include" : si ca ne marche pas,
	//une erreur fatale qui met fin au script se produit.
	//Avantage : si on a déjà inclut ce fichier, il ne le refera pas une seconde fois
	
	//On require le fichier avec la classe SQLConn, version objet de notre connection SQL
    //require_once(__ROOT__."/Classes/SQLconn.php");
    //$SQLconn = new SQLconn();
?>