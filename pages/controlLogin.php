<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015 
	// But    : Controle que le login et le mot de passe existe dans la base de donnees
	//			si c’est le cas alors la page « conf.php » est appelee.
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
	
	if(ISSET($_POST['login']) AND ISSET($_POST['password']))
	{
		if(($_POST['login']!= NULL) AND ($_POST['password']!=NULL))
		{
			//On recupere les variables transmisent par le POST et en utilise htmlentities
			$str_login = htmlentities($_POST['login']);
			$str_password = htmlentities($_POST['password']);
			
			//instanciation d'un nouvel objet base sur la class
			$objDBlfc = new dblfc(); 
			
			//contient 1 si il existe un user et un mot de passe identique sinon contient 0
			$tab_check_login= $objDBlfc->checkLoginFull($str_login,$str_password); 
			
			echo("<pre>");
			print_r($tab_check_login);
			echo("</pre>");
			
			//echo($tab_check_login[0][0]);
			
			//on se deconnecte de la base de donnees
			unset($objDBlfc); 
			
			//Verifie le login
			if(!empty($tab_check_login))
			{
			
				if($tab_check_login[0][0] != 0)
				{
					$_SESSION["id_enseignant"] = $tab_check_login[0][0];
					$_SESSION["str_ens_prenom"] = $tab_check_login[0][1];
					$_SESSION["str_ens_nom"] = $tab_check_login[0][2];
					$_SESSION["loger"] = TRUE;
				}//if
				header('Location: conf.php');
			}//if
				
			else
			{
				echo("vide");
				header('Location: index.php');
			}//else	
		}//if
			
		else
		{
			header('Location: index.php');
		}//else
	}//if
	else
	{
		header('Location: index.php');
		
	}//else

	// inclure le pied de page
	include("./include/footer.inc.php");
?>
