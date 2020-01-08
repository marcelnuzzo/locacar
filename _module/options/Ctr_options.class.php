<?php

class Ctr_options extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("options", $action);
        $this->table="options";
        $this->classTable = "Options";
        $this->cle = "opt_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "opt_id";
		$result=Options::selectAll("options");
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Options($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Options();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=options");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Options::supprimer("options","opt_id",$_GET["id"]);
		}
		header("location:index.php?m=options");
	}
}

?>