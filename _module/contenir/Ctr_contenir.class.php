<?php

class Ctr_contenir extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("contenir", $action);
        $this->table="contenir";
        $this->classTable = "Contenir";
        $this->cle = "con_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "con_id";
		$result=Contenir::listecon($tri="con_id");
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Contenir($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Contenir();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=contenir");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Contenir::supprimer("contenir","con_id",$_GET["id"]);
		}
		header("location:index.php?m=contenir");
	}
}

?>