<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 12.02.2015
	// But    : Contient les fonctions PHP
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************

	// *******************************************************************
	// Nom   :	random_str
	// But   :	Permet de générer une châine de caractères
	// Retour:	
	// Param.: 	$int_nbr 
	// *******************************************************************
	
	function random_str($int_nbr) {
		$str = "";
		$str_chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
		$int_nb_chars = strlen($str_chaine);

		for($i=0; $i<$int_nbr; $i++)
		{
			$str .= $str_chaine[ rand(0, ($int_nb_chars-1)) ];
		}//for
		return $str;
	}//random_str
	
	
?>