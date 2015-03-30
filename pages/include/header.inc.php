<?php
	//***********************************************************************************
	// Societe	: 	ETML 
	// Auteur	:  	Xavier Vaz Afonso
	// Date		:   02.02.2015 
	// But		:   Evaluation des modules: haut des pages
	//***********************************************************************************
	// Modifications: 
	// Date   		: -
	// Auteur 		: -
	// Raison 		: -
	//***********************************************************************************
	//on demarre la session
	session_start();
	
			
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Evaluation des modules</title>

    <!-- Bootstrap -->
	 <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/moncss.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
	<!--Contient les plugins jquery-->
	<script src="../bootstrap/js/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/monjavascript.js"></script>
	<!--<script src="../bootstrap/js/jquery.validate.js"></script>-->
	<script src="../bootstrap/js/validator.js"></script>
	<script src="../Flot/excanvas.js"></script>
	<script src="../Flot/jquery.flot.js"></script>
	<script src="../Flot/jquery.flot.pie.min.js"></script>
	<script src="../Flot/jquery.flot.resize.min.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
	<header class="navbar navbar-default navbar-fixed-top">
      
	  <div class="etml"> <a href="index.php"><img src="../bootstrap/image/logoetml.png" alt="logo"/></a></div>
	  <?php
	  if(isset($_SESSION["loger"]))
		{
			if($_SESSION["loger"] == "TRUE")
			{
	?>				
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
			<span class="icon-bar"></span>
          </button>
        </div>
		
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<li><a href="listStatistic.php">Mes évaluations</a></li>
			<li><a onclick="deconnexion()" >Déconnexion</a></li>
			</ul>
			<?php
			}//if
				else
				{
					$_SESSION["loger"] = FALSE;
				}//else
					
			}//if
			?>
		  
		</div><!--/.nav-collapse -->
	</header>
	<div class="container">		