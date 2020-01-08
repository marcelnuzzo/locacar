<?php

class Ctr_vehicule extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("vehicule", $action);
        $this->table="vehicule";
        $this->classTable = "Vehicule";
        $this->cle = "veh_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "veh_id";
		$result=Vehicule::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Vehicule($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Vehicule();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
		header("location:index.php?m=vehicule");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Vehicule::supprimer("vehicule","veh_id",$_GET["id"]);
		}
		header("location:index.php?m=vehicule");
	}
}

?>