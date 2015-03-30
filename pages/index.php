<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015
	// But    : Permet de s'identifier et de pouvoir se connecter
	//  		
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************
    // inclure le haut de page et le menu
    include_once("./include/header.inc.php"); 
	
	IF(ISSET($_SESSION["loger"]))
	{
		if($_SESSION["loger"])
		{
			header('Location: conf.php');
		}//if
		
	}//if
			
	?>

	<div class = "box">
	
		<form method="POST" action="controlLogin.php">
			<fieldset>
				<legend>Connexion</legend>
					<div id="voila" class="form-group">
						Login : <input type="text" name="login" class="form-control">
					</div>
					<div class="form-group">
						Mot de passe : <input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<button class=" pull-right btn btn-primary" type="submit" >Valider</button>
					</div>
				</fieldset>
			</form>
	</div>
	
<?php 
	// inclure le pied de page
	include("./include/footer.inc.php");
?>