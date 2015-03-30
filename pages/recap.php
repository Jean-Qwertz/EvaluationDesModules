<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 11.03.2015
	// But    : Affiche les adresses ou l’envoie du mail c’est fait ou ne s’est pas fait
	//  		
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************

    // inclure le haut de page et le menu
    include_once("./include/header.inc.php"); 
	include_once("./include/objDB.inc.php"); 
	if($_SESSION["loger"] == TRUE)
	{
		$tab_email_valide="";
		$tab_email_invalide = "";
		
		if(isset($_SESSION['tab_email_valide']) AND isset($_SESSION['tab_email_invalide']))
		{
			$tab_email_valide = $_SESSION['tab_email_valide'];
			$tab_email_invalide = $_SESSION['tab_email_invalide'];
		}//if
		
			
			echo('<div class="row">');
			echo('<div class="col-xs-12">');
			echo("EMAILS VALIDES");
			echo('</div>');
			echo('</div>');
			echo('<div class="row">');
			echo('<div class="col-xs-12">');
			echo("<pre>");
			print_r($tab_email_valide);
			echo("</pre>");
			echo('</div>');
			echo('</div>');
			
			echo('<div class="row">');
			echo('<div class="col-xs-12">');
			echo("EMAILS INVALIDES");
			echo('</div>');
			echo('</div>');
			echo('<div class="row">');
			echo('<div class="col-xs-12">');
			echo("<pre>");
			print_r($tab_email_invalide);
			echo("</pre>");
			echo('</div>');
			echo('</div>');
			
			echo('<div class="row">');
			echo('<div class="col-xs-2">');
			echo('<a href="http://127.0.0.1/EvalutationDesModules/pages/statistic.php?v='.$_SESSION['int_id_fiche'].'">Statistique</a>');
			echo('</div>');
			echo('</div>');


		
	}//if
	
	else
	{
		header('location: index.php');
	}//else

	// inclure le pied de page
	include("./include/footer.inc.php");
?>