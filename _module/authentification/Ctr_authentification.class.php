<?php
class Ctr_authentification extends Ctr_controleur {
	public function __construct($action) {
        parent::__construct("authentification", $action,"modele_authentification.php");        
        $a = "a_$action";
        $this->$a();
    }
	
	function a_index()
	{		
		//traitement du formulaire
		if (isset($_POST["btSubmit"]))
		{
			extract($_POST);
			
				if ($row = Client::verification($cli_mail) ) 
				{	
					if (password_verify($_POST['cli_mdp'],  $row["cli_mdp"])) {							
						$_SESSION["cli_id"]=$row["cli_id"];
						$_SESSION["cli_mail"]=$row["cli_mail"];
						$_SESSION["cli_nom"]=$row["cli_nom"];
						$_SESSION["profil"]="client";
						header("location:" . hlien("accueil","index"));
					} 
					else
						header("location:" . hlien("authentification","index","para",1));	
				}
				else
					header("location:" . hlien("authentification","index","para",1));	
		}
		else 
			require $this->gabarit;		
	}
	
	function a_gestionnaire()
	{		
		//traitement du formulaire
		if (isset($_POST["btSubmit"]))
		{
			extract($_POST);
			
				if( $row=Gestionnaire::verification($ges_mail) ) 
				{
					//var_dump($row);
					//var_dump($_SESSION);
					if (password_verify($_POST['ges_mdp'], $row["ges_mdp"])) {
					$_SESSION["ges_id"]=$row["ges_id"];
					$_SESSION["ges_mail"]=$row["ges_mail"];
					$_SESSION["ges_mdp"]=$row["ges_mdp"];
					$_SESSION["profil"]=$row["ges_profil"];
					$_SESSION["ges_agence"]=$row["ges_agence"];
					header("location:" . hlien("accueil","index"));
					}
					else
						header("location:" . hlien("authentification","gestionnaire","para",1));	
				}
				else
					header("location:" . hlien("authentification","gestionnaire","para",1));	
		}
		else 
			require $this->gabarit;		
	}
	
	function a_deconnexion()
	{
		unset($_SESSION["cli_id"]);
		unset($_SESSION["ges_id"]);
		session_destroy();
		header("location:" . hlien("accueil","index"));
	}
	
}

?>