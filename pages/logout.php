<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 03.02.2015
	// But    : Page permettant la deconnexion d'une session
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************

    // inclure le haut de page ,le menu et les classes
    include_once("./include/header.inc.php"); 

	//on detruit les variables de notre session
	session_unset ();
	
	//on detruit notre session
	session_destroy ();

	//on redirige le visiteur vers la page d'accueil
	header('location: index.php');
	
?>