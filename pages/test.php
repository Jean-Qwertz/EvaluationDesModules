<?php

	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015 
	// But    : Page des verfications des donnes
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
	
	//objet de connexion
	$objconnexion = new dblfc();
	
	//Déclaration des variables	
	$int_id_lien_random = $_SESSION["str_lien"]; //Id lien random
	$int_cpt_theme = $_SESSION['int_cpt_theme'];
	$int_cpt_question = $_SESSION['int_cpt_question'];
	$int_cpt_avis =$_SESSION['int_cpt_avis'];
	$int_cpt_remarque = $_SESSION['int_cpt_remarques'];
	$tab_theme = $_SESSION['$tab_theme'];
	$tab_split = array();
	$int_id_modele = $_SESSION['int_id_modele'];
	
	//Tableau qui contient les données de la table t_fiche
	$tab_fiche =  $objconnexion->SelectFiche($int_id_lien_random);
	$bln_exist = false;
	
	//ID Fiche 
	$int_id_fiche=$tab_fiche[0][0];
	
	$tab_data = $objconnexion->SelectData($int_id_modele);
	
	//ID Lien
	$int_id_lien = $objconnexion->SelectIDLien($int_id_lien_random);
	
	//Parcours les boutons radios
	for($intx=0;$intx<$int_cpt_question;$intx++)
	{
		if(isset($_POST["inlineRadioOptions".($intx+1)]))
		{
			
			$tab_split[] = explode("-",$_POST["inlineRadioOptions".($intx+1)]);  //Thème-Question-Avis
			
			for($inty=0;$inty<count($tab_data);$inty++)
			{
				if($tab_split[$intx][0]==$tab_data[$inty][0] AND $tab_split[$intx][1]==$tab_data[$inty][2] AND $tab_split[$intx][2]==$tab_data[$inty][4])
				{
					//il existe
					$bln_exist = true;	
				}//if
	
			}//for
			
			if(!$bln_exist)
			{
				echo("erreur1");
				header("location: index.php");
				exit();
				
			}//if

		}//if
		
		//manque une information
		else
		{
			echo("erreur2");
			header("location: index.php");
			exit();
		}//else
			
	}//for
	
	//controle si il y a un doublon
	$int_cpt_doublon =0;
	for($intx=0;$intx<count($tab_split);$intx++)
	{
		for($inty=0;$inty<count($tab_split);$inty++)
		{
			if($tab_split[$intx][0]==$tab_split[$inty][0] AND $tab_split[$intx][1]==$tab_split[$inty][1] AND $tab_split[$intx][2]==$tab_split[$inty][2])
			{
				$int_cpt_doublon++;
				
				if($int_cpt_doublon>1)
				{
					echo("erreur3");
					header("location: index.php");
					exit();
				}//if
				
			}//if
		
		}//for
		
		$int_cpt_doublon=0;
	}//for
	
	//Parcours les remarques
	for($inty=1;$inty<=$int_cpt_theme;$inty++)
	{
		$int_id_theme_remarque= $tab_theme[$inty-1];
		
		if(isset($_POST["textarea".$inty]))
		{
			//Escape le commentaire
			$str_contenu = htmlentities($_POST["textarea".$inty]);		
			//SI le champ n'est pas vide
			if(!empty($str_contenu))
			{
				$copiest = str_replace(' ', '', $str_contenu);
				
				//Si le champ n'est pas rempli que d'espace
				if(strlen($copiest)!=0)
				{
					$objconnexion->AddRemarques($int_id_lien[0][0],$int_id_theme_remarque,$str_contenu);
				}//if
			}//if
		}//if
		
		else
		{
			//Même si l'utilisateur modifie le nom ça ne l'affecte que lui 
		}//else
		
		echo("</br>");
		
	}//for
	
		//Insert les données 
		for($intx=0;$intx<count($tab_split);$intx++)
		{	
			$objconnexion->AddAvis($int_id_lien[0][0],$tab_split[$intx][0],$tab_split[$intx][1],$tab_split[$intx][2]);
		}//for
		
		//Ferme le lien
		$objconnexion->CloseLien($int_id_lien[0][0]);
	
		header('Location: end.php');
?>

<?php 
	// inclure le pied de page
	include("./include/footer.inc.php");
?>




