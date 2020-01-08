<?php

class Ctr_agence extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("agence", $action);
        $this->table="agence";
        $this->classTable = "Agence";
        $this->cle = "age_id";
		$a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "age_id";
		$result = Agence::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Agence($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Agence();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=agence");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Agence::supprimer("agence","age_id",$_GET["id"]);
		}
		header("location:index.php?m=agence");
	}
}

?>