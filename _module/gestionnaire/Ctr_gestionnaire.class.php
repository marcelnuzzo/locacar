<?php

class Ctr_gestionnaire extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("gestionnaire", $action);
        $this->table="gestionnaire";
        $this->classTable = "Gestionnaire";
        $this->cle = "ges_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "ges_id";
		$result=Gestionnaire::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Gestionnaire($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$_POST["ges_mdp"] = password_hash($_POST["ges_mdp"],PASSWORD_DEFAULT);
			 if ($_POST["ges_profil"] == "admin"or $_POST["ges_profil"] == "src"){
                $_POST["ges_agence"] = null;
                }	
			$u=new Gestionnaire();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
	
		header("location:index.php?m=gestionnaire");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Gestionnaire::supprimer("gestionnaire","ges_id",$_GET["id"]);
		}
		header("location:index.php?m=gestionnaire");
	}
}

?>