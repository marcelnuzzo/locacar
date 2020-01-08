<?php

class Ctr_plage_horaire extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("plage_horaire", $action);
        $this->table="plage_horaire";
        $this->classTable = "Plage_horaire";
        $this->cle = "pla_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "pla_id";
		$result=Plage_horaire::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Plage_horaire($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Plage_horaire();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=plage_horaire");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Plage_horaire::supprimer("plage_horaire","pla_id",$_GET["id"]);
		}
		header("location:index.php?m=plage_horaire");
	}
}

?>