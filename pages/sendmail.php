<?php

	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.03.2015 
	// But    : Genere et envoye les liens aux eleves par mail
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
	
	$tab_email_valide = array();
	$tab_email_invalide = array();
	$str_host = $_SERVER['HTTP_HOST'];
	
		
	if($_SESSION["loger"] == TRUE)
	{
		if(isset($_SESSION['int_id_fiche']))
		{	
			if(isset($_POST['str_email']))
			{
				$objconnexion = new dblfc();
				$int_id_fiche = $_SESSION['int_id_fiche'];
				$str_email = $_POST['str_email'];
				$str_email_split = array();
				$str_email_split = explode(";",$str_email);
				
				
				$int_cpt_email = count($str_email_split);
				for($intx=0;$intx<$int_cpt_email;$intx++)
				{
					$str_mail =  $str_email_split[$intx];
					
					if (preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/",$str_mail))
					{
						$tab_email_valide[]= $str_mail;
						echo("valide : ".$str_mail."<br/>");

						if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#",$str_mail)) // On filtre les serveurs qui rencontrent des bogues.
						{
							$passage_ligne = "\r\n";
						}//if
						else
						{
							$passage_ligne = "\n";
						}//else
						
						
						//Generer le lien 
						do{
							$str_random = random_str(6);
						
							//Verifie si la chaine de caractere aleatoire existe deja
							$checkstring = $objconnexion->ChechLienRandom($str_random);
					
							} while ($checkstring[0][0]!=0);
							
							$objconnexion->CreateLien($int_id_fiche,$str_random,1);

						//=====Declaration des messages au format texte et au format HTML.
						$str_message_txt = 'http://'.$str_host.'/EvalutationDesModules/pages/evaluation.php?v='.$str_random;
						$str_message_html = '<html><head></head><body><a href="http://'.$str_host.'/EvalutationDesModules/pages/evaluation.php?v='.$str_random.'">http://'.$str_host.'/EvalutationDesModules/pages/evaluation.php?v='.$str_random.'</a></body></html>';
						//==========
						 
						//=====Creation de la boundary
						$boundary = "-----=".md5(rand());
						//==========
						 
						//=====Definition du str_sujet.
						$str_sujet = "Evaluation";
						//=========
						 
						//=====Creation du str_header de l'e-str_mail.
						$str_header = "From: \"Evaluation des modules\"<evaluationsdesmodules@outlook.com>".$passage_ligne;
						$str_header.= "Reply-to: \"Evaluation des modules\" <evaluationsdesmodules@outlook.com>".$passage_ligne;
						$str_header.= "MIME-Version: 1.0".$passage_ligne;
						$str_header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
						//==========
						 
						//=====Creation du str_message.
						$str_message = $passage_ligne."--".$boundary.$passage_ligne;
						//=====Ajout du str_message au format texte.
						$str_message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
						$str_message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
						$str_message.= $passage_ligne.$str_message_txt.$passage_ligne;
						//==========
						$str_message.= $passage_ligne."--".$boundary.$passage_ligne;
						//=====Ajout du str_message au format HTML
						$str_message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
						$str_message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
						$str_message.= $passage_ligne.$str_message_html.$passage_ligne;
						//==========
						$str_message.= $passage_ligne."--".$boundary."--".$passage_ligne;
						$str_message.= $passage_ligne."--".$boundary."--".$passage_ligne;
						//==========
						 
						//=====Envoi de l'e-str_mail.
						mail($str_mail,$str_sujet,$str_message,$str_header);
						//==========
						//header('Location: conf.php');
						
					}//if
					else
					{
						//adresse invalide
						$tab_email_invalide[]= $str_mail;
						echo("PAS valide : ".$str_mail."<br/>");
					
					}//else

				}//for	
				
				$_SESSION['tab_email_valide'] = $tab_email_valide;
				$_SESSION['tab_email_invalide'] = $tab_email_invalide;
				header('Location: recap.php');
				
			}//if
		
		}//if
		else
		{
			header('location: index.php');
			
		}//else
			
	}//if	
		
	// inclure le pied de page
	include("./include/footer.inc.php");
?>