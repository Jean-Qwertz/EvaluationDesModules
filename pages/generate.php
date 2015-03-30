<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015 
	// But    : Génère l'évaluation
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

	
	if($_SESSION["loger"] == TRUE)
	{
		
		//En-tête
		$int_id_module=htmlentities($_POST['module']);
		$int_id_classe=htmlentities($_POST['classe']);
		$int_id_enseigant= $_SESSION["id_enseignant"];
		$int_id_annee=htmlentities($_POST['annee']);
		$tab_last_id_fiche = array();

		//modèle
		$idmodele=htmlentities($_POST['modele']);
		
		//objet de connexion
		$objconnexion = new dblfc();
		
		$objconnexion->CreateFiche($idmodele,$int_id_module,$int_id_classe,$int_id_enseigant,$int_id_annee);
		
		$tab_last_id_fiche = $objconnexion->SelectLastIdFiche();
		
		$int_id_fiche = $tab_last_id_fiche[0][0];
		$_SESSION['int_id_fiche']=$int_id_fiche;
		
		unset($objconnexion);
		header('Location: link.php');
		
	}//if
		
	else
	{
		header('location: index.php');
	}//else
	
	// inclure le pied de page
	include("./include/footer.inc.php");
?>