<?php

class Ctr_categorie extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("categorie", $action);
        $this->table="categorie";
        $this->classTable = "Categorie";
        $this->cle = "cat_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "cat_id";
		$result=Categorie::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Categorie($id);
		extract($u->data);	
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Categorie();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			if (is_uploaded_file($_FILES['monfichier']['tmp_name'])) {
				move_uploaded_file($_FILES['monfichier']['tmp_name'],"_images/categorie_" . $u->data["cat_id"] . ".jpg");
			}
		}
		header("location:index.php?m=categorie");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Categorie::supprimer("categorie","cat_id",$_GET["id"]);
		}
		header("location:index.php?m=categorie");
	}
}

?>