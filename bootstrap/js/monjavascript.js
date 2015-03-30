//*********************************************************
// Societe: ETML
// Auteur : Xavier Vaz Afonso
// Date   : 06.02.2015
// But    : Fonctions javascript
//			
//*********************************************************
// Modifications:
// Date   : 
// Auteur : 
// Raison : 
//          
//*********************************************************
// Date   :   
// Auteur :
// Raison :
//*********************************************************

					
$(function(){
	//Quand on change le modèle
	$("#modele").change(function(){
		
		values = $("#modele").val();
		showModel(this.value);	
	});
	
	//Quand on appuye sur le bouton modifier
	$("#modifier").click(function(){
		
		if(confirm("Entrer en mode édition ?"))
		{
			blnedit= true;	
		}//if
		else
		{
			blnedit = false;
		}//else
	});
});

//Déconnexion
function deconnexion()
{
	var blnDelConf= confirm("Êtes-vous sûr de vouloir vous déconnecter ?" );
	if(blnDelConf)
	{
		window.location.href="logout.php";
	}//if
	
}//deconnexion

	
//Appel le modele
function showModel(int_id_modele_tmp)
{
	var int_id_modele = int_id_modele_tmp;
		
	$.get("model.php?modelechoisi="+int_id_modele, function(data){
		$(".ajaxdiv").html(data);
		$('.ajaxdiv').hide().fadeIn(500);		
	});
}//showModel
	 

