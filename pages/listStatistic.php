<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 11.03.2015
	// But    : Affiche toute la liste des statistiques
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
	$str_host = $_SERVER['HTTP_HOST'];
		
	if($_SESSION["loger"] == TRUE)
	{
		$int_id_enseignant = $_SESSION["id_enseignant"];
		//objet de connexion
		$objconnexion = new dblfc();	
		$tab_fiche = $objconnexion->SelectAllFiche($int_id_enseignant);
?>	
	<div class = "row">
	<div class = "col-xs-12 table-responsive">
	<table class="table table-bordered table-striped table-condensed">
		<thead>
		
		<tr>
			<th>Classe</th>
			<th>Module</th>
			<th>Année</th>
			<th>Fiche </th>
			<th>lien</th>
		</tr>
		</thead>
		<tbody>
		
<?php
		foreach($tab_fiche as $line => $value)
		{
			echo('<tr>');
			echo('<td>'.$value[0].'</td>');
			echo('<td>'.$value[1].'</td>');
			echo('<td>'.$value[2].'</td>');
			echo('<td><a href="statistic.php?v='.$value[3].'">'.$value[3].'</a></td>');
			echo('<td><a href="link.php?v='.$value[3].'">Envoyer</a></td>');
			echo('</tr>');
		}//foreach

?>		
		</tbody>
	</table>
	</div>
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