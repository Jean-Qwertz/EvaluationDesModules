<?php

	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015 
	// But    : Page qui affiche que tout c'est bien deroule
	//  		
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************

	// inclut le haut de page et le menu
    include_once("./include/header.inc.php"); 
	
	//inclut le necessaire pour se connecter 
	include_once("./include/objDB.inc.php");

	echo("Votre participation a été prise en compte :)");
	echo("</br><a href='http://www.google.ch'> Google </a>");
	
	// inclure le pied de page
	include("./include/footer.inc.php");
?>
