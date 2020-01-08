<?php
class Ctr_profilgestionnaire extends Ctr_controleur {
	
	public function __construct($action) {
        parent::__construct("profilgestionnaire", $action);  
		$this->table="gestionnaire";
        $this->classTable = "Gestionnaire";
        $this->cle = "ges_id";
        $a = "a_$action";
        $this->$a();
    }	
	
	function a_index() {
		$result=Location::liste();
		require $this->gabarit;
	}
	
	function a_indexVehDispo() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "age_id";
		$result=Agence::listeVehDispo($_SESSION["ges_agence"],$tri);
		require $this->gabarit;
	}
	
	function a_indexLoc() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "loc_id";
		$result=Location::listeLoc($_SESSION["ges_agence"],$tri);
		require $this->gabarit;
	}
	
	function a_editLoc() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Location($id);
		extract($u->data);	
		require $this->gabarit;
	}
	
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Location();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
			header("profilgestionnaire:indexLoc.php?m=profilgestionnaire");
		
	}
	
	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Location::supprimer("profilgestionnaire","loc_id",$_GET["id"]);
		}
		header("profilgestionnaire:indexLoc.php?m=profilgestionnaire");
	}
}
?>