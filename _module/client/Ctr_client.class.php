<?php

class Ctr_client extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("client", $action);
        $this->table="client";
        $this->classTable = "Client";
        $this->cle = "cli_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$tri=(isset($_GET["tri"])) ? $_GET["tri"] : "cli_id";
		$result=Client::liste($tri);
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Client($id);
		extract($u->data);	
		//echo  $this->gabarit;
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$_POST["cli_mdp"]=password_hash($_POST["cli_mdp"], PASSWORD_DEFAULT);
			$u=new Client();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
			header("location:index.php?m=client");
	}

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Client::supprimer("client","cli_id",$_GET["id"]);
		}
		header("location:index.php?m=client");
	}
}

?>