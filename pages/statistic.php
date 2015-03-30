<?php

	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015 
	// But    : Page des statistiques, affiche les résultats sous formes de diagrammes.
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

?>

<script>
function CreateDiagramme(str_avis_1,int_cpt_avis_1,str_avis_2,int_cpt_avis_2,str_avis_3,int_cpt_avis_3,str_avis_4,int_cpt_avis_4,compteur)
{
	
	var data = [
		{ label: str_avis_1,  data: int_cpt_avis_1, color: "#60ca4a"},
		{ label: str_avis_2,  data: int_cpt_avis_2, color: "#4aa0ca"},
		{ label: str_avis_3,  data: int_cpt_avis_3, color: "#ffa500"},
		{ label: str_avis_4,  data: int_cpt_avis_4, color: "#f71d42"},

	];

	$(document).ready(function () {
	$.plot($("#diagramme"+compteur), data, {
	series: {
				pie: {
					show: true,			
				}
			 },
			 legend: {
				show: false
			 }	 
		});
	});
}

</script>
 
<?php	
	

	if($_SESSION["loger"] == TRUE)
	{
		//objet de connexion
		$objconnexion = new dblfc();
	
		if(ISSET($_GET['v']))
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
				echo("La fiche n'existe pas");
			}//if
			
			else
			{	
		
			if($tab_fiche[0][0] == $int_id_enseignant)
			{
			
				//int_id_modele
				$int_id_modele = $tab_fiche[0][1];
					
				//Tableau contenant les avis
				$tab_question_avis = $objconnexion->SelectQuestionAvis($int_id_fiche);
				
				if(empty($tab_question_avis))
				{
					echo('<div class="row">');
					echo('<div class="col-sm-12">');
					echo("En cours de saisie.");
					echo('</div>');
					echo('</div>');
					
				}//if
				
				else
				{
			
				//On rassemble les avis par thème et question
				$tab_question_avisFinal = array();
				
				//Compteur
				$int_cpt_case = 0;
				$int_index = 0;
				
				//ajoute celui qui manque 
				$bln_add = true;
				
				//Met en forme les choix
				foreach($tab_question_avis as $element => $str_value)  // /!\ mettre le "=>"
				{
					//On stock l'id des thèmes et des question
					$int_id_theme =  $str_value[0];
					$int_id_question = $str_value[1];
					
					//On rassemble les informations
					foreach($tab_question_avis  as $element2 => $str_value_2)
					{
						$idthemetmp = $str_value_2[0];
						$idquestiontmp = $str_value_2[1];
					
						if($int_id_theme==$idthemetmp AND $int_id_question==$idquestiontmp)
						{
							$tab_question_avisFinal[$int_id_theme][$int_id_question][$int_cpt_case] =$str_value_2[2];	
							unset($tab_question_avis[$element2]);
							$int_cpt_case++;
						}//if
						
					}//foreach

					$int_index++;
					$int_cpt_case=0;
		
				}//foreach
			
				
				//Compte les résulats
				foreach($tab_question_avisFinal as $int_cpt_theme => $str_question_contenu)
				{	
					//Mémorise la question
					foreach($str_question_contenu as $int_cpt_question => $str_value)
					{
						$str_value = array_count_values($str_value);		

						//Tableau qui contient tous les choix pour cette fiche
						$tab_choix = $objconnexion->SelectQuestionChoix($int_id_modele,$int_cpt_theme,$int_cpt_question);
						
						foreach($tab_choix as $element => $key)
						{
							foreach($key as $int_id_choix => $int_id_key_choix)
							{
								foreach($str_value as $idkeyavis => $nbidkey)
								{	
									if($int_id_key_choix == $idkeyavis)
									{
										$bln_add = false;
									}//if
								}//foreach
								
								//On bln_add le choix qui manque et on met 0
								if($bln_add)
								{	
									$str_value[$int_id_key_choix]="0";
								}//if
								
								$bln_add = true;
								
							}//foreach
							
						}//foreach
						
					$tab_question_avisFinal[$int_cpt_theme][$int_cpt_question] = $str_value;
				
					}//foreach
					
				}//foreach
				
				//Création des diagrames
				$int_cpt_diagramme = 1;
				foreach($tab_question_avisFinal as $int_id_theme => $key)
				{
					
					$str_theme_contenu = $objconnexion->SelectContenuTheme($int_id_theme);
					$str_theme_contenu = $str_theme_contenu [0][0];
					
					echo('<div class="row">');
					echo('<div class="col-sm-12">');
					echo('<h1>'.$str_theme_contenu.'</h1>');
					echo('</div>');
					echo('</div>');

					echo('<div class="row">');
					echo('<div class="col-sm-12">');
					foreach($key as $int_id_question=> $str_value)
					{
						$str_question_contenu = $objconnexion->SelectContenuQuestion($int_id_question);
						$str_question_contenu = $str_question_contenu [0][0];
							

						echo('<div  class="col-sm-6 cadreDiagrammme">');
						echo('<div class="col-sm-12 titrediagramme "  >');
						echo($str_question_contenu);
						echo('</div>');
						echo('<div class="col-sm-12">');
						echo('<div id="diagramme'.$int_cpt_diagramme.'" style="width:100%;height:450px;">');
						echo('</div>');
						echo('</div>');
						echo('</div>');
						
							
						//Décration et initialisation
						$str_avis_1 = 0;
						$str_avis_2 = 0;
						$str_avis_3 = 0;
						$str_avis_4 = 0;
						$int_cpt_avis_1 = 0;
						$int_cpt_avis_2 = 0;
						$int_cpt_avis_3 = 0;
						$int_cpt_avis_4 = 0;
						$int_cpt_line = 1;
						$int_cpt_eleve =0;
						
						//Compte le nombre de participant
						foreach($str_value as $int_key => $str_tmp)
						{
							$int_cpt_eleve+=$str_tmp;
						}//foreach
						
						foreach($str_value as $int_key => $str_tmp)
						{
							
							//On fait une reqête sql pour connâitre le "niveau des question
							$int_id_niveau_avis = $objconnexion->SelectNiveauAvis($int_key);
							$str_avis_contenu  = $int_id_niveau_avis[0][0];
							$int_id_niveau_avis = $int_id_niveau_avis[0][1];
							
							switch($int_id_niveau_avis)
							{
								
								case 1:
								{
									$str_avis_1 = $str_avis_contenu;
									$int_cpt_avis_1 = $str_tmp*100/$int_cpt_eleve;
									break;
								}//case
								
								case 2:
								{
									$str_avis_2 = $str_avis_contenu;
									$int_cpt_avis_2 = $str_tmp*100/$int_cpt_eleve;
									break;
								}//case
								case 3:
								{
									$str_avis_3 = $str_avis_contenu;
									$int_cpt_avis_3 = $str_tmp*100/$int_cpt_eleve;
									break;
								}//case
								case 4:
								{
									$str_avis_4 = $str_avis_contenu;
									$int_cpt_avis_4 = $str_tmp*100/$int_cpt_eleve;
									break;
								}//case
								
							}//switch

						}//foreach		

						$int_cpt_avis_1 = round($int_cpt_avis_1);
						$int_cpt_avis_2 = round($int_cpt_avis_2);
						$int_cpt_avis_3 = round($int_cpt_avis_3);
						$int_cpt_avis_4 = round($int_cpt_avis_4);
						
						
						
						
						//Permet d'avoir toujours un total de 100%
						if($int_cpt_avis_1+$int_cpt_avis_2+$int_cpt_avis_3+$int_cpt_avis_4 !=100)
						{
							if($int_cpt_avis_1==0)
							{
								if($int_cpt_avis_2+$int_cpt_avis_3+$int_cpt_avis_4 !==100)
								{
									if($int_cpt_avis_2 ==0 OR $int_cpt_avis_3 ==0 OR $int_cpt_avis_4 ==0)
									{
										if($int_cpt_avis_2==0)
										{
											if($int_cpt_avis_3+$int_cpt_avis_4 !=100)
											{
												if($int_cpt_avis_3==0)
												{
													$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
												}//if
												else if($int_cpt_avis_4==0)
												{
													$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
									
												}//else if
								
											}//if
										
										}//if
										else if($int_cpt_avis_3==0)
										{
											if($int_cpt_avis_2+$int_cpt_avis_4 !=100)
											{
												if($int_cpt_avis_2==0)
												{
													$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
												}//if
												else if($int_cpt_avis_4==0)
												{
													$int_cpt_avis_2=100-$int_cpt_avis_1-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
										else if($int_cpt_avis_4==0)
										{
											if($int_cpt_avis_2+$int_cpt_avis_3 !=100)
											{
												if($int_cpt_avis_2==0)
												{
													$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
												}//if
												else if($int_cpt_avis_3==0)
												{
													$int_cpt_avis_2=100-$int_cpt_avis_1-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
						
									}//if
									else
									{
							
										$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
										
									}//else
								}//if
				
							}//if

							if($int_cpt_avis_2==0)
							{
								if($int_cpt_avis_1+$int_cpt_avis_3+$int_cpt_avis_4 !==100)
								{
									if($int_cpt_avis_1 ==0 OR $int_cpt_avis_3 ==0 OR $int_cpt_avis_4 ==0)
									{
										if($int_cpt_avis_1==0)
										{
											if($int_cpt_avis_3+$int_cpt_avis_4 !=100)
											{
												if($int_cpt_avis_3==0)
												{
													$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
												}//if
												else if($int_cpt_avis_4==0)
												{
													$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
									
												}//else if
								
											}//if

										}//if
										else if($int_cpt_avis_3==0)
										{
											if($int_cpt_avis_1+$int_cpt_avis_4 !=100)
											{
												if($int_cpt_avis_1==0)
												{
													$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
												}//if
												else if($int_cpt_avis_4==0)
												{
													$int_cpt_avis_1=100-$int_cpt_avis_2-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
										else if($int_cpt_avis_4==0)
										{
											if($int_cpt_avis_4+$int_cpt_avis_3 !=100)
											{
												if($int_cpt_avis_1==0)
												{
													$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
												}//if
												else if($int_cpt_avis_3==0)
												{
													$int_cpt_avis_1=100-$int_cpt_avis_2-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
									}
									else
									{
										$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
										
									}//else
								}//if
				
							}//if
						
							if($int_cpt_avis_3==0)
							{
								if($int_cpt_avis_1+$int_cpt_avis_2+$int_cpt_avis_4 !==100)
								{
									if($int_cpt_avis_1 ==0 OR $int_cpt_avis_2 ==0 OR $int_cpt_avis_4 ==0)
									{
										if($int_cpt_avis_1==0)
										{
											if($int_cpt_avis_2+$int_cpt_avis_4 !=100)
											{
												if($int_cpt_avis_2==0)
												{
													$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
												}//if
												else if($int_cpt_avis_4==0)
												{
													$int_cpt_avis_2=100-$int_cpt_avis_1-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
										
										}//if
										else if($int_cpt_avis_2==0)
										{
											if($int_cpt_avis_1+$int_cpt_avis_4 !=100)
											{
												if($int_cpt_avis_1==0)
												{
													$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
												}//if
												else if($int_cpt_avis_4==0)
												{
													$int_cpt_avis_1=100-$int_cpt_avis_2-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
												
								
											}//if
											
										}//else if
										else if($int_cpt_avis_4==0)
										{
											if($int_cpt_avis_1+$int_cpt_avis_2 !=100)
											{
												if($int_cpt_avis_1==0)
												{
													$int_cpt_avis_2=100-$int_cpt_avis_1-$int_cpt_avis_3-$int_cpt_avis_4;
												}//if
												else if($int_cpt_avis_2==0)
												{
													$int_cpt_avis_1=100-$int_cpt_avis_2-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
									}//if
									
									else
									{
										$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
										
									}//else
								}//if
				
							}//if	
						
							if($int_cpt_avis_4==0)
							{
								if($int_cpt_avis_1+$int_cpt_avis_2+$int_cpt_avis_3 !==100)
								{
									if($int_cpt_avis_1 ==0 OR $int_cpt_avis_3 ==0 OR $int_cpt_avis_2 ==0)
									{
										
										if($int_cpt_avis_1==0)
										{
											if($int_cpt_avis_2+$int_cpt_avis_3 !=100)
											{
												if($int_cpt_avis_2==0)
												{
													$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
												}//if
												else if($int_cpt_avis_3==0)
												{
													$int_cpt_avis_2=100-$int_cpt_avis_1-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
										
										}//if
										else if($int_cpt_avis_2==0)
										{
											if($int_cpt_avis_1+$int_cpt_avis_3 !=100)
											{
												if($int_cpt_avis_1==0)
												{
													$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
												}//if
												else if($int_cpt_avis_3==0)
												{
													$int_cpt_avis_1=100-$int_cpt_avis_2-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
										else if($int_cpt_avis_3==0)
										{
											if($int_cpt_avis_1+$int_cpt_avis_2 !=100)
											{
												if($int_cpt_avis_1==0)
												{
													$int_cpt_avis_2=100-$int_cpt_avis_1-$int_cpt_avis_3-$int_cpt_avis_4;
												}//if
												else if($int_cpt_avis_2==0)
												{
													$int_cpt_avis_1=100-$int_cpt_avis_2-$int_cpt_avis_3-$int_cpt_avis_4;
									
												}//else if
								
											}//if
											
										}//else if
						
									}//if
									else
									{
										$int_cpt_avis_3=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_4;
									}
								}//if
				
							}//if	
						
						else if($int_cpt_avis_1 !=0 AND $int_cpt_avis_2 !=0 AND $int_cpt_avis_3!=0 AND $int_cpt_avis_4 !=0)
						{
							
							$int_cpt_avis_4=100-$int_cpt_avis_1-$int_cpt_avis_2-$int_cpt_avis_3;
							
						}//if
						
						
						}//if

						//Appel la fonction
						echo '<script>CreateDiagramme("'.$str_avis_1.'",'.$int_cpt_avis_1.',"'.$str_avis_2.'",'.$int_cpt_avis_2.',"'.$str_avis_3.'",'.$int_cpt_avis_3.',"'.$str_avis_4.'",'.$int_cpt_avis_4.','.$int_cpt_diagramme.');</script>';
						$int_cpt_diagramme++;	
					}//foreach
					
					echo('</div>');
					echo('</div>');
				
						//Afficher les commentaires
						$int_cpt_color=1;
						$tab_remarque = $objconnexion->SelectContenuRemarques($int_id_fiche,$int_id_theme);
						
						echo('<div class="row">');
						echo('<div class="col-sm-12">');
						echo("REMARQUES:");
						echo('</div>');
						echo('</div>');
						
						echo('<div class="row">');
						echo('<div class="col-sm-12">');
						foreach($tab_remarque  as $int_index => $line)
						{
							foreach($line as $int_index2 => $str_remarque)
							{
								if($int_cpt_color%2==0)
								{
									echo('<div class="col-sm-12 remarque">'.$str_remarque.'</div>');
								}//if
								else
								{
									echo('<div  class="col-sm-12 remarque2">'.$str_remarque.'</div>');
								}//else
								$int_cpt_color++;
								
							}//foreach
							
						}//foreach
						echo('</div>');
						echo('</div>');
						
					//echo('</div>');

				}//foreach
				
				}//else
			
			}//if	

			else
			{
				echo("ce n'est pas votre fiche");
				
			}//else
			
		}//else
		
		}//if
	
	}//if
	
	else
	{
		header('Location: index.php');
		
	}//else
?>

<?php	
	
	// inclure le pied de page
	include("./include/footer.inc.php");
?>
