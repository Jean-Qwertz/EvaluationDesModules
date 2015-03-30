<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015
	// But    : Contient le formulaire que l’élève doit compléter pour l’évaluation du module. 
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
	
	if(ISSET($_GET['v']))
	{
		$str_lien = htmlentities($_GET['v']);

		$_SESSION['str_lien']= $str_lien;
		//objet de connexion
		$objconnexion = new dblfc();
		
		$bln_check_exist = $objconnexion->ChechLienRandom($str_lien);
		
		//Vérifie si le lien est encore valide 
		if($bln_check_exist[0][0]==1)
		{
			//Les données de la fiche
			$tab_fiche =  $objconnexion->SelectFiche($str_lien);
			
			//Déclaration et initialisation des variables
			$str_id_theme_tmp = "";
			$str_id_question_tmp ="";
			$str_theme = "";
			$str_question ="";
			$bln_first = false;
			$int_cpt_radio=1;
			$int_cpt_color=0;
			$int_cpt_theme=0;
			$int_cpt_question=0;
			$str_color="";
			$int_remarque=1;
			$tab_theme = array();
			
			//Récupère le contenu
			$tab_data = $objconnexion->SelectData($tab_fiche[0][2]);
			
			//Nombre de ligne
			$int_cpt_line = count($tab_data);
?>		
			<form data-toggle="validator" id="formevaluation"  method="POST" action="test.php" >
				
				<table class="table table-bordered table-striped table-condensed">
					<caption>
						<h4>Evaluation des modules</h4>
					</caption>
					<thead>
					<tr>
						<th>
							<?php
							echo("Modèle: ".$tab_fiche[0][1]);
							$_SESSION['int_id_modele']=$tab_fiche[0][2];			
							?>			
						</th>
						<th>
							<?php
							echo("Module: ".$tab_fiche[0][3]);
							?>
						</th>
						<th>
							<?php
							echo("Classe: ".$tab_fiche[0][5]);
							?>
						</th>
						<th>
							<?php
							echo("Enseignant: ".$tab_fiche[0][7]." ".$tab_fiche[0][8]);
							?>
						<th>
							<?php
							echo("Année: ".$tab_fiche[0][10]);
							?>
						</th>
					</tr>
					</thead>
				</table>	
<?php			
			echo('<div class="row">');
			echo('<div class="col-xs-12 table-responsive">');
			echo('<table class="table table-bordered table-striped table-condensed" >');
			for($intx=0;$intx<$int_cpt_line;$intx++)
			{
				$str_theme = $tab_data[$intx][1];
				$str_question = $tab_data[$intx][3];
				
				//Affiche le thème
				if(($str_id_theme_tmp !=$str_theme))
				{	
					if($bln_first)
					{
						echo("<tr><td>Remarques:</td><td colspan='4'><textarea maxlength='255' name='textarea".$int_remarque."' COLS='100' ROWS='2'></textarea></td></tr>");
						$int_remarque++;
					}//if
					
					echo('<tr><th>'.$str_theme.'</th><th colspan="4"></th></tr>');
					$tab_theme[$int_cpt_theme]=$tab_data[$intx][0];
					$int_cpt_theme++;
		
				}//if
				
				if($str_id_question_tmp != $str_question)
				{
					//N'entre pas la premier fois
					if($bln_first)
					{
						$int_cpt_radio++;
					}//if
					
					echo("<tr class='form-group'><td>".$str_question."</td>");
					$int_cpt_question++;
					$bln_first=true;
				}//if
				
				switch($int_cpt_color)
				{	
					case 0:
						$str_color ="success";
						$int_cpt_color++;
						break;
					case 1:
						$str_color ="info";
						$int_cpt_color++;
						break;
					case 2:
						$str_color ="warning";
						$int_cpt_color++;
						break;
					case 3:
						$str_color ="danger";
						$int_cpt_color=0;
						break;
				}//switch
				
				echo('<td class="'.$str_color.'">');
				echo('<label class="radio-inline">');
			    echo('<input type="radio" name="inlineRadioOptions'.$int_cpt_radio.'" value='.$tab_data[$intx][0].'-'.$tab_data[$intx][2].'-'.$tab_data[$intx][4].' required>');
				echo($tab_data[$intx][5]);
				echo('</label>');
				echo('</td>');
				
				$str_id_theme_tmp = $str_theme;
				$str_id_question_tmp = $str_question;

			}//for
	
			echo('<tr><td>Remarques:</td><td colspan="4">');
			echo("<textarea maxlength='255' name='textarea".$int_remarque."' COLS='100' ROWS='2'></textarea>");
			echo('<input type="hidden" id="textarea">');
			echo('</td></tr>');
			echo('</table>');
			echo('</div>');
			echo('</div>');
			
			$_SESSION['int_cpt_theme']= $int_cpt_theme;
			$_SESSION['int_cpt_question']= $int_cpt_question;
			$_SESSION['int_cpt_avis']=$intx;
			$_SESSION['int_cpt_remarques']=$int_remarque;
			$_SESSION['$tab_theme']=$tab_theme;
?>
			<input onclick="return confirm('Êtes-vous sûr de vouloir envoyer ?');" type="submit" value="Envoyer" class="btn btn-default">
<?php
			echo('</form>');
			
		}//if
		else
		{
			echo("La page que vous essayez de joindre n'existe pas ou n'existe plus.");		
		}//else
	}//if
	
	else
	{
		echo("erreur get");
	}//else
?>

<?php
	// inclure le pied de page
	include("./include/footer.inc.php");
?>