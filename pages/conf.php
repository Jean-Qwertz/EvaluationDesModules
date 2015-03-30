<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015
	// But    : Permet de choisir via un formulaire, les choix pour pouvoir generer une evaluation.
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
?>
	<div class="box2">	
	
	<div class ="row">
		
		<div class="col-xs-12 col-sm-5">
			<form action="generate.php" method="POST">
			<a id="modifier" data-action="action1" class="btn btn-primary btn-default"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
			<a id="nouveau" class="btn btn-primary btn-default"><span class="glyphicon glyphicon-edit"></span> Nouveau</a>
		</div>
		<div class="col-xs-1 col-sm-offset-5 col-sm-2">
		<div class="boutongenerer">
		<input onclick="return confirm('Etes-vous sûr de votre choix ?');" type="submit" value="Generer" class="btn btn-primary btn-default">
		</div>
		</div>
	</div>
<?php	
		
	//objet de connexion
	$objconnexion = new dblfc();
	
	//Recupère les modules
	$tab_module = $objconnexion->SelectModule();
	
	//Recupère les modules
	$tab_modele = $objconnexion->SelectModele();
			
	//Recupère les classe
	$tab_classe = $objconnexion->SelectClasse();
			
	//Recupère les enseignants
	$tab_enseigant = $objconnexion->SelectEnseignant();
			
	//Recupère les annees
	$tab_annee = $objconnexion->SelectAnnee();
	
	//Declaration et initialisation des variables
	$int_cpt_module=0;
	$int_cpt_modele=0;
	$int_cpt_classe=0;
	$int_cpt_enseigant=0;
	$int_cpt_date=0;
			
	unset($objconnexion);

?>
		<div class = "row">
		<div class = "col-xs-12">
		<table class="table table-bordered table-striped table-condensed">
			<caption>
				<h4>Evaluation des modules</h4>
			</caption>
			<thead>
			<tr>
				<th>
					<label for="modele">Modèle:</label>
						<div class="controls">
							<select class="form-control" id="modele"  name="modele" size="1">
<?php
								$int_cpt_modele = count($tab_modele);
								
								for($intx=0;$intx<$int_cpt_modele;$intx++)
								{
									echo('<option  value='.$tab_modele[$intx][0].'>'.$tab_modele[$intx][1].'</option>');
									echo('<option value =2> deuxième choix </option>');
								}//for
?>						
							</select>
						</div>	
				</th>
				<th>
					<label for="module">Module:</label>
						<div class="controls">
							<select class="form-control" id="module" name="module" size="1">
<?php
								$int_cpt_module = count($tab_module);
								for($intx=0;$intx<$int_cpt_module;$intx++)
								{
									echo('<option value='.$tab_module[$intx][0].'>'.$tab_module[$intx][1].'</option>');
								}//for
?>			
							</select>
						</div>	
			</th>
			<th>
					<label for="classe">Classe:</label>
						<div class="controls">
							<select class="form-control" id="classe" name="classe" size="1">
<?php
								$int_cpt_classe = count($tab_classe);
								for($intx=0;$intx<$int_cpt_classe;$intx++)
								{
									echo('<option value='.$tab_classe[$intx][0].'>'.$tab_classe[$intx][1].'</option>');
								}//for	
?>
							</select>
						</div>
			</th>
			<th>
				<label for="annee">Annee:</label>
				<select class="form-control" id="annee" name="annee" size="1">

<?php

				$cptannee = count($tab_annee);
				
				for($intx=0;$intx<$cptannee;$intx++)
				{
					echo('<option value='.$tab_annee[$intx][0].'>'.$tab_annee[$intx][1].'</option>');
				}//for	


?>
				</select>
			</th>
		</tr>
		</thead>
	</table>
	</div>
	</div>
	<script>
	$(function(){
		//Affiche le premier modele au debut
		showModel(1);		
	});
	</script>
		
	<div class="ajaxdiv">
	<!--Tableau appele par AJAX-->	
	</div>
	
	
</form>
		
</div>	


	<?php	
	}//if
	
	else
	{
		header('location: index.php');
	}//else
	
	// inclure le pied de page
	include("./include/footer.inc.php");
?>