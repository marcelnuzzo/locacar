<?php

class Ctr_tarif extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("tarif", $action);
        $this->table="tarif";
        $this->classTable = "Tarif";
        $this->cle = "tar_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "tar_id";
		$result=Tarif::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		if($id==0) {
			$u=new Tarif($id);
			extract($u->data);
			
		}
		else {
			$u=new Tarif(0);
			$row=$u->getData($id);
			extract($row);	
		}
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			if ($_POST["tar_id"]==0) {
				$u=new Tarif();
				$u->chargerDepuisTableau($_POST);
			} else {
				$u=new Tarif($_POST["tar_id"]);
				$u->data["tar_thj"]=$_POST["tar_thj"];
			}
			$u->sauver();
		}
		
		header("location:index.php?m=tarif");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Tarif::supprimer("tarif","tar_id",$_GET["id"]);
		}
		header("location:index.php?m=tarif");
	}
}

?>