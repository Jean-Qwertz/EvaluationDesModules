<?php
	//*********************************************************
	// Societe: ETML 
	// Auteur : Xavier Vaz Afonso
	// Date   : 02.02.2015
	// But    : Page qui contient la class pour les connexions
	//*********************************************************
	// Modifications: -
	// Date   : -
	// Auteur : -
	// Raison : -
	//*********************************************************
class dblfc
{
	
	//$passwordphpmyadmin = sha1("mdp_secret$");
	
	//declaration des variables
	CONST HOST = "localhost";		//nom du pc
	CONST USER = "admin";			//utilisateur
	CONST PASSWORD = "mdp_secret$";	//mot de passe
	CONST DATABASE = "evaluation_des_modules";	//nom de la base de donnees
	
	private $objConnexion = null ; //L'objet de connexion
	
	// *******************************************************************
	// Nom   :	__construct
	// But   :	c'est le constructeur
	// Retour:	
	// Param.: 
	// *******************************************************************
	public function __construct()
	{
		$this->dbConnect();

	}//function __construct

	// *******************************************************************
	// Nom   :	__destruct
	// But   :	c'est le destructeur
	// Retour:	
	// Param.: 
	// *******************************************************************
	public function __destruct()
	{
		$this->dbUnconnect();

	}//function __destruct

	// *******************************************************************
	// Nom   :	dbConnect
	// But   :	Permet de se connecter a une base de donnees
	// Retour:	
	// Param.: 
	// *******************************************************************
	private function dbConnect()
	{
		$this->objConnexion = new mysqli(dblfc::HOST,dblfc::USER,dblfc::PASSWORD,dblfc::DATABASE);
		
	}//function dbConnect
	
	// *******************************************************************
	// Nom   :	dbUnconnect
	// But   :	Permet de se deconnecter a une base de donnees
	// Retour:	
	// Param.: 
	// *******************************************************************
	private function dbUnconnect()
	{
		$this->objConnexion->close();
		unset($this->objConnexion);
		
	}//function dbConnect
	
	// *******************************************************************
	// Nom   :	checkLoginFull
	// But   : 	Permet de verfifier si le login complet correspond
	// Retour:	
	// Param.: $strLogin->contient le login
	//		   $strPassword->mot de passe
	// *******************************************************************
	public function checkLoginFull($strLogin,$strPassword)
	{	
	
		//hash le mot de passe en sha1
		$strPassword=sha1($strPassword);
		
		//requete
		$strSqlRequest =     "SELECT id_enseignant,ens_prenom,ens_nom
							  FROM t_enseignant
							  WHERE ens_login = '$strLogin'
							  AND ens_password = '$strPassword'";
		
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function checkLoginFull
	
	// *******************************************************************
	// Nom   :	SelectData
	// But   : 	Récupère toutes les informations nécessaire selon le modèle
	// Retour:	
	// Param.: $idModele
	//		   
	// *******************************************************************
	public function  SelectData($idModele)
	{	
		
		$strSqlRequest = "SELECT idx_theme, the_contenu, idx_question, que_contenu, idx_avis, avi_contenu
						 FROM t_question_choix 
						 INNER JOIN t_question
						 ON t_question_choix.idx_question = t_question.id_question
						 INNER JOIN t_theme
						 ON t_question_choix.idx_theme = t_theme.id_theme
						 INNER JOIN t_avis
						 ON t_question_choix.idx_avis = t_avis.id_avis
						 INNER JOIN t_niveau
						 ON t_avis.idx_niveau = t_niveau.id_niveau
						 WHERE idx_modele = '$idModele'
						 ORDER BY $idModele,idx_theme,idx_question,id_niveau ASC";
						 					 		 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectData
		
	// *******************************************************************
	// Nom   :	SelectModule
	// But   : 	Récupère tous les modules
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectModule()
	{	
		
		$strSqlRequest = "SELECT id_module,modu_nom
						  FROM t_module";
						 		 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectModule
	
	// *******************************************************************
	// Nom   :	SelectQuestion
	// But   : 	Récupère toutes les questions
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectQuestion()
	{	
		
		$strSqlRequest = "SELECT id_question,que_contenu
						  FROM t_question";
						 		 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectQuestion
	
	// *******************************************************************
	// Nom   :	SelectTheme
	// But   : 	Récupère toutes les thèmes
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectTheme()
	{	
		
		$strSqlRequest = "SELECT id_theme,the_contenu
						  FROM t_theme";
						 		 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectTheme
	
	// *******************************************************************
	// Nom   :	SelectTheme
	// But   : 	Récupère toutes les avis
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectAvis()
	{	
		
		$strSqlRequest = "SELECT id_avis,avi_contenu
						  FROM t_avis";
						 		 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectTheme
	
	// *******************************************************************
	// Nom   :	SelectModele
	// But   : 	Récupère tous les modèles
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectModele()
	{	
		
		$strSqlRequest = "SELECT id_modele,mode_nom
						 FROM t_modele";
									 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectModule

	// *******************************************************************
	// Nom   :	SelectClasse
	// But   : 	Récupère toutes les classes
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectClasse()
	{	
		
		$strSqlRequest = "SELECT id_classe,clas_nom
						 FROM t_classe";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function  SelectClasse	
	
	// *******************************************************************
	// Nom   :	SelectEnseignant
	// But   : 	Récupère tous les enseignants
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectEnseignant()
	{	
		$strSqlRequest = "SELECT id_enseignant,ens_nom,ens_prenom
						 FROM t_enseignant";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);
		
	}//function  SelectEnseignant		
	
	// *******************************************************************
	// Nom   :	SelectAnnee
	// But   : 	Récupère toutes les annees
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectAnnee()
	{	
		$strSqlRequest = "SELECT id_annee,ann_nom
						 FROM t_annee";
							 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectAnnee
	
	// *******************************************************************
	// Nom   :	SelectQuestionAvis
	// But   : 	Récupère toutes les avis aux questions 
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectQuestionAvis($idfiche)
	{	
		
		$strSqlRequest = "SELECT idx_theme,idx_question,idx_avis 
						  FROM T_question_avis 
						  INNER JOIN t_lien
						  ON t_lien.id_lien = t_question_avis.idx_lien
						  INNER JOIN t_fiche
						  ON t_lien.idx_fiche = '$idfiche'";
						 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectQuestionAvis	
	
	// *******************************************************************
	// Nom   :	SelectQuestionChoix
	// But   : 	Récupère toutes les choix aux questions 
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectQuestionChoix($idmodele,$idtheme,$idquestion)
	{	
		
		$strSqlRequest = "SELECT idx_avis FROM T_question_choix WHERE idx_modele = '$idmodele' AND '$idtheme' = idx_theme AND idx_question = '$idquestion'";					 
						 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectQuestionChoix	
	
	// *******************************************************************
	// Nom   :	SelectLastIdFiche
	// But   : 	Récupère le dernier enregistrement
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectLastIdFiche()
	{	
		
		$strSqlRequest = " SELECT id_fiche FROM `t_fiche` ORDER BY `id_fiche` DESC LIMIT 1 ";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectLastIdFiche

	// *******************************************************************
	// Nom   :	SelectAllFiche
	// But   : 	Récupère tous les fiches
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectAllFiche($id_enseignant)
	{	
		
		$strSqlRequest = " SELECT clas_nom,modu_nom,ann_nom,id_fiche
						   FROM t_fiche
						   INNER JOIN t_module
						   ON t_fiche.idx_module = t_module.id_module
						   INNER JOIN t_classe
						   ON t_fiche.idx_classe = t_classe.id_classe
						   INNER JOIN t_annee
						   ON t_fiche.idx_annee = t_annee.id_annee
						   WHERE idx_enseignant = '$id_enseignant'
						   ORDER BY id_fiche
						   ";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectAllFiche		
	
	// *******************************************************************
	// Nom   :	SelectLastIdFiche
	// But   : 	SelectIDLien
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectIDLien($strrandom)
	{	
		
		$strSqlRequest = " SELECT id_lien FROM t_lien WHERE lie_random = '$strrandom'";
						 			 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectIDLien	
	
	// *******************************************************************
	// Nom   :	SelectFiche
	// But   : 	Récupère données fiches
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectFiche($strrandom)
	{	
		
	   //$strSqlRequest = "SELECT idx_modele,idx_module,idx_classe,idx_enseignant,idx_annee FROM t_fiche WHERE fich_random ='$strrandom' ";
	   $strSqlRequest = "SELECT id_fiche, mode_nom,idx_modele,modu_nom,idx_module,clas_nom,idx_classe,ens_prenom,ens_nom,idx_enseignant,ann_nom,idx_annee 
						 FROM t_fiche
						 INNER JOIN t_modele
						 ON t_fiche.idx_modele = t_modele.id_modele
						 INNER JOIN t_module
						 ON t_fiche.idx_module = t_module.id_module
						 INNER JOIN t_classe
						 ON t_fiche.idx_classe=  t_classe.id_classe
						 INNER JOIN t_enseignant
						 ON t_fiche.idx_enseignant = t_enseignant.id_enseignant
						 INNER JOIN t_annee
						 ON t_fiche.idx_annee = t_annee.id_annee
						 INNER JOIN t_lien
						 ON t_lien.idx_fiche = t_fiche.id_fiche
						 WHERE lie_random ='$strrandom'";
						 			 
						 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectAnnee	
	
	// *******************************************************************
	// Nom   :	SelectFicheWithID
	// But   : 	Récupère données fiches
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function  SelectFicheWithID($idfiche)
	{	
		
	   $strSqlRequest = "SELECT idx_enseignant,mode_nom
						 FROM t_fiche
						 INNER JOIN t_modele
						 ON t_fiche.idx_modele = t_modele.id_modele
						 WHERE id_fiche ='$idfiche'";
						 			 					 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectFicheWithID	
	
	// *******************************************************************
	// Nom   :	CreateFiche
	// But   : 	Permet de créer une nouvelle fiche
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function CreateFiche($idmodele,$idmodule,$idclasse,$idenseignant,$idannee)
	{	
		
		$strSqlRequest = "INSERT INTO t_fiche (idx_modele,idx_module,idx_classe,idx_enseignant,idx_annee) VALUES ('$idmodele','$idmodule','$idclasse','$idenseignant','$idannee')";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->blnRequest($strSqlRequest);

	}//function CreateFiche
	
	// *******************************************************************
	// Nom   :	CreateLien
	// But   : 	Permet de créer un nouveau lien pour un élève
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function CreateLien($idfiche,$strrandom,$valide)
	{	
		
		$strSqlRequest = "INSERT INTO t_lien (idx_fiche,lie_random,lie_valide) VALUES ('$idfiche','$strrandom','$valide')";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->blnRequest($strSqlRequest);

	}//function CreateLien
	
	// *******************************************************************
	// Nom   :	CloseLien
	// But   : 	Permet de fermer un lien
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function CloseLien($idlien)
	{	
		
		$strSqlRequest = "UPDATE t_lien SET lie_valide = 0 WHERE id_lien = '$idlien' ";				 
						 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->blnRequest($strSqlRequest);

	}//function CloseLien
	
	// *******************************************************************
	// Nom   :	AddAvis
	// But   : 	Permet d'ajouter son avis 
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function AddAvis($idlien,$idtheme,$idquestion,$idavis)
	{	
		
		$strSqlRequest = "INSERT INTO t_question_avis (idx_lien,idx_theme,idx_question,idx_avis) VALUES ('$idlien','$idtheme','$idquestion','$idavis')";
						 
						 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->blnRequest($strSqlRequest);

	}//function AddAvis
	
	// *******************************************************************
	// Nom   :	AddRemarques
	// But   : 	Permet d'ajouter des remarques
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function AddRemarques($idlien,$idtheme,$contenu)
	{	
		
		$strSqlRequest = "INSERT INTO t_commentaire (idx_lien,idx_theme,com_contenu) VALUES ('$idlien','$idtheme','$contenu')";
						 			 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->blnRequest($strSqlRequest);

	}//function AddRemarques

	// *******************************************************************
	// Nom   : ChechLienRandom
	// But   : Vérifie si le nombre générer aléatoirement ne s'y trouve pas déjà
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function ChechLienRandom($strrandom)
	{	
		
		$strSqlRequest = "SELECT COUNT(lie_random) FROM t_lien WHERE lie_random='$strrandom' AND lie_valide=1";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function ChechLienRandom

	// *******************************************************************
	// Nom   : SelectNiveauAvis
	// But   : Sélectionne le contenu et l'id du niveau du commentaire
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectNiveauAvis($idavis)
	{	
		$strSqlRequest = "SELECT avi_contenu,idx_niveau FROM t_avis WHERE id_avis = '$idavis'";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectNiveauAvis

	// *******************************************************************
	// Nom   : SelectContenuTheme
	// But   : Sélectionne le contenu du thème
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectContenuTheme($idtheme)
	{	
		$strSqlRequest = "SELECT the_contenu FROM t_theme WHERE id_theme= '$idtheme'";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectContenuTheme	

	// *******************************************************************
	// Nom   : SelectContenuQuestion
	// But   : Sélectionne le contenu de la question
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectContenuQuestion($idquestion)
	{	
		$strSqlRequest = "SELECT que_contenu FROM t_question WHERE id_question= '$idquestion'";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectContenuQuestion	

	// *******************************************************************
	// Nom   : SelectContenuRemarques
	// But   : Sélectionne les remarques 
	// Retour:	
	// Param.: 
	//		   
	// *******************************************************************
	public function SelectContenuRemarques($idfiche,$idtheme)
	{	
		$strSqlRequest = "SELECT com_contenu
						  FROM t_commentaire
						  INNER JOIN t_lien
						  ON t_commentaire.idx_lien = t_lien.id_lien
						  WHERE t_commentaire.idx_theme = '$idtheme' AND t_lien.idx_fiche = '$idfiche'";
						 				 
		//lancement de la requete et du retour du tableau de valeurs
		return $this->executeSqlRequest($strSqlRequest);

	}//function SelectContenuRemarques		
	
	// *******************************************************************
	// Nom   :	blnRequest
	// But   :	Permet d'executer une requete
	// Retour:  $orsRslt
	// Param.:  $strSQLRequest
	// *******************************************************************
	private function blnRequest($strSqlRequest)
	{
		$orsRslt = $this->objConnexion->query($strSqlRequest);
		
		//renvoie le resultat de la requete (booleen)
		return $orsRslt;
		
	}//blnRequest
	
	// *******************************************************************
	// Nom   :	executeSqlRequest
	// But   :	Permet d'executer une requete et de la transformer en tableau
	// Retour: $orsRslt
	// Param.: $strSQLRequest
	// *******************************************************************
	private function executeSqlRequest($strSQLRequest)
	{
		
		$orsRslt = $this->objConnexion->query($strSQLRequest);
		
		//permet de transformer les informations de la BD en tableau associatif
		$tab_crtRecord = mysqli_fetch_all($orsRslt);
		return $tab_crtRecord;

	}//function executeSqlRequest
	
	
}//class dblfc


?>