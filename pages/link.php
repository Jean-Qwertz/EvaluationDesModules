<?php

	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015 
	// But    : Permet de definir les destinataires
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
	
	//fonction PHP
	include_once("./include/functions.inc.php");
	
	$bln_show_form = true;
	
	if($_SESSION["loger"] == TRUE)
	{
		
		if(isset($_GET['v']))
		{	
			//Id de la fiche
			$int_id_fiche = htmlentities($_GET['v']);
	
			//objet de connexion
			$objconnexion = new dblfc();
			
			$int_id_enseignant = $_SESSION["id_enseignant"];
			
			//Tableau fiche
			$tab_fiche = $objconnexion->SelectFicheWithID($int_id_fiche);
			
			if(empty($tab_fiche))
			{
				//La fiche n'existe pas
				$bln_show_form = false;
				header('location: index.php');
			}//if
			
			else
			{	
		
				if($tab_fiche[0][0] == $int_id_enseignant)
				{
					//On controle 
					$int_id_fiche = htmlentities($_GET['v']);
					$_SESSION['int_id_fiche'] = $int_id_fiche;
					
				}//if
				else
				{
					//Cette fiche ne l'appartient pas
					$bln_show_form = false;
					header('location: index.php');
				}//else
			}//else
		
		}//if
		
		if(isset($_SESSION['int_id_fiche']))
		{
			if($bln_show_form)
			{
				echo('<div class="row">');
				echo('<div class="col-xs-12">');
				echo('<form action="sendmail.php" method="POST">');
				echo('<input name="str_email" class="form-control" type="text"/>');
				echo('<input type="submit" class="btn btn-primary btn-default" value="Envoyer"/>');
				echo('</form>');
				echo('</div>');
				echo('</div>');
			}//if
			
		}//if
		else
		{
			header('location: index.php');
		}//else
	}//if
	
	else
	{
		header('location: index.php');
	}//else
	
	// inclure le pied de page
	include("./include/footer.inc.php");
?>
