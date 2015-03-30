<?php

	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 12.02.2015 
	// But    : Affiche le modèle depuis une requête ajax
	//  		
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************
	
	session_start();
	
    if($_SESSION["loger"] == TRUE AND isset($_GET["modelechoisi"]))
	{
		
	include_once("./include/objDB.inc.php"); 

	
	//Déclaration et initialisation des variables
	$str_theme_tmp = "";
	$str_question_tmp ="";
	$str_theme = "";
	$str_question ="";
	$bln_first = false;
	$int_cpt_radio=0;
	$int_cpt_color=0;
	$str_color="";
	
	//objet de connexion
	$objconnexion = new dblfc();
	
	$int_id_modele = htmlentities($_GET["modelechoisi"]);
	
	//Récupère le contenu
	$tab_data = $objconnexion->SelectData($int_id_modele);
		
	//Tout les avis
	$tab_avis = $objconnexion->SelectAvis();
	
	//Toutes les questions
	$tab_question = $objconnexion->selectquestion();
	
	//Tous les thèmes
	$arraytheme =  $objconnexion->SelectTheme();
	
	//Nombre de ligne
	$int_cpt_line = count($tab_data);
	
	unset($objconnexion);
?>	

<div class="row">
<div class="col-xs-12 table-responsive">
<table class="table table-bordered table-striped table-condensed" >
<?php
			for($intx=0;$intx<$int_cpt_line;$intx++)
			{
				$str_theme = $tab_data[$intx][1];
				$str_question = $tab_data[$intx][3];
				
				//Affiche le theme
				if(($str_theme_tmp!=$str_theme))
				{	
					echo('<tr><th><span class="changetype"> '.$str_theme.'</span></th> <th colspan="4"> </th></tr>');
				}//if
		
				if($str_question_tmp != $str_question)
				{
					if($bln_first)
					{
						echo("</tr>"); 
					}//if

					echo('<tr><td><span class="changetype">'.$str_question.'</span></td>');
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
				echo('<span class="changetype">'.$tab_data[$intx][5].'</span>');
				echo('</td>');
				
				$str_theme_tmp = $str_theme;
				$str_question_tmp = $str_question;	
			}//for
	}//if
	else
	{
		header('location: index.php');
	}//else
?>

</table>
</div>
</div>

<script>

$(function(){
	
	var tab_question = <?php echo  json_encode($tab_question);?>;
	var tab_theme= <?php echo  json_encode($arraytheme);?>;
	var tab_avis= <?php echo  json_encode($tab_avis);?>;
	
	blnedit = false;
	
	$(".changetype").dblclick(function(){
		
	  if(blnedit)
	  {
		  $element = $(this);	  
		  $element.replaceWith('<input class="form-control" type="texte" value="'+$element.text() +'"/>');
	  }//if 
	  
	});
});

</script>
<?php
	// inclure le pied de page
	include("./include/footer.inc.php");
?>			

