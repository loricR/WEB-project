<?php
include("initialize.php");
include(__ROOT__."/helpz/functions.php");
include(__ROOT__."/connexion-base.php");
if(isset($_COOKIE['login']))
{
	//include("home-page.php");
	
	$redirect = "Location:".GetURL()."/blog.php?userID=".$_COOKIE['id'];
	//echo "Connexion réussie - Redirection vers blog.php".$redirect;
	header($redirect);
}
else
{
	include("connexion.php");
}
?>