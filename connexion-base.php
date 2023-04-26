<?php
//Connexion à la base de données
try
{
	$pdo=new PDO("mysql:host=localhost;dbname=rav_may_fan2jeu;charset=utf8","root","");
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>